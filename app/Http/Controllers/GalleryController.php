<?php

namespace app\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Response;

require_once 'DataSourceResult.php';
use MyNamespace\DataSourceResult; 


use app\products;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class wrapper
{
    public $total; //int
    public $data; //array(Datum)
}

class GalleryController extends BaseController
{
    public function is_image($path)
    {
        try
        {
       	 $a = getimagesize($path);
            $image_type = $a[2];
            
            if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
            {
                return true;
            }
        }
        catch (\Exception $exception)
        {
            return false;
        }                
    }


    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function getAdminPanelGalleries(Request $request, $crud = null , $arg = null)
    {
        if($crud == null)
            return ( view('frontend.AdminPanel.galleries'));

        $mainPath = "";

        $folder_ = $request->input('folder');


        $mainPath = config('settings.GalleryPath');

        switch ($crud)
        {
            case  "create" :      
                
                try
                {
                    $folder_ = $request->input('folder');
                    $title_ = $request->input('title');
                    
                    $AbsolutePath = base_path().$mainPath.$folder_;
                    
                    mkdir($AbsolutePath, 0744);
                    
                    $title_path = $AbsolutePath.'/'.'.title';
                    
                    $fp = fopen($title_path, 'w');
                    fwrite($fp,$title_);
                    fclose($fp);
                }
                catch (\Exception $exception)
                {
                    return response($exception->getMessage() ,400)->header('Content-Type', 'text/plain');
                }
                
                return response('ResultOK' ,200)->header('Content-Type', 'text/plain');

            case  "read" :               
                $folder_ = $request->input('folder');

                $path_ = $request->input('path');
                $AbsolutePath = base_path().$mainPath.$path_.'/'.$folder_;
                
                $files = scandir($AbsolutePath);	

                $arrlength = count($files);

                $retObj = array();

                for($index = 2; $index  < $arrlength; $index++) 
                {	
                    try
                    {
                        $_name  = $files[$index];
                        
                        $AbsolutePath = base_path().$mainPath.$path_;	
                        
                        if(!is_file ( $AbsolutePath))                        
                        { 
                            $title_path = $AbsolutePath.$_name.'/'.'.title';
                            $title = "new Title";
                            
                            
                            if(file_exists($title_path))
                            {
                                $fp = fopen($title_path, 'r');
                                $title = fread($fp , filesize($title_path));
                                fclose($fp);
                            }                        
                            else                        
                            {
                                $fp = fopen($title_path, 'w');
                                fwrite($fp,$title);
                                fclose($fp);
                            }
                            
                            $retObj[] = array("title" => $title , "url" => $_name );                                     
                        }
                    }
                    catch (\Exception $exception)
                    {
                    }                                        
                }
                
                //$rec = ' [{ "title": "page1", "url": "http://www.google.com" }, { "title" : "page2", "url" : "http://www.yahoo.com" }] ';

                $rec = json_encode($retObj, JSON_NUMERIC_CHECK);  
                
                echo $rec;
                exit;

            case  "update" :       
                
                try
                {
                    $folder_ = $request->input('folder');
                    $title_ = $request->input('title');
                    $oldFolderName = $request->input('oldFolderName');
                    
                    $AbsolutePath = base_path().$mainPath.$folder_;

                    $AbsolutePath_old = base_path().$mainPath.$oldFolderName;
                    
                    rename($AbsolutePath_old, $AbsolutePath);
                    
                    $title_path = $AbsolutePath.'/'.'.title';
                    
                    $fp = fopen($title_path, 'w');
                    fwrite($fp,$title_);
                    fclose($fp);
                }
                catch (\Exception $exception)
                {
                    return response($exception->getMessage() ,400)->header('Content-Type', 'text/plain');
                }
                
                return response('ResultOK' ,200)->header('Content-Type', 'text/plain');


            case  "destroy" :

                try
                {
            	    $pth = '';

                    $path_ = $request->input('path');
                    
                    if($folder_ == null)
                        $pth = base_path().$mainPath.$path_;
                    else
                        $pth = base_path().$mainPath.$path_.$folder_.'/';
                    
                    File::deleteDirectory($pth, false);
                    
                    return response('ResultOK' ,200)->header('Content-Type', 'text/plain');
                }
                catch (\Exception $exception)
                {
                    return response($exception->getMessage() ,400)->header('Content-Type', 'text/plain');
                }
            
            case "thumbnail" :

                $file_ = $request->input('path');

                $path_ = base_path().$GalleryPath.$file_ ;

                $image = Image::make($path_);

                $sert = $image->fit(70, 70);

                return $sert->response();
            default:
                return ( view('frontend.AdminPanel.products'));
        }


        
        
    }    

    public function getGalleryPages(Request $request)
    {
        $folder = $request->input('name');
        $thumbnail = $request->input('thumbnail');

        if($thumbnail != null)
        {
            return $this->getThumbnail($thumbnail,$folder);
        }
        else
        {
            $ImageList = $this->getImagesName($folder);

            return view('frontend.Home.gallery')->with('ImageList' , $ImageList)->with('folder',$folder);       
        }
    }      
    
    public function getImagesName($folder)
    {
        $mainPath = config('settings.GalleryPath');

        $AbsolutePath = base_path().$mainPath.'/'.$folder;
        
        $files = scandir($AbsolutePath);	

        $arrlength = count($files);

        $retObj = array();

        for($index = 2; $index  < $arrlength; $index++) 
        {	
            $_name  = $files[$index];

            $AbsolutePath ='';
            
            if($folder == null)
                $AbsolutePath = base_path().$mainPath.$_name;
            else
                $AbsolutePath = base_path().$mainPath.$folder.'/'.$_name;
            
            if(is_file ( $AbsolutePath))                        
            {                        
                if($this->is_image($AbsolutePath))
                {                            
                    $retObj[] = array("name" => $_name ); 
                }                                                
            }                   
        }

        return $retObj;
    }


    public function getThumbnail($FileName , $FolderName)
    {
        $mainPath = config('settings.GalleryPath');

        $path_ = base_path().$mainPath.$FolderName.'/'.$FileName;

        $image = Image::make($path_);

        $sert = $image->fit(150, 150);

        return $sert->response();
    }
}


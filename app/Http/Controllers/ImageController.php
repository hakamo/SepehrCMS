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

class ImageController extends BaseController
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
        
        return false;
    }


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdminPanelImages(Request $request, $crud = null , $arg = null)
    {
        if($crud == null)
            return ( view('frontend.AdminPanel.pages'));

        $mainPath = "";

        $folder_ = $request->input('folder');

        if($arg == null)
            $mainPath = config('settings.UploadPath');
        else
            $mainPath = config('settings.GalleryPath');

        switch ($crud)
        {
            case  "createDirectory" :                                        
                $folder_ = $request->input('name');
                $path_ = $request->input('path');
                //$path_ = str_replace('/', '\\', $path_);
                $path_ = base_path().$mainPath.$path_.$folder_;
                mkdir($path_, 0744);
                exit;

            case  "read" :
               

                $path_ = $request->input('path');
                $AbsolutePath = base_path().$mainPath.$path_.'/'.$folder_;
                
                $files = scandir($AbsolutePath);	

                $arrlength = count($files);

                $retObj = array();

                for($index = 2; $index  < $arrlength; $index++) 
                {	
                    $_name  = $files[$index];

                    $AbsolutePath ='';
                    
                    if($folder_ == null)
                        $AbsolutePath = base_path().$mainPath.$path_.$_name;
                    else
                        $AbsolutePath = base_path().$mainPath.$path_.$folder_.'/'.$_name;
                    
                    if(is_file ( $AbsolutePath))                        
                    {                        
                        if($this->is_image($AbsolutePath))
                        {                            
                            $_size = filesize ($AbsolutePath);
                            $retObj[] = array("name" => $_name , "type" => "f" , "size" => $_size); 
                        }                                                
                    }
                    else
                        $retObj[] = array("name" => $_name , "type" => "d" , "size" => 0);                     
                }
                
                $resWrap = new wrapper();

                $resWrap->data = array( $retObj);

                $rec = json_encode($retObj, JSON_NUMERIC_CHECK);  
                
                echo $rec;
                exit;

            case  "upload" :       
                $file = Input::file('file');
                $retString ='';


                if($file != null)
                {                    
                    $name = $file->getClientOriginalName();
                    $size = $file->getSize();

                    /*
                    //Display File Name
                    echo 'File Name: '.$file->getClientOriginalName();
                    echo '<br>';
                    
                    //Display File Extension
                    echo 'File Extension: '.$file->getClientOriginalExtension();
                    echo '<br>';
                    
                    //Display File Real Path
                    echo 'File Real Path: '.$file->getRealPath();
                    echo '<br>';
                    
                    //Display File Size
                    echo 'File Size: '.$file->getSize();
                    echo '<br>';
                    
                    //Display File Mime Type
                    echo 'File Mime Type: '.$file->getMimeType();
                     */

                    //Move Uploaded File

                    $path_ = $request->input('path');

                   // $path_ = str_replace('/', '\\', $path_);

                    $destinationPath =  base_path() . $mainPath.$path_.'/'.$folder_;

                    $file->move($destinationPath,$file->getClientOriginalName());

                    //{ "name": "foo.png", "type": "f", "size": 12345 }

                    $retString = '{ "name": "'.$name .'" , "type": "f" , "size" :'.$size.'}';

                    
                }                               
                echo $retString;
                exit;

            case  "destroy" :


                $name_ = $request->input('name');
                $path_ = $request->input('path');

                $type_ = $request->input('type');
                $size_ = $request->input('size');

                $success = "";

                $pth = '';

                if($folder_ == null)
                    $pth = base_path().$mainPath.$path_.$name_;
                else
                    $pth = base_path().$mainPath.$path_.$folder_.'/'.$name_;

                if($type_ == "f")
                {                   
                    File::delete($pth);
                }

                if($type_ == "d")
                {
                    $success = File::deleteDirectory($pth, false);
                }

                exit;

            case "thumbnail" :

                $file_ = $request->input('path');
                $path_ = '';

                if($folder_ != null)
                    $path_ = base_path().$mainPath.$folder_.'/'.$file_;
                else
                    $path_ = base_path().$mainPath.$file_.$folder_;


                $image = Image::make($path_);

                $sert = $image->fit(70, 70);

                return $sert->response();
            default:
                return ( view('frontend.AdminPanel.products'));
        }              
    }         
}


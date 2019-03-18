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


use app\pages;
use Illuminate\Database\Eloquent\Model;
use View;


class wrapper
{
    public $total; //int
    public $data; //array(Datum)
}

class PageController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdminPanelPages(Request $request, $language = null, $crud = null )
    {
        if($crud == null)
            return ( view('frontend.AdminPanel.pages'));

        switch ($crud)
        {
            case  "create" :                        
                try
                {
                    $slug_ = $request->input('slug');
                    $title_ = $request->input('title');                    
                    
                    $action = new  \App\page();

                    $action->title =  $title_;
                    $action->slug = $slug_;
                    $action->content = "";
                    $action->language = $language;

                    $result = $action->save();

                    //read saved record with Id
                    $k = $action->getAttributes();
                    
                    $rec = json_encode($k, JSON_NUMERIC_CHECK);    
                    
                    echo $rec;
                    exit;
                }
                catch (\Exception $exception)
                {
                    return response($exception->getMessage() ,400)->header('Content-Type', 'text/plain');
                }
            
            //return response('ResultOK' ,200)->header('Content-Type', 'text/plain');

            case  "read" :           

                $retObj = array();

                $action = new  \App\page();

                $result  = $action::where('language', 'LIKE', $language)->get();

                for($index = 0; $index  < $result->count(); $index++) 
                {	
                    try
                    {                        
                        $retObj[] = array("id" => $result[$index]->id, "title" => $result[$index]->title , "slug" => $result[$index]->slug  );                                                             
                    }
                    catch (\Exception $exception)
                    {
                    }                                        
                }                

                $rec = json_encode($retObj, JSON_NUMERIC_CHECK);                  
                echo $rec;
                exit;


            case  "update" :                                      
                
                try
                {
	                $slug_ = $request->input('slug');
                    $title_ = $request->input('title');   
                    $id_ = $request->input('id');   

                    $action  = \App\page::find($id_);

                    $action->title = $title_;
                    $action->slug = $slug_;

                    $result = $action->update();
                }
                catch (\Exception $exception)
                {
                    return response($exception->getMessage() ,400)->header('Content-Type', 'text/plain');
                }
                
                return response('ResultOK' ,200)->header('Content-Type', 'text/plain');
            
            case  "destroy" :
                try
                {
	                $id_ = $request->input('id');                 
                    $action  = \App\page::find($id_);

                    if($action != null)
                        $result = $action->delete();  
                }
                catch (\Exception $exception)
                {
                    return response($exception->getMessage() ,400)->header('Content-Type', 'text/plain');
                }
                
                return response('ResultOK' ,200)->header('Content-Type', 'text/plain');       

            case "updateContent" :
                
                try
                {	                
                    $content_ = $request->getContent();

                    //$content_= urlencode ($content_);

                    $id_ = $request->input('id');   

                    $action  = \App\page::find($id_);
                    
                    $action->content = $content_;

                    $result = $action->update();

                    return response(json_encode(array('foo' => 'bar')) ,200)->header('Content-Type', 'application/json; charset=utf-8');

                }
                catch (\Exception $exception)
                {
                    return response($exception->getMessage() ,400)->header('Content-Type', 'application/json; charset=utf-8');
                }
            
            case "readContent" :

                try
                {	                 
                    $id_ = $request->input('id');   

                    $action  = \App\page::find($id_);

                    $rec = json_encode($action->content, JSON_NUMERIC_CHECK);    
                    
                    $res = $action->content;

                    echo $res;


                    exit;
                }
                catch (\Exception $exception)
                {
                    return response($exception->getMessage() ,400)->header('Content-Type', 'text/plain');
                }

            case "view" :
                return (View::make('frontend.AdminPanel.pagesTable')->with('language', $language)->with('uid' , uniqid()));

            default:
                return ( view('frontend.AdminPanel.products'));
        }        
    } 
       
}


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

use View;
use constants;

class wrapper
{
    public $total; //int
    public $data; //array(Datum)
}
/**
 * SlideController short summary.
 *
 * SlideController description.
 *
 * @version 1.0
 * @author Admin
 */
class SlideController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdminPanelSlides(Request $request,$language = null, $crud = null )
    {
        if($crud == null)
            return ( view('frontend.AdminPanel.slides'));

        switch ($crud)
        {
            case  "create" :                
                $action = new  \App\Slide();
                $queryStr = json_decode( urldecode($request->getQueryString()));

                $action->ButtonTitle =  $queryStr->ButtonTitle;
                $action->Description = $queryStr->Description;
                $action->FilePath = $queryStr->FilePath;
                $action->Title = $queryStr->Title;
                $action->itemUrl = $queryStr->itemUrl;
                $action->language = $language;

                $result = $action->save();

                $k = $action->getAttributes();
                
                $resWrap = new wrapper();
                $resWrap->data = array( $k);
                $rec = json_encode($resWrap, JSON_NUMERIC_CHECK);               
                echo $rec;
                exit;

            case  "read" :


                //ãËÇá ÈÑÇ? ÍÇáÊ ? Ï? Çæ
                /*
                header('Access-Control-Allow-Origin: *');                  
                header('Content-Type: application/json');                
                Response::header('Access-Control-Allow-Origin' , '*');
                Response::header('Content-Type', 'application/json');                
                $request = json_decode(file_get_contents('php://input'));                                                            
                $result = new DataSourceResult('mysql:host=hakamo-lap;dbname=petbazke_laravel; charset=utf8', 'admin', '1234567aA');                
                $columns = array('id','product_title','product_description','product_page_url','product_picture_url');	                                               
                $result = $result->read('products', $columns, $request);                
                $rec = json_encode($result, JSON_NUMERIC_CHECK);
                 */

                $action = new  \App\Slide();
                //$result  =  $action::all();
                $result  = $action::where('language', 'LIKE', $language)->get();

                $resWrap = new wrapper();
                $resWrap->data = $result;
                $resWrap->total = $result->count();
                $rec = json_encode($resWrap, JSON_NUMERIC_CHECK);
                echo $rec;                
                exit;

            case  "update" :                                      
                $queryStr = json_decode( urldecode($request->getQueryString()));    
                
                $action  = \App\Slide::find($queryStr->id);

                $action->ButtonTitle =  $queryStr->ButtonTitle;
                $action->Description = $queryStr->Description;
                $action->FilePath = $queryStr->FilePath;
                $action->Title = $queryStr->Title;
                $action->itemUrl = $queryStr->itemUrl;
                $action->language = $language;

                $result = $action->update();
                
                $k = $action->getAttributes();                
                $resWrap = new wrapper();
                $resWrap->data = array( $k);
                $rec = json_encode($resWrap, JSON_NUMERIC_CHECK);               
                echo $rec;
                exit;

            case  "destroy" :
                $queryStr = json_decode( urldecode($request->getQueryString()));    
                
                $_slide  = \App\Slide::find($queryStr->id);
                $result = $_slide->delete();
                
                $k = $_slide->getAttributes();                
                $resWrap = new wrapper();
                $resWrap->data = array( $k);
                $rec = json_encode($resWrap, JSON_NUMERIC_CHECK);               
                echo $rec;
                exit;
            case "view" :
                return (View::make('frontend.AdminPanel.slidesTable')->with('language', $language));



            default:
                return ( view('frontend.AdminPanel.products'));
        }
        
    }         
}


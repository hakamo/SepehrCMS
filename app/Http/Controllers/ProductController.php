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

//$GLOBALS['languages']  = array(
//                         array("English",'en'),
//                         array("Farsi",'fa'),
//                         array("Turkish",'tr'),   
//                         array("France",'fr'),    
//                     );

class wrapper
{
    public $total; //int
    public $data; //array(Datum)
}

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');                     
    }

    public function getAdminPanelProducts(Request $request, $language = null, $crud = null )
    {
        if($crud == null)
            return ( view('frontend.AdminPanel.products'));

        switch ($crud)
        {
            case  "create" :                
                $action = new  \App\products();
                $queryStr = json_decode( urldecode($request->getQueryString()));

                $action->product_title =  $queryStr->product_title;
                $action->product_description = $queryStr->product_description;
                $action->product_page_url = $queryStr->product_page_url;
                $action->product_picture_url = $queryStr->product_picture_url;
                $action->language = $language;

                $result = $action->save();

                //read saved record with Id
                $k = $action->getAttributes();
                                   
                $resWrap = new wrapper();
                $resWrap->data = array( $k);
                $rec = json_encode($resWrap, JSON_NUMERIC_CHECK);    
                
                echo $rec;

                exit;

            case  "read" :

                //Ž
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

                $action = new  \App\products();
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
                
                $_product  = \App\products::find($queryStr->id);
                $_product->product_title =  $queryStr->product_title;
                $_product->product_description = $queryStr->product_description;
                $_product->product_page_url = $queryStr->product_page_url;
                $_product->product_picture_url = $queryStr->product_picture_url;
                $_product->language = $language;

                $result = $_product->update();
                
                $k = $_product->getAttributes();                
                $resWrap = new wrapper();
                $resWrap->data = array( $k);
                $rec = json_encode($resWrap, JSON_NUMERIC_CHECK);               
                echo $rec;
                exit;

            case  "destroy" :
                $queryStr = json_decode( urldecode($request->getQueryString()));    
                
                $_product  = \App\products::find($queryStr->id);
                $result = $_product->delete();
                
                $k = $_product->getAttributes();                
                $resWrap = new wrapper();
                $resWrap->data = array( $k);
                $rec = json_encode($resWrap, JSON_NUMERIC_CHECK);               
                echo $rec;
                exit;
            case "view" :
                return (View::make('frontend.AdminPanel.productsTable')->with('language', $language));

        	default:
                return ( view('frontend.AdminPanel.products'));
        }
        
    }         
}


?>
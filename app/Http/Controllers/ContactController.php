<?php

namespace app\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Response;

use app\contact;
use Illuminate\Database\Eloquent\Model;
use View;

class wrapper
{
    public $total; //int
    public $data; //array(Datum)
}

class ContactController extends BaseController
{
    public function __construct()
    {
        //$this->middleware('auth');                     
    }

    public function getAdminPanelContacts(Request $request, $crud = null )
    {
        if($crud == null)
            return ( view('frontend.AdminPanel.contacts'));

        switch ($crud)
        {

            //$table->mediumText('message');    
            //$table->string('name');
            //$table->string('email');
            //$table->string('phoneNumber');


            case  "create" :                
                $action = new  \App\contact();
                $queryStr = json_decode( urldecode($request->getQueryString()));

                $action->message =  $queryStr->message;
                $action->name = $queryStr->name;
                $action->email = $queryStr->email;
                $action->phoneNumber = $queryStr->phoneNumber;

                $result = $action->save();

                //read saved record with Id
                $k = $action->getAttributes();
                
                $resWrap = new wrapper();
                $resWrap->data = array( $k);
                $rec = json_encode($resWrap, JSON_NUMERIC_CHECK);    
                
                echo $rec;

                exit;

            case  "read" :

                $action = new  \App\contact();
                $result  =  $action::all();

                $resWrap = new wrapper();
                $resWrap->data = $result;
                $resWrap->total = $result->count();
                $rec = json_encode($resWrap, JSON_NUMERIC_CHECK);

                echo $rec;                
                exit;

            case  "update" :                                      
                $queryStr = json_decode( urldecode($request->getQueryString()));    
                
                $action  = \App\contact::find($queryStr->id);
                $action->message =  $queryStr->message;
                $action->name = $queryStr->name;
                $action->email = $queryStr->email;
                $action->phoneNumber = $queryStr->phoneNumber;

                $result = $action->update();
                
                $k = $action->getAttributes();                
                $resWrap = new wrapper();
                $resWrap->data = array( $k);
                $rec = json_encode($resWrap, JSON_NUMERIC_CHECK);               
                echo $rec;
                exit;

            case  "destroy" :
                $queryStr = json_decode( urldecode($request->getQueryString()));    
                
                $action  = \App\contact::find($queryStr->id);
                $result = $action->delete();
                
                $k = $action->getAttributes();                
                $resWrap = new wrapper();
                $resWrap->data = array( $k);
                $rec = json_encode($resWrap, JSON_NUMERIC_CHECK);               
                echo $rec;
                exit;

            case "view" :
                return (View::make('frontend.AdminPanel.contacts'));

        	default:
                return (View::make('frontend.AdminPanel.contacts'));
        }
        
    }   
    
    public function MakeContact(Request $request)
    {               
        try
        {
            $code = $request->session()->get('code');
            $captcha =  $request->input('captcha');

            if($captcha == null || $code == null || $code!= $captcha ) 
                return response("Captcha is incorrect" ,400)->header('Content-Type', 'text/plain');       

            $action = new  \App\contact();
            
            $action->message =  $request->input('message');
            $action->name = $request->input('name');
            $action->email = $request->input('email');
            $action->phoneNumber = $request->input('phoneNumber');
            
            $result = $action->save();  
            
            return response("Message saved" ,200)->header('Content-Type', 'text/plain'); 
        }
        catch (\Exception $exception)
        {
            //return response($exception->getMessage() ,400)->header('Content-Type', 'text/plain'); 
            return response("Error occured" ,400)->header('Content-Type', 'text/plain'); 
        }                       
    }
}


?>
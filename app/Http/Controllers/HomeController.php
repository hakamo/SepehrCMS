<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use app\menues;
use app\Slide;

use Illuminate\Database\Eloquent\Model;
use View;

require_once(__DIR__.'/Admin/CommonClass.php');

use app\Http\Controllers\Admin\SysParamsCode;

class HomeController extends Controller
{
    var $menuItems = array();

    var $retObj;// = array();

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');        
    }

    public function get_menu_Items($language = null)
    {
        $action = new  \App\menu();

        $result  = $action::where('language', 'LIKE', $language)
                        ->orderBy('linkId','ASC')
                        ->orderBy('index','ASC')  
                        ->get(['id', 'title','url','parentId' , 'index' , 'linkId']);
        
        return $result->toArray();
    }

    public function get_configuration_Items($language = null)
    {
        $result  = \App\SysParam::where('GroupCode',SysParamsCode::Configuration)->where('language' , $language)->get();
        
        $retObj = array();

        foreach ($result as $value)
        {
            switch ($value->Key_Name)
            {
                case 'SiteName' :
                    $retObj["SiteName"] = $value->Key_Val;
                    break;
                case 'OwnerName' :
                    $retObj["OwnerName"] = $value->Key_Val;
                    break;
                case 'SiteSlogan' :
                    $retObj["SiteSlogan"] = $value->Key_Val;
                    break;
                case 'SiteSubject' :
                    $retObj["SiteSubject"] = $value->Key_Val;
                    break;
                case 'SiteSEOtag' :
                    $retObj["SiteSEOtag"] = $value->Key_Val;
                    break;
                default:

            }                            
        }

        return $retObj;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language = null)
    {       
        if($language === null)
            return redirect('home/fa');

        //----------menue items-------------------
        //$action = new  \App\menu();

        //$result  = $action::where('language', 'LIKE', $language)
        //    ->orderBy('linkId','ASC')
        //    ->orderBy('index','ASC')  
        //    ->get(['id', 'title','url','parentId' , 'index' , 'linkId']);
        
        $menuItems = $this->get_menu_Items($language);

        //--------------Slide Items-------------------
        $action = new  \App\Slide();        
        $result  = $action::where('language', 'LIKE', $language)->get();
        $slideItems = $result->toArray();


        //--------------Products Items----------------

        $action = new  \App\products();

        $result  = $action::where('language', 'LIKE', $language)->get();

        $productItems = $result->toArray();

        //--------------Configurations Items----------------

        $configuration = $this->get_configuration_Items($language);
        
        return view('frontend.Home.main')->with('menues',new MenuGenerator($menuItems))
                                         ->with('slides',new SlideGenerator($slideItems))
                                         ->with('products',new ProductGenerator($productItems))
                                         ->with('language' , $language)
                                         ->with('configuration' , $configuration);
    }

    public function getPages(Request $request, $language = null, $id = null ,$slug = null)
    {
        try
        {
            $action  = \App\page::find($id);
            $title_ = $action->title;            
            $content_ = $action->content;
            $menuItems = $this->get_menu_Items($language);
            $configuration = $this->get_configuration_Items($language);

            return view('frontend.Home.page')->with('menues',new MenuGenerator($menuItems))
                                             ->with('title', $title_)
                                             ->with('content' , $content_)
                                             ->with('language' , $language)
                                             ->with('configuration' , $configuration);
        }
        catch (\Exception $exception)
        {
            return response($exception->getMessage() ,400)->header('Content-Type', 'text/plain');
        }                
    }

    public function searchtPages(Request $request)
    {
        try
        {
            $language = $request->input('language');
            $search_value =  $request->input('search-value');
            
            $action = new  \App\page();

            $result  = $action::where('language', 'LIKE', $language)->get();

            for($index = 0; $index  < $result->count(); $index++) 
            {	
                try
                {                                                                                 
                    $content = urldecode ( $result[$index]->content);

                    $contents = preg_replace('#<[^>]+>#', ' ',$content);

                    $pattern = preg_quote($search_value, '/');

                    // finalise the regular expression, matching the whole line
                    $pattern = "/^.*$pattern.*\$/m";

                    // search, and store all matching occurences in $matches
                    if(preg_match_all($pattern, $contents, $matches))
                    { 
                        $retObj[$index][0] = substr(strip_tags($contents),0,200);    
                        $retObj[$index][1] = route('cms.Pages')."/".$language."/".$result[$index]->id."/".$result[$index]->slug."/";
                    }
                }
                catch (\Exception $exception)
                {
                }                                        
            }                

            if(!isset($retObj))    
                $retObj= array();
            
            $menuItems = $this->get_menu_Items($language);

            $configuration = $this->get_configuration_Items($language);

            return view('frontend.Home.search')->with('menues',new MenuGenerator($menuItems))
                                                ->with('title', $search_value)
                                                ->with('items' , $retObj)
                                                ->with('language' , $language)
                                                ->with('configuration' , $configuration);
        }
        catch (\Exception $exception)
        {
            return response($exception->getMessage() ,400)->header('Content-Type', 'text/plain');
        }                    
    }

    public function getCaptcha(Request $request)
    {
        #######################################################################
        #				PHP Simple Captcha Script
        #	Script Url: http://toolspot.org/php-simple-captcha.php
        #	Author: Sunny Verma
        #	Website: http://toolspot.org
        #	License: GPL 2.0, @see http://www.gnu.org/licenses/gpl-2.0.html
        ########################################################################
        //session_start();
        $code=rand(1000,9999);
        //$_SESSION["code"]=$code;

        $request->session()->put('code', $code);

        $im = imagecreatetruecolor(50, 24);
        $bg = imagecolorallocate($im, 22, 86, 165);
        $fg = imagecolorallocate($im, 255, 255, 255);
        imagefill($im, 0, 0, $bg);
        imagestring($im, 5, 5, 5,  $code, $fg);
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);
    }
    
}

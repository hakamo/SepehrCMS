<?php

namespace app\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Response;

use Illuminate\Database\Eloquent\Model;
use View;

//use app\Http\Controllers\SysParamsCode as sysParam ;

require_once('CommonClass.php');


class ConfigurationController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getConfigurationView(Request $request, $language = null, $crud = null )
    {
        if($crud == null)
            return ( view('frontend.AdminPanel.configuration'));


        $retObj = array();

        switch ($crud)
        {
            case  "MainConfiguration" :                     
                return (View::make('frontend.AdminPanel.configurationMain')->with('language', $language)->with('uid' , uniqid()));

            case "read" :
                {
                    $result  = \App\SysParam::where('GroupCode',SysParamsCode::Configuration)
                                              ->where('language' , $language)->get();
                    
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
                    
                    $rec = json_encode($retObj, JSON_NUMERIC_CHECK);                      
                    echo $rec;
                    exit;                    
                }

            case "update" :
                { 
                    $SiteName = $request->input('SiteName');
                    $OwnerName = $request->input('OwnerName');
                    $SiteSlogan = $request->input('SiteSlogan');
                    $SiteSubject = $request->input('SiteSubject');
                    $SiteSEOtag = $request->input('SiteSEOtag');
                    
                    $result  = \App\SysParam::where('GroupCode',SysParamsCode::Configuration)
                                            ->where('language' , $language)->get();
                    
                    //in case of add new language and we dont have any record for that
                    if($result->count() <= 0)
                    {
                            $this->addRecord(SysParamsCode::Configuration,'Configuration' , 'SiteName' ,$SiteName ,$language);
                            $this->addRecord(SysParamsCode::Configuration,'Configuration' , 'OwnerName' ,$OwnerName ,$language);
                            $this->addRecord(SysParamsCode::Configuration,'Configuration' , 'SiteSlogan' ,$SiteSlogan ,$language);
                            $this->addRecord(SysParamsCode::Configuration,'Configuration' , 'SiteSubject' ,$SiteSubject ,$language);
                            $this->addRecord(SysParamsCode::Configuration,'Configuration' , 'SiteSEOtag' ,$SiteSEOtag ,$language);                                                       
                        }

                    foreach ($result as $value)
                    {
                        switch ($value->Key_Name)
                        {
                            case 'SiteName' :
                                $this->updateRecord($value , $SiteName);
                                break;
                            case 'OwnerName' :
                                $this->updateRecord($value , $OwnerName);
                                break;
                            case 'SiteSlogan' :
                                $this->updateRecord($value , $SiteSlogan);
                                break;
                            case 'SiteSubject' :
                                $this->updateRecord($value , $SiteSubject);
                                break;
                            case 'SiteSEOtag' :
                                $this->updateRecord($value , $SiteSEOtag);
                                break;
                            default:
                        }                            
                    }                   

                    break;                
                }

            default:
                return ( view('frontend.AdminPanel.configuration'));
        }        
    }

    public function updateRecord($value , $newValue)
    {
        $action  = \App\SysParam::find($value->id);
        $action->Key_Val = $newValue;
        $action->update();
    }

    public function addRecord($GroupCode , $Group_Name , $Key_Name , $Key_Val , $language)
    {                       
        $action = new  \App\SysParam();

        $action->GroupCode = $GroupCode;
        $action->Group_Name = $Group_Name;
        $action->Key_Name = $Key_Name;
        $action->Key_Val = $Key_Val;
        $action->language = $language;

        $action->save();   
    }
    
}


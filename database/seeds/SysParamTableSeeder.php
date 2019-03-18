<?php

use Illuminate\Database\Seeder;

require_once(__DIR__.'/../../app/Http/Controllers/Admin/CommonClass.php');

use app\Http\Controllers\Admin\SysParamsCode;

class SysParamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = new \App\SysParam();
        $record->GroupCode = SysParamsCode::Configuration;
        $record->Group_Name ='Configuration';
        $record->Key_Name = 'SiteName';
        $record->Key_Val =  'نام سایت';
        $record->language = 'fa';
        $record->save();

        //-----------------------

        $record = new \App\SysParam();
        $record->GroupCode = SysParamsCode::Configuration;
        $record->Group_Name ='Configuration';
        $record->Key_Name = 'OwnerName';
        $record->Key_Val =  'نام مالک سایت';
        $record->language = 'fa';
        $record->save();

        //------------------------

        $record = new \App\SysParam();
        $record->GroupCode = SysParamsCode::Configuration;
        $record->Group_Name ='Configuration';
        $record->Key_Name = 'SiteSlogan';
        $record->Key_Val =  'شعار سایت';
        $record->language = 'fa';
        $record->save();

        //------------------------

        $record = new \App\SysParam();
        $record->GroupCode = SysParamsCode::Configuration;
        $record->Group_Name ='Configuration';
        $record->Key_Name = 'SiteSubject';
        $record->Key_Val =  'عنوان سایت';
        $record->language = 'fa';
        $record->save();

        //------------------------

        $record = new \App\SysParam();
        $record->GroupCode = SysParamsCode::Configuration;
        $record->Group_Name ='Configuration';
        $record->Key_Name = 'SiteSEOtag';
        $record->Key_Val =  'تگ های سئو';
        $record->language = 'fa';
        $record->save();

    }
}

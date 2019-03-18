<?php

namespace app\Http\Controllers\Admin;


class wrapper
{
    public $total; //int
    public $data; //array(Datum)
}


abstract class SysParamsCode
{
    const Configuration = 100;
    const Scripts = 200;
}


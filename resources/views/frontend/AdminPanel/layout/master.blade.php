<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('bootstrap/css/bootstrap.min.css')}} " rel="stylesheet">
    <!-- styles -->
    <link href="{{URL::asset('css/styles.css')}} " rel="stylesheet">

    <link href="{{URL::asset('vendors/form-helpers/css/bootstrap-formhelpers.min.css')}} " rel="stylesheet">
    <link href="{{URL::asset('vendors/select/bootstrap-select.min.css')}} " rel="stylesheet">
    <link href="{{URL::asset('vendors/tags/css/bootstrap-tags.css')}} " rel="stylesheet">


    <link rel="stylesheet" href="{{URL::asset('kendo/css/kendo.common.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('kendo/css/kendo.default.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('kendo/css/kendo.material.mobile.min.css')}}" />

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('kendo/js/kendo.all.min.js') }}"></script>
    <script src="{{URL::asset('bootstrap/js/bootstrap.min.js')}}"></script>

    <style>
        @font-face {
            font-family: BYekan;
            src: url("fonts/BYekan.eot?#") format("eot"), url("../css/fonts/BYekan.woff") format("woff"), url("fonts/BYekan.ttf") format("truetype");
        }

        @font-face {
            font-family: DroidNaskh-Bold;
            src: url("{{URL::asset('css/fonts/DroidNaskh-Bold.ttf')}}") format("truetype");
        }

        @font-face {
            font-family: IRANSans-Bold;
            src: url("{{ URL::asset('css/fonts/IRANSans-Bold.woff')}}") format("woff");
        }

        * {
            font-family: IRANSans-Bold;
        }


        .panel-heading h5 {
            direction: rtl;
        }

        .k-filter-row th, .k-grid-header th.k-header {
            text-align: center;
        }

        /*.k-button {
            float: right;
        }*/

        /*.k-grid td {
            direction: rtl;
        }*/

        .well .control-label {
            text-align: right;
        }

        .sidebar .nav > li > a {
            text-align: right;
        }

        .sidebar .nav > li > ul > li > a {
            text-align: right;
        }

        .header .dropdown-menu li a {
            direction: rtl;
            text-align: right;
        }


        .form-group {
            direction: rtl;
        }

        .container {
            padding-left: 40px;
        }

        form button {
            float: right;
        }
    </style>

</head>

<body>
    @include('frontend.AdminPanel.includes.header')

    <div class="page-content">

        <div class="row">

            <div class="col-md-10">
                @yield('content')              
            </div>

            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h5>امکانات</h5>
                    </div>
                    <div class="panel-body">
                        @include('frontend.AdminPanel.includes.sidebar')                                  
                    </div>
                </div>
            </div>

        </div>
    </div>


    @include('frontend.AdminPanel.includes.footer')


    <script src="{{URL::asset('js/custom.js')}}"></script>
    <!--<script src="{{URL::asset('js/forms.js')}}"></script>-->


</body>

</html>

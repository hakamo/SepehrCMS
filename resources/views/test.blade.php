<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">

    <title>Compact contact form - Bootsnipp.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

  <!--  <link href="{{URL::asset('bootstrap/css/bootstrap.min.css')}} " rel="stylesheet">
    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('bootstrap/js/bootstrap.js')}}"></script>-->


    <!--@include('frontend.Home.includes.style')-->

    <style>
        @font-face {
            font-family: IRANSans-Bold;
            src: url("{{ URL::asset('css/fonts/IRANSans-Bold.woff')}}") format("woff");
        }

        * {
            font-family: IRANSans-Bold;
        }

       
    </style>


</head>
<body>


    <style>
    .brown {
        color: #9b846b;
    }

    .green {
        color: #d6e66e;
    }

    .violet {
        color: palevioletred;
    }

    .darkGreen {
        color: #00344d;
    }

    .gold {
        color: #ffe236;
    }

    .lightBlue {
        color: #4093f8;
    }
</style>

<div class="sidebar content-box" style="display: block;">
    <ul class="nav">
        <!-- Main menu -->
        <li {!!Route::is('cms.AdminPanelConfiguration') ? 'class="current"' : null !!}> <a href="{{route('cms.AdminPanelConfiguration')}}">تنظیمات <i class="glyphicon glyphicon-home brown darkGreen"></i></a></li>
        <li {!!Route::is('cms.AdminPanelProducts') ? 'class="current"' : null !!}> <a href="{{route('cms.AdminPanelProducts')}}">محصولات <i class="glyphicon glyphicon-home brown"></i></a></li>
        <li {!!Route::is('cms.AdminPanelSlides') ? 'class="current"' : null !!}> <a href="{{route('cms.AdminPanelSlides')}}">اسلاید تصاویر <i class="glyphicon glyphicon-calendar green"></i></a></li>
        <li {!!Route::is('cms.AdminPanelPages') ? 'class="current"' : null !!}> <a href="{{route('cms.AdminPanelPages')}}">صفحات <i class="glyphicon glyphicon-stats violet"></i></a></li>
        <li {!!Route::is('cms.AdminPanelGalleries') ? 'class="current"' : null !!}> <a href="{{route('cms.AdminPanelGalleries')}}">گالری تصاویر <i class="glyphicon glyphicon-list darkGreen"></i></a></li>
        <li {!!Route::is('cms.AdminPanelMenues') ? 'class="current"' : null !!}> <a href="{{route('cms.AdminPanelMenues')}}">منوی سایت <i class="glyphicon glyphicon-th gold"></i></a></li>
        <li {!!Route::is('cms.AdminPanelContact') ? 'class="current"' : null !!}> <a href="{{route('cms.AdminPanelContact')}}">پیام مخاطبین <i class="glyphicon glyphicon-th gold"></i></a></li>

      <!--  <li class="submenu">

            <a class="dropdown-toggle" href="#">بیشتر <i class="glyphicon glyphicon-off lightBlue"></i>
                        <span class="caret pull-right"></span>
            </a>-->
            <!-- Sub menu -->
      <!--      <ul>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">خروج از سیستم</a></li>
                <li><a href="{{ route('register') }}">ثبت نام</a></li>
            </ul>
        </li>-->

       <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Pages
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul style="display: none;">
                            <li><a href="login.html">Login</a></li>
                            <li><a href="signup.html">Signup</a></li>
                        </ul>
        </li>

     </ul>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form>

</div>
 


</body>
</html>

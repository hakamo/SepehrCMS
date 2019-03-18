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

        <li class="submenu">

            <a class="dropdown-toggle" href="#">بیشتر <i class="glyphicon glyphicon-off lightBlue"></i>
                        <span class="caret pull-right"></span>
            </a>
           <!--  Sub menu -->
            <ul>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">خروج از سیستم</a></li>
                <li><a href="{{ route('register') }}">ثبت نام</a></li>
            </ul>
        </li>


     </ul>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form>

</div>
 
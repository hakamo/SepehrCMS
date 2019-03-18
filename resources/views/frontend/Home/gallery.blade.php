<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>گالری تصاویر: {{$folder}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Bootstrap -->
    <link href="{{URL::asset('bootstrap/css/bootstrap.min.css')}} " rel="stylesheet">
    <link href="{{URL::asset('bootstrap/css/bootstrap-responsive.min.css')}} " rel="stylesheet">
    <link href="{{URL::asset('bootstrap/css/carousel.css')}} " rel="stylesheet">
    <link href="{{URL::asset('css/colorbox.css')}} " rel="stylesheet">
    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{URL::asset('js/jquery.colorbox.js')}}"></script>

    <!-- HTML5 shim, for IE6-8 support  of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    @include('frontend.Home.includes.style')

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{URL::asset('bootstrap/farsi/img/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{URL::asset('bootstrap/farsi/img/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{URL::asset('bootstrap/farsi/img/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{URL::asset('bootstrap/farsi/img/apple-touch-icon-57-precomposed.png')}}">


    <link rel="shortcut icon" href="../assets/ico/favicon.png">
   
    <script type="text/javascript">
        $(document).ready(function () {
            $("a[rel='colorbox']").colorbox({ maxWidth: "90%", maxHeight: "90%", opacity: ".5" });
        });
    </script>

    <style>
        .navbar {
            margin-top: 20px;
        }

        .navbar-inverse .brand {
            color: #FFF;
        }

        .gallery-wrapper {
            text-align: center;
        }

            .gallery-wrapper li {
                display: inline-block;
                float: none;
            }

        .pagination {
            margin: 0;
        }

        .credit {
            margin: 9px 0;
            text-align: center;
        }
    </style>

    <!-- @include('frontend.Home.includes.style')-->


</head>



<body>

    <div class="container">

        
        <div class="navbar navbar-inverse navbar-static-top">
            <div class="navbar-inner">
                <div class="container">
                    <div class="navbar-brand">{{$folder}}</div>
                </div>
            </div>
        </div>

        <ul class="gallery-wrapper thumbnails">

            @foreach ($ImageList as $item)
                <li class="">
                    <a href="{{URL::to('/').'/galleries/'.$folder."/".$item["name"]}}" title="{{$item["name"]}}" class="thumbnail" rel="colorbox">
                        <img src="{{route('cms.GalleryPages')."?thumbnail=".$item["name"]."&name=".$folder}}" alt="{{$item["name"]}}" />
                    </a>
                </li>
            @endforeach



        </ul>
    </div>


    <div id="cboxOverlay" style="display: none;"></div>
    <div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none;"><div id="cboxWrapper"><div><div id="cboxTopLeft" style="float: left;"></div><div id="cboxTopCenter" style="float: left;"></div><div id="cboxTopRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxMiddleLeft" style="float: left;"></div><div id="cboxContent" style="float: left;"><div id="cboxTitle" style="float: left;"></div><div id="cboxCurrent" style="float: left;"></div><button type="button" id="cboxPrevious"></button><button type="button" id="cboxNext"></button><button id="cboxSlideshow"></button><div id="cboxLoadingOverlay" style="float: left;"></div><div id="cboxLoadingGraphic" style="float: left;"></div></div><div id="cboxMiddleRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxBottomLeft" style="float: left;"></div><div id="cboxBottomCenter" style="float: left;"></div><div id="cboxBottomRight" style="float: left;"></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; display: none; max-width: none;"></div></div>


   @include('frontend.Home.includes.contact')

   @include('frontend.Home.includes.footer')


     <script>
         $(document).ready(function () {

             // hide #back-top first
             $("#back-top").hide();

             // fade in #back-top
             $(function () {
                 $(window).scroll(function () {
                     if ($(this).scrollTop() > 100) {
                         $('#back-top').fadeIn();
                     } else {
                         $('#back-top').fadeOut();
                     }
                 });

                 // scroll body to 0px on click
                 $('#back-top a').click(function () {
                     $('body,html').animate({
                         scrollTop: 0
                     }, 800);
                     return false;
                 });
             });

         });
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{URL::asset('bootstrap/css/bootstrap.min.css')}} " rel="stylesheet">
    <link href="{{URL::asset('bootstrap/css/carousel.css')}} " rel="stylesheet">


    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{URL::asset('bootstrap/farsi/img/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{URL::asset('bootstrap/farsi/img/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{URL::asset('bootstrap/farsi/img/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{URL::asset('bootstrap/farsi/img/apple-touch-icon-57-precomposed.png')}}">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
    @include('frontend.Home.includes.style')

</head>

<body>
    @include('frontend.Home.includes.navbar')

    <div style="clear: both; margin-top: 100px;"></div>

    <div class="container">

        <div class="panel panel-primary">

            <div class="panel-heading">
                <h3 class="panel-title">{{$title}}</h3>
            </div>

            <div class="panel-body">
            </div>

        </div>


         @include('frontend.Home.includes.tags')      

    </div>


        @include('frontend.Home.includes.contact')


    @include('frontend.Home.includes.footer')


    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('bootstrap/js/bootstrap.js')}}"></script>

    <script>


        $(document).ready(function () {

            var content = decodeURIComponent("{{$content}}");

            $('.panel-body').html(content);

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

    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>


</body>
</html>

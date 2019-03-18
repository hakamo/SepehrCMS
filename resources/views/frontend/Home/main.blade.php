<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{$configuration["SiteName"]}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$configuration["SiteSubject"]}}">
    <meta name="author" content="{{$configuration["OwnerName"]}}">



    <!-- Bootstrap -->
    <link href="{{URL::asset('bootstrap/css/bootstrap.min.css')}} " rel="stylesheet">
    <!--<link href="{{URL::asset('bootstrap/css/bootstrap-responsive.css')}} " rel="stylesheet">-->
    <link href="{{URL::asset('bootstrap/css/carousel.css')}} " rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support  of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

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



    <div id="myCarousel" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner" role="listbox">
            {{ $slides->get_slides_html() }}
        </div>

        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>




    <div class="container">
        <div class="row">
            {{ $products->get_products_html() }}         
        </div>

        @include('frontend.Home.includes.content')

        @include('frontend.Home.includes.tags')      
    </div>

    

    @include('frontend.Home.includes.contact')
      
    @include('frontend.Home.includes.footer')


    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('bootstrap/js/bootstrap.js')}}"></script>

    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>

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


            $(".close").click(function () {
                $("#myAlert").alert("close");
            });


        });




</script>


</body>
</html>

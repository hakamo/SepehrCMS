<style>
    @font-face {
        font-family: BYekan;
        src: url("{{URL::asset('css/fonts/BYekan.eot')}}") format("eot"), url("{{URL::asset('css/fonts/BYekan.woff')}}") format("woff"), url("{{URL::asset('css/fonts/BYekan.ttf')}}") format("truetype");
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

    /* GLOBAL STYLES
    -------------------------------------------------- */
    /* Padding below the footer and lighter body text */

    body {
        background-image: url("{{ URL::asset('img/pagebg.png')}}");
    }

    .featurette-divider {
        border-width: 3px;
        border-color: #bebfbe;
        clear: both;
    }

    .thumbnail {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }

        .thumbnail:hover {
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }

    .carousel-inner {
        border-bottom: solid;
        border-color: #ffffff;
        border-width: 1px;
    }

    .first-slide {
        /*box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);*/
        max-width: 400px;
        height: auto;
    }

    .panel {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    }



    h1 {
        font-family: IRANSans-Bold;
        color: whitesmoke;
        text-align: right;
        direction: rtl;
    }

    h3, h2 {
        font-family: IRANSans-Bold;
        text-align: right;
        direction: rtl;
    }

    p {
        text-align: right;
        direction: rtl;
    }

    .navbar-brand {
        float: right;
    }

    .navbar-toggle {
        float: left;
    }

    .navbar-nav > li > a {
        text-align: right;
    }

    .navbar-nav > li {
        float: right;
    }



    .navbar-nav > li {
        float: right;
    }

    .nav > li {
        position: relative;
        display: block;
        direction: rtl;
    }

    .navbar-inverse .navbar-nav .open .dropdown-menu > li > a {
        text-align: right;
        padding-right: 4em;
    }

    .navbar-nav {
        float: right;
        margin: 0;
    }


    caption p {
        text-align: justify;
    }

    /*.footer p {
        text-align: right;
        direction: rtl;
    }*/

    .list-group-item {
        text-align: right;
        direction: rtl;
    }

    .form-group {
        text-align: right;
    }

    .span5 {
        text-align: right;
    }

    input {
        text-align: right;
    }

    textarea {
        text-align: right;
    }


    .jumbotron {
        background: #358CCE;
        color: #FFF;
        border-radius: 0px;
    }

    .jumbotron-sm {
        padding-top: 24px;
        padding-bottom: 24px;
    }

    .jumbotron small {
        color: #FFF;
    }

    .h1 small {
        font-size: 24px;
    }
    
</style>

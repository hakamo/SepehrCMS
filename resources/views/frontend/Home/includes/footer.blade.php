<footer class="footer">
    <div class="container">
        <p>این سایت توسط قانون کپی رایت محافظت میشود.</p>
        <p>طراحی شده توسط HAKAMO.</p>

        <!-- <p id="sliderUp1" ><a class="glyphicon glyphicon-menu-down" href=""></a></p>-->

        <!--   <p id="sliderUp1" >up</p>-->
        <!--<button id="sliderUp1">UP</button>-->

        <p id="back-top">
            <a href="#top"><span></span>Back to Top</a>
        </p>

        <p>&copy; {{date("Y")}} شرکت شما. &middot; <a href="#">حفظ حریم خصوصی</a> &middot; <a href="#">شرایط</a></p>
    </div>
</footer>


<style>

    footer {
        background-color: #2a2730;
        box-shadow: inset 0px 0px 3px #111;
        color: #fff;
        font-size: 14px;
        line-height: 25px;
        padding: 10px 0px 10px 0px;
        bottom: 0px;
        margin-bottom: -40px;
        position: relative;
        clear: both;
        border-style: double none none;
    }

    #back-top {
        position: fixed;
        bottom: 10px;
        left: 10px;
        margin-left: 1px;
        opacity: 0.7;
    }

        #back-top a {
            width: 108px;
            display: block;
            text-align: right;
            font: 12px/100% Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            text-decoration: none;
            color: #bbb;            

            /* transition */
            -webkit-transition: 1s;
            -moz-transition: 1s;
            transition: 1s;
        }

            #back-top a:hover {
                color: #000;
            }

        /* arrow icon (span tag) */
        #back-top span {
            width: 80px;
            height: 80px;
            display: block;
            margin-bottom: 7px;
            background: #ddd url("{{ URL::asset('img/up-arrow.png')}}") no-repeat center center;
            /* rounded corners */
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
            /* transition */
            -webkit-transition: 1s;
            -moz-transition: 1s;
            transition: 1s;
        }

        #back-top a:hover span {
            background-color: #777;
        }
</style>




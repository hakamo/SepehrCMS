<a name="contactus" id="contactus"></a>

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h3 class="h2">تماس با ما <small>برای بهبود خدمات نظرات خود را با ما در میان بگذارید.</small></h3>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">


        <div class="col-md-12">
            <div class="well well-sm">

                <div class="alert alert-info" role="alert">
                    <p>اطلاعات شما محرمانه باقی خواهد ماند</p>
                    <p>آدرس IP شما ذخیره خواهد شد</p>
                </div>

                <div class="alert alert-success alert-dismissible" id="resultContact" style="display: none">
                   <!-- <p>تغییرات ذخیره شد</p>-->
                </div>

                <div class="row">
                    <form>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">پیام</label>
                                <textarea name="message" id="message" class="form-control" rows="13" cols="25" required="required"
                                    placeholder="متن پیام"></textarea>
                            </div>


                        </div>


                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="name">نام</label>
                                <input type="text" class="form-control" id="name" placeholder="نام شما" required="required" />
                            </div>

                            <div class="form-group">
                                <label for="email">آدرس ایمیل</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" placeholder="inbox@email.com" required="required" />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">
                                    شماره تماس
                                </label>
                                <input type="text" class="form-control" id="phoneNumber" placeholder="02188XXXXXX" required="required" />
                            </div>

                            <div class="form-group">
                                <!-- <label for="captcha">کد امنیتی :</label>-->
                                <img id="captcha_image" src="{{route('cms.Captcha')}}" style="padding-bottom: 5px;"> : کد امنیتی </img>
                                <input type="text" class="form-control" id="captcha" name="captcha" value="Security Code" required="required" onblur="if(this.value=='')this.value='Security Code'" onfocus="if(this.value=='Security Code')this.value=''" onkeypress="searchKeyPress(event)">
                            </div>

                        </div>

                        <input type="hidden" id="token" value="{{ csrf_token() }}">
                    </form>


                    <div class="col-md-12">
                        <button class="btn btn-primary pull-right" id="btnContactUs" onclick="MakeContact()">ارسال پیام</button>
                    </div>




                </div>



            </div>





        </div>

    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Result</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script>


    function showBusyIndicator(state) {
        // kendo.ui.progress(tabstrip_.element, state);
    }

    function MakeContact() {

        showBusyIndicator(true);

        //$("#myAlert").show();

        try {

            var _message = $("#message").val();
            var _name = $("#name").val();
            var _email = $("#email").val();
            var _phoneNumber = $("#phoneNumber").val();
            var _token = $("#token").val();
            var _captcha = $("#captcha").val();

            var request = "{{route('cms.MakeContact')}}" + "?" +

                "message=" + _message + "&name=" + _name + "&email=" + _email + "&phoneNumber=" + _phoneNumber + "&captcha=" + _captcha + "&_token=" + _token;

            $.post(request, function (data, status) {

                if (status == 'success') {

                    try {

                        showModal(data);
                        clearValues();
                        ReCaptcha();
                    }
                    catch ($exception) {
                        alert($exception);
                    }
                }

            }).fail(function (jqXHR, textStatus, errorThrown) {
                ReCaptcha();
                showModal('Error Message : ' + jqXHR.responseText);
            });
        }
        catch ($exception) {
            showModal('Error Message : ' + $exception)
        }
        finally {
            showBusyIndicator(false);
            return false;
        }
    }

    function ReCaptcha() {
        var logo = document.getElementById('captcha_image');
        var img = new Image();
        logo.src = "{{route('cms.Captcha')}}?" + Math.random();
    }

    function clearValues() {
        $("#message").val('');
        $("#name").val('');
        $("#email").val('');
        $("#phoneNumber").val('');
        $("#token").val('');
        $("#captcha").val('');
    }

    function showModal(message) {
        $("#resultContact").html('<p>' + message + '</p>');

        $("#resultContact").show();

        $("#resultContact").fadeTo(2000, 500).slideUp(500, function () {
            $("#resultContact").slideUp(500);
        });
    }


</script>

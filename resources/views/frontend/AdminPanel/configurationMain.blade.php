<div class="container config" style="max-width: 600px; margin: 60px auto;">
    <form role="form">

        <div class="form-group">
            <label for="name">نام سایت</label>
            <input type="text" class="form-control" id="SiteName{{$uid}}" placeholder="">
        </div>

        <div class="form-group">
            <label for="address">نام صاحب امتیاز</label>
            <input type="text" class="form-control" id="OwnerName{{$uid}}" placeholder="">
        </div>

        <div class="form-group">
            <label for="address">شعار سایت</label>
            <input type="text" class="form-control" id="SiteSlogan{{$uid}}" placeholder="">
        </div>

        <div class="form-group">
            <label for="address">موضوع سایت</label>
            <input type="text" class="form-control" id="SiteSubject{{$uid}}" placeholder="">
        </div>


        <div class="form-group">
            <label for="address">تگ های سایت</label>
            <textarea form="form_id" class="form-control" id="SiteSEOtag{{$uid}}" placeholder=""> </textarea>
        </div>

        <input type="hidden" id="token" value="{{ csrf_token() }}">
    </form>

    <button type="submit" class="btn btn-default" onclick="UpdateConfiguration()">ذخیره تنظیمات</button>
</div>



<script>

    readRecords();

    function UpdateConfiguration() {

        showBusyIndicator(true);

        try
        {
            var _SiteName = $("#SiteName{{$uid}}").val();
            var _OwnerName = $("#OwnerName{{$uid}}").val();
            var _SiteSlogan = $("#SiteSlogan{{$uid}}").val();
            var _SiteSubject = $("#SiteSubject{{$uid}}").val();
            var _SiteSEOtag = $("#SiteSEOtag{{$uid}}").val();
            var _token = $("#token").val();


            var request = "{{route('cms.AdminPanelConfiguration')}}" + "/{{$language}}" + "/update?" +

                "SiteName=" + _SiteName + "&OwnerName=" + _OwnerName + "&SiteSlogan=" + _SiteSlogan + "&SiteSubject=" + _SiteSubject + "&SiteSEOtag=" + _SiteSEOtag + "&_token=" + _token;

            $.post(request, function (data, status) {

                if (status == 'success') {

                    try {

                        //alert("تغییرات ذخیره شد.");
                    }
                    catch ($exception) {
                        alert($exception);
                    }
                }

            }).fail(function (jqXHR, textStatus, errorThrown) {
                alert('Error Message : ' + jqXHR.responseText);
            });
        }
        catch ($exception){
            alert($exception);
        }
        finally {
            showBusyIndicator(false);
        }

    }

    function readRecords() {

        showBusyIndicator(true);

        var _token = $("#token").val();

        $.get("{{route('cms.AdminPanelConfiguration')}}" + "/{{$language}}" + "/read?" + "_token=" + _token, function (data, status) {

            if (status == 'success') {

                try {

                    console.log(data);

                    // convert string to JSON
                    var response1 = $.parseJSON(data);




                    $("#SiteName{{$uid}}").val(response1.SiteName);
                    $("#OwnerName{{$uid}}").val(response1.OwnerName);
                    $("#SiteSlogan{{$uid}}").val(response1.SiteSlogan);
                    $("#SiteSubject{{$uid}}").val(response1.SiteSubject);
                    $("#SiteSEOtag{{$uid}}").val(response1.SiteSEOtag);
                }
                catch ($exception) {
                    alert($exception);
                }
                finally {
                    showBusyIndicator(false);
                }

            }

        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert('Error Message : ' + jqXHR.responseText);
        });


    };

    function showBusyIndicator(state) {
        kendo.ui.progress(tabstrip_.element, state);
    }

</script>

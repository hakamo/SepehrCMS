@extends('frontend.AdminPanel.layout.master')

@section('content')



<div class="panel panel-primary">
    <div class="panel-heading">
        <h5>گالری تصاویر</h5>
    </div>
    <div class="panel-body">

        <div class="k-grid k-widget">
            <div class="k-header k-grid-toolbar">
                <button class="add k-button k-grid-add">
                    <span class="k-icon k-add"></span>
                    Add
                </button>
            </div>
            <table id="grid">
                <colgroup>
                    <!--<col />-->
                    <!--<col style="width:110px" />-->
                    <col />
                    <col />
                    <col />
                    <!--<col style="width:120px" />-->
                    <!--<col style="width:120px" />-->
                </colgroup>
                <thead>
                    <tr>
                        <th data-field="title">عنوان آلبوم</th>
                        <th data-field="url">نام فولدر ذخیره</th>
                        <th data-field="command">دستورات</th>
                    </tr>
                </thead>
                <tbody class="records_table"></tbody>
            </table>
        </div>

    </div>
</div>

<div id="EditWindow" style="display: none">
    <div id="editor"></div>
</div>

<div id="AddWindow" style="display: none">

    <div class="well ">

        <label for="name" class="cols-sm-2 control-label">عنوان آلبوم</label>
        <div class="cols-sm-10">
            <div class="input-group">

                <input type="text" class="form-control" name="name" id="txtTitle" placeholder="به طور مثال : ظروف تفلون" />
                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            </div>
        </div>

        <div class="spacer10"></div>

        <label for="name" class="cols-sm-2 control-label">نام فولدر ذخیره</label>
        <div class="cols-sm-10">
            <div class="input-group">

                <input type="text" class="form-control" name="name" id="txtPath" placeholder="teflon_plates" />
                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            </div>
        </div>

        <div class="spacer10"></div>

        <div id="addError"></div>

    </div>



    <div style="clear: both"></div>

    <div style="float: right">
        <button id="btnAddRecord" class="btn btn-primary" style="float: none; margin-top: -15px;">Done</button>
    </div>

</div>

<div id="confirm" style="display: none">

    <div class="well ">
        <label for="name" class="cols-sm-2 control-label">آیا آیتم مورد نظر حذف گردد؟</label>
        <div class="spacer10"></div>
    </div>

    <div style="clear: both"></div>

    <div style="float: right">
        <button id="btnDoDelete" style="margin-top: -15px;">بله</button>
        <button id="btnCancelDelete" style="margin-top: -15px;">انصراف</button>
    </div>

</div>


<script>
    var Selectedrow;
    var SelectedFolder = "/";
    var imageBrowser;
    var addOperation = false;

    $(document).ready(function () {

        $("#grid").kendoGrid({
            height: 550,
            sortable: false,
        });


        //imageBrowser = $("#editor").kendoImageBrowser({

        //    transport: {

        //        read: {
        //                dataType: "json",
        //                url: function () {
        //                    return ("{{route('cms.AdminPanelImages')}}" + "/read/gallery" + "?folder=" + SelectedFolder)
        //                },
        //        },
        //        destroy: "{{route('cms.AdminPanelImages')}}" + "/destroy/gallery" + "?folder=" + SelectedFolder,
        //        create: "{{route('cms.AdminPanelImages')}}" + "/createDirectory/gallery",
        //        uploadUrl: "{{route('cms.AdminPanelImages')}}" + "/upload/gallery" + "?folder=" + SelectedFolder,
        //        thumbnailUrl: "{{route('cms.AdminPanelImages')}}" + "/thumbnail/gallery" + "?folder=" + SelectedFolder,
        //        imageUrl: "{{config('settings.UploadUrl')}}{0}"
        //    }

        //});


        $(".add").kendoButton();

        readRecords();

    });

    function readRecords() {

        $.post("{{route('cms.AdminPanelGalleries')}}" + "/read/", function (data, status) {

            var row = "";

            // convert string to JSON
            var response1 = $.parseJSON(data);



            $.each(response1, function (i, item) {

                row += "<tr>" +
                       "<td class=\"title\"" + "" + ">" + item.title + "</td>" +
                       "<td class=\"url\">" + item.url + "</td>" +

                       "<td>" +
                       "<button class=\"editItem\">Edit</button>" + "<button class=\"deleteItem\">Delete</button>" + "<button class=\"manageItem\">Manage</button>"
                "</td>" +

                "</tr>";
            });

            $('#grid > tbody:last-child').after(row);

            setEvent();
        });

    };

    function showModalManage() {

        $("#editor").html('');

        $("#editor").kendoImageBrowser({

            transport: {

                read: {
                    dataType: "json",
                    url: function () {
                        return ("{{route('cms.AdminPanelImages')}}" + "/read/gallery" + "?folder=" + SelectedFolder)
                    },
                },
                destroy: "{{route('cms.AdminPanelImages')}}" + "/destroy/gallery" + "?folder=" + SelectedFolder,
                create: "{{route('cms.AdminPanelImages')}}" + "/createDirectory/gallery",
                uploadUrl: "{{route('cms.AdminPanelImages')}}" + "/upload/gallery" + "?folder=" + SelectedFolder,
                thumbnailUrl: "{{route('cms.AdminPanelImages')}}" + "/thumbnail/gallery" + "?folder=" + SelectedFolder,
                imageUrl: "{{config('settings.UploadUrl')}}{0}"
            }

        });

        //hazfe dokme add folder
        $(".k-addfolder").parent().css('display', 'none');

        var myWindow = $("#EditWindow");

        function onClose() {
            myWindow.fadeIn();
        }

        myWindow.kendoWindow({
            width: "400px",
            title: "مدیریت آلبوم تصاویر",
            visible: false,
            actions: [
                //"Pin",
                //"Minimize",
                //"Maximize",
                "Close"
            ],
            close: onClose
        }).data("kendoWindow").center().open();
    }

    function showModalEdit() {

        var wndAdd = $("#AddWindow");

        wndAdd.click(function () {
            undo.fadeOut();
        });

        function onClose() {
            wndAdd.fadeIn();
        }

        wndAdd.kendoWindow({
            width: "400px",
            title: "ویرایش کردن",
            visible: false,
            actions: [
                //"Pin",
                //"Minimize",
                //"Maximize",
                "Close"
            ],
            close: onClose
        }).data("kendoWindow").center().open();

        $("#addError").html("");
    }

    function showModalDelete() {
        var undo = $("#confirm");

        function onClose() {
            undo.fadeIn();
        }

        undo.kendoWindow({
            width: "400px",
            title: "تائید",
            visible: false,
            actions: [
                //"Pin",
                //"Minimize",
                //"Maximize",
                "Close"
            ],
            close: onClose
        }).data("kendoWindow").center().open();
    }

    function showModalAdd() {
        var wndAdd = $("#AddWindow");

        //wndAdd.click(function () {
        //    undo.fadeOut();
        //});

        function onClose() {
            wndAdd.fadeIn();
        }

        wndAdd.kendoWindow({
            width: "400px",
            title: "اظافه کردن",
            visible: false,
            actions: [
                //"Pin",
                //"Minimize",
                //"Maximize",
                "Close"
            ],
            close: onClose
        }).data("kendoWindow").center().open();


        $("#txtTitle").val("");
        $("#txtPath").val("");
        $("#addError").html("");
    };

    function addTableRecord() {

        var _title = $("#txtTitle").val();
        var _folder = $("#txtPath").val();

        var request = "{{route('cms.AdminPanelGalleries')}}" + "/create?" + "title=" + _title + "&folder=" + _folder;


        $.post(request, function (data, status) {

            if (status == 'success') {

                try {
                    var row = "<tr>" +
                                "<td class=\"title\"" + "" + ">" + _title + "</td>" +
                                "<td class=\"url\">" + _folder + "</td>" +
                                "<td>" +
                                "<button class=\"editItem\">Edit</button>" + "<button class=\"deleteItem\">Delete</button>" + "<button class=\"manageItem\">Manage</button>" +
                                "</td>" +
                                "</tr>";

                    $('#grid > tr:last').after(row);

                    setEvent();

                    $("#AddWindow").data("kendoWindow").close();

                }
                catch ($exception) {
                    alert($exception);
                }
            }

        }).fail(function (jqXHR, textStatus, errorThrown) {
            $("#addError").html('Error Message : ' + jqXHR.responseText);
        });
    }

    function editTableRecord() {
        try {
            var _title = $("#txtTitle").val();
            var _folder = $("#txtPath").val();
            var _oldfoldername = Selectedrow.find(".url").text();

            var request = "{{route('cms.AdminPanelGalleries')}}" + "/update?" + "title=" + _title + "&folder=" + _folder + "&oldFolderName=" + _oldfoldername;
        }
        catch ($exception) {
            alert($exception);
        }


        $.post(request, function (data, status) {

            if (status == 'success') {

                try {

                    Selectedrow.find(".title").text(_title);
                    Selectedrow.find(".url").text(_folder);

                    $("#AddWindow").data("kendoWindow").close();
                }
                catch ($exception) {
                    alert($exception);
                }
            }

        }).fail(function (jqXHR, textStatus, errorThrown) {
            $("#addError").html('Error Message : ' + jqXHR.responseText);
        });
    }

    function setEvent() {

        $(".add").kendoButton({ icon: "add" }).click(function () {

            $("#txtTitle").val("");
            $("#txtPath").val("");

            addOperation = true;

            showModalAdd();
        });

        $(".editItem").kendoButton({}).click(function () {

            Selectedrow = $(this).closest("tr");

            var title_val = Selectedrow.find(".title").text(); // Find the text
            var url_val = Selectedrow.find(".url").text(); // Find the text

            addOperation = false;

            $("#txtPath").val(url_val);
            $("#txtTitle").val(title_val);

            showModalEdit();
        });

        $(".deleteItem").kendoButton({}).click(function () {

            Selectedrow = $(this).closest("tr");

            var title_val = Selectedrow.find(".title").text(); // Find the text
            var url_val = Selectedrow.find(".url").text(); // Find the text

            showModalDelete();
        });

        $(".manageItem").kendoButton({}).click(function () {

            Selectedrow = $(this).closest("tr");

            var title_val = Selectedrow.find(".title").text(); // Find the text
            var url_val = Selectedrow.find(".url").text(); // Find the text

            //alert(title_val + "--" + url_val + "--" + slug_val);

            $("#txtUrl").val(url_val);
            $("#txtTitle").val(title_val);

            SelectedFolder = url_val;

            showModalManage();
        });

        $("#btnDoDelete").kendoButton({}).click(function () {

            var title_val = Selectedrow.find(".title").text(); // Find the text
            var url_val = Selectedrow.find(".url").text(); // Find the text

            var request = "{{route('cms.AdminPanelGalleries')}}" + "/destroy?" + "title=" + title_val + "&folder=" + url_val;

            $.post(request, function (data, status) {

                if (status == 'success') {

                    try {

                        Selectedrow.css("background-color", "#999999");
                        Selectedrow.fadeOut(400, function () {
                            Selectedrow.remove();
                        });

                        $("#confirm").data("kendoWindow").close();
                        return false;
                    }
                    catch ($exception) {
                        alert($exception);
                    }
                }

            }).fail(function (jqXHR, textStatus, errorThrown) {
                // $("#addError").html('Error Message : ' + jqXHR.responseText);
                alert('Error Message : ' + jqXHR.responseText);
            });

        });

        $("#btnCancelDelete").kendoButton({}).click(function () {
            $("#confirm").data("kendoWindow").close().fadeIn();
        });

        $("#btnAddRecord").kendoButton({}).click(function () {

            if (addOperation)
                addTableRecord();
            else
                editTableRecord();
        });
    };

</script>

<style>
    /*#example {
        min-height: 500px;
    }

    #undo {
        text-align: center;
        position: absolute;
        white-space: nowrap;
        padding: 1em;
        cursor: pointer;
    }

    .armchair {
        float: left;
        margin: 30px 30px 120px 30px;
        text-align: center;
    }

        .armchair img {
            display: block;
            margin-bottom: 10px;
        }

    @media screen and (max-width: 1023px) {
        div.k-window {
            display: none !important;
        }
    }

    .spacer10 {
        height: 10px;
        width: 100%;
        font-size: 0;
        margin: 0;
        padding: 0;
        border: 0;
        display: block;
    }*/
</style>

@endsection
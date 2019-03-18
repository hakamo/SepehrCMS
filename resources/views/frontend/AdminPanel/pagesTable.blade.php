<div id="cotainerUnique{{$uid}}">
    <div class="k-grid k-widget">
        <div class="k-header k-grid-toolbar">
            <button class="add k-button k-grid-add">
                <span class="k-icon k-add"></span>
                Add
            </button>
        </div>
    </div>

    <div class="k-overlay" style="display: none; z-index: 10000; opacity: 0.5;"></div>

    <div id="EditWindow{{$uid}}" style="display: none; z-index: 10004;">
        <textarea id="editor{{$uid}}" style="width: 100%; height: 400px; "></textarea>

        <div class="k-header" style="float: right; width:100%;">
            <button id="btnDoUpdateContent{{$uid}}" style="margin: 5px;">بروز رسانی</button>
            <button id="btnCancelUpdateContent{{$uid}}" style="margin: 5px;">انصراف</button>
        </div>

    </div>

    <div id="AddWindow{{$uid}}" style="display: none">

        <div class="well">

            <label for="name" class="cols-sm-2 control-label">عنوان صفحه</label>
            <div class="cols-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" name="name" id="txtTitle{{$uid}}" placeholder="" />
                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                </div>
            </div>

            <div class="spacer10"></div>

            <label for="name" class="cols-sm-2 control-label">نشانه آدرس صفحه</label>

            <div class="cols-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" name="name" id="txtPath{{$uid}}" placeholder="" />
                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                </div>
            </div>

            <div class="spacer10"></div>

            <div id="addError{{$uid}}"></div>

        </div>

        <div style="clear: both"></div>

        <div style="float: right">
            <button id="btnAddRecord{{$uid}}" class="btn btn-primary" style="float: none; margin-top: -15px;">Done</button>
        </div>

    </div>

    <div id="confirm{{$uid}}" style="display: none">

        <div class="well ">
            <label for="name" class="cols-sm-2 control-label">آیا آیتم مورد نظر حذف گردد؟</label>
            <div class="spacer10"></div>
        </div>

        <div style="clear: both"></div>

        <div style="float: right">
            <button id="btnDoDelete{{$uid}}" style="margin-top: -15px;">بله</button>
            <button id="btnCancelDelete{{$uid}}" style="margin-top: -15px;">انصراف</button>
        </div>

    </div>

    <table id="grid{{$uid}}">
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
                <!--<th data-field="id" style="display:none; width:0px;"></th>-->
                <th data-field="title">عنوان صفحه</th>
                <th data-field="slug">نشانه آدرس صفحه</th>
                <th data-field="command">دستورات</th>
            </tr>
        </thead>
        <tbody class="records_table"></tbody>
    </table>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</div>



<script>

    $("#grid{{$uid}}").kendoGrid({
        height: 550,
        sortable: false,
    });

    $(".add").kendoButton();

    $("#btnDoUpdateContent{{$uid}}").kendoButton();

    $("#btnCancelUpdateContent{{$uid}}").kendoButton();

    $("#editor{{$uid}}").html('');

    $("#editor{{$uid}}").kendoEditor({

        tools: [
            "bold",
            "italic",
            "underline",
            "strikethrough",
            "justifyLeft",
            "justifyCenter",
            "justifyRight",
            "justifyFull",
            "insertUnorderedList",
            "insertOrderedList",
            "indent",
            "outdent",
            "createLink",
            "unlink",
            "insertImage",
            //"insertFile",
            "subscript",
            "superscript",
            "createTable",
            "addRowAbove",
            "addRowBelow",
            "addColumnLeft",
            "addColumnRight",
            "deleteRow",
            "deleteColumn",
            "viewHtml",
            "formatting",
            "cleanFormatting",
            "fontName",
            "fontSize",
            "foreColor",
            "backColor",
            "print"
        ],

        fileBrowser: {
            messages: {
                dropFilesHere: "Drop files here"
            },
            transport: {
                read: "/kendo-ui/service/FileBrowser/Read",
                destroy: {
                    url: "/kendo-ui/service/FileBrowser/Destroy",
                    type: "POST"
                },
                create: {
                    url: "/kendo-ui/service/FileBrowser/Create",
                    type: "POST"
                },
                uploadUrl: "/kendo-ui/service/FileBrowser/Upload",
                fileUrl: "/kendo-ui/service/FileBrowser/File?fileName={0}"
            }
        },

        imageBrowser: {
            transport: {
                read: {
                    dataType: "json",
                    url: "{{route('cms.AdminPanelImages')}}" + "/read",
                },
                destroy: "{{route('cms.AdminPanelImages')}}" + "/destroy",
                create: "{{route('cms.AdminPanelImages')}}" + "/createDirectory",
                uploadUrl: "{{route('cms.AdminPanelImages')}}" + "/upload",
                //{
                //dataType: "json",
                //url: '/test/'//"{{route('cms.AdminPanelImages')}}" + "/upload",
                //dataType: 'json',
                //type: 'post',
                //data: function (data) {
                //    data._token = $('#incomeGrid').data('csrf');
                //    //alert(data._token);
                //    return data;
                //}

                //},
                thumbnailUrl: "{{route('cms.AdminPanelImages')}}" + "/thumbnail",
                imageUrl: "{{config('settings.UploadUrl')}}{0}"
            }   
        }
    });

    var editor = $("#editor{{$uid}}").data("kendoEditor");

    readRecords();

    function readRecords() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: "{{route('cms.AdminPanelPages')}}" + "/{{ $language }}/read/",
            type: "POST",
            data: "",

            success: function (response) {
                var row = "";

                // convert string to JSON
                var response1 = $.parseJSON(response);

                $.each(response1, function (i, item) {

                    row += "<tr>" +
                           "<td class=\"title\"" + "" + ">" + item.title + "</td>" +
                           "<td class=\"slug\">" + item.slug + "</td>" +
                           "<td class=\"id\" style=\"display:none;\">" + item.id + "</td>" +
                           "<td>" +
                           "<button class=\"editItem\">Edit</button>" + "<button class=\"deleteItem\">Delete</button>" + "<button class=\"manageItem\">Manage</button>" + "<button class=\"copyUrlItem\">Copy URL</button>"
                    "</td>" +

                    "</tr>";
                });

                $('#grid{{$uid}} > tbody:last-child').after(row);

                setEvent();
            },
            error: function (xhr, textStatus, thrownError) {
                alert("xhr status: " + xhr.statusText);
            },

        });

    };

    function showModalManage() {

        try {
            var myWindow = $("#EditWindow{{$uid}}");

            function onClose() {
                myWindow.fadeIn();
                $(".k-overlay").css("display", "none");
            }

            myWindow.kendoWindow({
                width: "90%",
                title: "ویرایش محتویات صفحه",
                visible: false,
                actions: [
                    //"Pin",
                    //"Minimize",
                    //"Maximize",
                    "Close"
                ],
                close: onClose
            }).data("kendoWindow").center().open();


            $(".k-overlay").css("display", "block");

            //clear content
            editor.value("");

            readContent();
        }
        catch ($exception) {
            alert($exception)
        }


    }

    function showModalEdit() {

        var wndAdd = $("#AddWindow{{$uid}}");

        wndAdd.click(function () {
            undo.fadeOut();
        });

        function onClose() {
            wndAdd.fadeIn();
            $(".k-overlay").css("display", "none");
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

        $("#addError{{$uid}}").html("");

        $(".k-overlay").css("display", "block");

    }

    function showModalDelete() {
        var undo = $("#confirm{{$uid}}");

        function onClose() {
            undo.fadeIn();
            $(".k-overlay").css("display", "none");
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

        $(".k-overlay").css("display", "block");
    }

    function showModalAdd() {

        $(".k-overlay").css("display", "block");

        var wndAdd = $("#AddWindow{{$uid}}");

        //wndAdd.click(function () {
        //    undo.fadeOut();
        //});

        function onClose() {
            wndAdd.fadeIn();
            $(".k-overlay").css("display", "none");
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

        $("#txtTitle{{$uid}}").val("");
        $("#txtPath{{$uid}}").val("");
        $("#addError{{$uid}}").html("");
    };

    function addTableRecord() {

        var $_title = $("#txtTitle{{$uid}}").val();
        var $_folder = $("#txtPath{{$uid}}").val();

        var request = "{{route('cms.AdminPanelPages')}}" + "/{{ $language }}/create?" + "title=" + $_title + "&slug=" + $_folder;

        $.post(request, function (data, status) {

            if (status == 'success') {

                var response = $.parseJSON(data);

                try {
                    var row = "<tr>" +
                                "<td class=\"title\"" + "" + ">" + $_title + "</td>" +
                                "<td class=\"slug\">" + $_folder + "</td>" +
                                "<td class=\"id\" style=\"display:none;\">" + response.id + "</td>" +
                                "<td>" +
                                "<button class=\"editItem\">Edit</button>" + "<button class=\"deleteItem\">Delete</button>" + "<button class=\"manageItem\">Manage</button>" +
                                "</td>" +
                                "</tr>";

                    //$('#grid{{$uid}} > tr:last').append(row);

                    $('#grid{{$uid}} > tbody').append(row);

                    setEvent();

                    $("#AddWindow{{$uid}}").data("kendoWindow").close();

                }
                catch ($exception) {
                    alert($exception);
                }
            }

        }).fail(function (jqXHR, textStatus, errorThrown) {
            $("#addError{{$uid}}").html('Error Message : ' + jqXHR.responseText);
        });
    }

    function editTableRecord() {

        try {
            var _title = $("#txtTitle{{$uid}}").val();
            var _folder = $("#txtPath{{$uid}}").val();
            var _id = Selectedrow.find(".id").text();

            var request = "{{route('cms.AdminPanelPages')}}" + "/{{ $language }}/update?" + "title=" + _title + "&slug=" + _folder + "&id=" + _id;
        }
        catch ($exception) {
            alert($exception);
        }


        $.post(request, function (data, status) {

            if (status == 'success') {

                try {

                    Selectedrow.find(".title").text(_title);
                    Selectedrow.find(".slug").text(_folder);

                    $("#AddWindow{{$uid}}").data("kendoWindow").close();
                }
                catch ($exception) {
                    alert($exception);
                }
            }

        }).fail(function (jqXHR, textStatus, errorThrown) {
            $("#addError{{$uid}}").html('Error Message : ' + jqXHR.responseText);
        });
    }

    function readContent() {
        var _id = Selectedrow.find(".id").text();

        var request = "{{route('cms.AdminPanelPages')}}" + "/{{ $language }}/readContent?" + "id=" + _id;

        $.post(request, function (data, status) {

            if (status == 'success') {

                try {

                    editor.value(decodeURIComponent(data));
                }
                catch ($exception) {
                    alert($exception);
                }
            }

        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert('Error Message : ' + jqXHR.responseText);
        });
    }

    function updateContent() {
        var _id = Selectedrow.find(".id").text();
        var content = editor.value();

        var encoded = encodeURIComponent(request);

        var request = "{{route('cms.AdminPanelPages')}}" + "/{{ $language }}/updateContent?" + "id=" + _id ;

       

        $.ajax({
            url: request,
            type: "POST",

            //data: JSON.stringify(content), //Data sent to server
            data: encodeURIComponent(content), //Data sent to server
            contentType: "application/json; charset=utf-8", // content type sent to server
            dataType: "json", //Expected data format from server

            success: function (response) {
                closeUpdateContentWindow();
            },
            error: function (xhr, textStatus, thrownError) {
                alert("xhr status: " + xhr.statusText);
            },

        });



        //$.post(request, function (data, status) {

        //    if (status == 'success') {

        //        try {
        //            closeUpdateContentWindow();
        //        }
        //        catch ($exception) {
        //            alert($exception);
        //        }
        //    }

        //}).fail(function (jqXHR, textStatus, errorThrown) {
        //    alert('Error Message : ' + jqXHR.responseText);
        //});
    }

    function closeUpdateContentWindow() {

        $("#EditWindow{{$uid}}").data("kendoWindow").close();
    }

    function setEvent() {

        $(".add").unbind();
        $("#btnAddRecord{{$uid}}").unbind();
        $("#btnDoDelete{{$uid}}").unbind();
        $("#btnDoUpdateContent{{$uid}}").unbind();
        $("#btnCancelUpdateContent{{$uid}}").unbind();


        $(".add").kendoButton({ icon: "add" }).click(function () {

            try {
                $("#txtTitle{{$uid}}").val('');
                $("#txtPath{{$uid}}").val('');

                addOperation = true;

                showModalAdd();
            }
            catch ($exception) {
                alert($exception);
            }

        });

        $(".editItem").kendoButton({}).click(function () {

            try {

                Selectedrow = $(this).closest("tr");

                //var _id = Selectedrow.find(".id").text();

                var title_val = Selectedrow.find(".title").text(); // Find the text
                var url_val = Selectedrow.find(".slug").text(); // Find the text

                addOperation = false;

                $("#txtPath{{$uid}}").val(url_val);
                $("#txtTitle{{$uid}}").val(title_val);

                showModalEdit();
            }
            catch ($exception) {
                alert($exception);
            }

        });

        $(".deleteItem").kendoButton({}).click(function () {

            Selectedrow = $(this).closest("tr");

            var title_val = Selectedrow.find(".title").text(); // Find the text
            var url_val = Selectedrow.find(".slug").text(); // Find the text

            showModalDelete();
        });

        $(".manageItem").kendoButton({}).click(function () {

            Selectedrow = $(this).closest("tr");

            var title_val = Selectedrow.find(".title").text(); // Find the text
            var url_val = Selectedrow.find(".slug").text(); // Find the text

            //alert(title_val + "--" + url_val + "--" + slug_val);

            $("#txtUrl{{$uid}}").val(url_val);
            $("#txtTitle{{$uid}}").val(title_val);

            SelectedFolder = url_val;

            showModalManage();
        });


        $(".copyUrlItem").kendoButton({}).click(function () {

            Selectedrow = $(this).closest("tr");

            var title_val = Selectedrow.find(".title").text(); // Find the text
            var url_val = Selectedrow.find(".slug").text(); // Find the text            
            var id_val = Selectedrow.find(".id").text(); // Find the text 

            //var address = "http://" + window.location.href + '/' + id_val + '/' + url_val;

            var address = "http://" + window.location.host + '/page/{{$language}}/' + id_val + '/' + url_val;

            window.prompt("Copy to clipboard: Ctrl+C, Enter", address);
                   
        });


        $("#btnDoDelete{{$uid}}").kendoButton({}).click(function () {

            //var title_val = Selectedrow.find(".title").text(); // Find the text
            //var url_val = Selectedrow.find(".slug").text(); // Find the text

            var _id = Selectedrow.find(".id").text();

            var request = "{{route('cms.AdminPanelPages')}}" + "/{{ $language }}/destroy?" + "id=" + _id;

            $.post(request, function (data, status) {

                if (status == 'success') {

                    try {

                        Selectedrow.css("background-color", "#999999");
                        Selectedrow.fadeOut(400, function () {
                            Selectedrow.remove();
                        });

                        $("#confirm{{$uid}}").data("kendoWindow").close();
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

        $("#btnCancelDelete{{$uid}}").kendoButton({}).click(function () {
            $("#confirm{{$uid}}").data("kendoWindow").close().fadeIn();
        });

        $("#btnAddRecord{{$uid}}").kendoButton({}).click(function () {

            if (addOperation)
                addTableRecord();
            else
                editTableRecord();
        });

        $("#btnDoUpdateContent{{$uid}}").kendoButton({}).click(function () {
            updateContent();
        });

        $("#btnCancelUpdateContent{{$uid}}").kendoButton({}).click(function () {
            closeUpdateContentWindow();
        });
    };


</script>

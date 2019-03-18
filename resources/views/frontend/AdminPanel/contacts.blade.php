@extends('frontend.AdminPanel.layout.master')


@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h5>پیام مخاطبین</h5>
    </div>
    <div class="panel-body">
        <div id="grid"></div>
    </div>
</div>

<script>

    var zipCodesEditor = function (container, options) {
        $('<textarea data-bind="value: ' + options.field + '"></textarea>').appendTo(container);
    };

    var dataSource = new kendo.data.DataSource({

        transport: {
            read: {
                url: "{{route('cms.AdminPanelContact')}}" + "/read",
                dataType: "json",
                type: "GET"
            },
            update: {
                url: "{{route('cms.AdminPanelContact')}}" + "/update",
                dataType: "json",
                type: "get"
            },
            destroy: {
                url: "{{route('cms.AdminPanelContact')}}" + "/destroy",
                dataType: "json",
                type: "get"
            },
            create: {
                url: "{{route('cms.AdminPanelContact')}}" + "/create",
                dataType: "json",
                type: "get"
            },
            parameterMap: function (options, operation) {

                if (operation !== "read" && options.models) {
                    return kendo.stringify(options);
                }
                return kendo.stringify(options);

            }
        },
        batch: false,
        pageSize: 10,
        serverGrouping: false,
        sortable: true,
        schema: {

            model: {
                id: "id",
                fields: {
                    id: { editable: false },
                    message: { editable: true },
                    name: { editable: true },
                    email: { editable: true },
                    phoneNumber: { editable: true },
                    created_at: { editable: false },
                    updated_at: { editable: false }
                },
            },
            total: function (response) { return response.total; },
            data: "data",
        }
    });

    $("#grid").html('');

    $("#grid").kendoGrid({
        dataSource: dataSource,
        pageable: true,
        height: 550,
        //toolbar: ["create"],

        columns: [{
            field: "name",
            title: "نام ارسال کننده",
        }, {
            field: "email",
            title: "آدرس ایمیل",
        }, {
            field: "phoneNumber",
            title: "شماره تماس"
        }, {
            field: "message",
            title: "متن پیام",
            width: 500,
            editor: zipCodesEditor
        }, {
            command: ["edit", "destroy"],
            title: "&nbsp;", width: "200px"
        }],
        editable: "popup",
    });

   

</script>

@endsection
<div id="grid"></div>

<script>
    var dataSource = new kendo.data.DataSource({

        transport: {
            read: {
                url: "{{route('cms.AdminPanelProducts')}}" + "/{{ $language }}/read",
                dataType: "json",
                type: "GET"
            },
            update: {
                url: "{{route('cms.AdminPanelProducts')}}" + "/{{ $language }}/update",
                dataType: "json",
                type: "get"
            },
            destroy: {
                url: "{{route('cms.AdminPanelProducts')}}" + "/{{ $language }}/destroy",
                dataType: "json",
                type: "get"
            },
            create: {
                url: "{{route('cms.AdminPanelProducts')}}" + "/{{ $language }}/create",
                dataType: "json",
                type: "get"
            },
            parameterMap: function (options, operation) {

                //alert(kendo.stringify(options));

                if (operation !== "read" && options.models) {
                    return kendo.stringify(options);
                }
                return kendo.stringify(options);

            }
        },
        batch: false,
        pageSize: 10,
        serverGrouping: true,
        schema: {

            model: {
                id: "id",
                fields: {
                    id: { editable: false },
                    product_title: { editable: true },
                    product_description: { editable: true },
                    product_page_url: { editable: true },
                    product_picture_url: { editable: true },
                    created_at: { editable: false },
                    updated_at: { editable: false }
                },
            },
            total: function (response) { return response.total; },
            data: "data"
        }
    });

    $("#grid").html('');

    $("#grid").kendoGrid({
        dataSource: dataSource,
        pageable: true,
        height: 550,
        toolbar: ["create"],

        columns: [{
            field: "id",
            title: "ID",
        }, {
            field: "product_title",
            title: "product_title",
        }, {
            field: "product_description",
            title: "product_description"
        }, {
            field: "product_page_url",
            field: "product_picture_url",

            //}, {
            //    field: "updated_at",
            //    field: "updated_at",
            //}, {
            //    field: "created_at",
            //    field: "created_at",
        }, {
            command: ["edit", "destroy"],
            title: "&nbsp;", width: "250px"
        }],
        editable: "popup",
    });



    $(document).ready(function () { });

    $(document).ajaxComplete(function () {
        showTable();
    });

function showTable ( )
{
	 
}


</script>

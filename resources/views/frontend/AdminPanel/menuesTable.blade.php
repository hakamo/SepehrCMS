<div id="grid"></div>

<script>
    var dataSource = new kendo.data.DataSource({

        transport: {
            read: {
                url: "{{route('cms.AdminPanelMenues')}}" + "/{{ $language }}/read",
                dataType: "json",
                type: "GET"
            },
            update: {
                url: "{{route('cms.AdminPanelMenues')}}" + "/{{ $language }}/update",
                dataType: "json",
                type: "get"
            },
            destroy: {
                url: "{{route('cms.AdminPanelMenues')}}" + "/{{ $language }}/destroy",
                dataType: "json",
                type: "get"
            },
            create: {
                url: "{{route('cms.AdminPanelMenues')}}" + "/{{ $language }}/create",
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
        serverGrouping: false,
        sortable : true,
        schema: {

            model: {
                id: "id",
                fields: {
                    id: { editable: false },
                    title: { editable: true },
                    url: { editable: true },
                    parentId: { editable: true },
                    index: { editable: true },
                    linkId: { editable: true },
                    created_at: { editable: false },
                    updated_at: { editable: false }
                },
            },
            total: function (response) { return response.total; },
            data: "data",
        },
        sort: { field: "linkId", dir: "asc" }
    });

    $("#grid").html('');

    $("#grid").kendoGrid({
        dataSource: dataSource,
        pageable: true,
        height: 550,
        toolbar: ["create"],

        columns: [{
            field: "linkId",
            title: "شناسه لینک",
        }, {
            field: "parentId",
            title: "شناسه لینک مادر",
        }, {
            field: "title",
            title: "عنوان لینک",
        }, {
            field: "url",
            title: "آدرس صفحه مورد نظر"
        }, {
            field: "index",
            title: "اندیس نمایش",
        }, {
            command: ["edit", "destroy"],
            title: "&nbsp;", width: "250px"
        }],
        editable: "popup",
    });  

</script>

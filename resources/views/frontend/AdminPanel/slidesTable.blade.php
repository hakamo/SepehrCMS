<div id="grid"></div>

<script>
    var dataSource = new kendo.data.DataSource({

        transport: {
            read: {
                url: "{{route('cms.AdminPanelSlides')}}" + "/{{ $language }}/read",
                dataType: "json",
                type: "GET"
            },
            update: {
                url: "{{route('cms.AdminPanelSlides')}}" + "/{{ $language }}/update",
                dataType: "json",
                type: "get"
            },
            destroy: {
                url: "{{route('cms.AdminPanelSlides')}}" + "/{{ $language }}/destroy",
                dataType: "json",
                type: "get"
            },
            create: {
                url: "{{route('cms.AdminPanelSlides')}}" + "/{{ $language }}/create",
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
        serverGrouping: true,
        schema: {

            model: {
                id: "id",
                fields: {
                    id: { editable: false },
                    ButtonTitle: { editable: true },
                    Description: { editable: true },
                    FilePath: { editable: true },
                    Title: { editable: true },
                    itemUrl: { editable: true },
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

        columns: [
                    {
                        field: "ButtonTitle",
                        title: "ButtonTitle",
                    }
                    ,

                    {
                        field: "Description",
                        title: "Description"
                    }
                    ,
                    {
                        field: "FilePath",
                        title: "FilePath",
                    }
                    ,
                    {
                        field: "Title",
                        title: "Title",
                    }
                    ,
                    {
                        field: "itemUrl",
                        title: "Item URL",
                    }
                    ,
                    {
                        command: ["edit", "destroy"],
                        title: "&nbsp;", width: "250px"
                    }],

        editable: "popup",
    });

</script>

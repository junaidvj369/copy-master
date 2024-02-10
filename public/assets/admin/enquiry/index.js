$(document).ready(function () {
    let table;
    AjaxAdminListTable();

    function AjaxAdminListTable() {
        let columns = [
           
            {
                data: "id",
            },
            {
                data: "name",
            },
            {
                data: "email",
            },
            {
                data: "contact_no",
            },
            {
                data: "service",
            },
            {
                data: "message",
            },
        ];

        if ($.fn.DataTable.isDataTable("#enquiry_table")) {
            $("#enquiry_table").DataTable().destroy();
        }

        table = $("#enquiry_table").DataTable({
            bProcessing: true,
            serverSide: true,
            pageLength: 10,
            paging: true,
            bSort: true,
            order: [[1, "asc"]],
            scrollX: true,

            ajax: {
                url: $("#enquiry_table").data("route"), // json datasource
                type: "post", // type of method  , by default would be get
                datatype: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: function (data) {
                    data.custom_filter = $("#custom_select").val();
                },
                error: function () {
                    // error handling code
                    // $("#reports_visitors_processing").css("display", "none");
                },
            },
            columns: columns,
            lengthMenu: [
                [10, 20, 40, 60, 80, 100, -1],
                [10, 20, 40, 60, 80, 100, "All"],
            ],
            dom: "<'row'<'col-sm-6 text-left'B><'col-sm-6 text-right'f>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager pt-2'lp>>",
        });
    }
});

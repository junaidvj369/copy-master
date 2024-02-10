$(document).ready(function () {
    let table;
    AjaxAdminListTable();

    function AjaxAdminListTable() {
        let columns = [
           
            {
                data: "exam_name",
            },
            {
                data: "class_name",
            },
            {
                data: "subject_name",
            },
            {
                data: "chapter_name",
            },
            {
                data: "question",
            },
            {
                data: "status",
            },
            {
                data: "actions",
                orderable: false,
            },
        ];

        if ($.fn.DataTable.isDataTable("#question_table")) {
            $("#question_table").DataTable().destroy();
        }

        table = $("#question_table").DataTable({
            bProcessing: true,
            serverSide: true,
            pageLength: 10,
            paging: true,
            bSort: true,
            order: [[1, "asc"]],
            scrollX: true,

            ajax: {
                url: $("#question_table").data("route"), // json datasource
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

    $(document).on("click", ".delete_question", function (event) {
        event.preventDefault();
        let button = $(this);
        let route = button.data("route");

        Swal.fire({
            title: "Are you sure you wish to delete this?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-secondary",
            },
            buttonsStyling: true,
            confirmButtonText: "Delete",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                let options = {
                    url: route,
                    method: "DELETE",
                };
                let client = new HttpClient(options);
                client.acceptJson();
                client.setErrorHandler(errorHandler, "Master");
                client.setSuccessHandler(successHandler);
                return client.send();
            },
            allowOutsideClick: () => !Swal.isLoading(),
        });
    });

    function successHandler(response, textStatus, jqXHR, httpClient) {
        if (response.success) {
            Swal.fire("Deleted!", response.message, "success").then(() => {
                table.draw(false);
            });
        } else {
            Swal.fire("Failed!", response.message, "error");
        }
    }

    function errorHandler(statusCode, responseJson, jqXHR, httpClient) {
        Swal.fire(
            "Failed!",
            (responseJson || "").message || "Something went wrong",
            "error"
        );
    }

});

$(function () {
    let form = $("#question_status_form");

    let validator = form.validate({
        normalizer: function (value) {
            return $.trim(value);
        },
        ignore: [],
        rules: {
            status: {
                required: true,
            },

            // This is just dummy rule
            // It is added so that showErrors() method would show error labels under otherwise may throw error
            error: {
                required: false,
            },
        },
        messages: {},
        // the default class 'error' has some styling issues so we are using custom classes
        errorClass: "validation-error text-danger",
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        showErrors: function (errorMap, errorList) {
            this.defaultShowErrors();
        },
        submitHandler: function (formElement, event) {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure do you want change status?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-secondary",
                },
                buttonsStyling: true,
                confirmButtonText: "Confirm",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    let formData = new FormData($(form)[0]);

                    let url = form.data("action");

                    let options = {
                        url: url,
                        data: formData,
                        method: "POST",

                        // contentType:false and processData:false are needed when sending formData
                        contentType: false,
                        processData: false,
                        disableLoader: false,
                    };

                    const client = new HttpClient(options);

                    client.acceptJson();
                    client.setErrorHandler(validationHandler, 422);
                    client.setSuccessHandler(successHandler);

                    client.send();
                },
                allowOutsideClick: () => !Swal.isLoading(),
            });
        },
    });

    function validationHandler(statusCode, responseJson, jqXHR, httpClient) {
        let response = responseJson;
        if (response) {
            let errors = (response || {}).errors;
            if (errors) {
                validator.showErrors(response.errors);
            }
        }
    }
    function errorHandler(statusCode, responseJson, jqXHR, httpClient) {
        Swal.fire(
            "Failed!",
            (responseJson || "").message || "Something went wrong",
            "error"
        );
    }

    function successHandler(response, textStatus, jqXHR, httpClient) {
        let redirect = form.data("redirect");
        if (response.success) {
            Swal.fire({
                title: "Question Status",
                text: "Satus Changed successfully",
                icon: "success",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
                buttonsStyling: true,
                confirmButtonText: "Ok",
                willClose: () => {
                    location.href = redirect;
                },
            });
        }
    }

   
});

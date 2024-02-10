$(function () {
    let form = $("#chapter_form");
    let status = $("#status");

    let validator = form.validate({
        normalizer: function (value) {
            return $.trim(value);
        },
        ignore: [],
        rules: {
            exam_id: {
                required: true,
            },
            class_id: {
                required: true,
            },
            subject_id: {
                required: true,
            },
            chapter_name: {
                required: true,
                maxlength: 100,
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

            let formData = new FormData($(form)[0]);

            formData.append("is_active", status.is(":checked") ? 1 : 0);

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
            client.spoofMethod("PATCH");
            client.setErrorHandler(validationHandler, 422);
            client.setSuccessHandler(successHandler);

            client.send();
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

    function successHandler(response, textStatus, jqXHR, httpClient) {
        let redirect = form.data("redirect");
        if (response.success) {
            Swal.fire({
                title: "Chapter",
                text: "Chapter Updated successfully",
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

    $(document).on("change", "#exam_id", function (event) {

        var examId = this.value;
        var URL = window.config.baseUrl;


        $.ajax({
            url: URL+ 'admin/chapter/exam-data/' + examId,
            type: "GET",
            success: function (res) {
                var classes = res.class;
                var subjects = res.subject;
                var html = "<option value=''> Select </option>";
                var html2 = "<option value=''> Select </option>";

                $.each(classes, function (ind, item) {
                    html +=
                        "<option value='" +
                        item.id +
                        "'> " +
                        item.CLASS_NAME +
                        "</option>";
                });

                $.each(subjects, function (ind, item) {
                    html2 +=
                        "<option value='" +
                        item.id +
                        "'> " +
                        item.SUBJECT_NAME +
                        "</option>";
                });

                $("#class_id").html(html);
                $("#subject_id").html(html2);
            },
        });
    })
});

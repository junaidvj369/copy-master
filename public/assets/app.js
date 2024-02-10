class ErrorHandler {
    constructor(statusCode, responseJson, jqXHR, httpClient) {
        let response = responseJson || {};
        this.statusCode = statusCode;
        this.jqXHR = jqXHR;
        this.responseJson = responseJson;
        this.httpClient = httpClient;

        this.code = response.code;
        this.message = response.message;
        this.errors = response.errors;

        this.initDefaultHandlers();
    }

    /**
     * Handle the error
     */
    handle() {
        this.runBeforeHandler();

        // If user has defined a master handler, only the master handler will be run
        if (this.errorMasterHandler) {
            return this.runMasterHandler();
        }
        switch (this.statusCode) {
            case 200:
                // Not an error 😐
                // Someone has messed up
                break;
            case 400:
                // General Error
                this.handle400();
                break;
            case 401:
                // Not Authenticated
                this.handle401();
                break;
            case 403:
                // Permission Denied
                this.handle403();
                break;
            case 404:
                // Not found
                this.handle404();
                break;
            case 405:
                // Method not allowed
                // If this error occurs, then it needs to be fixed by developer
                this.handle405();
                break;
            case 408:
                // Timeout
                this.handle408();
                break;
            case 409:
                // Conflict
                this.handle409();
                break;
            case 419:
                // Csrf issue. Page Expired
                this.handle419();
                break;
            case 422:
                // Validation Error
                // Default validation handler should be avoided
                // Validation errors should ideally be displayed using custom handler
                this.handle422();
                break;
            case 429:
                // Too many requests. Rate limited
                this.handle429();
                break;
            case 500:
                // Server Error
                this.handle500();
                break;
            case 503:
                // Server down or under maintenance
                this.handle503();
                break;
            default:
                // for any other status code
                this.handleDefault();
                break;
        }
        this.runAfterHandler();
    }

    handle400() {
        return this.error400Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handle401() {
        return this.error401Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handle403() {
        return this.error403Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handle404() {
        return this.error404Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handle405() {
        return this.error405Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handle408() {
        return this.error408Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handle409() {
        return this.error409Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handle419() {
        return this.error419Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handle422() {
        return this.error422Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handle429() {
        return this.error429Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handle500() {
        return this.error500Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handle503() {
        return this.error503Handler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    handleDefault() {
        return this.errorDefaultHandler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    runMasterHandler() {
        return this.errorMasterHandler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    runAfterHandler() {
        return this.errorAfterHandler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    runBeforeHandler() {
        return this.errorBeforeHandler(
            this.statusCode,
            this.responseJson,
            this.jqXHR,
            this.httpClient
        );
    }

    set400Handler(handler) {
        this.error400Handler = handler.bind(this);
    }

    set401Handler(handler) {
        this.error401Handler = handler.bind(this);
    }

    set403Handler(handler) {
        this.error403Handler = handler.bind(this);
    }

    set404Handler(handler) {
        this.error404Handler = handler.bind(this);
    }

    set405Handler(handler) {
        this.error405Handler = handler.bind(this);
    }

    set408Handler(handler) {
        this.error408Handler = handler.bind(this);
    }

    set409Handler(handler) {
        this.error409Handler = handler.bind(this);
    }

    set419Handler(handler) {
        this.error419Handler = handler.bind(this);
    }

    set422Handler(handler) {
        this.error422Handler = handler.bind(this);
    }

    set429Handler(handler) {
        this.error429Handler = handler.bind(this);
    }

    set500Handler(handler) {
        this.error500Handler = handler.bind(this);
    }

    set503Handler(handler) {
        this.error503Handler = handler.bind(this);
    }

    setDefaultHandler(handler) {
        this.errorDefaultHandler = handler.bind(this);
    }

    setAfterHandler(handler) {
        this.errorAfterHandler = handler.bind(this);
    }

    setBeforeHandler(handler) {
        this.errorBeforeHandler = handler.bind(this);
    }

    /**
     * This method will set the master handler.
     * If master handler is set, none of the other handlers will be run
     * All errors must be handled by master handler
     *
     * @param {Function} handler
     */
    setMasterHandler(handler) {
        this.errorMasterHandler = handler.bind(this);
    }

    setHandlerForStatusCode(handler, statusCode = "Master") {
        if (statusCode) {
            let term = "set" + statusCode + "Handler";
            this[term](handler);
        } else {
            this.setMasterHandler(handler);
        }
    }

    /**
     * Initialize default error handlers
     */
    initDefaultHandlers() {
        this.error400Handler = this.defaultError400Handler;
        this.error401Handler = this.defaultError401Handler;
        this.error403Handler = this.defaultError403Handler;
        this.error404Handler = this.defaultError404Handler;
        this.error405Handler = this.defaultError405Handler;
        this.error408Handler = this.defaultError408Handler;
        this.error409Handler = this.defaultError409Handler;
        this.error419Handler = this.defaultError419Handler;
        this.error422Handler = this.defaultError422Handler;
        this.error429Handler = this.defaultError429Handler;
        this.error500Handler = this.defaultError500Handler;
        this.error503Handler = this.defaultError503Handler;
        this.errorDefaultHandler = this.defaultErrorDefaultHandler;
        this.errorAfterHandler = this.defaultErrorAfterHandler;
        this.errorBeforeHandler = this.defaultErrorBeforeHandler;
    }

    defaultError400Handler(statusCode, responseJson, jqXHR, httpClient) {
        let message = (responseJson || {}).message || "Something went wrong";
        Swal.fire({
            title: "Error",
            text: message,
            icon: "error",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: "Ok",
        });
    }

    defaultError401Handler(statusCode, responseJson, jqXHR, httpClient) {
        let loginRoute = window.config.loginRoute;
        let buttonText = "Go to Login";
        if (!loginRoute) {
            buttonText = "Reload Page";
        }
        Swal.fire({
            title: "Session Expired",
            text: "Looks like you have been logged out. Please Login to continue",
            icon: "warning",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: buttonText,
            willClose: () => {
                if (loginRoute) {
                    location.href = loginRoute;
                } else {
                    location.reload();
                }
            },
        });
    }

    defaultError403Handler(statusCode, responseJson, jqXHR, httpClient) {
        Swal.fire({
            title: "Permission Denied",
            text: "Looks like you do not have permission to perform this action.",
            icon: "error",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: "Ok",
        });
    }

    defaultError404Handler(statusCode, responseJson, jqXHR, httpClient) {
        Swal.fire({
            title: "Not Found",
            text: "Looks like the requested resource was not found.",
            icon: "error",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: "Ok",
        });
    }

    defaultError405Handler(statusCode, responseJson, jqXHR, httpClient) {
        Swal.fire({
            title: "Technical Error",
            text: "Oops, A technical error has occurred.",
            icon: "error",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: "Ok",
        });
    }

    defaultError408Handler(statusCode, responseJson, jqXHR, httpClient) {
        Swal.fire({
            title: "Timeout",
            text: "Request Timeout. Please try again",
            icon: "error",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: "Ok",
        });
    }

    defaultError409Handler(statusCode, responseJson, jqXHR, httpClient) {
        let message = (responseJson || {}).message || "Something went wrong";
        Swal.fire({
            title: "Error",
            text: message,
            icon: "error",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: "Ok",
        });
    }

    defaultError419Handler(statusCode, responseJson, jqXHR, httpClient) {
        Swal.fire({
            title: "Page Expired",
            text: "Looks like the page has expired. Please Refresh the page and try again",
            icon: "error",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: "Refresh",
            willClose: () => {
                // location.reload();
            },
        });
    }

    defaultError422Handler(statusCode, responseJson, jqXHR, httpClient) {
        const message =
            (responseJson || {}).message ||
            "Looks like you have entered some incorrect input";
        Swal.fire({
            title: "Incorrect Input",
            text: message,
            icon: "error",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: "Refresh",
            willClose: () => {
                location.reload();
            },
        });
    }

    defaultError429Handler(statusCode, responseJson, jqXHR, httpClient) {
        let message =
            (responseJson || {}).message ||
            "We have received too many requests from your side. Please wait for some time and try again";

        let seconds = (jqXHR || {}).getResponseHeader("Retry-After");
        if (seconds) {
            let html =
                'We have received too many requests from your side. Please wait for <span class="js-timer-seconds">' +
                seconds +
                "</span> seconds and try again";
            let timerInterval;
            Swal.fire({
                title: "Too many requests",
                html: html,
                icon: "error",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
                buttonsStyling: true,
                showConfirmButton: true,
                showLoaderOnConfirm: false,
                confirmButtonText: "Ok",
                timer: seconds * 1000,
                timerProgressBar: true,
                didOpen: () => {
                    // Swal.showLoading()
                    timerInterval = setInterval(() => {
                        const content = Swal.getContent();
                        if (content) {
                            const b =
                                content.querySelector(".js-timer-seconds");
                            if (b) {
                                b.textContent = parseInt(
                                    Swal.getTimerLeft() / 1000
                                );
                            }
                        }
                    }, 1000);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    Swal.fire({
                        title: "Too many requests",
                        text: "Your blocked time is over. You may try again now",
                        icon: "warning",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                        buttonsStyling: true,
                        confirmButtonText: "Ok",
                    });
                }
            });
        } else {
            Swal.fire({
                title: "Too many requests",
                text: message,
                icon: "error",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
                buttonsStyling: true,
                confirmButtonText: "Ok",
            });
        }
    }

    defaultError500Handler(statusCode, responseJson, jqXHR, httpClient) {
        Swal.fire({
            title: "Error",
            text: "A Technical Error has occurred. Please try again after some time",
            icon: "error",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: "Ok",
        });
    }

    defaultError503Handler(statusCode, responseJson, jqXHR, httpClient) {
        Swal.fire({
            title: "Server down or under mainteneance",
            text: "Looks like the server is down or under maintenance right now. Please try again after some time",
            icon: "error",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: "Ok",
        });
    }

    defaultErrorDefaultHandler(statusCode, responseJson, jqXHR, httpClient) {
        let message = (responseJson || {}).message || "Something went wrong";
        Swal.fire({
            title: "Error",
            text: message,
            icon: "error",
            customClass: {
                confirmButton: "btn btn-primary",
            },
            buttonsStyling: true,
            confirmButtonText: "Ok",
        });
    }

    defaultErrorAfterHandler(statusCode, responseJson, jqXHR, httpClient) {}

    defaultErrorBeforeHandler(statusCode, responseJson, jqXHR, httpClient) {}
}

class HttpClient {
    constructor(options = {}) {
        this.initDefaultOptions();
        const defaultOptions = JSON.parse(
            JSON.stringify(this.getDefaultOptions())
        );
        const mergedOptions = $.extend({}, defaultOptions, options);

        this.setOptions(mergedOptions);
    }

    initDefaultOptions() {
        const defaultOptions = {
            // The base url
            baseUrl: this.getDefaultBaseUrl(),
            // The endpoint
            endpoint: "",
            // The url. If not specified, endpoint will be appended to baseUrl and it will be set as the url
            url: "",
            method: "GET",
            dataType: "json",
            headers: {},
            params: {},
        };

        this.appendCsrfHeader(defaultOptions);

        this.defaultOptions = defaultOptions;
    }

    getDefaultOptions() {
        return this.defaultOptions;
    }

    getDefaultBaseUrl() {
        // return process.env.MIX_APP_URL
        return window.config.baseUrl;
    }

    setOptions(options) {
        Object.keys(options).forEach((key) => {
            this.setOption(key, options[key]);
        });
    }

    setOption(key, value) {
        this.getOptions()[key] = value;
    }

    getOptions() {
        let options = this.options;
        if (!options) {
            this.options = {};
        }
        return this.options;
    }

    getOption(key) {
        return this.getOptions()[key];
    }

    setEndpoint(value) {
        this.setOption("endpoint", value);
    }

    getEndpoint() {
        return this.getOption("endpoint");
    }

    setMethod(value) {
        this.setOption("method", value);
    }

    getMethod() {
        return this.getOption("method");
    }

    setHeaders(value) {
        this.setOption("headers", value);
    }

    getHeaders() {
        return this.getOption("headers");
    }

    addHeader(header, value) {
        let headers = this.getOption("headers");
        headers[header] = value;
        this.setOption("headers", headers);
    }

    setParams(value) {
        this.setOption("params", value);
    }

    getParams() {
        return this.getOption("params");
    }

    addParam(param, value) {
        let params = this.getOption("params");
        params[param] = value;
        this.setOption("params", params);
    }

    setBaseUrl(value) {
        this.setOption("baseUrl", value);
    }

    getBaseUrl() {
        return this.getOption("baseUrl");
    }

    send() {
        let options = this.getOptions();

        if (!options.url) {
            const url = this.generateUrl();
            this.setOption("url", url);
            options.url = url;
        }

        if (this.shouldStartLoader()) {
            CLoader.start();
        }

        options.httpClient = this;

        return $.ajax(options)
            .done(function (response, textStatus, jqXHR) {
                let options = this.httpClient.options;
                if (options.successHandler) {
                    let successHandler = options.successHandler;

                    successHandler(
                        response,
                        textStatus,
                        jqXHR,
                        this.httpClient
                    );
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                const status = jqXHR.status;
                let options = this.httpClient.options;
                let response = jqXHR.responseJSON;
                let errorHandler = new ErrorHandler(
                    status,
                    response,
                    jqXHR,
                    this.httpClient
                );

                if (options.errorHandler) {
                    let statusCode = Object.keys(options.errorHandler)[0];

                    let customErrorHandler = options.errorHandler[statusCode];
                    if (!statusCode) {
                        statusCode = "Master";
                    }
                    errorHandler.setHandlerForStatusCode(
                        customErrorHandler,
                        statusCode
                    );
                }

                errorHandler.handle();
            })
            .always(function () {
                if (this.httpClient.shouldStopLoader()) {
                    CLoader.stop();
                }
            });
        // return ajax
        // return axios.request(options)
    }

    generateUrl() {
        let baseUrl = this.getOption("baseUrl");
        let endPoint = this.getOption("endpoint") || "";
        let urlObj = new URL(
            this.removeTrailingSlash(baseUrl) + this.addLeadingSlash(endPoint)
        );

        let params = this.getParams() || {};
        if (params) {
            Object.keys(params).forEach((key) => {
                urlObj.searchParams.append(key, params[key]);
            });
        }
        const url = urlObj.toString();

        return url;
    }

    removeTrailingSlash(string) {
        return string.replace(/\/+$/, "");
    }

    removeLeadingSlash(string) {
        return string.replace(/^\/+/, "");
    }

    addLeadingSlash(string) {
        if (string) {
            return "/" + this.removeLeadingSlash(string);
        }
        return string;
    }

    getCookie(key) {
        if (typeof document === "undefined" || (arguments.length && !key)) {
            return;
        }

        // To prevent the for loop in the first place assign an empty array
        // in case there are no cookies at all.
        var cookies = document.cookie ? document.cookie.split("; ") : [];
        var jar = {};
        for (var i = 0; i < cookies.length; i++) {
            var parts = cookies[i].split("=");
            var value = parts.slice(1).join("=");

            try {
                var foundKey = decodeURIComponent(parts[0]);
                jar[foundKey] = converter.read(value, foundKey);

                if (key === foundKey) {
                    break;
                }
            } catch (e) {}
        }

        return key ? jar[key] : jar;
    }

    /**
     * Get the XSRF-TOKEN from header
     */
    getXSRFToken() {
        return this.getCookie("XSRF-TOKEN");
    }

    /**
     * Get the csrf token from meta tag
     */
    getCSRFToken() {
        return $('meta[name="csrf-token"]').attr("content");
    }

    /**
     * Append the xsrf header
     *
     * @param {} options
     */
    appendCsrfHeader(options) {
        let xsrf = this.getXSRFToken();
        let headers = {};

        // If got xsrf token
        if (xsrf) {
            headers["X-XSRF-TOKEN"] = xsrf;
        } else {
            // then get csrf token
            let csrf = this.getCSRFToken();
            headers["X-CSRF-TOKEN"] = csrf;
        }
        options.headers = $.extend({}, headers, options.headers);

        return options;
    }

    spoofMethod(method) {
        this.addHeader("X-HTTP-METHOD-OVERRIDE", method);
    }

    acceptJson() {
        this.addHeader("Accept", "application/json");
    }

    setErrorHandler(handler, statusCode = "Master") {
        let obj = {};
        obj[statusCode] = handler;
        this.setOption("errorHandler", obj);
    }

    setSuccessHandler(handler) {
        this.setOption("successHandler", handler);
    }

    dontStartLoader() {
        this.disableStartLoader = true;
    }

    dontStopLoader() {
        this.disableStopLoader = true;
    }

    shouldStartLoader() {
        return !this.shouldNotStartLoader();
    }

    shouldDisableLoader() {
        return this.getOption("disableLoader");
    }

    shouldNotStartLoader() {
        return this.shouldDisableLoader() || this.disableStartLoader;
    }

    shouldStopLoader() {
        return !this.shouldNotStopLoader();
    }

    shouldNotStopLoader() {
        return this.shouldDisableLoader() || this.disableStopLoader;
    }
}

class CustomLoader {
    start() {
        $("body").prepend(this.loaderHtml());
    }

    stop() {
        $("body")
            .find("." + this.loaderClass())
            .remove();
    }

    loaderHtml() {
        return ` <div class="${this.loaderClass()}">Loading&#8230;</div>`;
    }

    loaderClass() {
        return "loading";
    }
}

let CLoader = new CustomLoader();

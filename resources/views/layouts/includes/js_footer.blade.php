    <script src="{{ asset('assets/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/gleek.js') }}"></script>
    <script src="{{ asset('assets/js/styleSwitcher.js') }}"></script>
    <script src="{{ asset('assets/datatable/datatables.min.js') }}"></script>

    <!-- Chartjs -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Circle progress -->
    <script src="{{ asset('assets/plugins/circle-progress/circle-progress.min.js') }}"></script>
    <!-- Datamap -->
    <script src="{{ asset('assets/plugins/d3v3/index.js') }}"></script>
    <script src="{{ asset('assets/plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datamaps/datamaps.world.min.js') }}"></script>
    <!-- Morrisjs -->
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
    <!-- Pignose Calender -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    <!-- ChartistJS -->
    
    <script src="{{ asset('assets/js/sweet-alert/sweetalert2.min.js') }}"></script>


    <script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script>

    <script src="{{ asset('assets/app.js') }}"></script>
    

<script>
     window.config = {
        // baseUrl: "{{ asset('') }}",
        // baseUrl: $("#site-url").val()
         baseUrl: "{{env('APP_URL')}}"
     }
    class CommonDataLoader {
        constructor(options = {}) {

        }

        successHandler(response, textStatus, jqXHR, httpClient) {

        }

        getAdditionalResource() {
            let url = "";

            let options = {
                url: url
                , data: formData
                , method: "GET",

                // contentType:false and processData:false are needed when sending formData
                contentType: false
                , processData: false
                , disableLoader: false
            , };

            const client = new HttpClient(options);

            client.acceptJson();

            client.setErrorHandler(validationHandler, 422);

            client.setSuccessHandler(successHandler);

            client.send();

        }



        getVideos() {}
        getFlashcards() {}
        getPools() {}
    }

</script>
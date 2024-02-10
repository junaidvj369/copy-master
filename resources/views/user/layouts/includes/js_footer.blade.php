  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('frontend/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <!-- Template Main JS File -->
  <script src="{{ asset('frontend/assets/js/main.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/js/sweet-alert/sweetalert2.min.js') }}"></script>
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
          url: url,
          data: formData,
          method: "GET",

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

      }



      getVideos() {}
      getFlashcards() {}
      getPools() {}
    }
  </script>
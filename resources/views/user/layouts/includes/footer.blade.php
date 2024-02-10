  <!-- ======= Footer ======= -->
  <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">


    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('home')}}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('about')}}">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('services')}}">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('contact')}}">Contact</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              Near Abu Baker Metro Station <br>

              Hor Al Anz Shop No: 21 <br>

              Hor Al Anz Plaza-Dubai-UAE <br><br>
              <strong>Phone: </strong><a href="tel:+971 52 874 7050">+971 52 874 7050</a><br>
              <strong>Email: </strong><a href="mailto:copymasterdxd@gmail.com">copymasterdxd@gmail.com</a><br>
            </p>

          </div>

          <div class="col-lg-4 col-md-6 footer-info">
            <h3>About Copy Masterg</h3>
            <p>We are your trusted partner for cutting-edge digital printing solutions in Dubai. Our success is anchored in three core values: Service, Quality, and Price</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">

        <div class="col-lg-4 col-md-6 col-12 footer-info">
          <div class="copyright">
            &copy; Copyright <strong><span>Copy Master</span></strong>. All Rights Reserved
          </div>
        </div>
        <div class="col-lg-5"></div>


        <div class="col-lg-3 col-md-6 col-12  footer-info">
          <div class="credits">
            Designed by <a href="">Ji Design</a>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Send Enquiry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form data-action="{{route('enquiry.store')}}" data-redirect="" id="enquiry_form">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Name:</label>
              <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Email:</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Contact Number:</label>
              <input type="text" class="form-control" name="contact_no" id="contact_no">
            </div>
            <div class="mb-3">
              @php
              $services = getServiceTypes();
              @endphp
              <label for="recipient-name" class="col-form-label">Service:</label>
              <select name="service" class="form-control" id="service">
                <option value=""> Select Service</option>
                @foreach ( $services as $service)
                <option value="{{ $service->id }}"> {{ $service->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Message:</label>
              <textarea name="message" id="message" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Now</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="get-in-tuch d-flex wave-button align-items-center justify-content-center"><i class="bi bi-envelope"></i></a>
  @push('js')
  <script src="{{ asset('assets/js/validator/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/js/validator/additional-methods.min.js') }}"></script>

  <script src="{{ asset('frontend/user/enquiry.js')}}"></script>

  @endpush
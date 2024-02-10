@extends('user.layouts.layout')
@section('pageTitle', 'Contact Us')
@section('Description', '')
@section('content')
<main id="">

  <section class="banner-strip-wrap" style="background-image: url('{{ asset('frontend/assets/img/bg-1.jpg') }}')">
    <div class="container">
      <div class="row">
        <div class="d-flex bg-strip-text justify-content-center">
          Contact Us
        </div>
      </div>

    </div>
  </section>
  <section class=" p-t100 p-b100"></section>

  <!-- ======= Contact Section ======= -->
  <section class="contact p-t80 p-b80" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
    <div class="container">

      <div class="row">

        <div class="col-lg-6">

          <div class="row">
            <div class="col-md-12">
              <div class="info-box">
                <i class="bx bx-map"></i>
                <h3>Our Address</h3>
                <p>Near Abu Baker Metro Station

                  Hor Al Anz Shop No: 21

                  Hor Al Anz Plaza-Dubai-UAE</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box">
                <i class="bx bx-envelope"></i>
                <h3>Email Us</h3>
                <p><a href="mailto:copymasterdxd@gmail.com">copymasterdxd@gmail.com</a></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box">
                <i class="bx bx-phone-call"></i>
                <h3>Call Us</h3>
                <p><a href="tel:+971 52 874 7050">+971 52 874 7050</a><br><a href="tel:+971 56 515 3469">+971 56 515 3469</a></p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <form data-action="{{route('enquiry.store')}}" data-redirect="" id="contact">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" name="contact_no" class="form-control" id="contact_no" placeholder="Your Contact Number" required>
            </div>
            <div class="form-group mt-3">
              @php
              $services = getServiceTypes();
              @endphp
              <select name="service" class="form-control" id="service">
                <option value=""> Select Service</option>
                @foreach ( $services as $service)
                <option value="{{ $service->id }}"> {{ $service->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="form-group mt-3">

              <div class="text-center"><button type="submit" class="btn btn-primary btn-block">Send Message</button></div>
            </div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

  <!-- ======= Map Section ======= -->
  <section class="map mt-2">
    <div class="container-fluid p-0">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3607.5228961037656!2d55.323565074893466!3d25.286630228073317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5ca5f2b5706b%3A0x77d22abfcc1982de!2s21%20Hor%20Al%20Anz%20St%20-%20Abu%20Hail%20-%20Dubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1705858904060!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section><!-- End Map Section -->

</main><!-- End #main -->

@endsection

@push('js')
<script src="{{ asset('frontend/user/contact.js')}}"></script>
@endpush
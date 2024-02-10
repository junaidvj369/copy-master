@extends('user.layouts.layout')
@section('pageTitle', 'About')
@section('Description', '')
@section('content')
<main id="">
<!-- ======= About Section ======= -->
<section class="banner-strip-wrap" style="background-image: url('{{ asset('frontend/assets/img/bg-1.jpg') }}')">
<div class="container">
  <div class="row">
    <div class="d-flex bg-strip-text justify-content-center">
      About Us
    </div>
  </div>

</div>
</section>
<section class=" p-t100 p-b100"></section>
<section class="about p-t80 p-b80" data-aos="fade-up" id="">
  <div class="container">

    <div class="row">
      <div class="col-lg-5">
        <img src="{{ asset('frontend/assets/img/about.jpg')}}" class="img-fluid" alt="">
      </div>
      
      <div class="col-lg-1"></div>
      <div class="col-lg-6 pt-4 pt-lg-0">
        <h3>COPY MASTER PRINTING AND ADVERTISING</h3>
        <p class="fst-italic">
        COPY MASTER PRINTING AND ADVERTISING L.L.C is a hub of expertise offering a diverse array of top-notch digital printing solutions in Dubai.

Our success is anchored in three core values: Service, Quality, and Price. At Copy Master, we prioritize meeting customer specifications and exceeding expectations, all while maintaining competitive pricing for the exceptional quality of work, materials, and expertise we provide.

        </p>
      
        <p class="fst-italic">
        Experience high-quality digital printing services delivered throughout Dubai, accompanied by a commitment to excellent customer service. At Copy Master, we are dedicated to being your go-to destination for all printing and advertising needs. From Indoor Printing to Digital Printing and comprehensive advertising solutions, we are your one-stop shop for excellence in Dubai.

        </p>
      </div>

      
    </div>

    <div class="row p-t100">
     
      
      <div class="col-lg-6 pt-4 pt-lg-0">
        <h3>Customer Satisfaction</h3>
        <p class="fst-italic">
        Our commitment to customer satisfaction is unwavering. Upon entering our premises, customers are warmly welcomed by our office staff, ensuring a seamless experience in getting their work done promptly. Recognizing the value of our clients' time, Copy Master emphasizes efficiency in execution, a driving force that encourages many clients to return for future projects. We take pride in providing a hassle-free environment, ensuring that every client leaves with their specific work completed during their visit. Our guarantee is that no customer will need to seek services elsewhere; we are dedicated to fulfilling all requirements under one roof.
        </p>
      
        <p class="fst-italic">
        As we continue to introduce new services, we anticipate the continued support and patronage of our valued customers. Come and explore the epitome of quality printing and advertising excellence at Copy Master. Your satisfaction is not just a goal; it's our guarantee.
        </p>
      </div>
      <div class="col-lg-1"></div>

      <div class="col-lg-5">
        <img src="{{ asset('frontend/assets/img/about-1.jpg')}}" class="img-fluid" alt="">
      </div>

      
    </div>

  </div>
</section><!-- End About Section -->


<!-- ======= Team Section ======= -->
<section class="team  p-t80 " data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
  
  <div class="container">
    <div class="section-title">
      <h2>Our Team</h2>
      <p>
At COPY MASTER PRINTING AND ADVERTISING L.L.C, our team is the heartbeat of our operation, working collaboratively to deliver exceptional digital printing and advertising solutions in Dubai. Comprising talented professionals with diverse expertise, our team is committed to upholding the values of Service, Quality, and Price that define our success.</p>
    </div>
    <div class="row">

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
        <div class="member">
          <div class="member-img">
            <img src="{{ asset('frontend/assets/img/team/default.jpg')}}" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Shaiju Hassan</h4>
            <span>Managing Director</span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
        <div class="member">
          <div class="member-img">
            <img src="{{ asset('frontend/assets/img/team/default.jpg')}}" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Renjith Kumar</h4>
            <span>Product Manager</span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
        <div class="member">
          <div class="member-img">
            <img src="{{ asset('frontend/assets/img/team/default.jpg')}}" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Akhil Kumar</h4>
            <span>Designer cum Admin</span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
        <div class="member">
          <div class="member-img">
            <img src="{{ asset('frontend/assets/img/team/default.jpg')}}" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Mohammed Shebeer</h4>
            <span>Marketing Executive</span>
          </div>
        </div>
      </div>

    </div>

  </div>
</section><!-- End Team Section -->

</main><!-- End #main -->
@endsection
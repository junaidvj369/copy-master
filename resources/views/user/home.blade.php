@extends('user.layouts.layout')
@section('pageTitle', 'Home')
@section('Description', '')
@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-cntent-center align-items-center">
  <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="carousel-container">
        <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Copy Master Printing and Advertising</span></h2>
        <p class="animate__animated animate__fadeInUp">Whether you're in need of indoor printing, digital printing, or advertising solutions, Copy Master is your one-stop shop. We specialize in providing a full spectrum of services to cater to all your printing and advertising needs</p>
        <!-- <a href="" class=" animate__animated animate__fadeInUp custom-btn btn-8"><span>Read More</span></a> -->
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <div class="carousel-container">
        <h2 class="animate__animated animate__fadeInDown">Service</h2>
        <p class="animate__animated animate__fadeInUp">Our dedicated team is committed to meeting your specifications and ensuring your satisfaction. We strive to go above and beyond to delight our customers, providing excellent service every step of the way.</p>
        <!-- <a href="" class="custom-btn btn-8 animate__animated animate__fadeInUp"><span>Read More</span></a> -->
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <div class="carousel-container">
        <h2 class="animate__animated animate__fadeInDown">Quality</h2>
        <p class="animate__animated animate__fadeInUp">We understand the importance of delivering high-quality digital printing, and our state-of-the-art technology ensures that we meet and exceed industry standards. From materials to expertise, we are dedicated to maintaining the highest quality in all aspects of our work.</p>
        <!-- <a href="" class="custom-btn btn-8 animate__animated animate__fadeInUp"><span>Read More</span></a> -->
      </div>
    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
    </a>

  </div>
</section><!-- End Hero -->

<main id="main">

  <!-- ======= about Section ======= -->
  <div class="about-us-custom p-t80 p-b80">
    <div class="container">
      <div class="row aos-init aos-animate" data-aos="fade-up">
        <div class="col-md-5">
          <img src="{{ asset('frontend/assets/img/logo.jpg')}}" class="img-fluid" alt="">
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-6 pt-4 pb-1">
          <h3 class="pb-3 fw-medium fs-1">Get to Know Us</h3>
          <p>Welcome to Copy Master Printing and Advertising L.L.C! We are your trusted partner for cutting-edge digital printing solutions in Dubai. Our success is anchored in three core values: Service, Quality, and Price.
          </p>
          <p>At Copy Master, we take pride in providing excellent customer service, ensuring your satisfaction at every step. Our commitment to uncompromising quality is reflected in our use of advanced technology and meticulous attention to detail. We believe in delivering top-notch work while remaining competitive in pricing, offering exceptional value for your investment.
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- ======= Services Section ======= -->
  <section class="services p-b50">
    <div class="container">

      <div class="row">
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up">
          <div class="icon-box icon-box-pink">
            <div class="icon"><i class="bi bi-clipboard2-heart"></i></div>
            <h4 class="title"><a href="">Service Excellence</a></h4>
            <p class="description">Our dedicated team is committed to not just meeting but exceeding your specifications. We take pride in going the extra mile to ensure your satisfaction, making exceptional customer service a hallmark of our business.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="icon-box icon-box-cyan">
            <div class="icon"><i class="bi bi-patch-check"></i></div>
            <h4 class="title"><a href="">Uncompromising Quality</a></h4>
            <p class="description">At Copy Master, we recognize the importance of delivering top-tier digital printing. Our advanced technology and meticulous attention to detail guarantee that our work consistently meets and surpasses industry standards.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <div class="icon-box icon-box-green">
            <div class="icon"><i class="bi bi-cash-coin"></i></div>
            <h4 class="title"><a href="">Competitive Pricing</a></h4>
            <p class="description">While we prioritize quality, we also understand the importance of remaining competitive in pricing. Copy Master is dedicated to providing exceptional value for your investment, ensuring you receive top-notch work without straining your budget.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <div class="icon-box icon-box-blue">
            <div class="icon"><i class="bx bx-world"></i></div>
            <h4 class="title"><a href="">All-in-One Solutions</a></h4>
            <p class="description">Copy Master is not just a printing service; we are your comprehensive solution provider for indoor printing, digital printing, and advertising needs. Experience convenience and excellence all under one roof with Copy Master.</p>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Services Section -->

  <!-- ======= Why Us Section ======= -->
  <section class="why-us section-bg p-b80 p-t80" data-aos="fade-up" date-aos-delay="200">
    <div class="container">

      <div class="row">
        <div class="col-lg-6 video-box">
          <img src="{{ asset('frontend/assets/img/print.jpg')}}" class="img-fluid" alt="">
          <a href="https://www.youtube.com/watch?v=WB0HnXcW8qQ" target="_blank" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
        </div>

        <div class="col-lg-6 d-flex flex-column justify-content-center p-5">

          <div class="icon-box">
            <div class="icon"><i class="bx bx-fingerprint"></i></div>
            <h4 class="title"><a href="">Digital Precision</a></h4>
            <p class="description">Modern printing technologies, especially digital printing, offer unparalleled precision. Whether producing high-resolution images or fine text, digital printers ensure accurate reproduction, contributing to the clarity and visual impact of printed materials.</p>
          </div>

          <div class="icon-box">
            <div class="icon"><i class="bx bx-gift"></i></div>
            <h4 class="title"><a href="">Material Adaptability</a></h4>
            <p class="description">Printing has evolved beyond paper to embrace various materials. From textiles to plastics, printing technologies can now effectively apply designs to a diverse range of surfaces. This adaptability opens up new possibilities for creative expression and allows for customized printing on different mediums to suit various needs.</p>
          </div>

        </div>
      </div>

    </div>
  </section><!-- End Why Us Section -->

  <!-- ======= Features Section ======= -->
  <section class="features p-b80 p-t80">
    <div class="container">

      <div class="section-title p-b80">
        <h2>Services</h2>
        <p>Our dedicated team is committed to meeting your specifications and ensuring your satisfaction. We strive to go above and beyond to delight our customers, providing excellent service every step of the way.</p>
      </div>

      <div class="row" data-aos="fade-up">
        <div class="col-md-5">
          <img src="{{asset('frontend/assets/img/service/printing.jpg')}}" class="img-fluid" alt="">
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6 pt-4 pb-1">
          <h3 class="pb-3 fw-medium">Digital Printing</h3>
          <p class="fst-italic">
            Digital printing is a modern and versatile printing method that involves directly transferring digital files onto various substrates, eliminating the need for traditional printing plates or manual setup. Here are two key points about digital printing
          </p>
          <ul>
            <li><i class="bi bi-check"></i> On-Demand Printing.</li>
            <li><i class="bi bi-check"></i> Variable Data Printing</li>
          </ul>
        </div>
      </div>

      <div class="row" data-aos="fade-up">


        <div class="col-md-6 pt-5 ">
          <h3 class="pb-3 fw-medium">Offset printing</h3>
          <p class="fst-italic">
            Offset printing is a traditional and widely used commercial printing method known for its high-quality and cost-effectiveness, particularly for large print runs. Here are key details about offset printing
          </p>
          <ul>
            <li><i class="bi bi-check"></i>Lithographic Process</li>
            <li><i class="bi bi-check"></i>Ink and Water Balance</li>
            <li><i class="bi bi-check"></i>High-Quality Output</li>
          </ul>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-5 ">
          <img src="{{asset('frontend/assets/img/service/offset printing.jpg')}}" class="img-fluid" alt="">
        </div>



      </div>

      <div class="row" data-aos="fade-up">
        <div class="col-md-5">
          <img src="{{asset('frontend/assets/img/service/card.jpg')}}" class="img-fluid" alt="">
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-6 pt-5">
          <h3 class="pb-3 fw-medium">Business card printing</h3>
          <p>Business card printing is a crucial aspect of personal and professional branding, providing a tangible representation of your identity and contact information. Here are key details about business card printing</p>
          <ul>
            <li><i class="bi bi-check"></i> Design and Layout.</li>
            <li><i class="bi bi-check"></i> Printing Techniques.</li>
            <li><i class="bi bi-check"></i> Size and Dimensions.</li>
            <li><i class="bi bi-check"></i> Customization and Personalization.</li>
            <li><i class="bi bi-check"></i> Quantity.</li>
          </ul>
        </div>
      </div>

      <div class="row" data-aos="fade-up">
        <div class="col-md-6 pt-5 ">
          <h3 class="pb-3 fw-medium">Poster </h3>
          <p class="fst-italic">

            A poster printing service specializes in producing high-quality posters for a variety of purposes, ranging from promotional campaigns to decorative or informational displays. Here are key details about poster printing services
          </p>
          <ul>
            <li><i class="bi bi-check"></i> Design Assistance.</li>
            <li><i class="bi bi-check"></i> Printing Technologies.</li>
            <li><i class="bi bi-check"></i> Material Options.</li>
            <li><i class="bi bi-check"></i> Customization Features.</li>
            <li><i class="bi bi-check"></i> Quantity Flexibility.</li>
            <li><i class="bi bi-check"></i> Cost-Effective Solutions.</li>
          </ul>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-5">
          <img src="{{asset('frontend/assets/img/service/poster.jpg')}}" class="img-fluid" alt="">
        </div>
        <div class="cal-md-12 p-t50 d-flex justify-content-center service-btn">
          <a href="{{route('services')}}">View All</a>

        </div>
      </div>

    </div>
  </section><!-- End Features Section -->

</main><!-- End #main -->

@endsection
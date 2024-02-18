@extends('user.layouts.layout')
@section('pageTitle', 'Services')
@section('Description', 'Our Services')
@section('content')
<main>
  <section class="banner-strip-wrap" style="background-image: url('{{ asset('frontend/assets/img/bg-1.jpg') }}')">
    <div class="container">
      <div class="row">
        <div class="d-flex bg-strip-text justify-content-center">
          Services
        </div>
      </div>

    </div>
  </section>
  <section class=" p-t100 p-b100"></section>
  <!-- ======= Service Details Section ======= -->
  <section class="service-details p-t80 p-b80">
    <div class="container">

      <div class="row">
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('frontend/assets/img/service/printing.jpg')}}" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="#">Digital Printing</a></h5>
              <p class="card-text">Digital printing is a modern and versatile printing method that involves directly transferring digital files onto various substrates, eliminating the need for traditional printing plates or manual setup. Here are two key points about digital printing</p>
              <div class="read-more"><a href="{{route('contact')}}"><i class="bi bi-arrow-right"></i> Enquire now</a></div>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('frontend/assets/img/service/offset printing.jpg')}}" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="#">Offset printing</a></h5>
              <p class="card-text">Offset printing is a traditional and widely used commercial printing method known for its high-quality and cost-effectiveness, particularly for large print runs. Here are key details about offset printing</p>
              <div class="read-more"><a href="{{route('contact')}}"><i class="bi bi-arrow-right"></i> Enquire now</a></div>
            </div>
          </div>

        </div>
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('frontend/assets/img/service/card.jpg')}}" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="#">Business card printing</a></h5>
              <p class="card-text">Business card printing is a crucial aspect of personal and professional branding, providing a tangible representation of your identity and contact information. Here are key details about business card printing</p>
              <div class="read-more"><a href="{{route('contact')}}"><i class="bi bi-arrow-right"></i>Enquire now</a></div>

            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('frontend/assets/img/service/poster.jpg')}}" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="#">Poster</a></h5>
              <p class="card-text">A poster printing service specializes in producing high-quality posters for a variety of purposes, ranging from promotional campaigns to decorative or informational displays. Here are key details about poster printing services</p>
              <div class="read-more"><a href="{{route('contact')}}"><i class="bi bi-arrow-right"></i> Enquire now</a></div>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('frontend/assets/img/service/envelope printing.jpg')}}" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="#">Envelope printing</a></h5>
              <p class="card-text">
                Envelope printing is a specialized service that involves printing designs, logos, addresses, or other information directly onto envelopes</p>
              <div class="read-more"><a href="{{route('contact')}}"><i class="bi bi-arrow-right"></i>Enquire now</a></div>

            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('frontend/assets/img/service/scanning.jpg')}}" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="#">Scanning</a></h5>
              <p class="card-text">Scanning images is the process of converting physical images, such as photographs, documents, or artwork, into digital format using a scanner. </p>
              <div class="read-more"><a href="{{route('contact')}}"><i class="bi bi-arrow-right"></i> Enquire now</a></div>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('frontend/assets/img/service/lamination.jpg')}}" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="#">Lamination</a></h5>
              <p class="card-text">Lamination is a process that involves covering a document, photograph, or other materials with a thin layer of transparent plastic film to protect and enhance its appearance</p>
              <div class="read-more"><a href="{{route('contact')}}"><i class="bi bi-arrow-right"></i>Enquire now</a></div>

            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('frontend/assets/img/service/id card.jpg')}}" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="#">ID Card Printing</a></h5>
              <p class="card-text">
                ID card printing is a specialized process that involves creating identification cards for individuals, typically for use in various organizations, institutions, or businesses.</p>
              <div class="read-more"><a href="{{route('contact')}}"><i class="bi bi-arrow-right"></i> Enquire now</a></div>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('frontend/assets/img/service/printing on mugs.jpg')}}" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="#">Printing on mugs</a></h5>
              <p class="card-text">
                Printing on mugs, also known as mug printing or sublimation printing, is a popular method to create personalized and customized mugs with images, logos, or text. </p>
              <div class="read-more"><a href="{{route('contact')}}"><i class="bi bi-arrow-right"></i>Enquire now</a></div>

            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('frontend/assets/img/service/t-shirt printing.jpg')}}" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="#">T-shirt printing</a></h5>
              <p class="card-text">
                T-shirt printing is a popular method for creating customized and personalized apparel with various designs, logos, or messages. There are different techniques for printing on T-shirts, each with its own advantages.</p>
              <div class="read-more"><a href="{{route('contact')}}"><i class="bi bi-arrow-right"></i> Enquire now</a></div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Service Details Section -->


</main><!-- End #main -->

@endsection
@extends('layouts.app')

@section('title')
jejakPendaki
@endsection

@section('content')
<!-- Header -->
<header class="text-center">
  <h1>
    Petualangan Baru Menanti
    <br />
    Taklukkan Puncak Bersama Kami
  </h1>
  <p class="mt-3">
    Rasakan sensasi mendaki gunung dan temukan
    <br />
    keindahan alam yang memukau
  </p>
  <a href="#popular" class="btn btn-get-started px-4 mt-4">
    Get Started
  </a>
</header>

<main>
  <div class="container">
    <section class="section-stats row justify-content-center" id="stats">
      <div class="col-3 col-md-2 stats-detail">
        <h2>200K</h2>
        <p>Anggota</p>
      </div>
      <div class="col-3 col-md-2 stats-detail">
        <h2>5</h2>
        <p>Negara</p>
      </div>
      <div class="col-3 col-md-2 stats-detail">
        <h2>20</h2>
        <p>Akomodasi</p>
      </div>
      <div class="col-3 col-md-2 stats-detail">
        <h2>5</h2>
        <p>Mitra</p>
      </div>
    </section>
  </div>

  <section class="section-popular" id="popular">
    <div class="container">
      <div class="row">
        <div class="col text-center section-popular-heading">
          <h2>Jadwal Trip Terdekat</h2>
          <p>
            Eksplorasi Baru yang Belum Pernah
            <br />
            Anda Nikmati
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="section-popular-content" id="popularContent">
    <div class="container">
      <div class="section-popular-travel row justify-content-center">
        @foreach ($items as $item)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card-travel text-center d-flex flex-column"
        style="background-image: url('{{$item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}');">

        <div class="travel-country">{{$item->location}}</div>
        <div class="travel-location">{{$item->title}}</div>
        <div class="travel-button mt-auto">
          <a href="{{route('detail', $item->slug)}}" class="btn btn-travel-details px-4">
          VIEW DETAILS
          </a>
        </div>
        </div>
      </div>
    @endforeach


      </div>
    </div>
  </section>

  <section class="section-networks">
    <div class="container">
      <div class="row align-items-center">
        <div class=" col-12 col-md-4 mb-3 mb-md-0">
          <h2>Koneksi Kami</h2>
          <p>
            Lebih Dari Sekadar Trip,
            <br />
            Kami Dipercaya oleh Banyak Perusahaan
          </p>
        </div>
        <div class="col-12 col-md-8 d-flex justify-content-center flex-wrap">
          <img src="frontend/images/eiger.png" alt="Eiger Logo" class="img-parter mb-3" />
          <img src="frontend/images/tnf.png" alt="TNF Logo" class="img-parter mb-3" />
          <img src="frontend/images/rei.png" alt="REI Logo" class="img-parter mb-3" />
          <img src="frontend/images/kalibre.png" alt="Kalibre Logo" class="img-parter mb-3" />
        </div>
      </div>
    </div>
  </section>

  <section class="section-testimonial-heading" id="testimonialHeading">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h2>Kami Membuat Mereka Terpesona</h2>
          <p>
            Menyediakan Pengalaman Terbaik
            <br />
            di Setiap Momen
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="section section-testimonial-content" id="testimonialContent">
    <div class="container">
      <div class="section-popular-travel row justify-content-center">
        <div class="col-sm-6 col-md-6 col-lg-4">
          <div class="card card-testimonial text-center">
            <div class="testimonial-content">
              <img src="frontend/images/foto testi 1.jpg" alt="User" class="mb-4 rounded-circle" />
              <h3 class="mb-4">Wilson</h3>
              <p class="testimonial">
                "Pendakian dengan JejakPendaki luar biasa! Pemandu ahli dan
                rencana perjalanan yang terorganisir membuatnya sangat
                memuaskan."
              </p>
            </div>
            <hr />
            <p class="trip-to mt-2">
              Trip to Rinjani
            </p>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4">
          <div class="card card-testimonial text-center">
            <div class="testimonial-content">
              <img src="frontend/images/foto testi 2.jpg" alt="User" class="mb-4 rounded-circle" />
              <h3 class="mb-4">Bronson</h3>
              <p class="testimonial">
                "Pengalaman tak terlupakan! Pemandangan menakjubkan dan
                layanan profesional dari Jejak Pendaki."
              </p>
            </div>
            <hr />
            <p class="trip-to mt-2">
              Trip to Rinjani
            </p>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4">
          <div class="card card-testimonial text-center">
            <div class="testimonial-content">
              <img src="frontend/images/foto testi 3.jpg" alt="User" class="mb-4 rounded-circle" />
              <h3 class="mb-4">Winfrey</h3>
              <p class="testimonial">
                "JejakPendaki mengelola trip dengan sangat baik. Saya merasa
                aman dan nyaman sepanjang perjalanan."
              </p>
            </div>
            <hr />
            <p class="trip-to mt-2">
              Trip to Semeru
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center">
          <a href="#" class="btn btn-need-help px-4 mt-4 mx-1">
            I Need Help
          </a>
          <a href="{{route('register')}}" class="btn btn-get-started px-4 mt-4 mx-1">
            Get Started
          </a>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
@extends('layouts.app')
@section('title', 'Detail Trip')

@section('content')
<main>
      <section class="section-details-header"></section>
      <section class="section-details-content">
        <div class="container">
          <div class="row">
            <div class="col p-0">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">Paket Trip</li>
                  <li class="breadcrumb-item active">Details</li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 pl-lg-0">
              <div class="card card-details">
                <h1>{{$item->title}}</h1>
                <p>{{$item->location}}</p>

                @if ($item->galleries->count())
                <div class="gallery">
                  <div class="xzoom-container">
                    <img src="{{Storage::url($item->galleries->first()->image )}}" alt="" class="xzoom" id="xzoom-default" xoriginal="{{Storage::url($item->galleries->first()->image )}}">
                  </div>
                  <div class="xzoom-thumbs">
                    @foreach ($item->galleries as $gallery)
                    <a href="{{Storage::url ($gallery->image)}}">
                      <img src="{{Storage::url ($gallery->image)}}" alt="" class="xzoom-gallery" width="128" xpreview="{{Storage::url ($gallery->image)}}">
                    </a>
                    @endforeach

                  </div>
                </div>
                @endif
                <h2>Tentang Open Trip</h2>
                <p>
                  {!! $item->about !!}
                </p>

                <div class="features row">
                  <div class="col-md-4 ">
                    <img src="{{url('frontend/images/via.png')}}" alt="" class="featured-image">
                    <div class="description">
                      <h3>VIA</h3>
                      <p>{{$item->VIA}}</p>
                    </div>
                  </div>
                  <div class="col-md-4 border-left ">
                    <img src="{{url('frontend/images/hadiah.png')}}" alt="" class="featured-image">
                    <div class="description">
                      <h3>Hadiah</h3>
                      <p>{{$item->present}}</p>
                    </div>
                  </div>
                  <div class="col-md-4 border-left">
                    <img src="{{url('frontend/images/penghargaan.png')}}" alt="" class="featured-image">
                    <div class="description">
                      <h3>Penghargaan</h3>
                      <p>{{$item->award}}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card card-details card-right">
                <h2>Anggota Baru Bergabung</h2>
                <div class="members-container d-flex flex-wrap">
                  <div class="members my-2">
                    <img src="{{url('frontend/images/member1.png')}}" alt="" class="member-image mr-1 ">
                  </div>
                  <div class="members my-2">
                    <img src="{{url('frontend/images/member2.png')}}" alt="" class="member-image mr-1 ">
                  </div>
                  <div class="members my-2">
                    <img src="{{url('frontend/images/member3.png')}}" alt="" class="member-image mr-1 ">
                  </div>
                  <div class="members my-2">
                    <img src="{{url('frontend/images/member4.png')}}" alt="" class="member-image mr-1 ">
                  </div>
                  <div class="members my-2">
                    <img src="{{url('frontend/images/member5.png')}}" alt="" class="member-image mr-1 ">
                  </div>
                </div>
                
                <hr>
                <h2>Informasi Trip</h2>
                <table class="trip-informations">
                  <tr>
                    <th width="50%">Keberangkatan</th>
                    <td width="50%" class="text-right">
                      {{\Carbon\Carbon::create($item->date_of_departure)->format('F n, Y')}}
                    </td>
                  </tr>
                  <tr>
                    <th width="50%">Durasi</th>
                    <td width="50%" class="text-right">
                      {{$item->duration}}
                    </td>
                  </tr>
                  <tr>
                    <th width="50%">Tipe</th>
                    <td width="50%" class="text-right">
                      {{$item->type}}
                    </td>
                  </tr>
                  <tr>
                    <th width="50%">Harga</th>
                    <td width="50%" class="text-right">
                      ${{$item->price}},00 / person
                    </td>
                  </tr>
                </table>
              </div>
              <div class="join-container">
                @auth
                <form action="{{route('checkout_process', $item->id)}}" method="post">
                  @csrf
                  <button class="btn btn-block btn-join-now mt-3 py-2" type="submit">
                    Bergabung sekarang
                  </button>
                </form>
                @endauth

                @guest
                <a href="{{route('login')}}" class="btn btn-block btn-join-now mt-3 py-2">
                  Login or Register to Join
                </a>
                @endguest
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection

@push('prepend-style')
    <!-- Xzoom -->
    <link rel="stylesheet" href="{{url('frontend/libraries/xzoom/dist/xzoom.css')}}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/xZoom/0.3.3/xzoom.min.css"> -->
@endpush

@push('addon-script')
    <!-- Xzoom -->
    <script src="{{url('frontend/libraries/xzoom/dist/xzoom.min.js')}}"></script>
    <script>
      $(document).ready(function(){
        $('.xzoom, .xzoom-gallery').xzoom({
          zoomWidth: 500,
          title: false,
          tint: '#333',
          Xoffset:15
        });
      });
    </script>
@endpush

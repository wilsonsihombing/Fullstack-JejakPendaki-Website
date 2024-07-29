@extends('layouts.success')
@section('title', 'Checkout Success')

@section('content')
<main>
    <div class="section-success d-flex align-items-center">
        <div class="col text-center">
            <img src="{{url('frontend/images/mailbox.png')}}" alt="">
            <h1>Yay! Berhasil</h1>
            <p>
                Kami mengirimkan email link grup untuk Pendakian ini.
                <br>
                Silahkan bergabung untuk informasi lebih lanjut.
            </p>
            <a href="{{url('/')}}" class="btn btn-home-page mt-3 px-5">
                Home Page
            </a>
        </div>
    </div>
</main>
@endsection
@extends('layouts.checkout')
@section('title', 'Checkout')

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
                            <li class="breadcrumb-item">Details</li>
                            <li class="breadcrumb-item active">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 pl-lg-0">
                    <div class="card card-details">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>

                        @endif

                        <h1>Siapa yang berangkat?</h1>
                        <p>Trip to {{$item->trip_package->title}}, {{$item->trip_package->location}}</p>
                        <div class="anttendee">
                            <table class="table table-responsive-sm text-center">
                                <thead>
                                    <tr>
                                        <td>Picture</td>
                                        <td>Name</td>
                                        <td>Nationality</td>
                                        <td>Ban List</td>
                                        <td>Surat Sehat</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($item->details as $detail)
                                        <tr>
                                            <td>
                                                <img src="https://ui-avatars.com/api/?name={{$detail->username}}"
                                                    height="60" class="rounded-circle" />
                                            </td>
                                            <td class="align-middle">{{$detail->username}}</td>
                                            <td class="align-middle">{{$detail->nationality}}</td>
                                            <td class="align-middle">{{$detail->is_band ? 'Y' : 'N'}}</td>
                                            <td class="align-middle">
                                                {{\Carbon\Carbon::createFromDate($detail->d_healt_letter) > \Carbon\Carbon::now() ? 'Active' : 'Inactive'}}
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{route('checkout-remove', $detail->id)}}">
                                                    <img src="{{url('frontend/images/cross.png')}}" alt="" height="15" />
                                                </a>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                No Visitor
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="member mt-3">
                            <h2>Add Member</h2>
                            <form class="form-inline" method="post" action="{{route('checkout-create', $item->id)}}">
                                @csrf
                                <label for="username" class="sr-only">Name</label>
                                <input type="text" name="username" class="form-control mb-2 mr-sm-2" id="username"
                                    required placeholder="Username" />

                                <label for="nationality" class="sr-only">Nationality</label>
                                <input type="text" name="nationality" class="form-control mb-2 mr-sm-2"
                                    style="width: 50px;" id="nationality" required placeholder="Nationality" />

                                <label for="is_band" class="sr-only">Ban List</label>
                                <select name="is_band" id="is_band" required class="custom-select mb-2 mr-sm-2">
                                    <option value="" selected>Ban List</option>
                                    <option value="1">Y</option>
                                    <option value="0">N</option>
                                </select>

                                <label for="d_healt_letter" class="sr-only mb-2">Tempo S. Sehat</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="text" class="form-control datepicker" name="d_healt_letter"
                                        id="d_healt_letter" placeholder="Tempo S. Sehat" />
                                </div>

                                <button type="submit" class="btn btn-add-now mb-2 px-2">
                                    Add now
                                </button>
                            </form>
                            <h3 class="mt-2 mb-0">Note</h3>
                            <p class="disclaimer mb-0">
                            Kamu hanya boleh menambah orang yang sudah terdaftar di
                            JejakPendaki
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-details card-right">

                        <h2>Informasi Pembayaran</h2>
                        <table class="trip-informations">
                            <tr>
                                <th width="50%">Anggota</th>
                                <td width="50%" class="text-right">
                                    {{$item->details->count()}} person
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Total Surat Sehat</th>
                                <td width="50%" class="text-right">
                                    ${{$item->additional_health_letter}},00
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Biaya Trip</th>
                                <td width="50%" class="text-right">
                                    ${{$item->trip_package->price}},00 / person
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Sub Total</th>
                                <td width="50%" class="text-right">
                                    ${{$item->transaction_total}},00
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Total (+Unique)</th>
                                <td width="50%" class="text-right">
                                    <span class="text-blue">
                                        ${{$item->transaction_total}},00
                                    </span>
                                    <span class="text-orange">
                                        {{mt_rand(0, 99)}}
                                    </span>
                                </td>
                            </tr>
                        </table>
                        <hr>
                        <h2>Instruksi Pembayaran</h2>
                        <p class="payment-instructions">
                        Selesaikan pembayaran sebelum memulai trip
                        </p>
                        <div class="bank">
                            <div class="bank-item pb-3">
                                <img src="{{url('frontend/images/logo wallet.png')}}" alt="" class="bank-image">
                                <div class="description">
                                    <h3>PT JejakPendaki ID</h3>
                                    <p>
                                        0812 1234 1234
                                        <br>
                                        Bank Central Asia
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="bank-item pb-3">
                                <img src="{{url('frontend/images/logo wallet.png')}}" alt="" class="bank-image">
                                <div class="description">
                                    <h3>PT JejakPendaki ID</h3>
                                    <p>
                                        0812 1234 1234
                                        <br>
                                        Bank BRI
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="join-container">
                        <a href="{{route('checkout-success', $item->id)}}" class="btn btn-block btn-join-now mt-3 py-2">
                        Telah Melakukan Pembayaran
                        </a>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{route('detail', $item->trip_package->slug)}}" class="text-muted">
                            Cancel Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

@push('prepend-style')
    <!-- Gijgo -->
    <link rel="stylesheet" href="{{url('frontend/libraries/gijgo/css/gijgo.min.css')}}" />
@endpush

@push('addon-script')
    <!-- Gijgo -->
    <script src="{{url('frontend/libraries/gijgo/js/gijgo.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd",
                uiLibrary: "bootstrap4",
                icons: {
                    rightIcon:
                        '<img src="{{url('frontend/images/calender.png')}}" height="16px" width="16px" />',
                },
            });
        });
    </script>
@endpush
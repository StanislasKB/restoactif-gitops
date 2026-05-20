@extends('components.app')
@section('title')
    Email-verification
@endsection
@section('page_css')
<link href="/landing/css/booking-sign_up.css" rel="stylesheet">

@endsection
@section('header')
@include('landing.components.layouts.second_header')
@endsection

@section('other_main')
<main class="bg_gray pattern">
    <div class="container margin_60_40">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="box_booking_2">
                    <div class="head">
                        <div class="title">
                        <h3>Verification de l'email</h3>
                    </div>
                    </div>
                    <!-- /head -->
                    <div class="main">
                        <div id="confirm">
                            <div class="icon icon--order-success svg add_bottom_15">
                                <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                                    <g fill="none" stroke="#8EC343" stroke-width="2">
                                        <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                        <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                    </g>
                                </svg>
                            </div>
                            <h3>Votre inscription a été bien effectuée!</h3>
                            <p>Veuillez vérifier votre boîte mail (spams y compris) pour confirmer votre adresse mail. Nous avons envoyé un mail à {{$email}} </p>
                        </div>
                    </div>
                </div>
                <!-- /box_booking -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
</main>

<!-- /container -->
@endsection

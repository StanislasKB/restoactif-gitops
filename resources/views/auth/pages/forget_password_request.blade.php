
@extends('components.app')
@section('title')
    Connexion
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
                <div class="sign_up">
                    <div class="head">
                        <div class="title">
                        <h3>Mot de passe</h3>
                    </div>
                    </div>
                    <!-- /head -->
                    <form method="post" action="{{route('password_reset')}}">
                        <div class="main">
                          @csrf
                          @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                            <div class="form-group">
                                <input class="form-control" name="email" placeholder="Email Address">
                                <i class="icon_mail"></i>
                            </div>

                            <div class="text-center">
                                <input type="submit" value="Envoyer" class="btn_1 full-width mb_5">
                            </div>

                        </div>
                    </form>

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

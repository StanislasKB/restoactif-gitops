
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
                        <h3>Changer votre mot de passe</h3>
                    </div>
                    </div>
                    <!-- /head -->
                    <form method="post" action="{{route('change_password')}}">
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

                    <input type="hidden" name="token" value="{{$token}}">

                    <div class="form-group ">
                        <input class="form-control" placeholder="Mot de passe" id="password_sign" name="password">
                        <i class="icon_lock"></i>
                    </div>
                    @error('password')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group ">
                        <input class="form-control" placeholder="Confirmation de mot de passe" id="password_sign" name="password2">
                        <i class="icon_lock"></i>
                    </div>
                    @error('password2')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror


                            <div class="text-center">
                                <input type="submit" value="Changer" class="btn_1 full-width mb_5">
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

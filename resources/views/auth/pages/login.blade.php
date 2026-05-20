
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
                        <h3>Connexion</h3>
                    </div>
                    </div>
                    <!-- /head -->
                    <form method="post" action="{{route('login')}}">
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
                                <input class="form-control" name="email" placeholder="Adresse email">
                                <i class="icon_mail"></i>
                            </div>
                            <div class="form-group add_bottom_15">
                                <input class="form-control" name="password" placeholder="Mot de passe" id="password_sign" name="password_sign">
                                <i class="icon_lock"></i>
                            </div>
                            <div class="clearfix add_bottom_15">
                                <div class="checkboxes float-start">
                                    <label class="container_check">Souvenir de moi
                                      <input type="checkbox">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="float-end"><a id="forgot" href="{{route('password_reset.view')}}">Mot de passe oublié?</a></div>
                            </div>
                            <div class="text-center">
                                <input type="submit" value="Se connecter" class="btn_1 full-width mb_5">
                                Pas de compte ? <a href="{{route('register.view')}}">S'inscrire</a>
                            </div>
                            <div id="forgot_pw">
                                <div class="form-group">
                                    <label>Veuillez confirmer l'e-mail de connexion ci-dessous</label>
                                    <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                                    <i class="icon_mail_alt"></i>
                                </div>
                                <p>
                                    Vous recevrez un e-mail contenant un lien vous permettant de réinitialiser votre mot de passe avec un nouveau mot de passe préféré.</p>
                                <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
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

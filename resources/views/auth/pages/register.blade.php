@extends('components.app')
@section('title')
    Inscription
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
                        <h3>Inscription</h3>
                    </div>
                    </div>
                    <!-- /head -->
                    <form method="POST" action="{{route('register')}}">
                        @csrf
                        <div class="main">

                            <div class="form-group">
                                <input class="form-control" name="prenom" placeholder="Prénom">
                                <i class="icon_pencil"></i>
                            </div>
                            @error('prenom')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                            <div class="form-group">
                                <input class="form-control" name="nom" placeholder="Nom">
                                <i class="icon_pencil"></i>
                            </div>
                            @error('nom')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            {{-- <div class="form-group">
                                <input class="form-control" name="telephone" placeholder="Téléphone">
                                <i class="icon_phone"></i>
                            </div>
                            @error('telephone')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror --}}
                            <div class="form-group">
                                <input class="form-control" name="email" placeholder="Adresse email">
                                <i class="icon_mail"></i>
                            </div>
                            @error('email')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
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
                            <div class="checkboxes float-start add_bottom_15">
                                <label class="container_check">En cliquant j'accepte les termes et conditions.
                                  <input type="checkbox" name="check_term" required>
                                  <span class="checkmark"></span>
                                </label>
                                @error('check_term')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            </div>

                            <button class="btn_1 full-width mb_5">S'inscrire maintenant</button>
                            <div class="text-center">
                                Déjà un compte ? <a href="{{route('login.view')}}">Se connecter</a>
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

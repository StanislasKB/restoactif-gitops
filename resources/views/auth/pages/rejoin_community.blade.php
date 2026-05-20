@extends('components.app')
@section('title')
    Rejoindre la communauté
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
                        <h3>Rejoindre la communauté</h3>
                    </div>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                  @endif
                    <!-- /head -->
                    <form method="POST" id="community_form" action="{{ route('join.community') }}">
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
                            <div class="form-group">
                                <input class="form-control" name="telephone" placeholder="Téléphone">
                                <i class="icon_phone"></i>
                            </div>
                            @error('telephone')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            <div class="form-group">
                                <input class="form-control" name="address" placeholder="Adresse">
                                <i class="icon-user_2"></i>
                            </div>
                            @error('address')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            <div class="form-group">
                                <input class="form-control" name="email" placeholder="Adresse email">
                                <i class="icon_mail"></i>
                            </div>
                            @error('email')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            <div class="checkboxes float-start add_bottom_15">
                                <label class="container_check">En cliquant j'accepte de recevoir les notifications.
                                  <input type="checkbox" id="requestPermission" name="check_term" required>
                                  <span class="checkmark"></span>
                                </label>
                                @error('check_term')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            </div>
                            <div class="alert alert-danger" id="permissionMessage" style="display: none">
                                <p  >Vous devez activer les notifications pour soumettre le formulaire. Vous ne savez comment faire? </p>
                            </div>

                            <button class="btn_1 full-width mb_5"  type="submit" >Rejoindre</button>
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

<input type="hidden" value="{{env('VAPID_PUBLIC_KEY')}}" id="vapid_public_key" >
<!-- /container -->
@endsection

@section('page_js')
    {{-- <script src="/community_subscription.js"></script> --}}
@endsection

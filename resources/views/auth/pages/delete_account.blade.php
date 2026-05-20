
@extends('components.app')
@section('title')
    Suppression
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
                        <h3>Suppression de Compte</h3>
                    </div>
                    </div>
                    <!-- /head -->
                    <form method="post" action="{{ route('delete-account') }}">
                        <div class="main">
                            <p class="text-danger">
                                En supprimant votre compte, toutes les informations liées à celui-ci seront définitivement effacées. Cette action est irréversible et entraînera la perte de vos évènements, offres, menus spéciaux et autres informations associées à votre compte.
                            </p>
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
                          <label for="">Taper supprimer/{{ auth()->user()->last_name }}</label>
                            <div class="form-group">
                                <input class="form-control" name="confirm" placeholder="supprimer/***">
                                <i class="icon_mail"></i>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Votre mot de passe">
                                <i class="icon_lock"></i>
                            </div>
                            <div class="checkboxes float-start add_bottom_15">
                                <label class="container_check">En cliquant je confirme la suppression définitive de mon compte.
                                  <input type="checkbox" name="check" required>
                                  <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="text-center">
                                <input type="submit" value="Supprimer" class="btn_1 full-width mb_5">
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

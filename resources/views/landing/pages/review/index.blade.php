@extends('components.app')
@section('title')
    Avis
@endsection
@section('page_css')
<link href="/landing/css/review.css" rel="stylesheet">

@endsection
@section('header')
@include('landing.components.layouts.second_header')
@endsection

@section('other_main')
<main class="bg_gray pattern">
    @include('landing.pages.review.layouts.body')
</main>

<!-- /container -->
@endsection
@section('page_js')
<script src="/landing/js/specific_review.js"></script>
@endsection

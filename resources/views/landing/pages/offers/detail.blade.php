@extends('components.app')
@section('title')
    {{ $offer->name }}
@endsection
@section('page_css')
<link href="/landing/css/detail-page.css" rel="stylesheet">
@endsection
@section('header')
    @include('landing.components.layouts.second_header')
@endsection
@section('main_content')
@include('landing.pages.offers.layouts.details.hero')
@include('landing.pages.offers.layouts.details.body')
@endsection
@section('page_js')
<script src="/landing/js/sticky_sidebar.min.js"></script>
<script src="/landing/js/specific_detail.js"></script>
<script src="/landing/js/datepicker.min.js"></script>
<script src="/landing/js/datepicker_func_1.js"></script>
@endsection

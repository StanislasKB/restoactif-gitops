@extends('components.app')
@section('title')
    {{ $profil->name }}
@endsection
@section('page_css')
<link href="/landing/css/detail-page.css" rel="stylesheet">
<link href="/landing/css/listing.css" rel="stylesheet">
@endsection
@section('header')
    @include('landing.components.layouts.second_header')
@endsection
@section('main_content')
@include('landing.pages.restaurant.layouts.hero')
@include('landing.pages.restaurant.layouts.body')
@endsection
@section('page_js')
<script src="/landing/js/sticky_sidebar.min.js"></script>
<script src="/landing/js/specific_detail.js"></script>
<script src="/landing/js/datepicker.min.js"></script>
<script src="/landing/js/datepicker_func_1.js"></script>
<script src="/landing/js/sticky_sidebar.min.js"></script>
<script src="/landing/js/specific_listing.js"></script>
<script src="/landing/js/sort_select.js"></script>
@endsection

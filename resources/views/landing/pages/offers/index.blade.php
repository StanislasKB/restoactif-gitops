@extends('components.app')
@section('title')
    Offres
@endsection
@section('page_css')
<link href="/landing/css/listing.css" rel="stylesheet">
@endsection
@section('header')
    @include('landing.components.layouts.second_header')
@endsection
@section('main_content')
@include('landing.pages.offers.layouts.page_header')
@include('landing.pages.offers.layouts.filter_aside')
@include('landing.pages.offers.layouts.offers_grid')
@endsection
@section('page_js')
<script src="/landing/js/sticky_sidebar.min.js"></script>
<script src="/landing/js/specific_listing.js"></script>
<script src="/landing/js/sort_select.js"></script>

@endsection

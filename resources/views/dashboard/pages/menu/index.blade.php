@extends('dashboard.components.app')
@section("title")
   Offres
@endsection
@section('page_css')
<link href="/dashboard/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('main_content')
@php
    $page='Liste';
    $route=route('dashboard.menu.view');
@endphp
@include('dashboard.pages.menu.partials.page_title')
@include('dashboard.pages.menu.partials.menu_list')
@endsection
@section("page_js")
<script src="/dashboard/assets/libs/swiper/swiper-bundle.min.js"></script>
<script src="/dashboard/assets/js/pages/extended-swiper.js"></script>
@endsection

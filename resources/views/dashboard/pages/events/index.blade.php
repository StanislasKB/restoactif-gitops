@extends('dashboard.components.app')
@section("title")
    Mes évènements
@endsection
@section('page_css')
<link href="/dashboard/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('main_content')
@php
    $page='Liste';
    $route=route('dashboard.event.view');
@endphp
@include('dashboard.pages.events.partials.page_title')
@include('dashboard.pages.events.partials.event_list')
@endsection
@section("page_js")
<script src="/dashboard/assets/libs/swiper/swiper-bundle.min.js"></script>
<script src="/dashboard/assets/js/pages/extended-swiper.js"></script>
@endsection

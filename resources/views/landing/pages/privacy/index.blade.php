@extends('components.app')
@section('title')
    FAQ
@endsection
@section('page_css')
<link href="/landing/css/submit-rider.css" rel="stylesheet">
<link href="/landing/css/wizard.css" rel="stylesheet">
@endsection
@section('main_content')
@include('landing.pages.privacy.layouts.hero_banner')
@include('landing.pages.privacy.layouts.content')
@endsection

@extends('components.app')
@section('title')
    A propos de nous
@endsection
@section('page_css')
<link href="/landing/css/submit.css" rel="stylesheet">
@endsection
@section('main_content')
@include('landing.pages.about.layouts.hero_banner')
@include('landing.pages.about.layouts.principal_section')
@endsection

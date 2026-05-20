@extends('dashboard.components.app')
@section("title")
    Dashboard
@endsection
@section('page_css')

@endsection
@section('main_content')
@include('dashboard.pages.dashboard.layouts.page_title')
@include('dashboard.pages.dashboard.layouts.resume_card')
@include('dashboard.pages.dashboard.layouts.calendar_section')
@endsection
@section("page_js")

@endsection

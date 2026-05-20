@extends('admin.components.app')
@section("title")
    Dashboard
@endsection
@section('page_css')

@endsection
@section('main_content')
@include('admin.pages.dashboard.layout.page_title')
@include('admin.pages.dashboard.layout.resume_card')
@include('admin.pages.dashboard.layout.stat_section')
@endsection
@section("page_js")

@endsection

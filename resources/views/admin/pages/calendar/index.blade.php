@extends('admin.components.app')
@section("title")
    Calendrier
@endsection
@section('page_css')
<script src="/dashboard/assets/js/config.js"></script>
@endsection
@section('main_content')
@include('admin.pages.calendar.layouts.page_title')
@include('admin.pages.calendar.layouts.calendar')
@endsection
@section("page_js")
<script src="/dashboard/assets/libs/fullcalendar/index.global.min.js"></script>
<script src="/dashboard/assets/js/pages/apps-calendar.js"></script>
@endsection

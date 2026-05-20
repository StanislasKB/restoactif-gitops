@extends('admin.components.app')
@section("title")
    Communauté
@endsection
@section('page_css')
<link href="/dashboard/assets/libs/gridjs/theme/mermaid.min.css" rel="stylesheet" type="text/css" >
@endsection
@section('main_content')
@include('admin.pages.community.layout.page_title')
@include('admin.pages.community.layout.user_table')
@endsection
@section("page_js")
<script src="/dashboard/assets/libs/gridjs/gridjs.umd.js"></script>
<script src="/dashboard/assets/js/pages/table-gridjs.js"></script>
@endsection

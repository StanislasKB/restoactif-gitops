@extends('components.app')
@section('title')
    Contact
@endsection
@section('page_css')
<link href="/landing/css/contacts.css" rel="stylesheet">
@endsection
@section('main_content')
@include('landing.pages.contact.layouts.hero_banner')
@include('landing.pages.contact.layouts.contact_infos')
@include('landing.pages.contact.layouts.form_map')
@endsection

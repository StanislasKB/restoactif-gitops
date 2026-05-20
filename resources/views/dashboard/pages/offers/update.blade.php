@extends('dashboard.components.app')
@section("title")
   Modification
@endsection
@section('page_css')
<link href="/dashboard/assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" >
<link href="/dashboard/assets/libs/quill/quill.core.css" rel="stylesheet" type="text/css" >
<link href="/dashboard/assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" >

@endsection
@section('main_content')
<div class="flex flex-col gap-28">
    <div style="margin-bottom: 50px" >
        @include('dashboard.pages.offers.layouts.update_form')
    </div>

    @include('dashboard.pages.offers.layouts.offer_images')
</div>

@endsection
@section("page_js")
<script src="/dashboard/assets/libs/dropify/dropify.min.js"></script>
    <script>
        (function($) {
            'use strict';
            $('.dropify').dropify({
                messages: {
                    'default': 'Glissez-déposez ou choisir fichier',
                    'replace': 'Glissez-déposez ou cliquez pour remplacer',
                    'remove': 'Supprimer',
                    'error': 'Oups, quelque chose s\'est mal passé.'
                },
                allowMultiple: true,
            });
        })(jQuery);
    </script>
<script src="/dashboard/assets/libs/quill/quill.min.js"></script>
<script src="/dashboard/assets/js/pages/form-editor.js"></script>
@endsection

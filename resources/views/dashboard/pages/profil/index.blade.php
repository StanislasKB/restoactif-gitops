@extends('dashboard.components.app')
@section("title")
   Profil
@endsection
@section('page_css')
<link href="/dashboard/assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" >
<link href="/dashboard/assets/libs/quill/quill.core.css" rel="stylesheet" type="text/css" >
<link href="/dashboard/assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" >
<style>
  .file-custom-input {
    display: inline-block;
    position: relative;
}

.file-custom-input input[type="file"] {
    display: none;
}

.file-custom-label {
    /* background-color: #007BFF;
    color: white;
    padding: 10px 20px; */
    cursor: pointer;
    /* border-radius: 4px;
    font-size: 16px; */
}

#file-custom-name {
    display: block;
    margin-top: 10px;
    font-size: 16px;
    color: #333;
}


</style>
@endsection
@section('main_content')
@include('dashboard.pages.profil.layouts.page_title')
@include('dashboard.pages.profil.layouts.profil_form')
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
<script>
    function showFileName() {
    const input = document.getElementById('file-custom');
    const fileName = document.getElementById('file-custom-name');
    if (input.files.length > 0) {
        fileName.textContent = input.files[0].name;
    } else {
        fileName.textContent = "Aucun fichier choisi";
    }
}

</script>
@endsection

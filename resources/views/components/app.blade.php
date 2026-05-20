<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restoactif @yield('title')</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="/landing/img/logo.png">

     <!-- GOOGLE WEB FONT -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="anonymous">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap" as="fetch" crossorigin="anonymous">
    <script type="text/javascript">
    !function(e,n,t){"use strict";var o="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap",r="__3perf_googleFonts_c2536";function c(e){(n.head||n.body).appendChild(e)}function a(){var e=n.createElement("link");e.href=o,e.rel="stylesheet",c(e)}function f(e){if(!n.getElementById(r)){var t=n.createElement("style");t.id=r,c(t)}n.getElementById(r).innerHTML=e}e.FontFace&&e.FontFace.prototype.hasOwnProperty("display")?(t[r]&&f(t[r]),fetch(o).then(function(e){return e.text()}).then(function(e){return e.replace(/@font-face {/g,"@font-face{font-display:swap;")}).then(function(e){return t[r]=e}).then(f).catch(a)):a()}(window,document,localStorage);
    </script>

    <link rel="preload" as="image" href="/landing/img/home_section_1.jpg">

    <!-- BASE CSS -->
    <link rel="preload" href="/landing/css/bootstrap.min.css" as="style">
    <link href="/landing/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preload" href="/landing/css/style.css" as="style">
    <link href="/landing/css/style.css" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SPECIFIC CSS -->

    <!-- ALTERNATIVE COLORS CSS -->
	<link href="#" id="colors" rel="stylesheet">
    @yield('page_css')

</head>

<body>
    @hasSection('header')
    @yield('header')
@else
    @include('components.layouts.header')
@endif

@hasSection('other_main')
@yield('other_main')
@else
<main>
    @yield('main_content')
</main>
@endif


	<!-- /main -->

    @include('components.layouts.footer')
	<!--/footer-->

	<div id="toTop"></div><!-- Back to top button -->

	<div class="layer"></div><!-- Opacity Mask Menu Mobile -->

	<!-- Sign In Modal -->
	{{-- @include('auth.components.layouts.modal_signin') --}}
	<!-- /Sign In Modal -->

	<!-- COMMON SCRIPTS -->
    <script src="/landing/js/common_scripts.min.js"></script>
    <script src="/landing/js/common_func.js"></script>
    <script src="/landing/assets/validate.js"></script>

    <script src="/swjs/enable_push.js"></script>
    <!-- COLOR SWITCHER  -->
	<script src="/landing/js/switcher.js"></script>

    @yield('page_js')

	{{-- <div id="style-switcher">
		<h6>Color Switcher <a href="#"><i class="icon_cog"></i></a></h6>
		<div>
			<ul class="colors" id="color1">
				<li><a href="#" class="default" title="Default"></a></li>
				<li><a href="#" class="aqua" title="Aqua"></a></li>
				<li><a href="#" class="orange" title="Orange"></a></li>
				<li><a href="#" class="beige" title="Beige"></a></li>
				<li><a href="#" class="gray" title="Gray"></a></li>
				<li><a href="#" class="green-2" title="Green"></a></li>
				<li><a href="#" class="purple" title="Purple"></a></li>
				<li><a href="#" class="red" title="Red"></a></li>
				<li><a href="#" class="violet" title="Violet"></a></li>
			</ul>
		</div>
	</div> --}}

</body>

</html>

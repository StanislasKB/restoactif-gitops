<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="/manifest.json">

    <title>Restoactif</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="/landing/img/logo.png">


     <!-- GOOGLE WEB FONT -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="anonymous">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap" as="fetch" crossorigin="anonymous">
    <script type="text/javascript">
    !function(e,n,t){"use strict";var o="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap",r="__3perf_googleFonts_c2536";function c(e){(n.head||n.body).appendChild(e)}function a(){var e=n.createElement("link");e.href=o,e.rel="stylesheet",c(e)}function f(e){if(!n.getElementById(r)){var t=n.createElement("style");t.id=r,c(t)}n.getElementById(r).innerHTML=e}e.FontFace&&e.FontFace.prototype.hasOwnProperty("display")?(t[r]&&f(t[r]),fetch(o).then(function(e){return e.text()}).then(function(e){return e.replace(/@font-face {/g,"@font-face{font-display:swap;")}).then(function(e){return t[r]=e}).then(f).catch(a)):a()}(window,document,localStorage);
    </script>

    <!-- BASE CSS -->
    <link href="/landing/css/bootstrap.min.css" rel="stylesheet">
    <link href="/landing/css/style.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="/landing/css/booking-sign_up.css" rel="stylesheet">

    <!-- ALTERNATIVE COLORS CSS -->
	<link href="#" id="colors" rel="stylesheet">

    @yield('page_css')

</head>

<body>

	@include('components.layouts.header')
	<!-- /header -->

	<main class="bg_gray pattern">





	</main>
	<!-- /main -->

	@include('components.layouts.footer')
	<!--/footer-->


    @yield('page_script')
    <script>
        if ('serviceWorker' in navigator) {
          window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js').then((registration) => {
              console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }, (err) => {
              console.log('ServiceWorker registration failed: ', err);
            });
          });
        }
      </script>


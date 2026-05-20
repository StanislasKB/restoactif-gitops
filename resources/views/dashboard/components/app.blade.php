<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Restoactif @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="/manifest.json">

    <!-- App favicon -->
    <link rel="shortcut icon" href="/landing/img/logo.png">

    <!-- App css -->
    <link href="/dashboard/assets/css/app.min.css" rel="stylesheet" type="text/css">

    <!-- Icons css -->
    <link href="/dashboard/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!-- Theme Config Js -->
    <script src="/dashboard/assets/js/config.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('page_css')
</head>

<body>

    <div class="flex wrapper">

        @include('dashboard.components.layouts.sidebar')
        <!-- Sidenav Menu End  -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- Topbar Start -->
           @include('dashboard.components.layouts.topbar')
            <!-- Topbar End -->

            <!-- Topbar Search Modal -->
            @include('dashboard.components.layouts.topbar_modalsearch')

            <main class="flex-grow p-6">

               @yield('main_content')

            </main>

            <!-- Footer Start -->
            @include('dashboard.components.layouts.footer')
            <!-- Footer End -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>

    <!-- Back to Top Button -->
    <button data-toggle="back-to-top" class="fixed hidden h-10 w-10 items-center justify-center rounded-full z-10 bottom-20 end-14 p-2.5 bg-primary cursor-pointer shadow-lg text-white">
        <i class="mgc_arrow_up_line text-lg"></i>
    </button>

    {{-- @include('dashboard.components.layouts.theme_settings') --}}

    <!-- Plugin Js -->

    <script src="/dashboard/assets/libs/jquery/jquery.min.js"></script>
    <script src="/dashboard/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/dashboard/assets/libs/feather-icons/feather.min.js"></script>
    <script src="/dashboard/assets/libs/%40frostui/tailwindcss/frostui.js"></script>

    <!-- App Js -->
    <script src="/dashboard/assets/js/app.js"></script>

    <!-- Apexcharts js -->
    <script src="/dashboard/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Dashboard Project Page js -->
    <script src="/dashboard/assets/js/pages/dashboard.js"></script>
    @yield('page_js')
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

</body>


</html>

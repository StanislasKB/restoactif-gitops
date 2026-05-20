@php
     $user = Auth::user();
@endphp
<header class="app-header flex items-center px-4 gap-3">
    <!-- Sidenav Menu Toggle Button -->
    <button id="button-toggle-menu" class="nav-link p-2">
        <span class="sr-only">Menu Toggle Button</span>
        <span class="flex items-center justify-center h-6 w-6">
            <i class="mgc_menu_line text-xl"></i>
        </span>
    </button>

    <!-- Topbar Brand Logo -->
    <a href="{{ route('landing.accueil.accueil') }}" class="logo-box">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <img src="/dashboard/assets/images/logo-light.png" class="logo-lg h-6" alt="Light logo">
            <img src="/dashboard/assets/images/logo-sm.png" class="logo-sm" alt="Small logo">
        </div>

        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <img src="/dashboard/assets/images/logo-dark.png" class="logo-lg h-6" alt="Dark logo">
            <img src="/dashboard/assets/images/logo-sm.png" class="logo-sm" alt="Small logo">
        </div>
    </a>
    <div class="p-2 me-auto"></div>
    <div><p class="text-danger">@if ($user->profil()==null)
        Vous devez d'abord remplir les informations du profil avant toute chose
    @endif</p></div>
    <!-- Topbar Search Modal Button -->

    <!-- Language Dropdown Button -->


    <!-- Fullscreen Toggle Button -->
    <div class="md:flex hidden">
        <button data-toggle="fullscreen" type="button" class="nav-link p-2">
            <span class="sr-only">Fullscreen Mode</span>
            <span class="flex items-center justify-center h-6 w-6">
                <i class="mgc_fullscreen_line text-2xl"></i>
            </span>
        </button>
    </div>

    <!-- Notification Bell Button -->


    <!-- Light/Dark Toggle Button -->
    <div class="flex">
        <button id="light-dark-mode" type="button" class="nav-link p-2">
            <span class="sr-only">Light/Dark Mode</span>
            <span class="flex items-center justify-center h-6 w-6">
                <i class="mgc_moon_line text-2xl"></i>
            </span>
        </button>
    </div>

    <!-- Profile Dropdown Button -->
    <div class="relative">
        <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button" class="nav-link">
            <i class="mgc_user_3_line text-2xl"></i>
        </button>
        <div class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-44 z-50 transition-[margin,opacity] duration-300 mt-2 bg-white shadow-lg border rounded-lg p-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800">
            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="{{ route('dashboard.profil.view') }}">
                <i class="mgc_pic_2_line  me-2"></i>
                <span>Bar/Restaurant</span>
            </a>
            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="{{ route('dashboard.settings.view') }}">
                <i class="mgc_settings_4_line  me-2"></i>
                <span>Paramètres</span>
            </a>

            <hr class="my-2 -mx-2 border-gray-200 dark:border-gray-700">
            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="{{ route('logout') }}">
                <i class="mgc_exit_line  me-2"></i>
                <span>Déconnexion</span>
            </a>
        </div>
    </div>
</header>

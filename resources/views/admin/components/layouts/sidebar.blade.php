 <!-- Sidenav Menu -->
 <div class="app-menu">

    <!-- Sidenav Brand Logo -->
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

    <!-- Sidenav Menu Toggle Button -->
    <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
        <span class="sr-only">Menu Toggle Button</span>
        <i class="mgc_round_line text-xl"></i>
    </button>

    <!--- Menu -->
    <div class="srcollbar" data-simplebar>
        <ul class="menu" data-fc-type="accordion">
            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a href="{{ route('admin.dashboard.view') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                    <span class="menu-text"> Tableau de bord</span>
                </a>
            </li>

            <li class="menu-title">Fonctionnalités</li>
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_user_3_line"></i></span>
                    <span class="menu-text"> Utilisateurs </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{ route('admin.users.view') }}" class="menu-link">
                            <span class="menu-text">Restaurants/Bars</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.community.view') }}" class="menu-link">
                            <span class="menu-text">Communauté</span>
                        </a>
                    </li>
                </ul>
            </li>




            {{-- <li class="menu-item">
                <a href="{{ route('dashboard.calendar.view') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_calendar_line"></i></span>
                    <span class="menu-text"> Calendrier </span>
                </a>
            </li> --}}

            <li class="menu-title">Compte</li>


            <li class="menu-item">
                <a href="{{ route('admin.settings.view') }}" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_settings_3_line"></i></span>
                    <span class="menu-text">Paramètres de compte </span>
                </a>
            </li>

        </ul>
    </div>
</div>

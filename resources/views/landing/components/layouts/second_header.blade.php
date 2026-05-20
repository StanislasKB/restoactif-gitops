<header class="header_in clearfix">
    <div class="container">
    <div id="logo">
        <a href="{{ route('landing.accueil.accueil') }}">
            {{-- <img src="/landing/img/logo_light.png" width="140" height="35" alt="" class="logo_normal"> --}}
            <img src="/landing/img/logo_dark.png" width="140" height="35" alt="" class="logo_sticky">
        </a>
    </div>
    @php
    $user=auth()->user();
    @endphp
    @if (auth()->user())
    <ul id="top_menu" class="drop_user">
        <li>
            <div class="dropdown user clearfix">
                <a href="#" data-bs-toggle="dropdown">
                    @if ($user->profil()!=null)
                    <figure><img src="{{ Storage::url($user->profil()->logo) }}" alt="logo"></figure><span>{{ $user->profil()->name }}</span>
                    @else
                    <span>{{ auth()->user()->first_name }}</span>
                    @endif
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-menu-content">
                        <ul>
                            @if (auth()->user()->role==0)
                            <li><a href="{{ route('admin.dashboard.view') }}"><i class="icon_cog"></i>Dasboard</a></li>
                            <li><a href="{{ route('logout') }}"><i class="icon_key"></i>Déconnexion</a></li>
                            @else
                            <li><a href="{{ route('dashboard.index.view') }}"><i class="icon_cog"></i>Dasboard</a></li>
                            <li><a href="{{ route('dashboard.calendar.view') }}"><i class="icon_document"></i>Calendrier</a></li>
                            <li><a href="{{ route('logout') }}"><i class="icon_key"></i>Déconnexion</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /dropdown -->
        </li>
    </ul>
    @else
    <ul id="top_menu">
        <li><a href="{{ route('login.view') }}" class="login">Connexion</a></li>
    </ul>
    @endif
    <!-- /top_menu -->
    <a href="#0" class="open_close">
        <i class="icon_menu"></i><span>Menu</span>
    </a>
    <nav class="main-menu">
        <div id="header_menu">
            <a href="#0" class="open_close">
                <i class="icon_close"></i><span>Menu</span>
            </a>
            <a href="{{ route('landing.accueil.accueil') }}"><img src="/landing/img/logo_light.png" width="140" height="35" alt=""></a>
        </div>
        <ul>
            <li><a href="{{ route('landing.accueil.accueil') }}">Accueil</a></li>
            <li><a href="{{ route('landing.events.accueil') }}">Évènements</a></li>
            <li><a href="{{ route('landing.offers.accueil') }}">Offres</a></li>
            <li><a href="{{ route('landing.menu.accueil') }}">Menus</a></li>
            <li><a href="{{ route("landing.profil.accueil") }}">Restaurants</a></li>
            <li><a href="{{ route('join.community.view') }}">Rejoindre la communauté</a></li>
        </ul>
    </nav>
</div>
</header>
<!-- /header -->

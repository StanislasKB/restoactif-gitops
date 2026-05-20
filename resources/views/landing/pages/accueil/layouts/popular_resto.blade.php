<div class="bg_gray">
    <div class="container margin_60_40">
        <div class="main_title center">
            <span><em></em></span>
            <h2>Restaurants et bars</h2>
            {{-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p> --}}
        </div>
        <!-- /main_title -->
        <div class="owl-carousel owl-theme categories_carousel">

            @foreach ($profils as $profil)
            <div class="item">
                <a href="{{ route('landing.profil.detail',['id'=>$profil->id]) }}">
                    <span></span>
                    @if ($profil->type=='Bar')
                    <i class=" icon-food_icon_beer"></i>
                    @else
                    <i class="icon-food_icon_cloche"></i>
                    @endif
                    <h3>{{ $profil->name }}</h3>
                    <small>{{ $profil->type  }}</small>
                </a>
            </div>
            @endforeach
        </div>
        <!-- /carousel -->
    </div>
    <!-- /container -->
</div>

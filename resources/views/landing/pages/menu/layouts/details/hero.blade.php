<div class="hero_in detail_page background-image" data-background="url({{ Storage::url($menu->principal_image()->file_url) }})">
    <div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">

        <div class="container">
            <div class="main_info">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6">
                        <div class="head"><div class="score"><span>Menu spécial<em>{{ $menu->price }} €</em></span></div></div>
                        <h1>{{ $menu->name }}</h1>
                        {{ $menu->user->profil()->name }}
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-6 position-relative">
                        <div class="buttons clearfix">
                            <span class="magnific-gallery">
                                <a href="{{ Storage::url($menu->principal_image()->file_url) }}" class="btn_hero" title="{{ $menu->name }}" data-effect="mfp-zoom-in"><i class="icon_image"></i>Voir les photos</a>
                                @foreach ($menu->images()->get() as $img)
                                <a href="{{ Storage::url($img->file_url) }}" title="{{ $menu->name }}" data-effect="mfp-zoom-in"></a>
                                @endforeach

                            </span>
                            {{-- <a href="#0" class="btn_hero wishlist"><i class="icon_heart"></i>Wishlist</a> --}}
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /main_info -->
        </div>
    </div>
</div>

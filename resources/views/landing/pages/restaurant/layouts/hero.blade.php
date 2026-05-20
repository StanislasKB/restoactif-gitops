<div class="hero_in detail_page background-image" data-background="url(@if($profil->principal_image()!=null){{ Storage::url($profil->principal_image()->file_url)}}@else {{ Storage::url($profil->logo)}} @endif)">
    <div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">

        <div class="container">
            <div class="main_info">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6">
                        <div class="head"><div class="score"><span>{{ $profil->type }}<em></em></span></div></div>
                        <h1>{{ $profil->name }}</h1>
                        {{ $profil->address }}
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-6 position-relative">
                        <div class="buttons clearfix">
                            <span class="magnific-gallery">
                                <a href="@if($profil->principal_image()!=null){{ Storage::url($profil->principal_image()->file_url)}}@else {{ Storage::url($profil->logo)}} @endif" class="btn_hero" title="{{ $profil->name }}" data-effect="mfp-zoom-in"><i class="icon_image"></i>Voir les photos</a>
                                @foreach ($profil->images()->get() as $img)
                                <a href="{{ Storage::url($img->file_url) }}" title="{{ $profil->name }}" data-effect="mfp-zoom-in"></a>
                                @endforeach

                            </span>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /main_info -->
        </div>
    </div>
</div>

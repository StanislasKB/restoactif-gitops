<div class="container margin_detail">
    <div class="row">
        <div class="col-lg-12">

            <div class="tabs_detail">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab" role="tab">Information</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Catalogue</a>
                    </li>
                </ul>

                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5>
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
                                    Information
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body info_content">
                                <p>{{ $profil->description }}</p>
                                <div class="add_bottom_25"></div>
                                <h2>Galerie</h2>
                                <div class="pictures magnific-gallery clearfix">
                                    @foreach ($profil->images()->get() as $img)
                                    <figure><a href="{{ Storage::url($img->file_url) }}" title="{{ $profil->name }}" data-effect="mfp-zoom-in"><img src="/landing/img/thumb_detail_placeholder.jpg" data-src="{{ Storage::url($img->file_url) }}" class="lazy" alt=""></a></figure>
                                    @endforeach
                                    <figure><a href="{{ Storage::url($profil->logo) }}" title="logo" data-effect="mfp-zoom-in"><span class="d-flex align-items-center justify-content-center">+5</span><img src="{{ Storage::url($profil->logo) }}" data-src="{{ Storage::url($profil->logo) }}" class="lazy" alt=""></a></figure>
                                </div>
                                <div class="other_info">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /tab -->

                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5>
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
                                    Catalogue
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body reviews">
                                @if ($offers->count()!=0)
                                <h6>Offres promotionnelles</h6>
                                @endif
                                @include('landing.pages.restaurant.layouts.offers')
                                @if ($events->count()!=0)
                                <h6>Évènements</h6>
                                @endif
                                @include('landing.pages.restaurant.layouts.events')
                                @if ($menus->count()!=0)
                                <h6>Menus spéciaux</h6>
                                @endif
                                @include('landing.pages.restaurant.layouts.menus')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /tab-content -->
            </div>
            <!-- /tabs_detail -->
        </div>
        <!-- /col -->



    </div>
    <!-- /row -->
</div>

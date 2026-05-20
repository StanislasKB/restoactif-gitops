<style>
    .highlight {
        background-color: green !important;
        color: white !important;
    }
</style>
<div class="container margin_detail">
    <div class="row">
        <div class="col-lg-8">

            <div class="tabs_detail">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab" role="tab">Description</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Reviews</a>
                    </li> --}}
                </ul>

                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5>
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
                                    Description
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body info_content">
                                {!! $offer->description !!}
                                <div class="add_bottom_25"></div>
                                <h2>Images</h2>
                                <div class="pictures magnific-gallery clearfix">
                                    @foreach ($offer->offer_images()->get() as $img)
                                    <figure><a href="{{ Storage::url($img->file_url) }}" title="{{ $offer->title }}" data-effect="mfp-zoom-in"><img src="/landing/img/thumb_detail_placeholder.jpg" data-src="{{ Storage::url($img->file_url) }}" class="lazy" alt=""></a></figure>
                                    @endforeach
                                </div>
                                <!-- /pictures -->



                                <hr>


                                <!-- /special_offers -->

                                <div class="other_info">
                                <h2>{{ $offer->user->profil()->name }}</h2>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3>Adresse</h3>
                                        <p>{{ $offer->user->profil()->address  }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Galerie</h3>
                                        <div class="pictures magnific-gallery clearfix">
                                            @foreach ($offer->user->profil()->images()->get() as $img)
                                            <figure><a href="{{ Storage::url($img->file_url) }}" title="{{ $offer->title }}" data-effect="mfp-zoom-in"><img src="/landing/img/thumb_detail_placeholder.jpg" data-src="{{ Storage::url($img->file_url) }}" class="lazy" alt=""></a></figure>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Résumé</h3>
                                        {{ $offer->user->profil()->description }}
                                    </div>
                                </div>
                                <!-- /row -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /tab -->
                </div>
                <!-- /tab-content -->
            </div>
            <!-- /tabs_detail -->
        </div>
        <!-- /col -->

        <div class="col-lg-4" id="sidebar_fixed">
            <div class="box_booking">
                <div class="head">
                    <h3>Disponibilité</h3>
                </div>
                <!-- /head -->
                <div id="event-data" data-start="{{$offer->start_date}}" data-end="{{$offer->end_date}}"></div>

                <div class="main">
                    <input type="text" id="datepicker_field">
                    <div id="DatePicker"></div>
                </div>
            </div>

        </div>

    </div>
    <!-- /row -->
</div>

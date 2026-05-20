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
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Avis</a>
                    </li>
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
                                {!! $menu->description !!}
                                <div class="add_bottom_25"></div>
                                <h2>Images</h2>
                                <div class="pictures magnific-gallery clearfix">
                                    @foreach ($menu->images()->get() as $img)
                                    <figure><a href="{{ Storage::url($img->file_url) }}" title="{{ $menu->name }}" data-effect="mfp-zoom-in"><img src="/landing/img/thumb_detail_placeholder.jpg" data-src="{{ Storage::url($img->file_url) }}" class="lazy" alt=""></a></figure>
                                    @endforeach
                                </div>
                                <!-- /pictures -->
                                <h2>Plats du Menu</h2>
                                {{-- <h3>Starters</h3> --}}
                                @foreach ($menu->plats()->get() as $plat)
                                <div class="menu_item">
                                    <em>{{ $plat->price }}€</em>
                                    <h4>{{ $plat->name }}</h4>
                                    <p>{{ $plat->description }}</p>
                                </div>
                                @endforeach


                                <hr>


                                <!-- /special_offers -->

                                <div class="other_info">
                                <h2>{{ $menu->user->profil()->name }}</h2>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3>Adresse</h3>
                                        <p>{{ $menu->user->profil()->address  }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Galerie</h3>
                                        <div class="pictures magnific-gallery clearfix">
                                            @foreach ($menu->user->profil()->images()->get() as $img)
                                            <figure><a href="{{ Storage::url($img->file_url) }}" title="{{ $menu->name }}" data-effect="mfp-zoom-in"><img src="/landing/img/thumb_detail_placeholder.jpg" data-src="{{ Storage::url($img->file_url) }}" class="lazy" alt=""></a></figure>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Résumé</h3>
                                        {{ $menu->user->profil()->description }}
                                    </div>
                                </div>
                                <!-- /row -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /tab -->
                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5>
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
                                    Avis
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body reviews">
                                <div class="row add_bottom_45 d-flex align-items-center">
                                    <div class="col-md-3">
                                        @php
                                        $note=0.0;
                                        if ($menu->reviews()->get()->count()>0){
                                            foreach ($menu->reviews()->get() as $review) {
                                               $note=$note+$review->rating;
                                            }
                                            $note=$note/$menu->reviews()->count();
                                        }



                                        @endphp
                                        <div id="review_summary">
                                            <em>Note moyenne</em>
                                            <strong>{{$note}}</strong>
                                            {{-- <em>Superb</em> --}}
                                            <small>Basée sur {{$menu->reviews()->count()}} avis</small>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-9 reviews_sum_details">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Food Quality</h6>
                                                <div class="row">
                                                    <div class="col-xl-10 col-lg-9 col-9">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-3"><strong>9.0</strong></div>
                                                </div>
                                                <!-- /row -->
                                                <h6>Service</h6>
                                                <div class="row">
                                                    <div class="col-xl-10 col-lg-9 col-9">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-3"><strong>9.5</strong></div>
                                                </div>
                                                <!-- /row -->
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Location</h6>
                                                <div class="row">
                                                    <div class="col-xl-10 col-lg-9 col-9">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-3"><strong>6.0</strong></div>
                                                </div>
                                                <!-- /row -->
                                                <h6>Price</h6>
                                                <div class="row">
                                                    <div class="col-xl-10 col-lg-9 col-9">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-3"><strong>6.0</strong></div>
                                                </div>
                                                <!-- /row -->
                                            </div>
                                        </div>
                                        <!-- /row -->
                                    </div> --}}
                                </div>

                                <div id="reviews">
                                    @foreach ( $menu->reviews()->get() as $review )
                                    <div class="review_card">
                                        <div class="row">
                                            <div class="col-md-2 user_info">
                                                <figure><img src="/landing/img/avatar.avif" alt=""></figure>
                                                <h5> {{$review->last_name}}  {{$review->first_name}}</h5>
                                            </div>
                                            <div class="col-md-10 review_content">
                                                <div class="clearfix add_bottom_15">
                                                    <span class="rating">{{$review->rating}}<small>/10</small> <strong>Note</strong></span>
                                                    <em>{{$review->created_at}}</em>
                                                </div>
                                                <h4>"{{$review->review_title}}"</h4>
                                                <p>{{$review->review}}</p>
                                                <div class="pictures magnific-gallery clearfix">
                                                    @if ($review->images()->get()!=null)
                                                    @foreach ($review->images()->get() as $img)
                                                    <figure><a href="{{ Storage::url($img->file_url) }}" title="avis images" data-effect="mfp-zoom-in"><img src="/landing/img/thumb_detail_placeholder.jpg" data-src="{{ Storage::url($img->file_url) }}" class="lazy" alt=""></a></figure>
                                                    @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                    </div>
                                    @endforeach
                                </div>
                                <!-- /reviews -->
                                <div class="text-end"><a href="{{ route('review.view',['id'=>$menu->id,'slug'=>'menu']) }}" class="btn_1">Laisser un avis</a></div>
                            </div>
                        </div>
                    </div>
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
                <div id="event-data" data-start="{{$menu->start_date}}" data-end="{{$menu->end_date}}"></div>

                <div class="main">
                    <input type="text" id="datepicker_field">
                    <div id="DatePicker"></div>
                </div>
            </div>

        </div>

    </div>
    <!-- /row -->
</div>

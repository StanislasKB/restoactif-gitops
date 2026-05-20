<div class="row">
    <div class="col-12">
        <div class="main_title version_2">
            <span><em></em></span>
            <h2>Nos meilleures offres</h2>
            <p></p>
            {{-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p> --}}
            <a href="{{ route('landing.offers.accueil') }}">Toutes les offres</a>
        </div>
    </div>
    @if ($left_offers->count() == 0 && $right_offers->count() == 0)
        <div class="col-md-12">Aucune offre promotionnelle pour l'instant</div>
    @else
        <div class="col-md-6">
            <div class="list_home">
                <ul>
                    @foreach ($left_offers as $offer)
                        <li>
                            <a href="{{ route('landing.offers.detail', ['id' => $offer->id]) }}">
                                <figure>
                                    <img src="{{ Storage::url($offer->principal_image()->file_url) }}"
                                        data-src="{{ Storage::url($offer->principal_image()->file_url) }}" alt=""
                                        class="lazy">
                                </figure>
                                <div class="score"></div>
                                <em>Offre Promotionnelle</em>
                                <h3>{{ $offer->title }}</h3>
                                @php
                                    $startDate = new \Carbon\Carbon($offer->start_date);
                                    $endDate = new \Carbon\Carbon($offer->end_date);
                                @endphp
                                @if ($startDate->isSameDay($endDate))
                                    <small>{{ $startDate->format('d-m-Y') }}</small>
                                @else
                                    <small> Du {{ $startDate->format('d-m-Y') }} au
                                        {{ $endDate->format('d-m-Y') }}</small>
                                @endif

                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="list_home">
                <ul>
                    @foreach ($right_offers as $offer)
                        <li>
                            <a href="{{ route('landing.offers.detail', ['id' => $offer->id]) }}">
                                <figure>
                                    <img src="{{ Storage::url($offer->principal_image()->file_url) }}"
                                        data-src="{{ Storage::url($offer->principal_image()->file_url) }}"
                                        alt="" class="lazy">
                                </figure>
                                <div class="score"></div>
                                <em>Offre Promotionnelle</em>
                                <h3>{{ $offer->title }}</h3>
                                @php
                                    $startDate = new \Carbon\Carbon($offer->start_date);
                                    $endDate = new \Carbon\Carbon($offer->end_date);
                                @endphp
                                @if ($startDate->isSameDay($endDate))
                                    <small>{{ $startDate->format('d-m-Y') }}</small>
                                @else
                                    <small> Du {{ $startDate->format('d-m-Y') }} au
                                        {{ $endDate->format('d-m-Y') }}</small>
                                @endif

                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif


</div>
<!-- /row -->
<p class="text-center d-block d-md-block d-lg-none"><a href="{{ route('landing.offers.accueil') }}"
        class="btn_1">Toutes les offres</a>
</p>
<!-- /button visibile on tablet/mobile only -->
</div>

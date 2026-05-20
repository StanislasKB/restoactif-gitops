<div class="container margin_30_40">
    <div class="row">
        @if ($profils->count() == 0)
            <p>Aucun restaurant/bar disponible</p>
        @else
            @foreach ($profils as $profil)
                {{-- @php
                    $now = \Carbon\Carbon::now();
                    $startDate = \Carbon\Carbon::parse($offer->start_date);
                    $endDate = \Carbon\Carbon::parse($offer->end_date);

                    if ($now->lt($startDate)) {
                        $status = 'À venir';
                    } elseif ($now->between($startDate, $endDate)) {
                        $status = 'En cours';
                    } else {
                        $status = 'Fermé';
                    }
                @endphp --}}
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <div class="strip">
                        <figure>
                            {{-- <span class="ribbon off">-30%</span> --}}
                            <img src="{{ Storage::url($profil->logo) }}"
                                data-src="{{ Storage::url($profil->logo) }}" class="img-fluid lazy"
                                alt="logo du profil">
                            <a href="{{ route('landing.profil.detail', ['id' => $profil->id]) }}" class="strip_info">
                                <small> {{$profil->type}} </small>
                                <div class="item_title">
                                    <h3>{{ $profil->name }}</h3>
                                    <small>{{ $profil->address }}</small>

                                </div>
                            </a>
                        </figure>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
    <!-- /row -->
    @include('vendor.pagination.custom', ['paginator' => $profils])

</div>

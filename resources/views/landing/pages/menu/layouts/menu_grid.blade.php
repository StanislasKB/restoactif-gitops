<div class="container margin_30_40">
    <div class="row">
        @if ($menus->count() == 0)
            <p>Aucun menu disponible</p>
        @else
            @foreach ($menus as $menu)
                @php
                    $now = \Carbon\Carbon::now();
                    $startDate = \Carbon\Carbon::parse($menu->start_date);
                    $endDate = \Carbon\Carbon::parse($menu->end_date);

                    if ($now->lt($startDate)) {
                        $status = 'À venir';
                    } elseif ($now->between($startDate, $endDate)) {
                        $status = 'En cours';
                    } else {
                        $status = 'Fermé';
                    }

                    $note = 0.0;
                    if ($menu->reviews()->get()->count() > 0) {
                        foreach ($menu->reviews()->get() as $review) {
                            $note = $note + $review->rating;
                        }
                        $note = $note / $menu->reviews()->count();
                    }
                @endphp
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <div class="strip">
                        <figure>
                            <span class="ribbon off">{{ $menu->price }} €</span>
                            <img src="{{ Storage::url($menu->principal_image()->file_url) }}"
                                data-src="{{ Storage::url($menu->principal_image()->file_url) }}" class="img-fluid lazy"
                                alt="">
                            <a href="{{ route('landing.menu.detail', ['id' => $menu->id]) }}" class="strip_info">
                                <small>Spécial</small>
                                <div class="item_title">
                                    <h3>{{ $menu->name }}</h3>
                                    @php
                                        $startDate = new \Carbon\Carbon($menu->start_date);
                                        $endDate = new \Carbon\Carbon($menu->end_date);
                                    @endphp
                                    @if ($startDate->isSameDay($endDate))
                                        <small>{{ $startDate->format('d-m-Y') }}</small>
                                    @else
                                        <small> Du {{ $startDate->format('d-m-Y') }} au
                                            {{ $endDate->format('d-m-Y') }}</small>
                                    @endif
                                </div>
                            </a>
                        </figure>
                        <ul>
                            @if ($status == 'À venir')
                                <li><span class="loc_not_yet">{{ $status }}</span></li>
                            @elseif ($status == 'En cours')
                                <li><span class="loc_open">{{ $status }}</span></li>
                            @else
                                <li><span class="loc_closed">{{ $status }}</span></li>
                            @endif
                            <li>
                                <div class="score"><span>Moyenne<em>{{ $menu->reviews()->get()->count() }}
                                            Avis</em></span><strong>{{ $note }} </strong></div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif


        <!-- /row -->

        <!-- /col -->
    </div>
    @include('vendor.pagination.custom', ['paginator' => $menus])
</div>

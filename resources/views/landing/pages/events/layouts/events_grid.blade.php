<div class="container margin_30_40">
    <div class="row">
        @if ($events->count() == 0)
            <p>Aucun évènement disponible</p>
        @else
            @foreach ($events as $event)
                @php
                    $now = \Carbon\Carbon::now();
                    $startDate = \Carbon\Carbon::parse($event->start_date);
                    $endDate = \Carbon\Carbon::parse($event->end_date);

                    if ($now->lt($startDate)) {
                        $status = 'À venir';
                    } elseif ($now->between($startDate, $endDate)) {
                        $status = 'En cours';
                    } else {
                        $status = 'Fermé';
                    }

                    $note = 0.0;
                    if ($event->reviews()->get()->count() > 0) {
                        foreach ($event->reviews()->get() as $review) {
                            $note = $note + $review->rating;
                        }
                        $note = $note / $event->reviews()->count();
                    }
                @endphp
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <div class="strip">
                        <figure>
                            {{-- <span class="ribbon off">-30%</span> --}}
                            <img src="{{ Storage::url($event->principal_image()->file_url) }}"
                                data-src="{{ Storage::url($event->principal_image()->file_url) }}" class="img-fluid lazy"
                                alt="">
                            <a href="{{ route('landing.events.detail', ['id' => $event->id]) }}" class="strip_info">
                                <small>{{ $event->type }}</small>
                                <div class="item_title">
                                    <h3>{{ $event->title }}</h3>
                                    <small>{{ $event->address }}</small>
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
                                <div class="score"><span>Moyenne<em>{{ $event->reviews()->get()->count() }}
                                            Avis</em></span><strong>{{ $note }} </strong></div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
    <!-- /row -->
    @include('vendor.pagination.custom', ['paginator' => $events])

    <!-- /col -->
</div>
</div>

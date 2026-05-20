<div class="grid lg:grid-cols-3 grid-cols-1 gap-6">
    @if ($events->count() == 0)
        <h2>Aucun évènement créé</h2>
    @else
        @foreach ($events as $event)
            @include('dashboard.pages.events.partials.event')
        @endforeach
    @endif
</div>

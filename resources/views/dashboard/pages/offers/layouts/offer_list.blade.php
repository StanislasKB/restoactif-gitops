<div class="flex justify-between items-center mb-6">
    <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Offres</h4>

    <div class="md:flex hidden items-center gap-2.5 text-sm font-semibold">
        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard.index.view') }}"
                class="text-sm font-medium text-slate-700 dark:text-slate-400">Restoactif</a>
        </div>

        <div class="flex items-center gap-2">
            <i class="mgc_right_line text-lg flex-shrink-0 text-slate-400 rtl:rotate-180"></i>
            <a class="text-sm font-medium text-slate-700 dark:text-slate-400">Fonctionnalités</a>
        </div>

        <div class="flex items-center gap-2">
            <i class="mgc_right_line text-lg flex-shrink-0 text-slate-400 rtl:rotate-180"></i>
            <a href="{{ route('dashboard.offers.view') }}"
                class="text-sm font-medium text-slate-700 dark:text-slate-400" aria-current="page">Liste</a>
        </div>
    </div>
</div>
<!-- Page Title End -->


<div class="grid lg:grid-cols-3 grid-cols-1 gap-6">
    @if ($offres->count() == 0)
        <h2>Aucune offre créée</h2>
    @else
        @foreach ($offres as $offre)
            @include('dashboard.pages.offers.layouts.list')
        @endforeach
    @endif

</div>

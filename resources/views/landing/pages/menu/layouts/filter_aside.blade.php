
@php
                        $sortby = request()->input('sort_by');
                        $query = request()->query();
                        unset($query['sort_by']);
                        $urlWithoutSortBy = request()->url() . '?' . http_build_query($query);
                    @endphp

<div class="filters_full clearfix">
    <div class="container">
        <div class="sort_select">
            <select name="sort_by" class="sort-select" id="sort"- data-page_url="{{$urlWithoutSortBy}}">
                <option value="popularity" {{ request('sort_by') == 'popularity' ? 'selected' : '' }}>Trier par plus récents</option>
        <option value="en_cours" {{ request('sort_by') == 'en_cours' ? 'selected' : '' }}>En cours</option>
        <option value="venir" {{ request('sort_by') == 'venir' ? 'selected' : '' }}>A venir</option>
        <option value="ferme" {{ request('sort_by') == 'ferme' ? 'selected' : '' }}>Fermé</option>
        <option value="plus_chers" {{ request('sort_by') == 'plus_chers' ? 'selected' : '' }}>Plus chers</option>
        <option value="moins_chere" {{ request('sort_by') == 'moins_chere' ? 'selected' : '' }}>Moins chers</option>
            </select>
        </div>

    </div>
</div>

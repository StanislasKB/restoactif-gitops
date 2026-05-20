
@php
                        $sortby = request()->input('sort_by');
                        $query = request()->query();
                        unset($query['sort_by']);
                        $urlWithoutSortBy = request()->url() . '?' . http_build_query($query);
                    @endphp

<div class="filters_full clearfix">
    <div class="container">
        <div class="sort_select">
            <select name="sort_by" class="sort-select" id="sort" data-page_url="{{$urlWithoutSortBy}}" >
                <option value="popularity" {{ request('sort_by') == 'popularity' ? 'selected' : '' }}>Trier par plus récents</option>
                <option value="en_cours" {{ request('sort_by') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="venir" {{ request('sort_by') == 'venir' ? 'selected' : '' }}>A venir</option>
                <option value="ferme" {{ request('sort_by') == 'ferme' ? 'selected' : '' }}>Fermé</option>
                <option value="concert" {{ request('sort_by') == 'concert' ? 'selected' : '' }}>Concert</option>
                <option value="festival" {{ request('sort_by') == 'festival' ? 'selected' : '' }}>Festival</option>
                <option value="autre" {{ request('sort_by') == 'autre' ? 'selected' : '' }}>Autre</option>
            </select>
        </div>

    </div>
</div>

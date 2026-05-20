@php
                        $sortby = request()->input('sort_by');
                        $query = request()->query();
                        unset($query['sort_by']);
                        $urlWithoutSortBy = request()->url() . '?' . http_build_query($query);
                    @endphp


<div class="filters_full clearfix">
    <div class="container">
        <div class="sort_select">
            <select name="sort" class="sort-select" id="sort" data-page_url="{{$urlWithoutSortBy}}">
                <option value="popularity" {{ request('sort_by') == 'popularity' ? 'selected' : '' }}>Trier par nouveau</option>
                <option value="bar" {{ request('sort_by') == 'bar' ? 'selected' : '' }}>Bar</option>
                <option value="restaurant" {{ request('sort_by') == 'venir' ? 'selected' : '' }}>Restaurant</option>
                {{-- <option value="ferme" {{ request('sort_by') == 'ferme' ? 'selected' : '' }}>Fermé</option> --}}
            </select>
        </div>

    </div>
</div>

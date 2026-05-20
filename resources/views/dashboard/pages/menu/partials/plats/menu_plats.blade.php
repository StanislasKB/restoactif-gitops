

<div class="card mb-5">
    <div class="card-header bg-body-tertiary">
        <div class="flex w-full  flex-wrap items-center gap-4 justify-between">

            <div class="flex items-center" >
                <h6 class="mb-0">Plats du menu</h6>
            </div>
            <div class="flex flex-wrap align-items-center gap-4 justify-content-end">
                @include('dashboard.pages.menu.partials.plats.select_dish_modal')
                @include('dashboard.pages.menu.partials.plats.create_plat_modal')
            </div>
        </div>

    </div>
    <div class="card-body justify-content-center">
        <ul class="w-full flex flex-col" id="dishList">
            @foreach ($menu->plats()->get() as $plat )
            <li class="inline-flex items-center justify-between gap-x-2 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                {{$plat->name}}
                <input type="checkbox" value="{{$plat->id}}" name="dishes[]" class="hidden" checked>
                <button type="button" class="removeDishBtn bg-red-500 text-white rounded px-2 py-1">Supprimer</button>
            </li>
            @endforeach
        </ul>
    </div>
</div>


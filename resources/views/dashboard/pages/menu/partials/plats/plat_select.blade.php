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

        </ul>
    </div>
</div>

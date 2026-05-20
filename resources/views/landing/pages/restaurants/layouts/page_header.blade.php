<div class="page_header element_to_stick">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block">

                <h1>{{ $profils->count()   }} restaurants/bars en tout</h1>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-5">
                <form action="" method="get">
                    <div class="search_bar_list">
                        <input type="text" value="{{request('search')}}" class="form-control" name="search" placeholder="Taper un texte...">
                        <input type="submit" value="Rechercher">
                    </div>
                </form>
            </div>
        </div>
        <!-- /row -->
    </div>
</div>

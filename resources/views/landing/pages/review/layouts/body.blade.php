<div class="container margin_60_40">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @php
            $event = $event ?? null;
            $menu = $menu ?? null;
                if ($event!=null) {
                    $slug = 'event';
                    $id = $event->id;
                    $title = $event->title;
                }else if($menu!=null) {
                    $slug = 'menu';
                    $id = $menu->id;
                    $title = $menu->name;
                }
            @endphp
            <form action="{{ route('review.create', ['id' => $id, 'slug' => $slug]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="box_general write_review">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h1 class="add_bottom_15">Laissez un avis pour {{ $title }}</h1>
                    <div class="row">
                        <div class="row mt-1">
                            <div class="col-md-6 mt-3">
                                <label>Nom</label>
                                <input class="form-control" type="text" placeholder="Votre nom" name="last_name">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Prénom(s)</label>
                                <input class="form-control" type="text" placeholder="Votre prénom" name="first_name">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-8 add_bottom_25">
                            <div class="add_bottom_15">Note <strong class="food_quality_val"></strong></div>
                            <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="food_quality" name="rating">
                         </div>
                    </div>
                    <div class="form-group mt-3">
                        <label>Titre pour l'avis</label>
                        <input class="form-control" type="text"
                            placeholder="Si vous pouviez le dire en une phrase, que diriez-vous ?" name="title">
                    </div>
                    <div class="form-group">
                        <label>Votre avis</label>
                        <textarea class="form-control" style="height: 180px;" placeholder="Rédigez votre commentaire..." name="review"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ajouter des photos (facultatif)</label>
                        <div class="fileupload"><input type="file" name="images[]" multiple accept="image/*"></div>
                    </div>
                    <button class="btn_1">Donner l'avis</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /row -->
</div>


    <!-- Page Title Start -->

    <!-- Page Title End -->
    <form action="{{route('dashboard.menu.new.create')}}" method="post"  enctype="multipart/form-data" >
        <div class="grid lg:grid-cols-4 gap-6">
            @csrf
            <div class="lg:col-span-4 space-y-6">
                <div class="card p-6">
                    @if ($errors->any())
                            <div class="bg-danger/25 text-danger text-sm rounded-md p-4 mb-7 ">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                    <div class="bg-success/25 text-success text-sm rounded-md p-4 mb-7">{{ session('success') }}</div>
                      @endif
                    <div class="flex justify-between items-center mb-4">
                        <p class="card-title">Informations du menu spécial</p>
                        <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                            <i class="mgc_transfer_line"></i>
                        </div>
                    </div>

                    {{-- alert --}}



                    <div class="flex flex-col gap-3">
                        <div class="mb-5">
                            <label for="title" class="mb-2 block">Nom du menu<span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" value="{{old('name')}}" class="form-input" placeholder="Entrez le nom du menu" aria-describedby="input-helper-text">
                        </div>
                        <div class="mb-5">
                            <label for="description" class="mb-2 block">Description du menu <span class="text-red-500">*</span></label>
                            <textarea name="description" class="hidden" id="snow-hidden-textarea"></textarea>
                            <div id="snow-editor" style="height: 300px;"></div>
                        </div>


                        <div class="mb-5">
                            <label for="price" class="mb-2 block">Prix du menu<span class="text-red-500">*</span></label>
                            <input type="text" id="price" name="price" value="{{old('price')}}" class="form-input" placeholder="Entrez le prix du menu" aria-describedby="input-helper-text">
                        </div>
                        <div class="grid md:grid-cols-2 gap-3 mb-5">
                            <div class="">
                                <label for="start_date" class="mb-2 block">Date de debut<span class="text-red-500">*</span></label>
                                <input type="datetime-local" id="start_date" name="start_date" class="form-input"></input>
                            </div>

                            <div class="">
                                <label for="end_date" class="mb-2 block">Date de fin<span class="text-red-500">*</span></label>
                                <input type="datetime-local" id="end_date" name="end_date" class="form-input"></input>
                            </div>
                        </div>
                        @include('dashboard.pages.menu.partials.plats.plat_select')
                        <div class="card mb-5">
                            <div class="card-header bg-body-tertiary">
                                <h6 class="mb-0">Images</h6>
                            </div>
                            <div class="card-body justify-content-center">
                                <input name="images[]" class="dropify" type="file" multiple="multiple" accept="image/*" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 mt-5">
                <div class="flex justify-end gap-3">

                    <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                        Ajouter
                    </button>
                </div>
            </div>
        </div>
    </form>

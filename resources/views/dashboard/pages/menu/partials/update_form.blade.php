
    <!-- Page Title Start -->

    <!-- Page Title End -->
    <form action="{{route('dashboard.menu.edit',['id'=>$menu->id])}}" method="post"  enctype="multipart/form-data" >
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
                            <label for="title" class="mb-2 block">Nom du menu</label>
                            <input type="text" id="name" name="name" value="{{$menu->name}}" class="form-input" placeholder="Entrer Title" aria-describedby="input-helper-text">
                        </div>
                        <div class="mb-5">
                            <label for="description" class="mb-2 block">Description du menu <span class="text-red-500">*</span></label>
                            <textarea name="description" class="hidden" id="snow-hidden-textarea">{{$menu->description}}</textarea>
                            <div id="snow-editor" style="height: 300px;">{!!$menu->description!!} </div>
                        </div>


                        <div class="mb-5">
                            <label for="price" class="mb-2 block">Prix du menu</label>
                            <input type="number" id="price" name="price" value="{{$menu->price}}" class="form-input" placeholder="Entrer le prix du menu" aria-describedby="input-helper-text">
                        </div>
                        <div class="grid md:grid-cols-2 gap-3 mb-5">
                            <div class="">
                                <label for="start_date" class="mb-2 block">Date de debut</label>
                                <input type="datetime-local" id="start_date" value="{{$menu->start_date}}" name="start_date" class="form-input"></input>
                            </div>

                            <div class="">
                                <label for="end_date" class="mb-2 block">Date de fin</label>
                                <input type="datetime-local" value="{{$menu->end_date}}" id="end_date" name="end_date" class="form-input"></input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 mt-5">
                <div class="flex justify-end gap-3">

                    <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                        Modifier
                    </button>
                </div>
            </div>
        </div>
    </form>


    <!-- Page Title Start -->

    <!-- Page Title End -->
    <form action="{{route('dashboard.event.edit',['id'=>$event->id])}}" method="post"  enctype="multipart/form-data" >
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
                        <p class="card-title">Informations de l'évènement</p>
                        <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                            <i class="mgc_transfer_line"></i>
                        </div>
                    </div>

                    {{-- alert --}}



                    <div class="flex flex-col gap-3">
                        <div class="mb-5">
                            <label for="title" class="mb-2 block">Titre de l'évènement</label>
                            <input type="text" id="title" name="title" value="{{ $event->title}}" class="form-input" placeholder="Entrer Title" aria-describedby="input-helper-text">
                        </div>

                        {{-- <div class="mb-5">
                            <label for="description" class="mb-2 block">Description de l'èvènement <span class="text-red-500">*</span></label>
                            <textarea id="description" name="description" placeholder="Entrer la description de votre evènement" class="form-input" rows="8">{{old('description')}} </textarea>
                        </div> --}}
                        <div class="mb-5">
                            <label for="description" class="mb-2 block">Description de l'èvènement <span class="text-red-500">*</span></label>
                            <textarea name="description" class="hidden" id="snow-hidden-textarea">{{ $event->title}}</textarea>
                            <div id="snow-editor" style="height: 300px;">{!! $event->description !!}</div>
                        </div>

                        <div class="mb-5">
                            <label for="type" class="mb-2 block">Type</label>
                            <select id="type" name="type" class="form-select">
                                <option @if ($event->type=='concert')
                                    selected
                                @endif >Concert</option>
                                <option>Autre</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="address" class="mb-2 block">Adresse</label>
                            <input type="text" id="address" name="address" value="{{ $event->address }}" class="form-input" placeholder="Entrer l'adresse de votre évènement" aria-describedby="input-helper-text">
                        </div>
                        <div class="grid md:grid-cols-2 gap-3 mb-5">
                            <div class="">
                                <label for="start_date" class="mb-2 block">Date de debut</label>
                                <input type="datetime-local" value="{{$event->start_date}}" id="start_date" name="start_date" class="form-input"></input>
                            </div>

                            <div class="">
                                <label for="end_date" class="mb-2 block">Date de fin</label>
                                <input type="datetime-local" value="{{$event->end_date}}" id="end_date" name="end_date" class="form-input"></input>
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

                </div>
            </div>


        </div>
    </form>



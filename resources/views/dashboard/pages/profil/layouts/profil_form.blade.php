<form
    action="@if ($profil == null) {{ route('dashboard.profil.create') }}@else {{ route('dashboard.profil.update', ['id' => $profil->id]) }} @endif"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid lg:grid-cols-4 grid-cols-1 gap-6">
        <div class="col-span-1 flex flex-col gap-6">
            <div class="card p-6">

                <div class="flex justify-between items-center mb-4">
                    <h4 class="card-title">Logo</h4>
                    {{-- <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                    <i class="mgc_add_line"></i>
                </div> --}}
                </div>
                {{-- <div class="block lg:hidden text-danger">
                    Choisissez une photo, n'utilisez pas l'appareil photo du support
                </div> --}}

                <div class="flex items-center justify-center text-gray-700 dark:text-gray-300 ">
                    <div class="flex flex-col mt-5">

                        @if ($profil != null)
                            <div class="mb-5">
                                <div class="mb-3">Logo actuel</div>
                                <div class="w-full flex justify-center">
                                    <img src="{{ Storage::url($profil->logo) }}" alt="logo" class="w-1/2 lg:w-full mx-auto">
                                </div>
                                <div class="mb-3">Changer le logo</div>
                                <input name="logo" class="dropify" type="file" accept="image/*" />

                                {{-- <div class="file-custom-input" style="margin-top: 25px">
                                    <input type="file" id="file-custom" onchange="showFileName()" name="logo" accept=".jpg,.jpeg,.png" >
                                    <button type="button" onclick="document.getElementById('file-custom').click();" class="rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">Changer le logo</button>
                                    <span id="file-custom-name"></span>
                                </div> --}}
                            </div>

                            {{-- <input name="logo" class="" type="file" /> --}}
                        @else
                            <div class="card mb-5">
                                <div class="card-body justify-content-center">
                                    <input name="logo" class="dropify" type="file" accept="image/*"  />
                                    {{-- <input name="logo" class="dropify" type="file" data-default-file="@if ($profil != null){{ }}@endif" /> --}}
                                </div>
                            </div>
                        @endif



                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">Informations de profil</p>

                </div>
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
                <div class="flex flex-col gap-3">
                    <div class="">
                        <label for="project-name" class="mb-2 block">Nom</label>
                        <input type="text" id="project-name" class="form-input"
                            placeholder="Entrer le nom du bar ou restaurant" aria-describedby="input-helper-text"
                            name="name" value="@if ($profil != null) {{ $profil->name }} @endif">
                    </div>

                    <div class="">
                        <label for="project-description" class="mb-2 block">Description <span
                                class="text-red-500">*</span></label>
                        <textarea id="project-description" class="form-input" rows="8" name="description">
@if ($profil != null)
{{ $profil->description }}
@endif
</textarea>
                    </div>
                    <div>
                        <label for="select-label" class="mb-2 block">Type</label>
                        <select id="select-label" class="form-select" name="type">
                            <option selected>
                                @if ($profil != null)
                                    {{ $profil->type }}
                                @else
                                    Sélectionner le type
                                @endif
                            </option>
                            <option value="Bar">Bar</option>
                            <option value="Restaurant">Restaurant</option>
                        </select>
                    </div>

                    <div>
                        <label for="address" class="mb-2 block">Adresse</label>
                        <input type="text" id="address" class="form-input"
                            placeholder="Ex: Rue,Ville,Département,Pays" name="address"
                            value="@if ($profil != null) {{ $profil->address }} @endif">
                    </div>
                    <div class="lg:col-span-4 mt-5">
                        <div class="flex justify-end gap-3">

                            <button type="submit"
                                class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </div>

            </div>
</form>
@if ($profil != null)
    @include('dashboard.pages.profil.layouts.profil_images')
@endif
</div>
</div>

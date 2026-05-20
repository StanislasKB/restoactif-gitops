

<button class="btn bg-success text-white" data-fc-target="update_plat-modal-{{$plat->id}}" data-fc-type="modal" type="button">
    Modifier
</button>


    <div id="update_plat-modal-{{$plat->id}}" class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
        <div class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
            <form action="{{route('dashboard.event.image.edit',['id'=>$plat->id])}}" method="post" >
                @csrf
            <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                    Modifier ce plat
                </h3>
                <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                        data-fc-dismiss type="button">
                    <span class="mgc_close_fill">close</span>
                </button>
            </div>
            <div class="px-4 py-8 overflow-y-auto">
                <div class="mb-5">
                    <label for="title" class="mb-2 block">Nom du plat</label>
                    <input type="text" id="name" name="name" value="{{ $plat->name}}" class="form-input" placeholder="Entrer Title" aria-describedby="input-helper-text" required>
                </div>
                <div class="mb-5">
                    <label for="price" class="mb-2 block">Prix du plat</label>
                    <input type="text" id="price" name="price" value="{{ $plat->price}}" class="form-input" placeholder="Entrer le prix du menu" aria-describedby="input-helper-text" required>
                </div>
                <div class="mb-5">
                    <label for="description" class="mb-2 block">Description du plat <span class="text-red-500">*</span></label>
                    <textarea name="description" class="form-input">{{ $plat->description}}</textarea>
                </div>
            </div>
            <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">Annuler</button>
                <button type="submit" class="btn bg-primary text-white" href="javascript:void(0)">Modifier</button>
            </div>
        </form>
        </div>
    </div>




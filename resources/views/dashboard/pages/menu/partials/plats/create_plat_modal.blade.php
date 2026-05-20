<button class="btn bg-primary text-white" data-fc-target="#add_dish_modal" data-fc-type="modal" type="button">
    Ajouter nouveau
</button>


    <div id="add_dish_modal" class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
        <div class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
            <form action="" method="post" id="createDishForm"  enctype="multipart/form-data" >
             @csrf
                <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                    Nouveau plat du menu
                </h3>
                <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                        data-fc-dismiss type="button">
                    <span class="mgc_close_fill"></span>
                </button>
            </div>
            <div class="px-4 py-8 overflow-y-auto flex flex-col gap-3">
                <div class="mb-5">
                    <label for="title" class="mb-2 block">Nom du plat<span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{old('name')}}" class="form-input" placeholder="Entrez le nom" aria-describedby="input-helper-text" required>
                </div>
                <div class="mb-5">
                    <label for="price" class="mb-2 block">Prix du plat<span class="text-red-500">*</span></label>
                    <input type="text" id="price" name="price" value="{{old('price')}}" class="form-input" placeholder="Entrez le prix du plat" aria-describedby="input-helper-text" required>
                </div>
                <div class="mb-5">
                    <label for="description" class="mb-2 block">Description du plat <span class="text-red-500">*</span></label>
                    <textarea name="description" class="form-input">{{old('description')}}</textarea>
                </div>

            </div>
            <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">Annuler</button>
                <button type="submit" class="btn bg-primary text-white" >Ajouter</button>
            </div>
        </form>
        </div>
    </div>




<button class="btn bg-primary text-white" data-fc-target="delete_image-modal-{{$image->id}}" data-fc-type="modal" type="button">
    Supprimer
</button>


    <div id="delete_image-modal-{{$image->id}}" class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
        <div class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
            <form action="{{ route('dashboard.offer.image.delete',['id'=>$image->id] ) }}" method="POST" >
                @csrf
                @method('DELETE')
            <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                    Suprimer
                </h3>
                <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                        data-fc-dismiss type="button">
                    <span class="material-symbols-rounded"></span>
                </button>
            </div>
            <div class="px-4 py-8 overflow-y-auto">
                <p class=" text-center" > Êtes vous sur de vouloir supprimer cette image</p>
            </div>
            <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">Annuler</button>
                <form action="{{ route('dashboard.offer.image.delete',['id'=>$image->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">
                        Supprimer
                    </button>
                </form>
            </div>
        </form>
        </div>
    </div>


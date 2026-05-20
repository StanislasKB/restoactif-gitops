<div class="card">
    <div class="card-header">
        <div class="flex justify-between items-center">
           <h5 class="card-title"> </h5>
            <button data-fc-type="dropdown" type="button"
    class=" bg-green-600 text-white py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium  shadow-sm align-middle hover:bg-green-500  transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
    Actions <i class="mgc_down_line text-lg"></i>
</button>

<div
    class="hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700">
    <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
        href="{{ route('dashboard.update_offers.view',['id'=>$offre->id]) }}">
        Modifier
    </a>
    <a class="flex items-center py-2 px-3 rounded-md text-sm text-red-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
        href="{{ route('dashboard.offers.delete',['id'=>$offre->id]) }}">
        Supprimer
    </a>
</div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="py-3 px-6">
            <h3 class="my-2 text-slate-900 dark:text-slate-200">{{ $offre->title }}</h3>
            <p class="text-gray-500 text-sm mb-9">
                {{ strip_tags(substr($offre->description, 0, 200)) }}...
            </p>

             {{-- images for events --}}


                    <!-- Swiper -->
                    <div class="swiper navigation-swiper rounded">
                        <div class="swiper-wrapper">
                            @foreach ($offre->offer_images()->get() as $img )
                            <div class="swiper-slide">
                                <img src="{{ Storage::url($img->file_url) }}" alt="offre image">
                            </div>
                            @endforeach

                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>


                <!-- end card -->

             {{-- end image for events  --}}


        </div>

        <div class="border-t p-5 border-gray-300 dark:border-gray-700">
            <div class="grid lg:grid-cols-2 gap-4">
                <div class="flex -space-x-2 justify-between gap-2">
                    @php
                        $startDate=new \Carbon\Carbon($offre->start_date);
                        $endDate=new \Carbon\Carbon($offre->end_date);
                    @endphp
                    <span class="text-sm">

                        @if($startDate->isSameDay($endDate))
                        <div><i class="mgc_calendar_line text-lg me-2"></i><span class="align-text-bottom">{{ $startDate->format('d-m-Y H:i') }}</span></div>
                        @else
                        <div><i class="mgc_calendar_line text-lg me-2"></i><span class="align-text-bottom">du {{ $startDate->format('d-m-Y H:i') }}</span></div>
                        <div><i class="mgc_calendar_line text-lg me-2"></i><span class="align-text-bottom">au {{ $endDate->format('d-m-Y H:i') }}</span></div>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

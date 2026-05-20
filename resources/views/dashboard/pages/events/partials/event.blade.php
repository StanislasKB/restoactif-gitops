<div class="card">
    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="card-title"> {{$event->type}} </h5>
        <button data-fc-type="dropdown" type="button"
    class=" bg-green-600 text-white py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium  shadow-sm align-middle hover:bg-green-500  transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
    <i class="mgc_more_1_fill text-xl"></i>
</button>

<div
    class="hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700">
    <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
        href="{{route('dashboard.event.edit',['id'=>$event->id])}}">
        Modifier
    </a>
    <a class="flex items-center py-2 px-3 rounded-md text-sm text-red-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
        href="{{route('dashboard.event.delete',['id'=>$event->id])}}">
        Supprimer
    </a>
</div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="py-3 px-6">
            <h5 class="my-2"><a href="apps-project-detail.html" class="text-slate-900 dark:text-slate-200">{{$event->title}} </a></h5>
            <p class="text-gray-500 text-sm mb-9">
                {{ strip_tags(substr($event->description, 0, 200)) }}...
            </p>

             {{-- images for events --}}


                    <!-- Swiper -->
                    <div class="swiper navigation-swiper rounded">
                        <div class="swiper-wrapper">
                            @foreach ($event->images()->get() as $image )
                            <div class="swiper-slide">
                                <img src="{{Storage::url($image->file_url)}}" alt="event image" >
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
            <div class="">
                <div class="flex items-center gap-2">
                    <a href="#" class="text-sm">
                        <i class="mgc_calendar_line text-lg me-2"></i>
                    </a>
                    @php
                        $startDate=new \Carbon\Carbon($event->start_date);
                        $endDate=new \Carbon\Carbon($event->end_date);
                    @endphp
                    <div class="flex items-center justify-between gap-2">
                        @if($startDate->isSameDay($endDate))
                        <span class="align-text-bottom">{{ $startDate->format('d-m-Y H:i') }}</span>
                         @else
                         <span class="align-text-bottom">{{ $startDate->format('d-m-Y H:i') }}</span>
                         <span class="align-text-bottom">{{ $endDate->format('d-m-Y H:i') }}</span>
                         @endif

                    </div>

                </div>
                <div class="flex items-center gap-2">
                    <a href="#" class="text-sm">
                        <i class="mgc_location_2_line text-lg me-2"></i>
                    </a>
                    <span class="align-text-bottom">{{$event->address}}</span>
                </div>

            </div>
        </div>
    </div>
</div>

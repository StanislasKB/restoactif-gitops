<div class="grid 2xl:grid-cols-4 gap-6 mb-6">
     @php
         $events=\App\Models\Event::where('user_id',auth()->user()->id);
         $menus=\App\Models\Menu::where('user_id',auth()->user()->id);
         $offers=\App\Models\Offer::where('user_id',auth()->user()->id);
         $dishs=\App\Models\Dish::where('user_id',auth()->user()->id);

         $lastEvent = \App\Models\Event::where('user_id', auth()->user()->id)->latest()->first();
        $lastMenu = \App\Models\Menu::where('user_id', auth()->user()->id)->latest()->first();
        $lastOffer = \App\Models\Offer::where('user_id', auth()->user()->id)->latest()->first();
        $lastDish = \App\Models\Dish::where('user_id', auth()->user()->id)->latest()->first();
     @endphp
    <div class="2xl:col-span-4">
        <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6 mb-6">
            <div class="card">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-base mb-1 text-gray-600 dark:text-gray-400">Evènements</h4>
                            {{-- <p class="font-normal text-sm text-gray-400 truncate dark:text-gray-500">New Task Assign</p> --}}
                        </div>


                    </div>

                    <div class="flex items-end">
                        <div class="flex-grow">
                            @if ($lastEvent)
                            <p class="text-[13px] text-gray-400 dark:text-gray-500 font-semibold"><i class="mgc_alarm_2_line"></i> {{\Carbon\Carbon::parse($lastEvent->created_at)->format('M Y') }}</p>
                            @endif

                        </div>

                        <div>
                            <h2 class="h2 text-xl ">
                                {{$events->count()}}
                            </h2>
                        </div>

                    </div>
                </div>
            </div>

            {{-- menus  --}}

            <div class="card">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-base mb-1 text-gray-600 dark:text-gray-400">Menus</h4>
                            {{-- <p class="font-normal text-sm text-gray-400 truncate dark:text-gray-500">New Task Assign</p> --}}
                        </div>


                    </div>

                    <div class="flex items-end">
                        <div class="flex-grow">
                            @if ($lastMenu)
                            <p class="text-[13px] text-gray-400 dark:text-gray-500 font-semibold"><i class="mgc_alarm_2_line"></i> {{\Carbon\Carbon::parse($lastMenu->created_at)->format('M Y') }}</p>
                            @endif

                        </div>

                        <div>
                            <h2 class="h2 text-xl ">
                                {{$menus->count()}}
                            </h2>
                        </div>

                    </div>
                </div>
            </div>

            {{-- offers  --}}

            <div class="card">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-base mb-1 text-gray-600 dark:text-gray-400">Offres</h4>
                            {{-- <p class="font-normal text-sm text-gray-400 truncate dark:text-gray-500">New Task Assign</p> --}}
                        </div>


                    </div>

                    <div class="flex items-end">
                        <div class="flex-grow">
                            @if ($lastOffer)
                            <p class="text-[13px] text-gray-400 dark:text-gray-500 font-semibold"><i class="mgc_alarm_2_line"></i> {{\Carbon\Carbon::parse($lastOffer->created_at)->format('M Y') }}</p>
                            @endif

                        </div>

                        <div>
                            <h2 class="h2 text-xl ">
                                {{$offers->count()}}
                            </h2>
                        </div>

                    </div>
                </div>
            </div>

            {{-- plats  --}}
            <div class="card">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-base mb-1 text-gray-600 dark:text-gray-400">Plats</h4>
                            {{-- <p class="font-normal text-sm text-gray-400 truncate dark:text-gray-500">New Task Assign</p> --}}
                        </div>


                    </div>

                    <div class="flex items-end">
                        <div class="flex-grow">
                            @if ($lastDish)
                            <p class="text-[13px] text-gray-400 dark:text-gray-500 font-semibold"><i class="mgc_alarm_2_line"></i> {{\Carbon\Carbon::parse($lastDish->created_at)->format('M Y') }}</p>
                            @endif

                        </div>

                        <div>
                            <h2 class="h2 text-xl ">
                                {{$dishs->count()}}
                            </h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

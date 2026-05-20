<div class="card mt-24 ">
    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="card-title"> Images</h5>
            @include('dashboard.pages.events.partials.images.add_image_modal')


        </div>
    </div>
    <div class="flex flex-col p-6">
        {{-- une image  --}}

            @foreach ($event->images()->get() as $image )
            <div class="flex flex-col sm:flex-row justify-between gap-8 mb-10">
                <div>
                    <a href="{{ Storage::url($image->file_url) }}" class="image-popup">
                        <img src="{{ Storage::url($image->file_url) }}" alt="work-thumbnail" class="rounded-lg w-full sm:w-52 h-52 object-cover">
                    </a>
                </div>
                <div class="flex gap-4 mt-7 sm:mt-0">
                    <div>
                        @include('dashboard.pages.events.partials.images.update_image_modal')
                        @include('dashboard.pages.events.partials.images.delete_image_modal')
                    </div>
                </div>
            </div>

        @endforeach

    </div>
</div>

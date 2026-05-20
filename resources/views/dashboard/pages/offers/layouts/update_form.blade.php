<div class="flex justify-between items-center mb-6">
    <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Offres</h4>

    <div class="md:flex hidden items-center gap-2.5 text-sm font-semibold">
        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard.index.view') }}" class="text-sm font-medium text-slate-700 dark:text-slate-400">Restoactif</a>
        </div>

        <div class="flex items-center gap-2">
            <i class="mgc_right_line text-lg flex-shrink-0 text-slate-400 rtl:rotate-180"></i>
            <a  class="text-sm font-medium text-slate-700 dark:text-slate-400">Fonctionnalités</a>
        </div>

        <div class="flex items-center gap-2">
            <i class="mgc_right_line text-lg flex-shrink-0 text-slate-400 rtl:rotate-180"></i>
            <a  class="text-sm font-medium text-slate-700 dark:text-slate-400" aria-current="page">Modifier</a>
        </div>
    </div>
</div>
<form action="{{ route('dashboard.update_offers.update',['id'=>$offre->id]) }}" method="post" enctype="multipart/form-data">
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
                    <p class="card-title">Modification de l'offre</p>
                    <div
                        class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                        <i class="mgc_transfer_line"></i>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="mb-5">
                        <label for="title" class="mb-2 block">Titre de l'offre<span
                            class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ $offre->title }}"
                            class="form-input" placeholder="Entrez le titre" aria-describedby="input-helper-text">
                    </div>
                    <div class="mb-5">
                        <label for="description" class="mb-2 block">Description de l'offre <span
                                class="text-red-500">*</span></label>
                        <textarea name="description" class="hidden" id="snow-hidden-textarea">{{ $offre->description }}</textarea>
                        <div id="snow-editor" style="height: 300px;">{!! $offre->description !!}</div>
                    </div>
                    @php
                        $startDate=new \Carbon\Carbon($offre->start_date);
                        $endDate=new \Carbon\Carbon($offre->end_date);
                    @endphp
                    <div class="grid md:grid-cols-2 gap-3 mb-5">
                        <div class="">
                            <label for="start_date" class="mb-2 block">Date de debut <span
                                class="text-red-500">*</span></label>
                            <input type="date" id="start_date" name="start_date" class="form-input" value="{{ $startDate->format('Y-m-d') }}">
                        </div>

                        <div class="">
                            <label for="end_date" class="mb-2 block">Date de fin <span
                                class="text-red-500">*</span></label>
                            <input type="date" id="end_date" name="end_date" class="form-input" value="{{ $endDate->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="lg:col-span-4 mt-5">
                        <div class="flex justify-end gap-3">
                            <button type="submit"
                                class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                                Modifier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

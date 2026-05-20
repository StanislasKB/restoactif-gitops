<div class="py-1 px-4">
    <nav class="flex items-center space-x-2">
        @if ($paginator->onFirstPage())
            <span class="text-gray-400 hover:text-primary p-4 inline-flex items-center gap-2 font-medium rounded-md">
                <span aria-hidden="true">«</span>
                <span class="sr-only">Précedent</span>
            </span>
        @else
            <span class="text-gray-400 hover:text-primary p-4 inline-flex items-center gap-2 font-medium rounded-md"
                href="{{ $paginator->previousPageUrl() }}">
                <span aria-hidden="true">«</span>
                <span class="sr-only">Précedent</span>
                </a>
        @endif

        @php
            $start = max(1, $paginator->currentPage() - 1);
            $end = min($start + 2, $paginator->lastPage());
            $start = max(1, $end - 2);
        @endphp
        @foreach ($paginator->getUrlRange($start, $end) as $page => $url)
            @if ($page == $paginator->currentPage())
                <a class="w-10 h-10 bg-primary text-white p-4 inline-flex items-center text-sm font-medium rounded-full"
                    href="#" aria-current="page">{{ $page }}</a>
            @else
                <a class="w-10 h-10 text-gray-400 hover:text-primary p-4 inline-flex items-center text-sm font-medium rounded-full"
                    href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <a class="text-gray-400 hover:text-primary p-4 inline-flex items-center gap-2 font-medium rounded-md"
                href="{{ $paginator->nextPageUrl() }}">
                <span class="sr-only">Suivant</span>
                <span aria-hidden="true">»</span>
            </a>
        @else
            <span class="text-gray-400 hover:text-primary p-4 inline-flex items-center gap-2 font-medium rounded-md">
                <span class="sr-only">Suivant</span>
                <span aria-hidden="true">»</span>
            </span>
        @endif

    </nav>
</div>

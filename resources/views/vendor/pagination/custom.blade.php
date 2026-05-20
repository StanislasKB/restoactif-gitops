<!-- resources/views/components/pagination.blade.php -->
<div class="pagination_fg">
    @if ($paginator->onFirstPage())
        <span>&laquo;</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
    @endif

    @php
    $start = max(1, $paginator->currentPage() - 1);
    $end = min($start + 2, $paginator->lastPage());
    $start = max(1, $end - 2);
@endphp
    @foreach ($paginator->getUrlRange($start, $end) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a href="#" class="active">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
    @else
        <span>&raquo;</span>
    @endif
</div>

@if($paginator->hasPages())
    <nav class="pager" aria-label="التنقل بين الصفحات">
        @if($paginator->onFirstPage())
            <span class="pager-off">→ السابق</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">→ السابق</a>
        @endif

        <span class="pager-info">صفحة {{ $paginator->currentPage() }} من {{ $paginator->lastPage() }}</span>

        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">التالي ←</a>
        @else
            <span class="pager-off">التالي ←</span>
        @endif
    </nav>
@endif

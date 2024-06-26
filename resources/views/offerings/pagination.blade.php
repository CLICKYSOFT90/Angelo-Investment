@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="font-unset" href="#" tabindex="-1">
                        <i class="fa-solid fa-chevron-left"></i>
                        <i class="fa-solid fa-chevron-left chev-adjust"></i>
                        <i class="fa-solid fa-chevron-left chev-adjust"></i>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link font-unset" href="{{ $paginator->previousPageUrl() }}">
                        <i class="fa-solid fa-chevron-left"></i>
                        <i class="fa-solid fa-chevron-left chev-adjust"></i>
                        <i class="fa-solid fa-chevron-left chev-adjust"></i>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">{{ $element }}</li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item right-chev chev-right-margin">
                    <a class="font-unset" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fa-solid fa-chevron-left rt-right"></i>
                        <i class="fa-solid fa-chevron-left chev-adjust rt-right"></i>
                        <i class="fa-solid fa-chevron-left chev-adjust rt-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled chev-right-margin">
                    <a class="page-link font-unset" href="#">
                        <i class="fa-solid fa-chevron-left rt-right"></i>
                        <i class="fa-solid fa-chevron-left chev-adjust rt-right"></i>
                        <i class="fa-solid fa-chevron-left chev-adjust rt-right"></i>
                    </a>
                </li>
            @endif
        </ul>
@endif

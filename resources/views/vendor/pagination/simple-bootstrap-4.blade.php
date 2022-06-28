@if ($paginator->hasPages())
    <nav id="pagination" class="w-100">
        <ul class="pagination mt-3 mb-0 pr-md-2 pr-xl-3 justify-content-end">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">
                        <i data-feather="chevron-left" class="icon_direction"></i>
                    </span>
                </li>
            @else
                <li class="page-item toolt bottom">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i data-feather="chevron-left" class="icon_direction"></i>
                    </a>
                    <span class="tiptext">Anterior</span>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item toolt bottom">
                    <a class="page-link ml-1" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i data-feather="chevron-right" class="icon_direction"></i>
                    </a>
                    <span class="tiptext">Siguiente</span>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link ml-1">
                        <i data-feather="chevron-right" class="icon_direction"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center flex-wrap gap-2">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link rounded-pill px-4 py-2 text-muted border-0"
                          style="background-color: #f0f0f0; transition: all 0.3s;">
                        &laquo;
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link rounded-pill px-4 py-2 text-white border-0 shadow-sm"
                       href="{{ $paginator->previousPageUrl() }}"
                       style="background: linear-gradient(45deg, #c084fc, #f472b6); transition: all 0.3s; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"
                       onmouseover="this.style.transform='scale(1.08)';"
                       onmouseout="this.style.transform='scale(1)';">
                        &laquo;
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Dots --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link rounded-pill px-4 py-2 text-muted border-0"
                              style="background-color: #f0f0f0;">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Page Numbers --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link rounded-pill px-4 py-2 text-white border-0 shadow"
                                      style="background: linear-gradient(45deg, #a855f7, #ec4899); transform: scale(1.05); box-shadow: 0 4px 10px rgba(0,0,0,0.2); transition: all 0.3s;">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-pill px-4 py-2 text-white border-0 shadow-sm"
                                   href="{{ $url }}"
                                   style="background: linear-gradient(45deg, #c084fc, #f472b6); transition: all 0.3s; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
                                   onmouseover="this.style.transform='scale(1.08)';"
                                   onmouseout="this.style.transform='scale(1)';">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link rounded-pill px-4 py-2 text-white border-0 shadow-sm"
                       href="{{ $paginator->nextPageUrl() }}"
                       style="background: linear-gradient(45deg, #c084fc, #f472b6); transition: all 0.3s; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"
                       onmouseover="this.style.transform='scale(1.08)';"
                       onmouseout="this.style.transform='scale(1)';">
                        &raquo;
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link rounded-pill px-4 py-2 text-muted border-0"
                          style="background-color: #f0f0f0; transition: all 0.3s;">
                        &raquo;
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif

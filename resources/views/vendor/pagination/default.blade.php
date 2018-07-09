@if ($paginator->hasPages())
        <div class="ui right floated pagination menu">
    {{-- <ul class="pagination"> --}}
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
                <a class="icon item disabled">
                  <i class="left chevron icon"></i>
                </a>
            {{-- <li class="disabled"><span>&laquo;</span></li> --}}
        @else
            <a class="icon item" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="left chevron icon"></i></a>
            {{-- <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li> --}}
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="item disabled">{{ $element }}</a>
                {{-- <li class="disabled"><span>{{ $element }}</span></li> --}}
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="item active">{{ $page }}</a>
                        {{-- <li class="active"><span>{{ $page }}</span></li> --}}
                    @else
                        <a class="item" href="{{ $url }}">{{ $page }}</a>
                        {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="icon item" href="{{ $paginator->nextPageUrl() }}"><i class="right chevron icon"></i></a>
            {{-- <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li> --}}
        @else
            <a class="icon item disabled"><i class="right chevron icon"></i></a>
            {{-- <li class="disabled"><span>&raquo;</span></li> --}}
        @endif
    </ul>
@endif

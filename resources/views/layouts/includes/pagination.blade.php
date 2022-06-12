{{--generate laravel pagination--}}


@if ($paginator->hasPages())    {{--if there are more than one page--}}
<div class="row">
    <div class="col-md-12">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)

            @if (is_array($element))
                @foreach ($element as $page => $url)
               <li class="page-item"><a class="page-link" href="{{$url}}">{{$page}}</a></li>
                @endforeach
            @endif
        @endforeach


        @if($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
                    </li>
        @else
            <li class="text-hide"><span>&raquo;</span></li>
        @endif
    </ul>
    </nav>
    </div>
</div>
@endif




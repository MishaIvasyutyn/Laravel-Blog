<header class="market-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{route('home')}}"><img
                    src="/assets/front/images/version/market-logo.png" alt=""></a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Home</a>
                    </li>
                    @if($categories->count())
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('category.show', $category->slug)}}">{{$category->name}}</a>
                            </li>
                        @endforeach
                        @endif
                </ul>

                <form class="form-inline" method="get" action="{{route('search')}}">
                        <input name="search" class="form-control mr-sm-2" @error('search') style="border: solid 2px #f44336 ;border-radius: 9px" @enderror type="text" placeholder="Search"
                               required>
                    <button class="btn btn-outline-success my-2 my-sm-0" style="cursor: pointer" type="submit">Search</button>
                </form>

            </div>
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->

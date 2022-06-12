@extends('layouts.categories_layout')
@section('title','Markedia - Marketing Blog Template- Search')
@section('page-title')
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2>Search: {{$search}}</h2>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Search</li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="blog-custom-build">
            @if($posts->count())
                @foreach($posts as $post)
                <div class="blog-box wow fadeIn">
                    <div class="post-media">
                        <a href="{{route('post.show',['slug'=>$post->slug])}}" title="">
                            <img src="{{$post->getImage()}}" alt="" class="img-fluid">
                            <div class="hovereffect">
                                <span></span>
                            </div>
                            <!-- end hover -->
                        </a>
                    </div>
                    <!-- end media -->
                    <div class="blog-meta big-meta text-center">
                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i
                                            class="fa fa-facebook"></i> <span
                                            class="down-mobile">Share on Facebook</span></a>
                                </li>
                                <li><a href="#" class="tw-button btn btn-primary"><i
                                            class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a>
                                </li>
                                <li><a href="#" class="gp-button btn btn-primary"><i
                                            class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div><!-- end post-sharing -->
                        <h4><a href="{{route('post.show',['slug'=>$post->slug])}}"
                               title="{{$post->title}}">{{$post->title}}</a></h4>
                        <p>{{$post->description}}</p>
                        @if($post->category)
                            <small><a href="{{ $post->category ?  route('category.show',['slug'=>$post->category->slug]) : '#None'}}"
                                  title="">{{$post->category->name ?? 'None'}}</a></small>
                        @endif
                        <small>{{$post->getPostDate()}}</small>
                        <small><i class="fa fa-eye"></i> {{$post->views}}</small>
                    </div><!-- end meta -->
                </div><!-- end blog-box -->

                <hr class="invis">
            @endforeach
                @else
                    <h4>No results found</h4>
            @endif
        </div>
    </div>

    <hr class="invis">

                {{$posts->appends(['search'=>request()->search])->links('layouts.includes.pagination')}}


@endsection

@extends('admin.layouts.app')
@section('title')
    @parent Post-edit {{ $post->title }}
@endsection
<script src="https://cdn.tailwindcss.com"></script>
<link
    href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css"
    rel="stylesheet"
/>
@section('content')

    @if ($errors->has('thumbnail'))
        <div
            class="p-3  mt-4 mb-4 font-semibold leading-tight text-red-700 bg-red-100 rounded-lg dark:text-red-100 dark:bg-red-700">
            <span class="font-medium">{{$errors->first('thumbnail')}}</span>
        </div>
    @endif

    <div class="container px-6 mx-auto grid">
        <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Edit Post {{ $post->title }}
        </h2>
        <div
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
        >
            <form action="{{route('admin.posts.update', ['post'=>$post->id] )}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Helper text -->
                <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Enter post name
                </span>
                    <input
                        class="mt-6 block w-full mt-1 text-sm @error('title') border-red-600 @else dark:border-gray-600 @enderror   dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input mb-2"
                        placeholder="Post title" name="title" value="{{ old('title') ?? $post->title}}"
                    />
                    @error('title')
                    <span class="mt-8 text-xs text-red-600 dark:text-red-400">
                        {{$message}}
                     </span>
                    @enderror
                </label>
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Content</span>
                    <textarea id="content"
                        class="block w-full mt-1 text-sm  @error('content') border-red-600 @else dark:border-gray-600 @enderror dark:text-gray-300 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray mb-2"
                        rows="6" placeholder="Content..."
                        name="content">{{ old('content') ?? $post->content}}</textarea>
                    @error('content')
                    <span class="mt-8 text-xs text-red-600 dark:text-red-400">
                        {{$message}}
                     </span>
                    @enderror
                </label>
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Description</span>
                    <textarea
                        class="block w-full mt-1 text-sm  @error('description') border-red-600 @else dark:border-gray-600 @enderror dark:text-gray-300 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray mb-2"
                        rows="4" placeholder="Description..."
                        name="description">{{ old('description') ?? $post->description}}</textarea>
                    @error('description')
                    <span class="mt-8 text-xs text-red-600 dark:text-red-400">
                        {{$message}}
                     </span>
                    @enderror
                </label>
                <label for="categories" class="block mb-2 mt-4 text-sm font-medium text-gray-900 dark:text-gray-400">Select
                    your category</label>
                @if(count($categories))
                    <select id="categories"
                            class="block mb-4  px-4 py-2 mt-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600  focus:outline-none focus:shadow-outline-blue"
                            name="category_id">
                        @foreach($categories as $key => $category)
                            <option
                                value="{{$key}}" @selected($key==old('category_id') xor $key==$post->category_id )>{{$category}}</option>
                        @endforeach
                    </select>
                @else
                    <div
                        class="p-2 mb-4  text-gray-500 dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        No categories available... To create a category <a href="{{route('admin.categories.create')}}"
                                                                           class="text-purple-600">click here</a>
                    </div>
                @endif
                <div class="w-1/3">
                    <label for="select-tags"
                           class="block mb-2 mt-4 text-sm font-medium text-gray-900 dark:text-gray-400">Select
                        your tag</label>
                    @if(count($tags))
                        <div class="relative flex w-full">
                            <select
                                id="select-tags"
                                name="tags[]"
                                placeholder="Select tags..."
                                autocomplete="off"
                                class="mt-2 mb-4 block w-full rounded-sm cursor-pointer focus:outline-none"
                                multiple
                            >
                                @foreach($tags as $key => $tag)
                                    <option
                                        value="{{$key}}" @selected($post->tags->contains('id', $key))>{{$tag}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
                <script>
                    new TomSelect('#select-tags', {
                        maxItems: 3,
                    });
                </script>
                @else
                    <div
                        class="p-2 mb-4  text-gray-500 dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        No tags available... To create a tag <a href="{{route('admin.tags.create')}}" class="text-purple-600">click
                            here</a>
                    </div>
                @endif
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="user_avatar">Upload
                    file</label>
                <input
                    class="block  rounded-br-lg  p-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="user_avatar_help" id="user_avatar" name="thumbnail" type="file">
                <div
                    class="w-1/3 mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <img class="rounded-t-lg" src="{{$post->getImage()}}" alt=""></div>
                <button type="submit"
                        class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                    Update
                </button>
            </form>
        </div>
    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#user_avatar').on('change', function () {
            var fileName = $(this).val().split('\\').pop();
            $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endsection



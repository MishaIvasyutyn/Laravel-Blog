@extends('admin.layouts.app')
@section('title')
    @parent Category-create
@endsection
@section('content')
    <div class="container px-6 mx-auto grid">
        <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Create category
        </h2>
        <div
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
        >
            <form action="{{route('admin.categories.store')}}" method="post">
                @csrf
                <!-- Helper text -->
                <label class="block mt-4 text-sm">
                <span class=" text-gray-700 dark:text-gray-400">
                 Enter category name
                </span>
                    <input
                        class="mt-6 block w-full mt-1 text-sm @error('name') border-red-600 @else dark:border-gray-600 @enderror   dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                        placeholder="Name of the category" name="name" value="{{old('name')}}"
                    />
                    @error('name')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{$message}}
                     </span>
                    @enderror
                </label>
                <button type="submit"
                        class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                    Create
                </button>
            </form>
        </div>
    </div>

@endsection

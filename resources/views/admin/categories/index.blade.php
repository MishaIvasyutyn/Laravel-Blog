@extends('admin.layouts.app')
@section('title')
    @parent Categories
@endsection
@section('content')
    <div class="flex flex-col flex-1 w-full">
        @if (session('error'))
            <div
                class="p-3  mt-4 mb-4 font-semibold leading-tight text-red-700 bg-red-100 rounded-lg dark:text-red-100 dark:bg-red-700">
                <span class="font-medium">{{session('error')}}</span>
            </div>
        @endif
        <main class="h-full pb-16 overflow-y-auto">
            <div class="container grid px-6 mx-auto">
                <h2
                        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
                >
                    Categories
                </h2>
                <div class="px-6 my-6 w-64">
                    <a href="{{ route('admin.categories.create') }}"
                       class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    >
                        Create category
                        <span class="ml-2" aria-hidden="true">+</span>
                    </a>
                </div>
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        @if(count($categories))
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                                >
                                    <th class="px-4 py-3">№</th>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Slug</th>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                                </thead>
                                <tbody
                                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                                >@foreach($categories as $category)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm">
                                            {{$category->id}}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{$category->name}}
                                        </td>
                                        <td class="px-4 py-3 text-xs">
                        <span
                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                        >
                            {{$category->slug}}
                        </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{$category->created_at}}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <a href="{{route('admin.categories.edit',['category'=>$category->id])}}"
                                                   class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                   aria-label="Edit"
                                                >
                                                    <svg
                                                            class="w-5 h-5"
                                                            aria-hidden="true"
                                                            fill="currentColor"
                                                            viewBox="0 0 20 20"
                                                    >
                                                        <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                                        ></path>
                                                    </svg>
                                                </a>
                                                <form
                                                        action="{{route('admin.categories.destroy', ['category'=>$category->id])}}"
                                                        method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure?')"
                                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                            aria-label="Delete"
                                                    >
                                                        <svg
                                                                class="w-5 h-5"
                                                                aria-hidden="true"
                                                                fill="currentColor"
                                                                viewBox="0 0 20 20"
                                                        >
                                                            <path
                                                                    fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd"
                                                            ></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div
                                    class="p-2 mb-8  text-gray-500 dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                No data available...
                            </div>
                        @endif
                    </div>
                    {{$categories->links('admin.layouts.pagination')}}
                </div>
            </div>
        </main>
    </div>
@endsection


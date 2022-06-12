@extends('admin.layouts.app')
@section('title')
    @parent User-edit
@endsection
@section('content')
    <div class="container px-6 mx-auto grid">
        <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Edit user {{ $user->name }}
        </h2>
        <div
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
        >
            <form action="{{route('admin.users.update',['user'=>$user->id])}}" method="post">
                @csrf
                @method('PUT')
                <!-- Helper text -->
                <label class="block mt-4 text-sm">
                <span class=" text-gray-700 dark:text-gray-400">
                 Enter user name
                </span>
                    <input
                        class="mt-6 block w-full mt-1 text-sm @error('name') border-red-600 @else dark:border-gray-600 @enderror   dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                        placeholder="Enter username" name="name" value="{{old('name') ?? $user->name}}"
                    />
                    @error('name')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{$message}}
                     </span>
                    @enderror
                    <label class="block mt-4 text-sm">
                        <span class=" text-gray-700 dark:text-gray-400">
                            Enter password
                        </span>
                        <input
                            class="mt-6 block w-full mt-1 text-sm @error('password') border-red-600 @else dark:border-gray-600 @enderror   dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                            placeholder="Password" name="password" type="password"
                        />
                        @error('password')
                        <span class="text-xs text-red-600 dark:text-red-400">
                            {{$message}}
                         </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                    <span class=" text-gray-700 dark:text-gray-400">
                        Enter email
                    </span>
                        <input
                            class="mt-6 block w-full mt-1 text-sm @error('email') border-red-600 @else dark:border-gray-600 @enderror   dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                            placeholder="Email" name="email" value="{{old('email') ?? $user->email}}"
                        />
                        @error('email')
                        <span class="text-xs text-red-600 dark:text-red-400">
                        {{$message}}
                     </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Is admin?
                    </span>
                        <select name="is_admin" class="mt-4 block w-full mt-1 text-sm @error('is_admin') border-red-600 @else dark:border-gray-600 @enderror   dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input">
                           <option value="0" {{old('is_admin') ?? $user->is_admin ? 'selected' : ''}}>No</option>
                            <option value="1" {{old('is_admin') ?? $user->is_admin ? 'selected' : ''}}>Yes</option>
                        </select>
                        @error('is_admin')
                        <span class="text-xs text-red-600 dark:text-red-400">
                        {{$message}}
                     </span>
                        @enderror
                    </label>
                    <button type="submit"
                            class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    >
                        Update
                    </button>
                </label>
            </form>
        </div>
    </div>

@endsection

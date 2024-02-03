<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
         {{-- font awesome icon --}}
         <link rel="stylesheet" href="{{asset('css/all.min.css')}}">

        <!-- Fonts
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
-->

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])



    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif


            <div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
                <div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 lg:max-w-lg">
                    <div class="mb-4 space-y-3">
                        {{--  <input  class="outline-none shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" placeholder="Name">
                            <h1 class="text-grey-darkest ">Hello</h1> --}}
                        <h1 class="text-grey-darkest font-bold">Todo App</h1>
                        <form class="" method="Post" action="{{ route('create-todo')}}">
                            @csrf
                            <input name="addTodo" class=" outline-none placeholder:text-black placeholder:text-sm shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" placeholder="What do  you need to do?">
                        </form>
                        @if($errors->has('addTodo'))
                            <span class="text-sm text-red-500">{{$errors->first('addTodo')}}</span>
                        @endif
                    </div>
                    <div class="divide-y">
                        <div>
                        @forelse($tasks as $task)
                            <div class="flex items-center gap-x-2">

                                <input type="checkbox" name="addChecked" id="addChecked">
                                <p class="w-full">{{$task->name}}</p>
                                <form action="{{route('delete-todo',['id'=>$task->id])}}" method="post">
                                    @csrf
                                    <button class="flex-no-shrink p-2 ml-2 text-red border-red">X</button>
                                </form>
                            </div>
                        @empty
                            <span class="text-red-500">No Task Yet</span>
                        @endforelse

                        </div>
                        <div class="py-3 flex justify-between items-center gap-x-2">
                            <button class="">Check All</button>
                            <p class=" text-sm">3 items remaning</p>
                        </div>
                        <div class="py-3 flex justify-between items-center gap-x-2 text-sm">
                            <div class="flex items-center gap-x-1">
                                <button class="p-1 px-2 border rounded border-gray-400">All</button>
                                <button class="p-1">Active</button>
                                <button class="p-1">Complete</button>
                            </div>
                            <button class="p-1 px-2 border rounded border-gray-400">Clear completed</button>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </body>
</html>

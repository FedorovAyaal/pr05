<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('image/logo14.png')}}" type="image/png">
    @yield("head")
    <title> @yield('title') </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:focus {
            transition: background-color 600000s 0s, color 600000s 0s;
        }
        input[data-autocompleted] {
            background-color: transparent !important;
        }
    </style>
</head>
<body class="bg-gray-100">
<header class="w-full bg-red-500">


    <div class="container mx-auto w-4/5 px-5 ">
        <div class="flex items-center justify-between flex-wrap py-6">

            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <img src="{{asset('image/logo14.png')}}" class="p-0 m-0 mr-3" alt="">
              <span class="font-semibold text-xl tracking-wide"><a href="{{route('home')}}">News Sakha<a></span>
            </div>
            <div class="block lg:hidden">
              <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white" id="menu-target">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
              </button>
            </div>
            <div class="w-full hidden flex-grow lg:flex lg:items-center lg:w-auto" id="menu">
              <div class="text-lg lg:flex-grow">

                @foreach($all_categories as $category)
                <a href="{{route('post.by_category',$category->id)}}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-100 hover:underline hover:underline-offset-4 hover:text-white mr-4">
                  {{$category->name}}
                </a>
                @endforeach
              </div>
              <div>

                @if(auth()->check())
                @can('view',auth()->user())
                <a href="{{route('post.create')}}" class="inline-block text-lg px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Admin</a>
                @endcan
                <form action="{{route('logout')}}" method="POST" class="inline-block">
                    @csrf
                    <button class="inline-block text-lg px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0" type="submit">Выйти</button>
                </form>

                @else
                <a href="{{route('login')}}" class="inline-block text-lg px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Войти</a>
                <a href="{{route('register')}}" class="inline-block text-lg px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Регистрация</a>
                @endif
              </div>
            </div>
          </div>
    </div>

  </header>

      <div class="container mx-auto w-4/5">
        @yield('content')
      </div>
    

    <footer>
  
    </footer>
    @yield("scripts")
    <script src="{{asset('js/layout.js')}}"></script>
</body>
</html>
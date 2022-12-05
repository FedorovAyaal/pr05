@extends('layouts.layout')
@section('title')
 Вход   
@endsection
@section('content')
<div class="container mx-auto ">
    <form action="{{route('login')}}" method="POST" autocomplete="off">
        @csrf
        <div class="w-3/4 lg:w-1/2 mx-auto mt-10">
            <h1 class="text-3xl mb-10">Вход</h1>
            <div class="relative z-0 mb-6 w-full group">
                <input type="email" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer focus:bg-none"  required autocomplete="email" value="{{old('email')}}"/>
                @error('email')
                <p class="text-red-500"><small>{{$message}}</small></p>
                @enderror
                <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required autocomplete="new-password" />
                @error('password')
                <p class="text-red-500"><small>{{$message}}</small></p>
                @enderror
                <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Войти</button>
            <p class="mt-2"><small>Нет аккаунта? <a href="{{route('register')}}" class="text-green-400 hover:text-blue-700 font-bold">Зарегистрироваться</a></small></p>
        </div>
    </form>

@endsection

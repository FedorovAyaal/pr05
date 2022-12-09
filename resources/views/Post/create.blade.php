@extends('layouts.layout')
@section('title')
    Create Post
@endsection

@section('content')
<form action="{{route('post.store')}}" method="POST" class="mb-4"  enctype="multipart/form-data">
    @csrf
    <div class="w-3/4 lg:w-1/2 mx-auto mt-10">
        <h1 class="text-3xl mb-10">Создать новый пост</h1>
        <div class="relative z-0 mb-6 w-full group">
            <input type="text" name="title" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer focus:bg-none" placeholder=" " required autocomplete="email" value="{{old('email')}}"/>
            @error('email')
            <p class="text-red-500"><small>{{$message}}</small></p>
            @enderror
            
            <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Заголовок</label>
        </div>


        <div class="relative z-0 mb-6 w-full group">
            <textarea name="content" rows="20" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required ></textarea>
            @error('password_confirmation')
            <p class="text-red-500"><small>{{$message}}</small></p>
            @enderror
            <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Текст</label>
        </div>
        <div class="relative z-0 mb-6 w-full group">
            <p class="text-gray-500 text-sm">Выберите изображение</p>
            <input type="file" name="image" class="mt-2 text-sm text-red-400 cursor-pointer " required>
        </div>
        <p class="text-gray-500 text-sm">Включить комментарии?</p>
        <div class="mt-4">
            <input type="radio" id="contactChoice1"
             name="comments_available" checked value="1">
            <label for="contactChoice1">Да</label>
        
            <input type="radio" id="contactChoice2"
             name="comments_available" value="0">
            <label for="contactChoice2">Нет</label>
        </div>
        <div class="mt-4">
            <label for="countries" class="text-gray-500 text-sm">Выберите категорию</label>
            <select required name="category_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Выберите категорию</option>
            @foreach($all_categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
            </select>
        </div>

        <button type="submit" class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Создать</button>
        
      </div>
</form>

@endsection

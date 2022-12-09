@extends('layouts.layout')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Жалобы
@endsection

@section('content')
<div class="reports mt-4 flex flex-col space-y-4">
    <h1 class="text-5xl font-medium">Репорты</h1>
    @if(count($reports) == 0)
    <p class=" font-medium text-gray-500 text-xl">Нет репортов</p>
    @else
    @foreach($reports as $report)
        <div class="report p-6 bg-slate-500 rounded-md text-white ">
            <p class="font-bold text-2xl">Репорт #{{$report->id}}</p>
            <div class="info font-medium flex flex-col space-y-3 ">
                <p class=" font-bold ">Информация:</p>
                <p>Причина: <span class="bg-red-500 p-1 px-2 rounded ">{{$report->reason->name}}</span></p>
                <p>Отправитель: <a href="">{{$report->comment->author->name}}</a></p>
                <p>Статус отправителя: @if($report->comment->author->status == 2) <span class="text-red-500">Забанен</span> @elseif($report->comment->author->status == 1) <span class="text-blue-500"> Админ </span> @else <span class="text-green-500"> Пользователь </span>@endif </p>
                <div class="w-full py-4 flex space-y-0 space-x-6">
                    <img class="block mx-0 h-12 lg:h-16 rounded-full shrink-0" src="{{asset('storage/images/avatar/'.$report->comment->author->avatar)}}" alt="Avatar">
                    <div class="space-y-2">
                      <div class="space-y-0.5">
                        <p class="text-xs text-white">{{date_format($report->comment->created_at,'d.m.Y, H:i:s')}}</p>
                        <p class="text-sm lg:text-lg text-black font-semibold">
                            {{$report->comment->author->first_name}} {{$report->comment->author->last_name}}
                        </p>
                        <p class="text-xs lg:text-sm">{!! $report->comment->text !!}</p>
                      </div>

    
                     
    
                    </div>
    
                  </div>
            
                
            </div>
            <div class="forms mt-4">
                    <input type="button" value="Выдать Бан" onclick="ban_user({{$report->comment->author->id}})" class=" font-medium bg-red-500 hover:bg-red-700 p-3 rounded-md px-6" id="banBtn">
               
                <form action="{{route('post.delete_comment',$report->comment->id)}}" class="inline" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Удалить комментарий" class="font-medium bg-red-500 hover:bg-red-700 p-3 rounded-md px-6">
                </form>
            </div>
        </div>
    @endforeach
    @endif
</div>
</div>

@section('scripts')
    <script src="{{asset('js/report.js')}}"></script>
@endsection

@endsection

@extends('layout.app')
@section('content')
    <a class="btn btn-primary openFriendChat" id="{{$lessonMessage->user_id}}" href="">Отговори</a>
    <div class="col-sm-6">
        <h1>Урок: {{$lesson->name}}</h1>
        <p>Местоположение: {{$lesson->location}}</p>
        <p>Публикувано на: {{$lesson->created_at}}</p>
        <h4>Категория: {{$lesson->category}}</h4>
        <p>Описание: {!!$lesson->description!!}</p>
    </div>
    <div class="col-sm-6">
        <p>Съобщение: {!! $lessonMessage->message !!}</p>
        {{$lessonMessage->user->id}}
    </div>
@endsection
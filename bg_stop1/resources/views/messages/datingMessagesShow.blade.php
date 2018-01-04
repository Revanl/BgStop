@extends('layout.app')
@section('content')
    <button class="btn btn-primary openFriendChat" id="{{$datingMessage->user_id}}">Отговори</button>
    <div class="col-sm-6">
        <img src="/storage/users/images/{{$userImage->image}}" width="250" height="250">
        <h1>Име: {{$dating->name}}</h1>
        <p>Пол: {{$dating->gender}}</p>
        <p>Възраст: {{$dating->age}}</p>
        <p>Интересува се от: {{$dating->interested_in}}</p>
        <p>Харесва: {{$dating->likes}}</p>
        <p>Не харесва: {{$dating->dislikes}}</p>
        <p>Местоположение: {{$dating->location}}</p>
        <p>Описание: {!! $dating->description !!}</p>
    </div>
    <div class="col-sm-6">
        <p>Съобщение: {!! $datingMessage->message !!}</p>
    </div>
@endsection
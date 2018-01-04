@extends('layout.app')
@section('content')
    <button class="btn btn-primary openFriendChat" id="{{$rentMessage->user_id}}">Отговори</button>
    <div class="col-sm-6">
        <h1>квартира: {{$rent->name}}</h1>
        <p>Местоположение: {{$rent->location}}</p>
        <p>Публикувано на: {{$rent->created_at}}</p>
        <p>Описание: {!!$rent->description!!}</p>
    </div>
    <div class="col-sm-6">
        <p>Съобщение: {!! $rentMessage->message !!}</p>
    </div>
@endsection
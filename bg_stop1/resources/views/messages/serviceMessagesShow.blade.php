@extends('layout.app')
@section('content')
    <button class="btn btn-primary openFriendChat" id="{{$serviceMessage->user_id}}">Отговори</button>
    <div class="col-sm-6">
        <h1>Услуга: {{$service->name}}</h1>
        <p>Местоположение: {{$service->location}}</p>
        <p>Публикувано на: {{$service->created_at}}</p>
        <h4>Категория: {{$service->category}}</h4>
        <p>Описание: {!!$service->description!!}</p>
    </div>
    <div class="col-sm-6">
        <p>Съобщение: {!! $serviceMessage->message !!}</p>
    </div>
@endsection
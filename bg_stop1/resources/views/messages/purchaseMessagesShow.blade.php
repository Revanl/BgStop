@extends('layout.app')
@section('content')
    <button class="btn btn-primary openFriendChat" id="{{$purchaseMessage->user_id}}">Отговори</button>
    <div class="col-sm-6">
        <h1>Продукт: {{$purchase->name}}</h1>
        <p>Местоположение: {{$purchase->location}}</p>
        <p>Публикувано на: {{$purchase->created_at}}</p>
        <h4>Категория: {{$purchase->category}}</h4>
        <p>Описание: {!!$purchase->description!!}</p>
    </div>
    <div class="col-sm-6">
        <p>Съобщение: {!! $purchaseMessage->message !!}</p>
    </div>
@endsection
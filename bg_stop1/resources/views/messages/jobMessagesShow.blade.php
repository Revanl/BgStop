@extends('layout.app')
@section('content')

    <button class="btn btn-primary openFriendChat" id="{{$jobMessage->user_id}}">Отговори</button>
<div class="col-sm-6">
    <h1>Позицията: {{$job->name}}</h1>
    <p>Местоположение: {{$job->location}}</p>
    <p>Публикувано на: {{$job->created_at}}</p>
    <h4>Категория: {{$job->category}}</h4>
    <p>Описание: {!! $job->description !!}</p>
</div>
<div class="col-sm-6">

    <embed src="/storage/jobs/cv/{{$jobMessage->cv}}" width="100%" height="500px"/>


    <p>Мотивационно писмо: {!! $jobMessage->message !!}</p>
</div>
@endsection
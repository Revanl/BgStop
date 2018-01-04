@extends('layout.app')
@section('content')

    <a href="/lessons" class="btn btn-success">Назад</a>
    <small>{!! $post->message !!}</small>
    <br>

@if(Auth::user()->id == $post->user_id)
    <a href="/posts/{{$post->id}}/edit" class="btn btn-success">Редактирай</a>
    {!! Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Изтрий', ['class'=>'btn btn-danger btn-xs', 'style'=>'border-radius:20px'])}}
    {!! Form::close() !!}
@endif
@endsection

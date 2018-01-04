@extends('layout.app')

@section('content')
    <h1>Редакция на квартира.</h1>
    {!!Form::open(['action'=>['PostsController@update',$post->id],'method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
    <div class="form-group">
        {{Form::label('message', 'Редактирай')}}
        {{Form::textarea('message', $post->message, ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Редактирай'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Редактирай', ['class'=>'btn btn-success btn-block'])}}
    {!! Form::close() !!}
@endsection

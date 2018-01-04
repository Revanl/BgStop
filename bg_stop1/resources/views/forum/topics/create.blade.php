@extends('layout.app')

@section('content')
    <h1>Публикувай нова тема</h1>
    {!!Form::open(['action'=>['ForumController@storePost', $forum_category->id] ,'method'=>'POST'])!!}
    <div class="form-group">
        {{Form::label('name', 'Име на темата')}}
        {{Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'Име на темата'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Описание на темата')}}
        {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Описание на темата'])}}
    </div>
        {{Form::submit('Публикувай', ['class'=>'btn btn-success btn-block'])}}
    {!! Form::close() !!}
@endsection

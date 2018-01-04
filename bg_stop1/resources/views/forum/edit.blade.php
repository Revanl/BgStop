@extends('layout.app')

@section('content')
    <h1>Редакция на категория.</h1>
    {!!Form::open(['action'=>['ForumController@update',$forum_category->id],'method'=>'POST'])!!}
        <div class="form-group">
            {{Form::label('category', 'Редакция на категория')}}
            {{Form::text('category', $forum_category->category, ['class'=>'form-control', 'placeholder'=>'Редакция на категория'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Редактирай', ['class'=>'btn btn-success btn-block'])}}
    {!! Form::close() !!}
@endsection

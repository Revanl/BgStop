@extends('layout.app')

@section('content')
    <h1>Публикувай нова категория.</h1>
    {!!Form::open(['action'=>'ForumController@store','method'=>'POST'])!!}
    <div class="form-group">
        {{Form::label('category', 'Име на форум категорията')}}
        {{Form::text('category', '', ['class'=>'form-control', 'placeholder'=>'Име на форум категорията'])}}
    </div>
    {{Form::submit('Публикувай', ['class'=>'btn btn-success btn-block'])}}
    {!! Form::close() !!}
@endsection

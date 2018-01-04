@extends('layout.app')
@section('content')
    <h1>Редакция на профил.</h1>

    {!!Form::open(['action'=>['EditController@edit'],'method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
    <div class="form-group">
        {{Form::label('image', 'Можете да си сложите снимка')}}
        {{Form::file('image')}}
    </div>
    <div class="form-group">
        {{Form::label('name', 'Име')}}
        {{Form::text('name', Auth()->user()->name, ['class'=>'form-control', 'placeholder'=>'Име'])}}
    </div>
    <div class="form-group">
        {{Form::label('gender', 'Пол')}}
        {{Form::select('gender', ['Мъж'=>'Мъж', 'Жена'=>'Жена'], Auth()->user()->gender, ['placeholder'=>'Избери категория','class'=>'form-control'])}}
    </div>

        {{Form::submit('Редактирай', ['class'=>'btn btn-success btn-block'])}}
    {!! Form::close() !!}
@endsection
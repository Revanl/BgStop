@extends('layout.app')

@section('content')
    <h1>Редакция на услуга.</h1>
    {!!Form::open(['action'=>['ServicesController@update', $service->id],'method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
    <div class="form-group">
        {{Form::label('name', 'Заглавие на квартирата')}}
        {{Form::text('name', $service->name, ['class'=>'form-control', 'placeholder'=>'Заглавие на квартирата'])}}
    </div>
    <div class="form-group">
        {{Form::label('location' , 'Местоположение')}}
        {{Form::select('location', ['Онлайн'=>'Онлайн' ,'Лондон централен'=>'Лондон централен','Лондон северен'=>'Лондон северен', 'Лондон източен'=>'Лондон източен', 'Лондон южен'=>'Лондон южен', 'Лондон западен'=>'Лондон западен', 'Югоизточна Англия'=>'Югоизточна Англия', 'Югозападна Англия'=>'Югозападна Англия', 'Източна Англия'=>'Източна Англия', 'Източна среда'=>'Източна среда', 'Западна среда'=>'Западна среда', 'Йоркшир и Хъмбър'=>'Йоркшир и Хъмбър', 'Северозападна Англия'=>'Северозападна Англия', 'Североизточна Англия'=>'Североизточна Англия', 'Уелс'=>'Уелс', 'Шотландия'=>'Шотландия', 'Северна Ирландия'=>'Северна Ирландия' ], $service->location, ['placeholder'=>'Избери категория','class'=>'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('category' , 'Категория')}}
        {{Form::select('category', ['Масажисти'=>'Масажисти', 'Техник'=>'Техник', 'Други'=>'Други'], $service->category, ['placeholder'=>'Избери категория','class'=>'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Описание на квартира')}}
        {{Form::textarea('description', $service->description, ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Описание на квартира'])}}
    </div>
    <div class="form-group">
        {{Form::label('image', 'Можете да си сложите снимка')}}
        {{Form::file('image')}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Редактирай', ['class'=>'btn btn-success btn-block'])}}
    {!! Form::close() !!}
@endsection

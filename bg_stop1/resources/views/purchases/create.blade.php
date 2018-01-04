@extends('layout/app')
@section('content')
    <h1>Публикувай продукт който искаш да продадеш</h1>
    {!! Form::open(['action'=>'PurchasesController@store','method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
        <div class="form-group">
            {{Form::label('name', 'Име на предлагания за закупване продукт')}}
            {{Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'Име на предлагания за закупване продукт'])}}
        </div>
        <div class="form-group">
            {{Form::label('location' , 'Местоположение')}}
            {{Form::select('location', ['Лондон централен'=>'Лондон централен','Лондон северен'=>'Лондон северен', 'Лондон източен'=>'Лондон източен', 'Лондон южен'=>'Лондон южен', 'Лондон западен'=>'Лондон западен', 'Югоизточна Англия'=>'Югоизточна Англия', 'Югозападна Англия'=>'Югозападна Англия', 'Източна Англия'=>'Източна Англия', 'Източна среда'=>'Източна среда', 'Западна среда'=>'Западна среда', 'Йоркшир и Хъмбър'=>'Йоркшир и Хъмбър', 'Северозападна Англия'=>'Северозападна Англия', 'Североизточна Англия'=>'Североизточна Англия', 'Уелс'=>'Уелс', 'Шотландия'=>'Шотландия', 'Северна Ирландия'=>'Северна Ирландия' ], null, ['placeholder'=>'Избери категория','class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('category' , 'Категория')}}
            {{Form::select('category', ['Жилища'=>'Жилища', 'Коли'=>'Коли', 'Други'=>'Други'], null, ['placeholder'=>'Избери категория','class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Описание на предлагания за закупване продукт')}}
            {{Form::textarea('description', '', ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Описание на предлагания за закупване продукт'])}}
        </div>
        <div class="form-group">
            {{Form::label('image', 'Можете да си сложите снимка')}}
            {{Form::file('image')}}
        </div>
        {{Form::submit('Публикувай', ['class'=>'btn btn-success btn-block'])}}
    {!! Form::close() !!}
@endsection
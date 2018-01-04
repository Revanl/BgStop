@extends('layout.app')

@section('content')
    <h1>Редакция на профил за запознанства.</h1>
    {!!Form::open(['action'=>['DatingController@update',$datingProfile->id],'method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
        <div class="form-group">
            {{Form::label('image', 'Можете да си сложите снимка')}}
            {{Form::file('image')}}
        </div>
        <div class="form-group">
            {{Form::label('age', 'Възраст')}}
            {{Form::number('age', $datingProfile->age, ['class'=>'form-control', 'placeholder'=>'Възраст'])}}
        </div>
        <div class="form-group">
            {{Form::label('interested_in', 'Интересува се от')}}
            {{Form::select('interested_in', ['Жени'=>'Жени', 'Мъже'=>'Мъже'], $datingProfile->interested_in, ['placeholder'=>'Избери категория','class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('likes', 'Харесва')}}
            {{Form::text('likes', $datingProfile->likes, ['class'=>'form-control', 'placeholder'=>'Пример: Харесва футбол, природата'])}}
        </div>
        <div class="form-group">
            {{Form::label('dislikes', 'Не харесва')}}
            {{Form::text('dislikes', $datingProfile->dislikes, ['class'=>'form-control', 'placeholder'=>'Пример: Не харесва: алкохол'])}}
        </div>
        <div class="form-group">
            {{Form::label('location' , 'Местоположение')}}
            {{Form::select('location', ['Лондон централен'=>'Лондон централен','Лондон северен'=>'Лондон северен', 'Лондон източен'=>'Лондон източен', 'Лондон южен'=>'Лондон южен', 'Лондон западен'=>'Лондон западен', 'Югоизточна Англия'=>'Югоизточна Англия', 'Югозападна Англия'=>'Югозападна Англия', 'Източна Англия'=>'Източна Англия', 'Източна среда'=>'Източна среда', 'Западна среда'=>'Западна среда', 'Йоркшир и Хъмбър'=>'Йоркшир и Хъмбър', 'Северозападна Англия'=>'Северозападна Англия', 'Североизточна Англия'=>'Североизточна Англия', 'Уелс'=>'Уелс', 'Шотландия'=>'Шотландия', 'Северна Ирландия'=>'Северна Ирландия' ], $datingProfile->location, ['placeholder'=>'Избери категория','class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Описание на предлагания под наем продукт')}}
            {{Form::textarea('description', $datingProfile->description, ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Описание на предлагания под наем продукт'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Редактирай', ['class'=>'btn btn-success btn-block'])}}
    {!! Form::close() !!}
@endsection

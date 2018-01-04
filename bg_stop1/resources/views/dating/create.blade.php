@extends('layout.app')
@section('content')
    <h1>Отвори своя профил за запознанства</h1>
    {!!Form::open(['action'=>'DatingController@store','method'=>'POST', 'enctype'=>'multipart-form/data'])!!}
        <div class="form-group">
            {{Form::label('image[]', 'Можете да си сложите снимка')}}
            {{Form::file('image[]', $attributes = array('multiple'=>'multiple'))}}
            {{--<input type="file" name="photos[]" $attributes = array(multiple) />--}}
        </div>
        <div class="form-group">
            {{Form::label('age', 'Възраст')}}
            {{Form::number('age', '', ['class'=>'form-control', 'placeholder'=>'Възраст'])}}
        </div>
        <div class="form-group">
            {{Form::label('interested_in', 'Интересува се от')}}
            {{Form::select('interested_in', ['Жени'=>'Жени', 'Мъже'=>'Мъже'],'', ['placeholder'=>'Избери категория','class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('likes', 'Харесва')}}
            {{Form::text('likes', '', ['class'=>'form-control', 'placeholder'=>'Пример: Харесва футбол, природата'])}}
        </div>
        <div class="form-group">
            {{Form::label('dislikes', 'Не харесва')}}
            {{Form::text('dislikes', '', ['class'=>'form-control', 'placeholder'=>'Пример: Не харесва: алкохол'])}}
        </div>
        <div class="form-group">
            {{Form::label('location' , 'Местоположение')}}
            {{Form::select('location', ['Лондон централен'=>'Лондон централен','Лондон северен'=>'Лондон северен', 'Лондон източен'=>'Лондон източен', 'Лондон южен'=>'Лондон южен', 'Лондон западен'=>'Лондон западен', 'Югоизточна Англия'=>'Югоизточна Англия', 'Югозападна Англия'=>'Югозападна Англия', 'Източна Англия'=>'Източна Англия', 'Източна среда'=>'Източна среда', 'Западна среда'=>'Западна среда', 'Йоркшир и Хъмбър'=>'Йоркшир и Хъмбър', 'Северозападна Англия'=>'Северозападна Англия', 'Североизточна Англия'=>'Североизточна Англия', 'Уелс'=>'Уелс', 'Шотландия'=>'Шотландия', 'Северна Ирландия'=>'Северна Ирландия' ], null, ['placeholder'=>'Избери категория','class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Описание на предлагания под наем продукт')}}
            {{Form::textarea('description', '', ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Описание на предлагания под наем продукт'])}}
        </div>
        {{Form::submit('Публикувай', ['class'=>'btn btn-success btn-block'])}}
    {!! Form::close() !!}
@endsection
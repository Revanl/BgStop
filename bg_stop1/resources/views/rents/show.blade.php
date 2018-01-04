@extends('layout.app')

@section('content')

    <a href="/rents" class="btn btn-success">Назад</a>
    <h1>{{$rent->name}}</h1>
    <img style="width:200px;height:200px" src="/storage/rents/images/{{$rent->image}}">
    <br><br>
    <p>{{$rent->location}}</p>
    <p>Публикувано на {{$rent->created_at}} от {{$rent->user->name}}</p>
    <small>{!! $rent->description !!}</small>
    <br>
    @if(!Auth::guest())
        @if(Auth::user()->id == $rent->user_id)
            <a href="/rents/edit" class="btn btn-success">Редактирай</a>
            {!! Form::open(['action'=>['RentsController@destroy', $rent->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Изтрий', ['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
        @else
            {!! Form::open(['action'=>['RentsController@message', $rent->id], 'method'=>'POST']) !!}
            <div class="form-group">
                {{Form::label('message', 'Съобщение')}}
                {{Form::textarea('message', '', ['id'=>'article-ckeditor', 'class'=>'form-control'])}}
            </div>
            {{Form::submit('Изпрати', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        @endif
    @else
        <p class="alert alert-danger">Трябва и вие да имате профил за да пишете на други хора</p>
        <a href="/register" class="btn btn-block btn-danger">Натиснете тук за да си създадете профил</a>
    @endif
@endsection

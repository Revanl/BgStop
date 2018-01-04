@extends('layout.app')
@section('content')

    <a href="/lessons" class="btn btn-success">Назад</a>
    <h1>{{$lesson->name}}</h1>
    <img style="width:200px;height:200px" src="/storage/lessons/images/{{$lesson->image}}"><br><br>
    <p>{{$lesson->location}}</p>
    <p>{{$lesson->category}}</p>
    <p>Публикувано на {{$lesson->created_at}} от {{$lesson->user->name}}</p>
    <small>{!! $lesson->description !!}</small>
    <br>
    @if(!Auth::guest())
        @if(Auth::user()->id == $lesson->user_id)
            <a href="/lessons/{{$lesson->id}}/edit" class="btn btn-success">Редактирай</a>
            {!! Form::open(['action'=>['LessonsController@destroy', $lesson->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Изтрий', ['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
        @else
            {!! Form::open(['action'=>['LessonsController@message', $lesson->id], 'method'=>'POST']) !!}
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
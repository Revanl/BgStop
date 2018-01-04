@extends('layout.app')

@section('content')

    <a href="/dating" class="btn btn-success">Назад</a>

    <h1>Име: {{$datingProfile->name}}</h1>
    <img style="width:200px;height:200px" src="/storage/dating/images/{{$datingProfile->image}}">
    <br><br>
    <p>Пол: {{$datingProfile->gender}}</p>
    <p>Възраст: {{$datingProfile->age}}</p>
    <p>Интересува се от: {{$datingProfile->interested_in}}</p>
    <p>Харесва: {{$datingProfile->likes}}</p>
    <p>Не харесва: {{$datingProfile->dislikes}}</p>
    <p>Местоположение: {{$datingProfile->location}}</p>
    <p>Описание: {{$datingProfile->description}}</p>

    <br>
    @if(!Auth::guest())
        @if(Auth::user()->id == $datingProfile->user_id)
            <a href="/dating/{{$datingProfile->id}}/edit" class="btn btn-success">Редактирай</a>
            {!! Form::open(['action'=>['DatingController@destroy', $datingProfile->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Изтрий', ['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
        @else
            {!! Form::open(['action'=>['DatingController@message', $datingProfile->id], 'method'=>'POST']) !!}
            <div class="form-group">
                {{Form::label('message', 'Съобщение')}}
                {{Form::textarea('message', '', ['id'=>'article-ckeditor', 'class'=>'form-control'])}}
            </div>
                {{Form::submit('Изпрати съобщение', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        @endif
        @else
            <p class="alert alert-danger">Трябва и вие да имате профил за запознанства за да пишете на други хора</p>
            <a href="/dating/create" class="btn btn-block btn-danger">Натиснете тук за да си създадете профил</a>
        @endif


@endsection

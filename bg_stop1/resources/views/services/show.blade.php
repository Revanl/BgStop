@extends('layout.app')

@section('content')

    <a href="/services" class="btn btn-success">Назад</a>
    <h1>{{$service->name}}</h1>
    <img style="width:200px;height:200px" src="/storage/services/images/{{$service->image}}">
    <br><br>
    <p>{{$service->location}}</p>
    <p>Публикувано на {{$service->created_at}} от {{$service->user->name}}</p>
    <small>{!! $service->description !!}</small>
    <br>
    @if(!Auth::guest())
        @if(Auth::user()->id == $service->user_id)
            <a href="/services/{{$service->id}}/edit" class="btn btn-success">Редактирай</a>
            {!! Form::open(['action'=>['ServicesController@destroy', $service->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Изтрий', ['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
        @else
            {!! Form::open(['action'=>['ServicesController@message', $service->id], 'method'=>'POST']) !!}
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

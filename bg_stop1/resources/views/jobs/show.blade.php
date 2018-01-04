@extends('layout.app')

@section('content')

    <a href="/jobs" class="btn btn-success">Назад</a>
    <h1>{{$job->name}}</h1>
    <img style="width:200px;height:200px" src="/storage/jobs/images/{{$job->image}}">
    <br><br>
    <p>{{$job->location}}</p>
    <p>{{$job->category}}</p>
    <p>Публикувано на {{$job->created_at}} от {{$job->user->name}}</p>
    <small>{!! $job->description !!}</small>
    <br>
    @if(!Auth::guest())
        @if(Auth::user()->id == $job->user_id)
            <a href="/jobs/{{$job->id}}/edit" class="btn btn-success">Редактирай</a>
            {!! Form::open(['action'=>['JobsController@destroy', $job->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Изтрий', ['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
        @else
            {!! Form::open(['action'=>['JobsController@message', $job->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('message', 'Мотивационно писмо')}}
                    {{Form::textarea('message', '', ['id'=>'article-ckeditor', 'class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    CV
                    {{Form::file('cv')}}
                </div>
                {{Form::submit('Кандидатствай', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        @endif
    @else
        <p class="alert alert-danger">Трябва и вие да имате профил за да пишете на други хора</p>
        <a href="/register" class="btn btn-block btn-danger">Натиснете тук за да си създадете профил</a>
    @endif
@endsection

@extends('layout.app')
@section('content')

    <a href="/forum" class="btn btn-success">Назад</a>
    <p>{{$forum_category->category}}</p>
    <br>
    @if(!Auth::guest())
        @if(Auth::user()->id == $forum_category->user_id)
            <a href="/forum/{{$forum_category->id}}/edit" class="btn btn-success">Редактирай</a>
            {!! Form::open(['action'=>['ForumController@destroy', $forum_category->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Изтрий', ['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
        <a class="btn btn-primary btn-block" href="/forum/{{$forum_category->id}}/topics/create">Публикувай тема</a>
    @else
        <p class="alert alert-danger">Трябва и вие да имате профил за да пишете на други хора</p>
        <a href="/register" class="btn btn-block btn-danger">Натиснете тук за да си създадете профил</a>
    @endif
    @foreach($forum_topics as $forum_topic)
        <div class="well">
            <a href="/forum/{{$forum_category->id}}/topics/{{$forum_topic->id}}">
                {{$forum_topic->name}}
            </a>
        </div>
    @endforeach
@endsection
@extends('layout.app')
@section('content')

    <a class="btn btn-success" href="/forum/{{$forum_category->id}}">Назад</a>
    <div class="well">
        <h1>{{$forum_topic->name}}</h1>
        <small>{{$forum_topic->description}}</small>
    </div>
    @foreach($forum_topic_replies as $forum_topic_reply)
    <div class="well col-sm-12">
        <div class="col-sm-10">
        <small>{{$forum_topic_reply->message}}</small>
        </div>
        <div class="col-sm-2">
            <img src="/storage/users/images/{{$forum_topic_reply->ForumReplyUserImage}}" width="50" height="50">
        </div>
    </div>
    @endforeach
    {{$forum_topic_replies->links()}}

    @if(!Auth::guest())
        {!! Form::open(['action'=>['ForumController@reply', $forum_category->id, $forum_topic->id], 'method'=>'POST']) !!}
            <div class="form-group">
                {{Form::label('message', 'Отговор за темата')}}
                {{Form::textarea('message', '', ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Отговор за темата'])}}
            </div>
            {{Form::submit('Отговорете', ['class'=>'btn btn-success btn-block'])}}
        {{ Form::close() }}
    @else
    <div class="col-sm-12">
        <p class="alert alert-danger">Трябва и вие да имате профил за да пишете на други хора</p>
        <a href="/register" class="btn btn-block btn-danger">Натиснете тук за да си създадете профил</a>
    </div>
    @endif
@endsection

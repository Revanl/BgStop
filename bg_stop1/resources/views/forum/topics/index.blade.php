@extends('layout.app')
@section('content')

    <a class="btn btn-success" href="/forum">Назад</a>
    <a class="btn btn-primary btn-block" href="topics/create">Отворете тема</a>
    @foreach($forum_topics as $forum_topic)
        {{$forum_topic->name}}
    @endforeach
    qewqe
@endsection

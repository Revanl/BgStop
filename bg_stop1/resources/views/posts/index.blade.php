@extends('layout.app')
@section('content')
    <p>Новини</p>
    {{--{!! Form::open(['method'=>'POST', 'enctype'=>'multipart/form-data']) !!}--}}
    {{--{{ Form::textarea('w') }}--}}
    {{--{{ Form::submit('Публикувай', ['class'=>'btn btn-success col-xs-12']) }}--}}
    {{--{!! Form::close() !!}--}}

    {{--{!! Form::open(['method'=>'POST', 'enctype'=>'multipart/form-data']) !!}--}}
    {{--{{ Form::textarea('e') }}--}}
    {{--{{ Form::submit('Публикувай', ['class'=>'btn btn-success col-xs-12']) }}--}}
    {{--{!! Form::close() !!}--}}
    USERS ARE STILL NOT BEING DISPLAYED ON COMMMENTS, FIX IT
    @if(!Auth::guest())
            {!! Form::open(['action'=>'PostsController@store', 'name'=>'sendPost', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                {{--{{ Form::file('image',['class'=>'chatFileUploader']) }}--}}
                {{--{{ Form::button('',['class'=>'glyphicon glyphicon-picture getChatFileUploader']) }}--}}
                {{ Form::textarea('message', null, ['id'=>'article-ckeditor']) }}

                {{ Form::submit('Публикувай', ['class'=>'btn btn-success col-xs-12']) }}
            {!! Form::close() !!}
    @else
        <p class="alert alert-danger">Трябва и вие да имате профил за да публикувате и коментирате</p>
        <a href="/register" class="btn btn-block btn-danger">Натиснете тук за да си създадете профил</a>
    @endif
    <br>
    <br>

    @if(count($posts)>0)
        @foreach($posts as $post)
            <div class="panel panel-info" style="border-radius:20px">
                <div class="panel-heading">{!! $post->message !!}</div>
                @if(Auth::user())
                    @if(Auth::user()->id == $post->user_id)
                        {!! Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Изтрий', ['class'=>'btn btn-danger btn-xs', 'style'=>'border-radius:20px;'])}}
                        {!! Form::close() !!}
                        <a href="/posts/{{$post->id}}/edit" class="btn btn-success btn-xs" style="border-radius:20px">Редактирай</a>
                    @endif
                @endif
                <div class="btn btn-warning btn-xs" href="#" style="border-radius:20px;" data-toggle="collapse" data-target="#{{$post->id}}">виж коментарите</div>
                <div class="panel-body collapse" id="{{$post->id}}">

                    @foreach($post->PostComment as $comment)
                            <div class="alert alert-warning" style="border-radius:20px;">
                                <img src="/storage/users/images/{{$post->image}}" height="50" width="50">

                                    <p>{{$comment->comment}}</p>

                            </div>
                        @endforeach


                    @if(!Auth::guest())
                        {!! Form::open(['action'=>['PostsController@comment', $post->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                            {{ Form::textarea('message') }}
                            {{ Form::submit('Публикувай', ['class'=>'btn btn-success col-xs-12']) }}
                        {!! Form::close() !!}
                    @else
                        <p class="alert alert-danger">Трябва и вие да имате профил за да коментирате</p>
                        <a href="/register" class="btn btn-block btn-danger">Натиснете тук за да си създадете профил</a>
                    @endif
                </div>
            </div>
        @endforeach
        {{--{{$posts->links()}}--}}
        @else
            <p>В момента нищо не е публикувано.</p>
    @endif
@endsection
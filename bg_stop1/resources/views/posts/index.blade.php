@extends('layout.app')
@section('content')
    <p>Новини</p>



            {!! Form::open(['action'=>'PostsController@store', 'name'=>'sendPost', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}


                {{ Form::textarea('message', null, ['id'=>'article-ckeditor']) }}

                {{ Form::submit('Публикувай', ['class'=>'btn btn-success col-xs-12']) }}
            {!! Form::close() !!}

    <br>
    <br>

    @if(count($posts)>0)
        @foreach($posts as $post)
            <div class="panel panel-info" style="border-radius:20px">
                <div class="panel-heading">{!! $post->message !!}</div>

                <div class="btn btn-warning btn-xs" href="#" style="border-radius:20px;" data-toggle="collapse" data-target="#this{{$post->id}}">виж коментари ({{count($post->PostComment)}})</div>
                <div class="panel-body collapse" id="this{{$post->id}}">

                    @foreach($post->PostComment as $comment)
                            <div class="alert alert-warning" style="border-radius:20px;">

                                    <p>{{$comment->comment}}</p>
                            </div>
                        @endforeach

                        {!! Form::open(['action'=>['PostsController@comment', $post->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                            {{ Form::textarea('message') }}
                            {{ Form::submit('Публикувай', ['class'=>'btn btn-success col-xs-12']) }}
                        {!! Form::close() !!}

                </div>
            </div>
        @endforeach
        @else
            <p>В момента нищо не е публикувано.</p>
    @endif
@endsection

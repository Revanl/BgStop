@extends('layout.app')
@section('content')
<h3>Вашите публикации</h3>
@if(count($posts) > 0)
    <table class="table table-striped">
        <tr>
            <th>Title</th>
            <th></th>
            <th></th>
        </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                <td>
{{--{{ Form::open(array(['url' => 'posts/' . $post->id], 'class' => 'btn btn-small')) }}--}}
{{--{{ Form::hidden('_method', 'DELETE') }}--}}
{{--{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}--}}
{{--{{ Form::close() }}--}}

{{--<form action="{{ url('/', ['id' => $post->id]) }}" method="post">--}}
{{--<input type="button" name="_method" value="delete" />--}}
{{--{!! csrf_field() !!}--}}
{{--</form>--}}

{!! Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
{!!Form::close()!!}
                </td>
            </tr>
        @endforeach
    </table>
@else
    <p>You have no posts</p>
@endif
@endsection
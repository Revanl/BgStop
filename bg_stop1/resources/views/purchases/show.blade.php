@extends('layout.app')

@section('content')

    <a href="/purchases" class="btn btn-success">Назад</a>
    <h1>{{$purchase->name}}</h1>
    <img style="width:200px;height:200px" src="/storage/purchases/images/{{$purchase->image}}">
    <br><br>
    <p>{{$purchase->location}}</p>
    <p>{{$purchase->category}}</p>
    <p>Публикувано на {{$purchase->created_at}} от {{$purchase->user->name}}</p>
    <small>{!! $purchase->description !!}</small>
    <br>
    @if(!Auth::guest())
        @if(Auth::user()->id == $purchase->user_id)
            <a href="/purchases/{{$purchase->id}}/edit" class="btn btn-success">Редактирай</a>
            {!! Form::open(['action'=>['PurchasesController@destroy', $purchase->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Изтрий', ['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
        @else
            {!! Form::open(['action'=>['PurchasesController@message', $purchase->id], 'method'=>'POST']) !!}
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

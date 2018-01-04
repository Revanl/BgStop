@extends('layout.app')
@section('content')
    <h1>Уроци</h1>

    @if(!Auth::guest())
        @if(Auth::user()->email == 'ianihrg@abv.bg')
            <a href="lessons/create" class="btn btn-success btn-block">Публикувай</a>
        @endif
    @endif
    @if(count($lessons) > 0)
        @foreach($lessons as $lesson)
        <div class="well">
            <div class="row">
                <div class="col-md-4">
                    <img class="itemImg" src="/storage/lessons/images/{{$lesson->image}}">
                </div>
                <div class="col-md-8 rowHeightSmall">
                    <h3><a href="/lessons/{{$lesson->id}}">{{$lesson->name}}</a></h3>
                    <small>{!! $lesson->description !!}</small>
                    <p>Публикувано на {{$lesson->created_at}}</p>
                    <p>От {{$lesson->user->name}}</p>
                </div>
            </div>
        </div>
        @endforeach
        {{$lessons->links()}}
    @else
        <p>В момента никакви уроци не се предлагат.</p>
    @endif
@endsection
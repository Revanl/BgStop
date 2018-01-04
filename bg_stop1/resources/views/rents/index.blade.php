@extends('layout.app')

@section('content')
    <h1>Квартири</h1>
    <a href="rents/create" class="btn btn-success btn-block">Публикувай</a>
    @if(count($rents) > 0)
        @foreach($rents as $rent)
            <div class="well">
                <div class="row">
                    <div class="col-md-4">
                        <img class="itemImg" src="/storage/rents/images/{{$rent->image}}">
                    </div>
                    <div class="col-md-8 rowHeightSmall">
                        <h3><a href="/rents/{{$rent->id}}">{{$rent->name}}</a></h3>
                        <small>{!! $rent->description !!}</small>
                        <p>Публикувано на {{$rent->created_at}}</p>
                        <p>От {{$rent->user->name}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        {{$rents->links()}}
    @else
        <p>В момента нищо не се предлага под наем.</p>
    @endif
@endsection

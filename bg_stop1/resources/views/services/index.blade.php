@extends('layout.app')

@section('content')
    <h1>Услуги</h1>
    <a href="services/create" class="btn btn-success btn-block">Публикувай</a>
    @if(count($services) > 0)
        @foreach($services as $service)
            <div class="well">
                <div class="row">
                    <div class="col-md-4">
                        <img class="itemImg" src="/storage/services/images/{{$service->image}}">
                    </div>
                    <div class="col-md-8 rowHeightSmall">
                        <h3><a href="/services/{{$service->id}}">{{$service->name}}</a></h3>
                        <small>{!! $service->description !!}</small>
                        <p>Публикувано на {{$service->created_at}}</p>
                        <p>От {{$service->user->name}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        {{$services->links()}}
    @else
        <p>В момента не се предлагат услуги.</p>
    @endif
@endsection

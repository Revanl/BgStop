@extends('layout.app')
@section('content')
    <h1>Купуване-Продаване</h1>
    <a href="purchases/create" class="btn btn-success btn-block">Публикувай</a>
    @if(count($purchases) > 0)
        @foreach($purchases as $purchase)
            <div class="well">
                <div class="row">
                    <div class="col-md-4">
                        <img class="itemImg" src="/storage/purchases/images/{{$purchase->image}}">
                    </div>
                    <div class="col-md-8 rowHeightSmall">
                        <h3><a href="purchases/{{$purchase->id}}">{{$purchase->name}}</a></h3>
                        <small>{!!$purchase->description!!}</small>
                        <p>Публикувано на {{$purchase->created_at}}</p>
                        <p>От {{$purchase->user->name}}</p>
                    </div>
            </div>
        </div>
        @endforeach
        {{$purchases->links()}}
    @else
        <p>В момента нищо не се продава</p>
    @endif
@endsection
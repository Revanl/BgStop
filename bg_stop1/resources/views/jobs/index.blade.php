@extends('layout.app')

@section('content')
    <h1>Работа</h1>
    <a href="jobs/create" class="btn btn-success btn-block">Публикувай</a>
    @if(count($jobs) > 0)
        @foreach($jobs as $job)
            <div class="well">
                <div class="row">
                    <div class="col-md-4">
                        <img class="itemImg" src="/storage/jobs/images/{{$job->image}}">
                    </div>
                    <div class="col-md-8 rowHeightSmall">
                        <h3><a href="/jobs/{{$job->id}}">{{$job->name}}</a></h3>
                        <small>{!! $job->description !!}</small>
                        <p>Публикувано на {{$job->created_at}}</p>
                        <p>От {{$job->user->name}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        {{$jobs->links()}}
    @else
        <p>В момента няма свободни работни позиции.</p>
    @endif
@endsection

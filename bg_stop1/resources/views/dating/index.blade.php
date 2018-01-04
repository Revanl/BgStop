@extends('layout.app')
@section('content')
@if(count($hasDatingProfile) == 0)
<a href="dating/create" class="btn btn-success btn-block">Присъедини се</a>
@endif
<table class="table table-striped">
    @if(count($datingProfiles) > 0)
        @foreach($datingProfiles as $datingProfile)
            <div class="well">

                <div class="row">
                    <div class="col-md-4">
                        <img class="itemImg" src="/storage/dating/images/{{$datingProfile->image}}">
                    </div>
                    <div class="col-md-8 rowHeightSmall">
                        <h3><a href="/dating/{{$datingProfile->id}}">{{$datingProfile->name}}</a></h3>
                        <small>{!! $datingProfile->description !!}</small>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>В момента няма профили за запознанства.</p>
    @endif
</table>
@endsection
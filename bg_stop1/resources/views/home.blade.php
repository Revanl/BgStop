@extends('layout.app')

@section('content')
<div class="panel-body">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if(count($jobApplications) > 0)

            @foreach($jobApplications as $jobApplication)
                @if($jobApplication->seen == 0)
                    <div style="background:Red;width:100%;height:100px;">
                        <a href="/jobApplications/{{ $jobApplication->id }}">
                            {{$jobApplication->id}}
                            {{$jobApplication->seen}}
                        </a>
                    </div>
                    @else
                    <div style="background:green;width:100%;height:100px;">
                        <a href="/Message/{{ $jobApplication->id }}">
                            {{$jobApplication->id}}
                            {{$jobApplication->seen}}
                        </a>
                    </div>
                @endif
            @endforeach

                <p>no messages</p>

    @endif
    You are logged in!
</div>
{{--@if(count($jobApplications) > 0)--}}
    {{--<table class="table table-striped">--}}
        {{--<tr>--}}
            {{--<th>Име</th>--}}
            {{--<th>Категория</th>--}}
            {{--<th>Местоположение</th>--}}
            {{--<th>Описание</th>--}}
        {{--</tr>--}}
        {{--@foreach($jobApplications as $jobApplication)--}}
            {{--<tr>--}}
                {{--<td>{{$jobApplication->name}}</td>--}}
                {{--<td><a href="/job/{{$jobApplication->id}}/edit" class="btn btn-success">Редактирай</a></td>--}}
                {{--<td>--}}
                    {{--{{$jobApplications->user_id}};--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
    {{--</table>--}}
    {{--@else--}}
    {{--<p>Вие не сте публикували нищо</p>--}}
{{--@endif--}}
@endsection

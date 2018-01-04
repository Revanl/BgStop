@extends('layout.app')

@section('content')
    <h1>Форум</h1>

    @if(!Auth::guest())
        @if(Auth::user()->email == 'ianihrg@abv.bg')
            <a href="forum/create" class="btn btn-success btn-block">Публикувай</a>
        @endif
    @endif
    @if(count($forum_categories) > 0)
        @foreach($forum_categories as $forum_category)
            <div class="well">
                <div class="row">
                    <div class="col-sm-12">
                        <h3><a href="/forum/{{$forum_category->id}}">{{$forum_category->category}}</a></h3>
                    </div>
                </div>
            </div>
        @endforeach
        {{$forum_categories->links()}}
    @else
        <p>В момента няма категории.</p>
    @endif
@endsection

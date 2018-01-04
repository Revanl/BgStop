
<a class="btn btn-info btn-lg openContacts">
    <span class="glyphicon glyphicon-user"></span>Контакти
</a>


<div class="contactsBox well">
    @foreach($friends as $friend)
        <button class="alert alert-warning openFriendChat" style="height:75px;width:100%" id="{{$friend->id}}">
            <div class="col-xs-2">
                <img src="/storage/users/images/{{$friend->image}}" style="height:50px!important;width:50px!important;max-width:50px!important">
            </div>
            ‎ <div class="col-xs-10">
                ‎   {{$friend->name}}
             </div>
        </button>
    @endforeach
    {{--{{$friends->links()}}--}}
</div>



<a class="btn btn-default btn-lg openUnseen">
    <span class="glyphicon glyphicon-envelope">   </span>
    <span class="badge" style="margin-left:20px;">
         {{ count($friendMessages) }}
    </span>
</a>


<div class="unSeenBox well">
    @foreach($friendMessages as $friendMessage)
        <button class="alert alert-warning openFriendChat" style="height:75px;width:100%" id="{{$friendMessage->id}}">
            <div class="col-xs-2">
                <img src="/storage/users/images/{{$friendMessage->image}}" style="height:50px!important;width:50px!important;max-width:50px!important">
            </div>
            ‎ <div class="col-xs-10">
                ‎   {{$friendMessage->name}}
                {{ count($friendMessage->seen) }}
            </div>
        </button>
    @endforeach
    {{--{{$friends->links()}}--}}
</div>
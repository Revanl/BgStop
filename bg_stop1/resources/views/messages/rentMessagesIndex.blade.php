<div class="messageBox">
    @if(count($rentMessages)>0)
        @foreach($rentMessages as $rentMessage)
            @if($rentMessage->seen == 0)
                <div class="messageUnseen">
                    <a href="/rentMessages/{{$rentMessage->id}}">
                        съобщение от {{$rentMessage->rentUserName}}
                        за {{$rentMessage->rentName}}
                    </a>
                </div>
            @else
                <div class="messageSeen">
                    <a href="/rentMessages/{{ $rentMessage->id }}">
                        съобщение от {{$rentMessage->rentUserName}}
                        за {{$rentMessage->rentName}}
                    </a>
                </div>
            @endif
        @endforeach
    @else
        <div class="messageEmpty">Нямате съобщения</div>
    @endif
</div>
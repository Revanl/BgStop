<div class="messageBox">
    @if(count($datingProfileMessages) > 0)
        @foreach($datingProfileMessages as $datingProfileMessage)
            @if($datingProfileMessage->seen == 0)
                <div class="messageUnseen">
                    <a href="/datingMessages/{{$datingProfileMessage->id}}">
                        съобщение от {{$datingProfileMessage->datingProfileUserName}}
                        за {{$datingProfileMessage->datingProfileName}}
                    </a>

                </div>
            @else
                <div class="messageSeen">
                    <a href="/datingMessages/{{ $datingProfileMessage->id }}">
                        съобщение от {{$datingProfileMessage->datingProfileUserName}}
                        за {{$datingProfileMessage->datingProfileName}}
                    </a>
                </div>
            @endif
        @endforeach
    @else
        <div class="messageEmpty">Нямате съобщения</div>
    @endif
</div>

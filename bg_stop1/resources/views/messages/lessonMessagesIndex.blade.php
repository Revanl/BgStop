<div class="messageBox">
    @if(count($lessonMessages)>0)
        @foreach($lessonMessages as $lessonMessage)
            @if($lessonMessage->seen == 0)
                <div class="messageUnseen">
                    <a href="/lessonMessages/{{$lessonMessage->id}}">
                        съобщение от {{$lessonMessage->lessonUserName}}
                        за {{$lessonMessage->lessonName}}
                    </a>
                </div>
            @else
                <div class="messageSeen">
                    <a href="/lessonMessages/{{ $lessonMessage->id }}">
                        съобщение от {{$lessonMessage->lessonUserName}}
                        за {{$lessonMessage->lessonName}}
                    </a>
                </div>
            @endif
        @endforeach
    @else
        <div class="messageEmpty">Нямате съобщения</div>
    @endif
</div>
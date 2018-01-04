<div class="messageBox">

    @if(count($jobMessages) > 0)
        @foreach($jobMessages as $jobMessage)
            @if($jobMessage->seen == 0)
                <div class="messageUnseen">
                    <a href="/jobMessages/{{$jobMessage->id}}">
                        съобщение от {{$jobMessage->jobUserName}}
                        за {{$jobMessage->jobName}}
                    </a>
                </div>
            @else
                <div class="messageSeen">
                    <a href="/jobMessages/{{$jobMessage->id}}">
                        съобщение от {{$jobMessage->jobUserName}}
                        за {{$jobMessage->jobName}}
                    </a>
                </div>
            @endif
        @endforeach

        @else
        <div class="messageEmpty">Нямате съобщения</div>
    @endif
</div>

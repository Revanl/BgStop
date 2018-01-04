<div class="messageBox">
    @if(count($serviceMessages)>0)
        @foreach($serviceMessages as $serviceMessage)
            @if($serviceMessage->seen == 0)
                <div class="messageUnseen">
                    <a href="/serviceMessages/{{$serviceMessage->id}}">
                        съобщение от {{$serviceMessage->serviceUserName}}
                        за {{$serviceMessage->serviceName}}
                    </a>
                </div>
            @else
                <div class="messageSeen">
                    <a href="/serviceMessages/{{ $serviceMessage->id }}">
                        съобщение от {{$serviceMessage->serviceUserName}}
                        за {{$serviceMessage->serviceName}}
                    </a>
                </div>
            @endif
        @endforeach
    @else
        <div class="messageEmpty">Нямате съобщения</div>
    @endif
</div>
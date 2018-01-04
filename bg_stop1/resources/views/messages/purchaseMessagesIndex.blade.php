<div class="messageBox">
    @if(count($purchaseMessages)>0)
        @foreach($purchaseMessages as $purchaseMessage)
            @if($purchaseMessage->seen == 0)
                <div class="messageUnseen">
                    <a href="/purchaseMessages/{{$purchaseMessage->id}}">
                        съобщение от {{$purchaseMessage->purchaseUserName}}
                        за {{$purchaseMessage->purchaseName}}
                    </a>
                </div>
            @else
                <div class="messageSeen">
                    <a href="/purchaseMessages/{{ $purchaseMessage->id }}">
                        съобщение от {{$purchaseMessage->purchaseUserName}}
                        за {{$purchaseMessage->purchaseName}}
                    </a>
                </div>
            @endif
        @endforeach
    @else
        <div class="messageEmpty">Нямате съобщения</div>
    @endif
</div>
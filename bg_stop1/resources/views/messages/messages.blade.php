<div class="triangleParent">
    @auth
    <div class="triangleDown"><span> <span class="countPosition"> {{ count($jobMessagesSeen) }} </span> @include('messages.jobMessagesIndex')</span></div>
    <div class="triangleDown"><span> <span class="countPosition"> {{ count($rentMessagesSeen) }} </span> @include('messages.rentMessagesIndex')</span></div>
    <div class="triangleDown"><span> <span class="countPosition"> {{ count($purchaseMessagesSeen) }} </span> @include('messages.purchaseMessagesIndex')</span></div>
    <div class="triangleDown"><span> <span class="countPosition"> {{count($datingProfileMessagesSeen)}} </span> @include('messages.datingMessagesIndex')</span></div>
    <div class="triangleDown"><span> <span class="countPosition"> {{ count($lessonMessagesSeen) }} </span> @include('messages.lessonMessagesIndex')</span></div>
    <div class="triangleDown"><span> <span class="countPosition"> {{ count($serviceMessagesSeen) }} </span> @include('messages.serviceMessagesIndex')</span></div>
    @endauth
    <br>
    <button class="btn btn-info btn-block"  ><a href="/contactUs" >Натиснете тук за да рекламирате с нас</a></button>

</div>

@foreach($messages as $message)
<li class="media">
    <div class="mr-3">
            <img src="{{asset('user_asset/global_assets/images/placeholders/placeholder.jpg')}}" class="rounded-circle" width="40" height="40" alt="">
    </div>

    <div class="media-body">
        @if($message->image)
        <a href="{{asset($message->image)}}" target="_blank">
            <img src="{{asset($message->image)}}" height="200px" width="200px"  alt="">
        </a>
        @endif
        <div class="media-chat-item">{!! $message->message !!}</div>
        <div class="font-size-sm text-muted mt-2">{{$message->created_at->format('M d,Y H:i A')}}</div>
    </div>
</li>
@endforeach
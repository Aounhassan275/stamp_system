@extends('admin.layout.index')

@section('title')
Chat 
@endsection
@section('styles')
<script src="{{asset('admin/global_assets/js/demo_pages/chat_layouts.js')}}"></script>
@endsection

@section('contents')
<div class="row " >
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Share Your Chat Link</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        {{-- <a href="{{route('user.tree.show')}}" class="btn btn-dark" >See Your Tree</a> --}}
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
                {{-- <div class="text-right">
                </div> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label">Copy Link For Share </label>
                        <input type="text" class="form-control" id="link_area"  value="{{url('chat',$chat->id)}}"  readonly>    
                        <br>
                        <button type="button" class="copy-button btn btn-dark  btn-sm" data-clipboard-action="copy" data-clipboard-target="#link_area">Copy to clipboard</button>

                    </div> 
                </div>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>
<!-- Basic layout -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{$chat->name}} Chat</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <ul class="media-list media-chat media-chat-scrollable mb-3">
            @foreach($chat->messages as $message)
                @if($message->admin_id)
                <li class="media media-chat-item-reverse">
                    <div class="media-body">
                        
                        @if($message->image)
                        <a href="{{asset($message->image)}}" target="_blank">
                            <img src="{{asset($message->image)}}" height="200px" width="200px"  alt="">
                        </a>
                        @endif
                        <div class="media-chat-item">{!! $message->message !!}</div>
                        <div class="font-size-sm text-muted mt-2">{{$message->created_at->format('M d,Y H:i A')}}</div>
                    </div>

                    <div class="ml-3">
                            <img src="{{asset('user_asset/global_assets/images/placeholders/placeholder.jpg')}}" class="rounded-circle" width="40" height="40" alt="">
                    </div>
                </li>
                @else
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
                @endif
            @endforeach
            <div id="latest_chat"></div>
        </ul>

        <form action="{{route('admin.chatmessage.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input name="message" class="form-control mb-3"  placeholder="Enter your message...">

            <input type="hidden" name="admin_id" value="{{Auth::user()->id}}"  placeholder="Enter Course Price" class="form-control" required>
            <input type="hidden" name="chat_id" value="{{$chat->id}}"  placeholder="Enter Course Price" class="form-control" required>
            <div class="d-flex align-items-center">
                <div class="list-icons list-icons-extended">
                <label><input hidden type="file" name="image"><i class="icon-file-picture"></i></label>
                </div>

                <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-auto"><b><i class="icon-paperplane"></i></b> Send</button>
            </div>
        </form>
    </div>
</div>
<!-- /basic layout -->
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('clipboard.js')}}"></script>
<script type="text/javascript">
	var clipboard = new Clipboard('.copy-button');
        clipboard.on('success', function(e) {
            copyText.select();
            var $div2 = $("#coppied");
            console.log($div2);
            console.log($div2.is(":visible"));
            if ($div2.is(":visible")) { return; }
            $div2.show();
            setTimeout(function() {
                $div2.fadeOut();
            }, 800);
        });
</script>
<script>
    setInterval(function()
        { 
            $.ajax({
                url: "{{url('admin/get_latest_chat')}}",
                type: "POST",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                dataType: 'JSON',
                data: {
                    'chat_id': "{{$chat->id}}",
                },
                success: function(response)
                {
                    if(response.messages)
                    {
                        $('#latest_chat').html(response.html);
                    }
                }
            });
        }, 3000);
    $('html,body').animate({scrollTop: document.body.scrollHeight},"fast");
</script>
@endsection
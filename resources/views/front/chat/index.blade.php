<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>CHAT WITH ADMIN</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('front/image/favicon.png')}}">
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/global_assets/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/toastr.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	

	<!-- Core JS files -->
	<script src="{{asset('user_asset/global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('user_asset/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js')}}"></script>

	<script src="{{asset('user_asset/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/demo_pages/form_select2.js')}}"></script>

	<script src="{{asset('user_asset/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('user_asset/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    
	<script src="{{asset('user_asset/global_assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>

	<script src="{{asset('user_asset/assets/js/app.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/demo_pages/datatables_basic.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/demo_pages/form_layouts.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/demo_pages/dashboard.js')}}"></script>
	<!-- /theme JS files -->
	<!-- /theme JS files -->
    <script src="{{asset('admin/global_assets/js/demo_pages/chat_layouts.js')}}"></script>

</head>

<body>
    <div class="page-content">

        <div class="content-wrapper">
            <div class="content">
                <!-- Basic layout -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{@$chat->name}} Chat</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="media-list media-chat media-chat-scrollable mb-3" >
                            @foreach(@$chat->messages as $message)
                                @if(!$message->admin_id)
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

                        <form  action="{{route('chatmessage.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input name="message" class="form-control mb-3"  placeholder="Enter your message...">
                            <input type="hidden" name="chat_id" value="{{@$chat->id}}"  placeholder="Enter Course Price" class="form-control" required>
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
            </div>
        </div>
    </div>
	<script src="{{asset('user_asset/assets/js/toastr.js')}}"></script>
    <script>
        
        setInterval(function()
        { 
            $.ajax({
                url: "{{url('get_latest_chat')}}",
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
	@toastr_render
</body>
</html>
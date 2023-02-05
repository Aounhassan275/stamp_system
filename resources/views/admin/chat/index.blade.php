@extends('admin.layout.index')
@section('contents')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">View Your Chat With User</h5>
        <div class="header-elements">
            <div class="list-icons">
                <button data-toggle="modal"  data-target="#create_modal" class="btn btn-success  float-right complete-btn" type="button">Create Chat</button>
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <table class="table  datatable-basic datatable-row-basic">
        <thead>
            <tr>
                <th>Sr#</th>
                <th>Chat Name</th>
                <th>Chat Status</th>
                <th>Unread Messages</th>
                <th>Action</th>
                <th>Action</th>
                <th>Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($chats as $key => $chat)
            <tr> 
                <td>{{$key+1}}</td>
                <td>{{$chat->name}}</td>
                <td>
                    @if($chat->status)
                        <span class="badge badge-success">Active</span>
                    @else 
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm">{{$chat->messages->where('status','Unread')->count()}}</button>
                </td>
                <td>
                    
                    @if($chat->status)
                    <a href="{{route('admin.chat.make_inactive',$chat->id)}}">
                        <button type="button" class="btn btn-danger btn-sm">Make Inactive</button>
                    </a> 
                    @else 
                        <a href="{{route('admin.chat.make_active',$chat->id)}}">
                            <button type="button" class="btn btn-success btn-sm">Make Active</button>
                        </a> 
                    @endif
                </td>
                <td>
                    <a href="{{route('admin.chat.show',$chat->id)}}">
                        <button type="button" class="btn btn-success btn-sm">View</button>
                    </a> 
                </td>
                <td>
                    <form action="{{route('admin.chat.destroy',$chat->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                    <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="create_modal" class="modal fade">
    <div class="modal-dialog">
        <form action="{{route('admin.chat.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Create Chat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Chat Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Chat Name" required>
                    </div>  
                    <div class="form-group">
                        <label>Enter Your Message</label>
                        <textarea name="message" id="" cols="30" rows="2" required class="form-control"></textarea>
                    </div>  
                    <input type="hidden" name="admin_id" value="{{Auth::user()->id}}"  class="form-control" required>
                    <input type="hidden" name="status" value="1"  class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@endsection
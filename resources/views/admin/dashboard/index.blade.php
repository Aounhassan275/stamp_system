@extends('admin.layout.index')

@section('title')

    
DASHBOARD

@endsection


@section('contents')
<div class="row">
    <div class="col-sm-12 col-xl-12">
        <div class="card card-body">
            <div class="media mb-3">
                <div class="media-body">
                    <a href="{{route('admin.chat.index')}}">
                        <h6 class="font-weight-semibold mb-0">Total Chats</h6>
                        <span class="text-muted">{{App\Models\Chat::count()}}</span>
                    </a>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-mail-read icon-2x text-indigo-400 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
@section('scripts')
@endsection

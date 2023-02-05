@extends('admin.layout.index')
@section('title')
Stamps
@endsection
@section('contents')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Stamps</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{route('admin.stamp.create')}}" style="marign-right:10px;" class="btn btn-success  float-right complete-btn" type="button">Create New Stamp Paper</a>
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
                <th>Stamp ID</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Action</th>
                <th>Action</th>
                <th>Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($stamps as $key => $stamp)
            <tr> 
                <td>{{$key+1}}</td>
                <td>{{$stamp->stamp_id}}</td>
                <td>{{$stamp->type}}</td>
                <td>{{$stamp->amount}}</td>
                <td>
                    <a href="{{route('admin.stamp.edit',$stamp->id)}}">
                        <button type="button" class="btn btn-primary btn-sm">Edit</button>
                    </a> 
                </td>
                <td>
                    <a href="{{route('admin.stamp.show',$stamp->id)}}">
                        <button type="button" class="btn btn-success btn-sm">View</button>
                    </a> 
                </td>
                <td>
                    <form action="{{route('admin.stamp.destroy',$stamp->id)}}" method="POST">
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
@endsection
@section('scripts')
@endsection
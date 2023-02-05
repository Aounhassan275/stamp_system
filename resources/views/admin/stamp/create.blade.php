@extends('admin.layout.index')
@section('title')
CREATE NEW STAMP
@endsection
@section('contents')

<form action="{{route('admin.stamp.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Challan Detail</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Stamp ID</label>
                            <input type="text" name="stamp_id" class="form-control" value="PB-SGD-FR978AB123" placeholder="Stamp ID" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Type</label>
                            <input type="text" name="type" class="form-control" value="LoeDenomination" placeholder="Stamp ID" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Amount</label>
                            <input type="text" name="amount" class="form-control" placeholder="Amount" value="PKR 100 /-" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Applicant Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Description</label>
                            <select name="description_id" class="form-control" required>
                                @foreach(App\Models\Description::all() as $description)
                                <option value="{{$description->id}}">{{$description->name}}</option>
                                @endforeach  
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Applicant</label>
                            <input type="text" name="applicant" class="form-control" placeholder="Applicant" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Guardian Type</label>
                            <select name="guardian_type" class="form-control" required>
                                <option value="S/o">S/o</option>
                                <option value="D/o">D/o</option>
                                <option value="W/o">W/o</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Guardian Name</label>
                            <input type="text" name="guardian" class="form-control" placeholder="Guardian Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Agent</label>
                            <input type="text" name="agent" class="form-control" value="Self" placeholder="Agent" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Address" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Issue Date</label>
                            <input type="datetime-local" name="issue_date" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Amount In Words</label>
                            <input type="text" name="amount_in_words" value="One Hundred Rupees Only" class="form-control" placeholder="Amount In Words" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Reason</label>
                            <input type="text" name="reason" class="form-control" placeholder="Reason" value="AFFIDAVIT" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Vendor Information</label>
                            <select name="vendor_id" class="form-control" required>
                                @foreach(App\Models\Vendor::all() as $vendor)
                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                @endforeach  
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" placeholder="Notes" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('scripts')
@endsection
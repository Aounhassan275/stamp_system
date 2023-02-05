@extends('admin.layout.index')
@section('title')
Stamps
@endsection
@section('contents')

<form action="{{route('user.user.update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Update Profile</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id" class="form-control" value="{{Auth::user()->id}}">
                            <div class="form-group col-md-6">
                                <label class="form-label">User Name</label>
                                <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" >
                            </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" >

                            </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Country</label>
                            <select data-placeholder="Enter 'as'" name="country_id" id="country_id" class="form-control select-minimum " data-fouc>
                                <option></option>
                                <optgroup label="Countries">
                                    @foreach(App\Models\Country::all() as $country)
                                    <option @if(Auth::user()->country_id == $country->id) selected @endif value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </optgroup>
                            </select>                        
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Cities</label>
                            <select data-placeholder="Enter 'as'" name="city_id" id="city_id" class="form-control select-minimum " data-fouc>
                                <option></option>
                                <optgroup label="Cities">
                                    @foreach(App\Models\City::where('country_id',Auth::user()->country_id)->get() as $city)
                                    <option @if(Auth::user()->city_id == $city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </optgroup>
                            </select>                           
                        </div>
                    </div>
                    <div class="row">
                
                            <div class="form-group col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="number" name="phone" class="form-control" value="{{Auth::user()->phone}}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="{{Auth::user()->address}}">
                            </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Martial Status</label>
                                <select name="martial_status" id="martial_status" class="form-control">
                                    <option selected disabled>Select Martial Status</option>
                                    @foreach(App\Models\MartialStatus::all() as $martial_status)
                                    <option @if(Auth::user()->martial_status == $martial_status->name) selected @endif value="{{$martial_status->name}}">{{$martial_status->name}}</option>
                                    @endforeach
                                </select>                        
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Religion</label>
                                <select name="religion" id="religion" class="form-control">
                                    <option selected disabled>Select Religion</option>
                                    @foreach(App\Models\Religion::all() as $religion)
                                    <option @if(Auth::user()->religion == $religion->name) selected @endif value="{{$religion->name}}">{{$religion->name}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Sect.</label>
                                <input type="text" name="sect" class="form-control" placeholder="Sect"  value="{{Auth::user()->sect}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Caste</label>
                                <input type="text" name="caste" class="form-control" placeholder="Caste" value="{{Auth::user()->caste}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Gender</label>
                                <select name="gender"  class="form-control">
                                    <option selected disabled>Select Gender</option>
                                    <option @if(Auth::user()->gender == 'Male') selected @endif value="Male">Male</option>
                                    <option @if(Auth::user()->gender == 'Female') selected @endif value="Female">Female</option>
                                    <option @if(Auth::user()->gender == 'TransGender') selected @endif value="TransGender">TransGender</option>
                                </select>                                
                            </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Date Of Birth</label>
                                <input type="date" name="dob" class="form-control" placeholder="Caste" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Monthly Income</label>
                                <select name="monthly_income"  class="form-control">
                                    <option selected disabled>Select Monthly Income</option>
                                    <option @if(Auth::user()->monthly_income == 'Less Than 50,000') selected @endif value="Less Than 50,000">Less Than 50,000</option>
                                    <option @if(Auth::user()->monthly_income == '50,000 To 1 Lac') selected @endif value="50,000 To 1 Lac">50,000 To 1 Lac</option>
                                    <option @if(Auth::user()->monthly_income == '1 Lac To 2 Lac') selected @endif value="1 Lac To 2 Lac">1 Lac To 2 Lac</option>
                                    <option @if(Auth::user()->monthly_income == '2 Lac To 5 Lac') selected @endif value="2 Lac To 5 Lac">2 Lac To 5 Lac</option>
                                    <option @if(Auth::user()->monthly_income == 'More Than 5 Lac') selected @endif value="More Than 5 Lac">More Than 5 Lac</option>
                                </select>                                
                            </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Service</label>
                                <select name="service_id" id="service_id" class="form-control">
                                    <option selected disabled>Select Service</option>
                                    @foreach(App\Models\Service::all() as $service)
                                    <option @if(Auth::user()->service_id == $service->id) selected @endif value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>                        
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Type</label>
                                <select name="type_id" id="type_id" class="form-control">
                                    <option selected disabled>Select Service Type</option>
                                    @foreach(App\Models\Type::all() as $type)
                                    <option @if(Auth::user()->type_id == $type->id) selected @endif value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Blood Group</label> 
                                <select name="blood_group" id="blood_group" class="form-control">
                                    <option selected disabled>Select Blood Group</option>
                                    @foreach(App\Models\BloodGroup::all() as $blood_group)
                                    <option @if(Auth::user()->blood_group == $blood_group->name) selected @endif value="{{$blood_group->name}}">{{$blood_group->name}}</option>
                                    @endforeach
                                </select>                        
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Education</label>
                                <select name="education" id="education" class="form-control">
                                    <option selected disabled>Select Education</option>
                                    @foreach(App\Models\Education::all() as $education)
                                    <option @if(Auth::user()->education == $education->name) selected @endif value="{{$education->name}}">{{$education->name}}</option>
                                    @endforeach
                                </select>                              
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Profession</label>
                                <select name="profession" id="profession" class="form-control">
                                    <option selected disabled>Select Profession</option>
                                    @foreach(App\Models\Profession::all() as $profession)
                                    <option @if(Auth::user()->profession == $profession->name) selected @endif value="{{$profession->name}}">{{$profession->name}}</option>
                                    @endforeach
                                </select>                           
                            </div>
                    </div>
                    <p><strong>Social Links:</strong></p>
                    <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Facebook</label>
                                <input type="text" name="facebook" class="form-control" value="{{Auth::user()->facebook}}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Instagram</label>
                                <input type="text" name="instagram" class="form-control" value="{{Auth::user()->instagram}}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Whatsapp</label>
                                <input type="text" name="whatsapp" class="form-control" value="{{Auth::user()->whatsapp}}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Youtube</label>
                                <input type="text" name="youtube" class="form-control" value="{{Auth::user()->youtube}}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Linkedin</label>
                                <input type="text" name="linkedin" class="form-control" value="{{Auth::user()->linkedin}}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Twitter</label>
                                <input type="text" name="twitter" class="form-control" value="{{Auth::user()->twitter}}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Tiktok</label>
                                <input type="text" name="tiktok" class="form-control" value="{{Auth::user()->tiktok}}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Snack Video</label>
                                <input type="text" name="snack_video" class="form-control" value="{{Auth::user()->snack_video}}" >
                            </div>
                            <p><strong>Personal Informations:</strong></p>
                            <div class="form-group col-md-12">  
                                <label class="form-label">
                                    Banner Image 
                                    @if(Auth::user()->banner())
                                    <a href="{{asset(Auth::user()->banner())}}" target="_blank">
                                        <i class="icon-eye text-indigo-400 opacity-75"></i>
                                    </a>
                                    @endif
                                </label>
                                <input type="file" name="banner" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">CNIC Front
                                    @if(Auth::user()->cnicFront())
                                    <a href="{{asset(Auth::user()->cnicFront())}}" target="_blank">
                                        <i class="icon-eye text-indigo-400 opacity-75"></i>
                                    </a>
                                    @endif
                                </label>
                                <input type="file" name="cnic_front" class="form-control"  >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">CNIC Back
                                    @if(Auth::user()->cnicBack())
                                    <a href="{{asset(Auth::user()->cnicBack())}}" target="_blank">
                                        <i class="icon-eye text-indigo-400 opacity-75"></i>
                                    </a>
                                    @endif
                                </label>
                                <input type="file" name="cnic_back" class="form-control"  >
                            </div>
                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea class="form-control summernote"   name="description">{{Auth::user()->description}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label><input  @if(Auth::user()->hide_profile) checked="" @endif  type="checkbox" name="hide_profile" > Hide Profile On Website</label>
                            </div>
                    </div>
                        
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('scripts')
@endsection
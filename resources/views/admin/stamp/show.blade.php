<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ADMIN PANEL</title>
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

	@yield('styles')
</head>

<body>
    <div class="page-content">
		<div class="content-wrapper">
			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <br>
                                        <img src="{{asset('barcode.jpeg')}}" width="60%" alt="">
                                        <table class="" style="width: 100%;margin-top:3px;font-size:19px;">
                                            <tbody>
                                                <tr>
                                                    <td><strong>ID :</strong></td>
                                                    <td><strong>{{$stamp->stamp_id}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Type :</strong></td>
                                                    <td><strong>{{$stamp->type}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Amount :</strong></td>
                                                    <td><strong>{{$stamp->amount}}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="" style="width: 100%;margin-top:20px;font-size:19px;">
                                            <tbody>
                                                <tr>
                                                    <td >Description :</td>
                                                    <td>{{$stamp->description->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Applicant :</td>
                                                    <td>{{$stamp->applicant}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{$stamp->guardian_type}} :</td>
                                                    <td>{{$stamp->guardian}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Agent :</td>
                                                    <td>{{$stamp->agent}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Address :</td>
                                                    <td>{{$stamp->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Issue Date :</td>
                                                    <td>{{$stamp->issue_date->format('d-M-Y h:m:s A')}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Delisted On / Validity Date :</td>
                                                    <td>{{$stamp->issue_date->format('d-M-Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Amount In Words :</td>
                                                    <td>{{$stamp->amount_in_words}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Reason :</td>
                                                    <td>{{$stamp->reason}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Vendor Information :</td>
                                                    <td>{{$stamp->vendor->name}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <iframe src="{{$url}}" height="155" width="155" style="border:white;"></iframe>
                                        <br>
                                        <strong>Scan For Online Verification</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="border:solid 2px;">
                                        <p>نوٹ :یہ ٹرانزیکشن اجرا سے سات دنوں کے لئے قابل استعمال ہے۔ ای اسٹامپ کی تصدیق بذریعہ ویب سائٹ ، کیوآر کوڈ یا ایس ایم ایس سے کی جا سکتی ہے۔</p>
                                        <p>Type "eStamp<16 digit eStamp Number>" send to 8100</p>
                                    </div>
                                </div>
                                @if($stamp->image)
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="{{asset($stamp->image)}}" width="100%" height="100%" alt="">
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
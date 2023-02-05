<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">
    <title> {{App\Models\Setting::siteName()}} </title> 	

	<link rel="preconnect" href="{{asset('//fonts.gstatic.com/')}}" crossorigin="">

	<!-- PICK ONE OF THE STYLES BELOW -->
    <link href="{{asset('css/classic.css')}}" rel="stylesheet"> 
	<!-- <link href="{{asset('css/corporate.css')}}" rel="stylesheet"> -->
	<!-- <link href="{{asset('css/modern.css')}}" rel="stylesheet"> -->
	<script src="{{asset('js/settings.js')}}"></script>

	<!-- max="{{Auth::user()->balance>Auth::user()->package->price*0.8?Auth::user()->package->price*0.8:Auth::user()->balance}}" -->
	<!-- You can remove this after picking a style -->
	<style>
		body {
			opacity: 0;
		}
	</style>
	<!-- END SETTINGS -->
	<script>
		(function(h,o,t,j,a,r){
			h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
			h._hjSettings={hjid:1685936,hjsv:6};
			a=o.getElementsByTagName('head')[0];
			r=o.createElement('script');r.async=1;
			r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
			a.appendChild(r);
		})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>
	@toastr_css
</head>

<body>
	<main class="main d-flex justify-content-center w-100">
		<div class="container d-flex flex-column">
			<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center">
							<h1 class="display-1 font-weight-bold">{{App\Models\Setting::siteName()}}.COM</h1>
							<p class="h1">Is Under Contruction.</p>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
	<script src="{{asset('js\app.js')}}"></script>
	@toastr_js
	@toastr_render
	@yield('scripts')
</body>

</html>
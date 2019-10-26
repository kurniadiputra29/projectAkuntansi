<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Login | AccountMin - Simple Accountant Admin</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="/ProjectAkuntan/favicon.ico" type="image/x-icon" />

	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

	<link rel="stylesheet" href="/ProjectAkuntan/plugins/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/ProjectAkuntan/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="/ProjectAkuntan/plugins/ionicons/dist/css/ionicons.min.css">
	<link rel="stylesheet" href="/ProjectAkuntan/plugins/icon-kit/dist/css/iconkit.min.css">
	<link rel="stylesheet" href="/ProjectAkuntan/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
	<link rel="stylesheet" href="/ProjectAkuntan/dist/css/theme.min.css">
	<script src="/ProjectAkuntan/src/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="auth-wrapper">
	<div class="container-fluid h-100 lavalite-bg" style="background-image: url('/ProjectAkuntan/img/auth/login-unsplash.jpg')">
		<div class="row flex-row h-100">
			{{-- <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
				<div class="lavalite-bg" style="background-image: url('/ProjectAkuntan/img/auth/login-unsplash.jpg')">
					<div class="lavalite-overlay"></div>
				</div>
			</div> --}}
			<div class="col-xl-4 col-lg-6 col-md-7 mx-auto my-auto p-0 bg-white" style="opacity: 0.9">
				<div class="authentication-form mx-auto">
					<div class="logo-centered">
						<a href="/ProjectAkuntan/index.html"><img src="/ProjectAkuntan/src/img/am.svg" alt=""></a>
					</div>
					<h3>Sign In to AccountMin</h3>
					<p>Happy to see you again!</p>
					@if (session('Success'))
							<div class="alert alert-success">
								{{ session('Success') }}
							</div>
					@endif
					<form action="{{route('login.enter')}}" method="post">
						@csrf
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Email" required="">
							<i class="ik ik-user"></i>
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password" required="">
							<i class="ik ik-lock"></i>
						</div>
						<div class="row">
							<div class="col text-left">
								<label class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
									<span class="custom-control-label">&nbsp;Remember Me</span>
								</label>
							</div>
							<div class="col text-right">
								<a href="forgot-password.html">Forgot Password ?</a>
							</div>
						</div>
						<div class="sign-btn text-center">
							<button class="btn btn-theme">Sign In</button>
						</div>
						<div class="social-auth-links text-center">
						  <p></p>
						  <a href="{{ URL('social-media/register/facebook') }}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="ik ik-facebook"></i> Sign in using
						  Facebook</a>
						  <a href="{{ URL('social-media/register/google') }}" class="btn btn-block btn-social btn-google btn-flat"><i class="ik ik-mail"></i> Sign in using
						  Google+</a>
						</div>
					</form>
					<div class="register">
						<p>Don't have an account? <a href="/register">Create an account</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>window.jQuery || document.write('<script src="/ProjectAkuntan/src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<script src="/ProjectAkuntan/plugins/popper.js/dist/umd/popper.min.js"></script>
<script src="/ProjectAkuntan/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/ProjectAkuntan/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="/ProjectAkuntan/plugins/screenfull/dist/screenfull.js"></script>
<script src="/ProjectAkuntan/dist/js/theme.js"></script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
	(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
		function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
	e=o.createElement(i);r=o.getElementsByTagName(i)[0];
	e.src='https://www.google-analytics.com/analytics.js';
	r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
	ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>
</html>

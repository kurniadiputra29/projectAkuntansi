<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Sign Up | AccountMin - Simple Accountant Admin</title>
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
	<div class="container-fluid h-100 lavalite-bg" style="background-image: url('/ProjectAkuntan/img/auth/reg-unsplash.jpg')">
		<div class="row flex-row h-100">
			<div class="col-xl-4 col-lg-6 col-md-7 mx-auto my-auto p-0 bg-white" style="opacity: 0.9">
				<div class="authentication-form mx-auto">
					<div class="logo-centered">
						<a href="/ProjectAkuntan/index.html"><img src="/ProjectAkuntan/src/img/am.svg" alt=""></a>
					</div>
					<h3>New to AccountMin</h3>
					<p>Join us today! It takes only few steps</p>
					@if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			    @endif
					<form action="{{route('input.register')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<input type="text" name="nama" class="form-control" placeholder="Nama" required="">
							<i class="ik ik-user-plus"></i>
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Email" required="">
							<i class="ik ik-user"></i>
						</div>
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
							<i class="ik ik-lock"></i>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="retri" placeholder="Confirm Password" required="">
							<i class="ik ik-eye-off"></i>
						</div>
						{{-- <div class="form-group">
							<input type="file" name="foto" class="form-control" >
							<i class="ik ik-camera"></i>
						</div> --}}
						<div class="form-group">
								<input type="file" name="foto" class="file-upload-default">
								<div class="input-group col-xs-12">
										<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
										<span class="input-group-append">
										<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
										</span>
										<i class="ik ik-camera"></i>
								</div>
						</div>
						<div class="row">
							<div class="col-12 text-left">
								<label class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
									<span class="custom-control-label">&nbsp;I Accept <a href="#">Terms and Conditions</a></span>
								</label>
							</div>
						</div>
						<div class="sign-btn text-center">
							<button class="btn btn-theme" id="submit">Create Account</button>
						</div>
					</form>
					<div class="register">
						<p>Already have an account? <a href="/login">Sign In</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>window.jQuery || document.write('<script src="/ProjectAkuntan/src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<script>
  $(function () {
    $("#submit").click( function() {
      var password = $("#password").val();
      var retri = $("#retri").val();
      if (password != retri) {
        alert("Passwords do not match !!");
        return false;
      }
      return true;
    });
  })
</script>
<script src="/ProjectAkuntan/plugins/popper.js/dist/umd/popper.min.js"></script>
<script src="/ProjectAkuntan/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/ProjectAkuntan/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="/ProjectAkuntan/plugins/screenfull/dist/screenfull.js"></script>
<script src="/ProjectAkuntan/dist/js/theme.js"></script>
<script src="/ProjectAkuntan/js/form-components.js"></script>
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

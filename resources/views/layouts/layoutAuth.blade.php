<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="../../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		{{ config('app.name', 'Laravel') }}
	</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<!-- CSS Files -->
	<link href="../../assets/css/material-dashboard.css?v=2.2.2" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="../../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="off-canvas-sidebar">
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
		<div class="container">
			<div class="navbar-wrapper">
				<a class="navbar-brand" href="javascript:;">Login Page</a>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
				<span class="sr-only">Toggle navigation</span>
				<span class="navbar-toggler-icon icon-bar"></span>
				<span class="navbar-toggler-icon icon-bar"></span>
				<span class="navbar-toggler-icon icon-bar"></span>
			</button>
			<!-- <div class="collapse navbar-collapse justify-content-end">
				<ul class="navbar-nav">
					<li class="nav-item  active ">
						<a href="../pages/login.html" class="nav-link">
							<i class="material-icons">fingerprint</i>
							Login
						</a>
					</li>
				</ul>
			</div> -->
		</div>
	</nav>
	<!-- End Navbar -->
	@yield('content')
	<!--   Core JS Files   -->
	<script src="../../assets/js/core/jquery.min.js"></script>
	<script src="../../assets/js/core/popper.min.js"></script>
	<script src="../../assets/js/core/bootstrap-material-design.min.js"></script>
	<script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
	<!--  Google Maps Plugin    -->
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
	<!-- Chartist JS -->
	<script src="../../assets/js/plugins/chartist.min.js"></script>
	<!--  Notifications Plugin    -->
	<script src="../../assets/js/plugins/bootstrap-notify.js"></script>
	<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
	<script src="../../assets/js/material-dashboard.js?v=2.2.2" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			md.checkFullPageBackgroundImage();
			setTimeout(function() {
				// after 1000 ms we add the class animated to the login/register card
				$('.card').removeClass('card-hidden');
			}, 700);
		});
	</script>
	@yield('script')
	
</body>

</html>
@extends('layouts.layoutAuth')
@section('content')

<div class="wrapper wrapper-full-page">
	<div class="page-header login-page header-filter" filter-color="black" style="background-image: url('../../assets/img/login.jpg'); background-size: cover; background-position: top center;">
		<!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
					<form class="form" method="POST" action="{{ route('login') }}">
						@csrf
						<div class="card card-login card-hidden">
							<div class="card-header card-header-rose text-center">
								<h4 class="card-title">{{ __('Login') }}</h4>
							</div>
							<div class="card-body ">
								<span class="bmd-form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="material-icons">email</i>
											</span>
										</div>
										<input type="email" class="form-control" placeholder="Email..." name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
									</div>
								</span>
								<span class="bmd-form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="material-icons">lock_outline</i>
											</span>
										</div>
										<input type="password" class="form-control" placeholder="Password..."  name="password" required autocomplete="current-password">
									</div>
								</span>
							</div>
							<div class="card-footer justify-content-center">
								<button type="submit" class="btn btn-rose btn-link btn-lg">{{ __('Login') }}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<nav class="float-left">
					<!-- <ul>
						<li>
							<a href="https://www.creative-tim.com">
								Creative Tim
							</a>
						</li>
						<li>
							<a href="https://creative-tim.com/presentation">
								About Us
							</a>
						</li>
						<li>
							<a href="http://blog.creative-tim.com">
								Blog
							</a>
						</li>
						<li>
							<a href="https://www.creative-tim.com/license">
								Licenses
							</a>
						</li>
					</ul> -->
				</nav>
				<div class="copyright float-right">
					&copy;
					<script>
						document.write(new Date().getFullYear())
					</script>
					<!-- , made with <i class="material-icons">favorite</i> by
					<a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web. -->
				</div>
			</div>
		</footer>
	</div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../../assets/js/plugins/bootstrap-notify.js"></script>
<script type="text/javascript">

	var message = ""
	@error('email')
	setTimeout(function () { 
		showNotification('top','center')
	}, 1000);
	message = "{{$message}}"
	@enderror

	function showNotification(from, align) {
		$.notify({
			icon: "close",
			message: "<b>Somthing error </b><br>" + message

		}, {
			type: 'danger',
			timer: 3000,
			placement: {
				from: from,
				align: align
			}
		});
	}
</script>
@endsection
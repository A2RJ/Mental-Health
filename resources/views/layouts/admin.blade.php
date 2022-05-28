<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ env('APP_NAME') }} - @yield('title')</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/bootstrap/css/bootstrap.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/font-awesome/css/font-awesome.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/Ionicons/css/ionicons.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/iCheck/all.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/select2/css/select2.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/select2/css/select2-bootstrap.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/datepicker/css/bootstrap-datepicker3.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables/datatables.net-bs/css/dataTables.bootstrap.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/admin-lte/css/AdminLTE.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/admin-lte/css/skins/_all-skins.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="{{ asset('admin-lte/css/app.css', ENV('SSL_FLAG')) }}">

		<style type="text/css">
			.loader {
			  border: 16px solid #f3f3f3;
			  border-radius: 50%;
			  border-top: 16px solid blue;
			  border-bottom: 16px solid blue;
			  width: 60px;
			  height: 60px;
			  -webkit-animation: spin 2s linear infinite;
			  animation: spin 2s linear infinite;
			}

			@-webkit-keyframes spin {
			  0% { -webkit-transform: rotate(0deg); }
			  100% { -webkit-transform: rotate(360deg); }
			}

			@keyframes spin {
			  0% { transform: rotate(0deg); }
			  100% { transform: rotate(360deg); }
			}
		</style>
		@yield('contentCss')
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<a href="{{ url('/') }}" class="logo" target="_blank">
					<span class="logo-mini"><b>X</b></span>
					<span class="logo-lg">
						<b>Mental<span> Health.</span></b>
					</span>
				</a>
				<nav class="navbar navbar-static-top">
					<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<span class="hidden-xs">{{ Auth::User()->email }}</span>
								</a>
								<ul class="dropdown-menu">
									<li class="user-header">
										<p>
											{{ Auth::User()->email }}
										</p>
									</li>
									<li class="user-footer">
										<div class="row">
											<div class="col-md-5">
												<a href="{{ route('sign.out') }}" class="btn btn-block btn-default">Logout</a>
											</div>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<aside class="main-sidebar">
				@include('layouts.sidebar')
			</aside>
			<div class="content-wrapper">
				<section class="content main-content">
					<div class="box box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">@yield('title')</h3>
						</div>
						<div class="box-body" style="min-height: 550px;">
							<div id="mainAlert"></div>
							@yield('content')
						</div>
					</div>
				</section>
			</div>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 1.0.1
				</div>
				{{ date('Y') }} &copy; Created by <strong><span><a href="http://sonyamin58.com/">Gelar Family Engineer</a></span></strong>.
			</footer>
		</div>
		<script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/bootstrap/js/bootstrap.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/jquery-slimscroll/jquery.slimscroll.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/fastclick.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/admin-lte/js/adminlte.min.js', ENV('SSL_FLAG')) }}"></script>

		<script src="{{ asset('admin-lte/plugins/moment.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/iCheck/icheck.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/select2/js/select2.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/datepicker/js/bootstrap-datepicker.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/datatables/datatables.net/js/jquery.dataTables.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/datatables/datatables.net-bs/js/dataTables.bootstrap.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/jquery.blockUI.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/js/app.js', ENV('SSL_FLAG')) }}"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
		<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
		@yield('contentJs')
	</body>
</html>

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
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/admin-lte/css/AdminLTE.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('admin-lte/plugins/iCheck/square/blue.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

		<link rel="stylesheet" href="{{ asset('admin-lte/css/app.css', ENV('SSL_FLAG')) }}">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href=""><b>Mental</b> Health.</a>
			</div>
			<div class="login-box-body main-content">
				<div id="mainAlert" style="display: none;"></div>
				@yield('content')
			</div>
		</div>
		<script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/bootstrap/js/bootstrap.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/iCheck/icheck.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/moment.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/select2/js/select2.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/datepicker/js/bootstrap-datepicker.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/plugins/jquery.blockUI.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('admin-lte/js/app.js', ENV('SSL_FLAG')) }}"></script>
		<script>
			$(document).ready(function(){
				$('input[id]:not([name])', '.main-content').attr('name', function(){ 
					if( this.id != undefined ){ return this.id; }
				});
			});
			
			$(function () {
			  $('input').iCheck({
			    checkboxClass: 'icheckbox_square-blue',
			    radioClass: 'iradio_square-blue',
			    increaseArea: '20%' /* optional */
			  });
			});
		</script>
		
		@yield('contentJs')
	</body>
</html>
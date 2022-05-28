<?php
	$currentAction = Route::currentRouteAction();
	list($controller, $method) = explode('@', $currentAction);
	$controller = str_replace("App\\Http\\Controllers\\Admin\\", "", $controller);
?>
<section class="sidebar">
	<ul class="sidebar-menu" data-widget="tree">
		<li class="header">MAIN NAVIGATION</li>
		<li class="{{ ($controller=='DashboardController'?'active':'') }}">
			<a href="{{ route('admin.index') }}">
			<i class="fa fa-dashboard"></i> <span>Dashboard</span>
			</a>
		</li>
		
		<li class="{{ ($controller=='LocationController'?'active':'') }}">
			<a href="{{ route('location.index') }}">
			<i class="fa fa-building"></i> <span>Location RS</span>
			</a>
		</li>

		<li class="{{ ($controller=='CountryController'?'active':'') }}">
			<a href="{{ route('countries.index') }}">
			<i class="fa fa-flag"></i> <span>Negara</span>
			</a>
		</li>

		<li class="{{ ($controller=='ProvinceController'?'active':'') }}">
			<a href="{{ route('provinces.index') }}">
			<i class="fa fa-map-marker"></i> <span>Provinsi</span>
			</a>
		</li>

		<li class="{{ ($controller=='PasienController'?'active':'') }}">
			<a href="{{ route('pasiens.index') }}">
			<i class="fa fa-users"></i> <span>Pasien</span>
			</a>
		</li>
	</ul>
</section>
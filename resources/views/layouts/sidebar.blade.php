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
	</ul>
</section>
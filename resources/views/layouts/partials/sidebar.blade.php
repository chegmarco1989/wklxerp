<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

	<a href="{{route('home')}}" class="logo">
		<?php // <span class="logo-lg">{{ Session::get('business.name') }}</span> ?>
		<span class="logo-lg logomobilestyled"> {{ config('app.name', 'Worklx ERP') }} </span>
	</a>
	
	<!-- Sidebar Menu -->
	
	<div class="row smenu-row" style="width: 100%; margin-right: 0px; margin-left: 15px;">
        <div class="btnPrev col-md-1 col-sm-1 col-xs-1" id="btn-menu-nav-previous" style="width: 4%">
			<!-- COUROUSEL ICONS "PRECEDENT" POUR MENU: -->
			<i class="fa fas fa-arrow-alt-circle-left menu-icon"></i>
		</div>
        <div id="menu-nav-horizontal" class="menu-inner-box col-md-10 col-sm-10 col-xs-10" style="padding-left: 1.5px;box-shadow: 5px 0 15px -4px rgba(86, 134, 194, 0.8), -5px 0 8px -5px rgba(126, 164, 211, 0.8);">
			{!! Menu::render('admin-sidebar-menu', 'adminltecustom'); !!}
		</div>
        <div class="btnNext col-md-1 col-sm-1 col-xs-1" id="btn-menu-nav-next" style="width: 5%">
			<!-- COUROUSEL ICONS "SUIVANT" POUR MENU: -->
			<i class="fa fas fa-arrow-alt-circle-right menu-icon" style=""></i>
		</div>
    </div>

    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

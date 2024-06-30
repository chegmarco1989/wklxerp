@inject('request', 'Illuminate\Http\Request')
<!-- Main Header -->
  <header class="main-header no-print">
    <a href="{{route('home')}}" class="logo" style="width: 255px;">
		<?php // <span class="logo-lg logodashbordstyled">{{ Session::get('business.name') }} <i class="fa fa-circle text-success" id="online_indicator"></i></span> ?>
		<span class="logo-lg logodashbordstyled">{{ config('app.name', 'Worklx ERP') }}  <i class="fa fa-circle text-success" id="online_indicator"></i></span> 
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			&#9776;
			<span class="sr-only">Toggle navigation</span>
		</a>

      @if(Module::has('Superadmin'))
        @includeIf('superadmin::layouts.partials.active_subscription')
      @endif

        @if(!empty(session('previous_user_id')) && !empty(session('previous_username')))
            <a href="{{route('sign-in-as-user', session('previous_user_id'))}}" class="btn btn-flat btn-danger m-8 btn-sm mt-10"><i class="fas fa-undo"></i> @lang('lang_v1.back_to_username', ['username' => session('previous_username')] )</a>
        @endif

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
	  
		<!-- POUR LE MOTEUR DE RECHERCHE DES "max-width: 766px" -->
		<div class="most-small-screen navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="small-screen-search dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fas fa-search"></i>
					</a>
					<ul class="searchtopbar dropdown-menu">
						<li>
							<!-- The search form will be appended here using JavaScript -->
							<div id="searchForm" class="input-group">
								<input type="search" class="form-control menuFilterInput" onkeyup="menuFilterFunction(this)" placeholder="{{__('lang_v1.search')}}...">
								<span class="input-group-btn">
									<button type="button" class="btn btn-default" id="searchBtn">
										<i class="fas fa-search"></i>
									</button>
								</span>
								<div class="dropdown-content"></div>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- FIN FORMULAIRE DE RECHERCHE AU NIVEAU DE L'EN-TÊTE (AJOUTE) POUR LES ECRANS DE "max-width: 766px" -->
		
		<!-- DEBUT FORMULAIRE DE RECHERCHE AU NIVEAU DE L'EN-TÊTE (AJOUTE) POUR LES ECRANS MAXIMUM "1129px" DE LARGEUR: -->
		<div class="searchbar dropdown-container">
			<input class="search_input menuFilterInput" type="text" name="" onkeyup="menuFilterFunction(this)" placeholder="{{__('lang_v1.search')}}...">
			<span class="search_icon"><i class="fas fa-search"></i></span>
			<div class="dropdown-content"></div>
		</div>
		<!-- FIN FORMULAIRE DE RECHERCHE AU NIVEAU DE L'EN-TÊTE (AJOUTE) -->
		
		<!-- DEBUT FORMULAIRE DE RECHERCHE AU NIVEAU DE L'EN-TÊTE (AJOUTE) POUR LES ECRANS MINIMUM "1130px" DE LARGEUR: -->
		<div class="form-group has-feedback header-search-form">
			<span class="glyphicon glyphicon-search form-control-feedback"></span>
			<input type="search" class="form-control header-search-input menuFilterInput" onkeyup="menuFilterFunction(this)" placeholder="{{__('lang_v1.search')}}...">
			<div class="dropdown-content"></div>
		</div>
		<!-- FIN FORMULAIRE DE RECHERCHE AU NIVEAU DE L'EN-TÊTE (AJOUTE) POUR LES ECRANS DE "max-width: 1129px" -->

		<?php /* <div class="gtranslate_wrapper" style="color: white"></div>
			<script>window.gtranslateSettings = {"default_language":"en","native_language_names":true,"detect_browser_language":true,"url_structure":"sub_directory","wrapper_selector":".gtranslate_wrapper","flag_size":24,"flag_style":"3d"}</script>
			// <script>window.gtranslateSettings = {"default_language":"en","native_language_names":true,"detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper","flag_size":24,"flag_style":"3d"}</script>
			
        <script src="{{ asset('translator/GTranslate-IO-Popup.js') }}" defer></script>
		*/ ?>

        @if(Module::has('Essentials'))
          @includeIf('essentials::layouts.partials.header_part')
        @endif
		
        <a href="{{url('/meet')}}" style="color: white">
			<button id="" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.videomeeting')" type="button" class="btn btn-warning btn-flat pull-left m-8 btn-sm mt-10 popover-default" data-toggle="popover" data-trigger="click" data-content='@include("layouts.partials.calculator")' data-html="true" data-placement="bottom">
				<strong><i class="fas fa-video fa-lg"></i></strong>
			</button>
		</a>
        <div class="btn-group">
          <button id="header_shortcut_dropdown" type="button" class="btn btn-success dropdown-toggle btn-flat pull-left m-8 btn-sm mt-10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-plus-circle fa-lg"></i>
          </button>
          <ul class="dropdown-menu">
            @if(config('app.env') != 'demo')
              <li><a href="{{route('calendar')}}">
                  <i class="fas fa-calendar-alt" aria-hidden="true"></i> @lang('lang_v1.calendar')
              </a></li>
            @endif
            @if(Module::has('Essentials'))
              <li><a href="#" class="btn-modal" data-href="{{action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'create'])}}" data-container="#task_modal">
                  <i class="fas fa-clipboard-check" aria-hidden="true"></i> @lang( 'essentials::lang.add_to_do' )
              </a></li>
            @endif
            <!-- Help Button -->
            @if(auth()->user()->hasRole('Admin#' . auth()->user()->business_id))
              <li><a id="start_tour" href="#" style="display: none;">
                  <i class="fas fa-question-circle" aria-hidden="true"></i> @lang('lang_v1.application_tour')
              </a></li>
            @endif
          </ul>
        </div>
        <button id="btnCalculator" title="@lang('lang_v1.calculator')" type="button" class="btn btn-success btn-flat pull-left m-8 btn-sm mt-10 popover-default hidden-xs" data-toggle="popover" data-trigger="click" data-content='@include("layouts.partials.calculator")' data-html="true" data-placement="bottom">
            <strong><i class="fa fa-calculator fa-lg" aria-hidden="true"></i></strong>
        </button>
        
        @if($request->segment(1) == 'pos')
          @can('view_cash_register')
          <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-success btn-flat pull-left m-8 btn-sm mt-10 btn-modal" data-container=".register_details_modal" 
          data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getRegisterDetails'])}}">
            <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
          </button>
          @endcan
          @can('close_cash_register')
          <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-danger btn-flat pull-left m-8 btn-sm mt-10 btn-modal" data-container=".close_register_modal" 
          data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getCloseRegister'])}}">
            <strong><i class="fa fa-window-close fa-lg"></i></strong>
          </button>
          @endcan
        @endif

        @if(in_array('pos_sale', $enabled_modules))
          @can('sell.create')
            <a href="{{action([\App\Http\Controllers\SellPosController::class, 'create'])}}" title="@lang('sale.pos_sale')" data-toggle="tooltip" data-placement="bottom" class="btn btn-flat pull-left m-8 btn-sm mt-10 btn-success">
              <strong><i class="fa fa-th-large"></i> &nbsp; @lang('sale.pos_sale')</strong>
            </a>
          @endcan
        @endif

        @if(Module::has('Repair'))
          @includeIf('repair::layouts.partials.header')
        @endif

        @can('profit_loss_report.view')
          <button type="button" id="view_todays_profit" title="{{ __('home.todays_profit') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-success btn-flat pull-left m-8 btn-sm mt-10">
            <strong><i class="fas fa-money-bill-alt fa-lg"></i></strong>
          </button>
        @endcan

        <div class="m-8 pull-left mt-15 hidden-xs ojdwdate" style="color: #fff;"><strong>{{ @format_date('now') }}</strong></div>

        <ul class="nav navbar-nav">
          @include('layouts.partials.header-notifications')
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              @php
                $profile_photo = auth()->user()->media;
              @endphp
              @if(!empty($profile_photo))
                <img src="{{$profile_photo->display_url}}" class="user-image" alt="User Image">
              @endif
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span>{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                @if(!empty(Session::get('business.logo')))
                  <img src="{{ asset( 'uploads/business_logos/' . Session::get('business.logo') ) }}" alt="Logo">
                @endif
                <p>
                  {{ Auth::User()->first_name }} {{ Auth::User()->last_name }}
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{action([\App\Http\Controllers\UserController::class, 'getProfile'])}}" class="btn btn-default btn-flat">@lang('lang_v1.profile')</a>
                </div>
                <div class="pull-right">
                  <a href="{{action([\App\Http\Controllers\Auth\LoginController::class, 'logout'])}}" class="btn btn-default btn-flat">@lang('lang_v1.sign_out')</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
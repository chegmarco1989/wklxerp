@inject('request', 'Illuminate\Http\Request')

@if($request->segment(1) == 'pos' && ($request->segment(2) == 'create' || $request->segment(3) == 'edit'
 || $request->segment(2) == 'payment'))
    @php
        $pos_layout = true;
    @endphp
@else
    @php
        $pos_layout = false;
    @endphp
@endif

@php
    $whitelist = ['127.0.0.1', '::1'];
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ? 'rtl' : 'ltr'}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
		
		<!-- ICON NAVIGATEUR -->
		<link rel="icon" href="{{ asset('img/worklx-icon.png') }}">

        <title>@yield('title') - {{ Session::get('business.name') }} | {{ config('app.name') }}</title>
		
		<!-- /* ON AJOUTE ICI UN FONT (Police de caractère) POUR STYLISISER NOTRE LOGO */ -->
		<style type="text/css">
			@font-face {
				font-family: "TESLA Regular";
				src: url('{{ url('fonts/TESLA Regular/TESLA Regular.eot') }}?#iefix') format('embedded-opentype'), 				/* IE6-IE8 */
					 url('{{ url('fonts/TESLA Regular/TESLA Regular.woff2') }}') format('woff2'), 								/* Super Modern Browsers */
					 url('{{ url('fonts/TESLA Regular/TESLA Regular.woff') }}') format('woff'), 								/* Pretty Modern Browsers */
					 url('{{ url('fonts/TESLA Regular/TESLA Regular.ttf') }}') format('truetype'), 								/* Safari, Android, iOS */
					 url('{{ url('fonts/TESLA Regular/TESLA Regular.svg#TESLA Regular') }}') format('svg'); 					/* Legacy iOS */
			}

			.logodashbordstyled {
        		font-family: TESLA Regular; 
				position: absolute; 
				margin-left: -8px;
				font-weight: bold;
        	}
			.logomobilestyled {
				font-family: TESLA Regular;
				position: absolute;
				margin-left: -100px;
				font-size: 27px;
				font-weight: bold;
			}
		</style>
		
		<style>
			<!-- CSS AJOUTE POUR LE FORMULAIRE DE RECHERCHE AU NIVEAU DE L'EN-TÊTE: -->
			.autocomplete {
				position: relative;
				display: inline-block;
			}

			.dropdown {
				position: relative;
				display: inline-block;
			}

			.dropdown-content {
				position: absolute;
				list-style: none;
				top: 100%;
				/* left: 0; */
				/* right: 0; */
				z-index: 1;
				background-color: #f1f1f1;
				min-width: 150px;
				max-height: 250px;
				overflow-y: scroll;
				border: 1px solid #ddd;
				border-top: none;
			}

			.dropdown-content a {
				color: black;
				padding: 12px 16px;
				text-decoration: none;
				display: block;
			}

			.dropdown-content a:hover {
				background-color: #2b80ec;
				color: #ffffff;
			}

			.dropdown-content.show {
				display: block;
			}
				
			@media (max-width: 1129px) {
				.searchbar {
					margin-bottom: auto;
					margin-top: auto;
					height: 40px;
					background-color: #f7f8fa;
					border-radius: 30px;
					padding: 10px;
				}
				.search_input {
					color: #555;
					border: 0;
					outline: 0;
					background: none;
					width: 0;
					caret-color: transparent;
					line-height: 30px;
					transition: width 0.4s linear;
					margin-top: -7px;
				}
				.searchbar:hover > .search_icon {
					background: white;
					color: #e74c3c;
					display: none;
				}
				.search_icon {
					height: 30px;
					width: 30px;
					float: right;
					display: flex;
					justify-content: center;
					align-items: center;
					border-radius: 50%;
					color: #2b80ec;
					text-decoration: none;
					margin-top: -5px;
				}
				
				.dropdown-content {
					display: none;
				}
				
				.ojdwdate {
					display: none;
				}
				
				.btn.bg-blue.btn-flat.pull-left.m-8.btn-sm.mt-10.clock_in_btn {
					display: none;
				}
			}

			@media (max-width: 766px) {
				/* Add this to your existing CSS or create a new stylesheet */
				.input-group {
					width: 100%;
				}
				.input-group-btn {
					width: 100%;
					display: block;
				}
				
				ul.searchtopbar.dropdown-menu {
				  top: 3px;
				}

				.menuFilterInput {
				  border: 1px solid #ccc;
				  padding: 10px;
				  width: 100%;
				}
			}
				
			/* Styles spécifiques à l'écran max-width: 767px */
			@media (min-width: 767px) {
				.small-screen-search.dropdown.user.user-menu {
				  display: none;
				}
				
				.logodashbordstyled {
					font-family: TESLA Regular;
					position: absolute;
					margin-left: -8px;
					font-weight: bold;
					font-size: 30px;
				}
			}

			/* Styles spécifiques à l'écran max-width: 1099px */

			@media (max-width: 1099px) {
				.searchbar {
					display: none;
				}
			}
				
			/* Styles spécifiques à l'écran max-width: 1119px */

			@media (min-width: 1100px) and (max-width: 1119px) {
				.header-search-form {
					display: none;
				}
				
				.searchbar:hover > .search_input {
					border: 1px solid #ccc;
					padding: 0 10px;
					width: 140px;
					caret-color: red;
					transition: width 0.4s linear;
				}
				
				.dropdown-content {
					width: 140px;
				}
			}
			
			/* Styles spécifiques à l'écran max-width: 1129px */

			@media (min-width: 1120px) and (max-width: 1129px) {
				.header-search-form {
					display: none;
				}
				
				.searchbar:hover > .search_input {
					border: 1px solid #ccc;
					padding: 0 10px;
					width: 165px;
					caret-color: red;
					transition: width 0.4s linear;
				}
				
				.dropdown-content {
					width: 165px;
				}
			}

			/* Styles spécifiques à l'écran max-width: 1221px */

			@media (min-width: 1130px) and (max-width: 1221px) {
				.searchbar {
					display: none;
				}
				
				.header-search-form {
					width: 180px;
					bottom: -8px;
				}
			  
				.menuFilterInput {
					border: 1px solid #ccc;
					padding: 10px;
					width: 180px;
				}
				
				.dropdown-content {
					width: 180px;
				}
				
			}

			/* Styles spécifiques à l'écran min-width: 1222px */

			@media (min-width:1222px){
				.searchbar {
					display: none;
				}
				
				.header-search-form{
					/* margin-right: 115px; */
					width: 250px;
					bottom: -8px;
				}

				.menuFilterInput {
				  border: 1px solid #ccc;
				  padding: 10px;
				  width: 250px;
				}
				
				.dropdown-content {
					width: 250px;
				}
				
			}
			<!-- FIN CSS AJOUTE POUR LE FORMULAIRE DE RECHERCHE AU NIVEAU DE L'EN-TÊTE -->
		
			<!-- /* CSS ajouté POUR CACHER LA BANDE DE DEFINALEMENT AU NIVEAU DES MENUS. "menu-inner-box" est pour la "div" dans "sidebar.blade.php": */ -->
			@media (max-width:767px){
				.menu-inner-box {
				  
				}
			}
			@media (min-width:768px){
				.menu-inner-box {
				  overflow: hidden;	
				}
			}
			
			.menu-icon{
				font-size: 35px; 
				cursor: pointer; 
				color: #2b80ec; 
			}
			.fa-arrow-alt-circle-left:hover{
				color: skyblue;
			}
			.fa-arrow-alt-circle-right:hover{
				color: skyblue;
			}
		
			@media (min-width: 768px) and (max-width: 1249px) { 
				div.row.smenu-row{
					width: 100%;
					margin-left: 17px;
				}
				div#menu-nav-horizontal {
					width: 85%;
					  padding-left: 1.5px;
					  box-shadow: 5px 0 15px -4px rgba(86, 134, 194, 0.8), -5px 0 8px -5px rgba(126, 164, 211, 0.8);
					  margin-left: -10px;
				}
				#btn-menu-nav-previous {
					width: 5%;
					left: -16px;
					margin-right: 15px;
					padding-left: 10px;
				}
				
				#btn-menu-nav-next {
					
				}
			}
			
			@media (min-width: 1250px){ 
				div#menu-nav-horizontal {
					width: 90%;
				}
			}
        </style>
		
        @include('layouts.partials.css')

        @yield('css')
    </head>

    <body class="@if($pos_layout) hold-transition lockscreen @else hold-transition skin-@if(!empty(session('business.theme_color'))){{session('business.theme_color')}}@else{{'blue-light'}}@endif sidebar-mini @endif">
        <div class="wrapper thetop">
            <script type="text/javascript">
                if(localStorage.getItem("upos_sidebar_collapse") == 'true'){
                    var body = document.getElementsByTagName("body")[0];
                    body.className += " sidebar-collapse";
                }
            </script>
            @if(!$pos_layout)
                @include('layouts.partials.header')
                @include('layouts.partials.sidebar')
            @else
                @include('layouts.partials.header-pos')
            @endif

            @if(in_array($_SERVER['REMOTE_ADDR'], $whitelist))
                <input type="hidden" id="__is_localhost" value="true">
            @endif

            <!-- Content Wrapper. Contains page content -->
            <div class="@if(!$pos_layout) content-wrapper @endif">
                <!-- empty div for vuejs -->
                <div id="app">
                    @yield('vue')
                </div>
                <!-- Add currency related field-->
                <input type="hidden" id="__code" value="{{session('currency')['code']}}">
                <input type="hidden" id="__symbol" value="{{session('currency')['symbol']}}">
                <input type="hidden" id="__thousand" value="{{session('currency')['thousand_separator']}}">
                <input type="hidden" id="__decimal" value="{{session('currency')['decimal_separator']}}">
                <input type="hidden" id="__symbol_placement" value="{{session('business.currency_symbol_placement')}}">
                <input type="hidden" id="__precision" value="{{session('business.currency_precision', 2)}}">
                <input type="hidden" id="__quantity_precision" value="{{session('business.quantity_precision', 2)}}">
                <!-- End of currency related field-->
                @can('view_export_buttons')
                    <input type="hidden" id="view_export_buttons">
                @endcan
                @if(isMobile())
                    <input type="hidden" id="__is_mobile">
                @endif
                @if (session('status'))
                    <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
                @endif
                @yield('content')

                <div class='scrolltop no-print'>
                    <div class='scroll icon'><i class="fas fa-angle-up"></i></div>
                </div>

                @if(config('constants.iraqi_selling_price_adjustment'))
                    <input type="hidden" id="iraqi_selling_price_adjustment">
                @endif

                <!-- This will be printed -->
                <section class="invoice print_section" id="receipt_section">
                </section>
                
            </div>
            @include('home.todays_profit_modal')
            <!-- /.content-wrapper -->

            @if(!$pos_layout)
                @include('layouts.partials.footer')
            @else
                @include('layouts.partials.footer_pos')
            @endif

            <audio id="success-audio">
              <source src="{{ asset('/audio/success.ogg?v=' . $asset_v) }}" type="audio/ogg">
              <source src="{{ asset('/audio/success.mp3?v=' . $asset_v) }}" type="audio/mpeg">
            </audio>
            <audio id="error-audio">
              <source src="{{ asset('/audio/error.ogg?v=' . $asset_v) }}" type="audio/ogg">
              <source src="{{ asset('/audio/error.mp3?v=' . $asset_v) }}" type="audio/mpeg">
            </audio>
            <audio id="warning-audio">
              <source src="{{ asset('/audio/warning.ogg?v=' . $asset_v) }}" type="audio/ogg">
              <source src="{{ asset('/audio/warning.mp3?v=' . $asset_v) }}" type="audio/mpeg">
            </audio>
        </div>

        @if(!empty($__additional_html))
            {!! $__additional_html !!}
        @endif

        @include('layouts.partials.javascripts')

        <div class="modal fade view_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>

        @if(!empty($__additional_views) && is_array($__additional_views))
            @foreach($__additional_views as $additional_view)
                @includeIf($additional_view)
            @endforeach
        @endif
    </body>

</html>
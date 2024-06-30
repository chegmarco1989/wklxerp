<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
		
	<!-- ICON NAVIGATEUR -->
	<link rel="icon" href="{{ asset('img/worklx-icon.png') }}">

    <title>@yield('title') - {{ config('app.name', 'Worklx ERP') }}</title> 

    @include('layouts.partials.css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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

		.logostyled {
        	font-family: TESLA Regular; 
        	font-size: 55px;
        
        	/* Fallback: Set a background color. */
			/* background: #ADA996; */  /* fallback for old browsers */
  
			/* Create the gradient. */
			/* background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); */ /* Chrome 10-25, Safari 5.1-6 */
			/* background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); */ /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

			/* Set the background size and repeat properties. */
			/* background-size: 100%; */
			/* background-repeat: repeat; */

			/* Use the text as a mask for the background. */
			/* This will show the gradient as a text color rather than element bg. */
			/* -webkit-background-clip: text; */
			/* -webkit-text-fill-color: transparent;  */
			/* -moz-background-clip: text; */
			/* -moz-text-fill-color: transparent; */
        }
		
		.registerbuttonstyle {
			@media (max-width: 766px) {
				text-align: left;
				padding-top: 50px;
				margin-left: 11px;
			}
			@media (min-width: 767px) {
				text-align: right;
				padding-top: 10px;
			}
		}
	</style>
</head>

<body>
    @inject('request', 'Illuminate\Http\Request')
    @if (session('status') && session('status.success'))
        <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
    @endif
    <div class="container-fluid">
        <div class="row eq-height-row">
            <div class="col-md-5 col-sm-5 hidden-xs left-col eq-height-col" >
                <div class="left-col-content login-header"> 
                    <div style="margin-top: 50%;">
                    <a href="/">
                    @if(file_exists(public_path('uploads/logo.png')))
                        <img src="/uploads/logo.png" class="img-rounded" alt="Logo" width="150">
                    @else
                       <span class="logostyled">{{ config('app.name', 'Worklx ERP') }}</span>
                    @endif 
                    </a>
                    <br/>
                    @if(!empty(config('constants.app_title')))
                        <?php // <small style="color: yellow">{{config('constants.app_title')}}</small> ?>
						<small style="color: yellow; font-size: 80%; font-family: math;">{{ __('custom.auth_left_desc') }}</small>
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12 right-col eq-height-col">
                <div class="row">
                <div class="col-md-3 col-xs-4" style="text-align: left;">
                    <select class="form-control input-sm" id="change_lang" style="margin: 10px;">
                    @foreach(config('constants.langs') as $key => $val)
                        <option value="{{$key}}" 
                            @if( (empty(request()->lang) && config('app.locale') == $key) 
                            || request()->lang == $key) 
                                selected 
                            @endif
                        >
                            {{$val['full_name']}}
                        </option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-xs-8" style="text-align: right;padding-top: 20px;">
                    @if(!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
                        @if(config('constants.allow_registration'))
                            @if(Route::has('pricing') && config('app.env') != 'demo' && $request->segment(1) != 'pricing')
                                <a href="{{ action([\Modules\Superadmin\Http\Controllers\PricingController::class, 'index']) }}"><i class="fas fa-money-check" style=""></i> @lang('superadmin::lang.pricing')</a>
                            @endif
                        @endif
                    @endif
                </div>
                <div class="registerbuttonstyle col-md-5 col-xs-8" style="">
                    @if(!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
                        <!-- Register Url -->
                        @if(config('constants.allow_registration'))
                            <a href="{{ route('business.getRegister', ['package' => 2]) }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif" class="btn bg-maroon btn-flat" ><b>{{ __('business.not_yet_registered')}}</b> {{ __('business.register_now') }}</a>
                        @endif
                    @endif
                </div>
				@if($request->segment(1) != 'login')
					<div class="col-md-9 col-xs-8 alreadyregistreredstyle" style="text-align: right;padding-top: 10px;">
						&nbsp; &nbsp;<span class="text-white">{{ __('business.already_registered')}} </span><a href="{{ action([\App\Http\Controllers\Auth\LoginController::class, 'login']) }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif">{{ __('business.sign_in') }}</a>
					</div>
				@endif
                
                @yield('content')
                </div>
            </div>
        </div>
    </div>

    
    @include('layouts.partials.javascripts')
    
    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>
    
    @yield('javascript')

    <script type="text/javascript">
        $(document).ready(function(){
            $('.select2_register').select2();

            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>
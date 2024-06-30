<script type="text/javascript">
    base_path = "{{url('/')}}";
    //used for push notification
    APP = {};
    APP.PUSHER_APP_KEY = '{{config('broadcasting.connections.pusher.key')}}';
    APP.PUSHER_APP_CLUSTER = '{{config('broadcasting.connections.pusher.options.cluster')}}';
    APP.INVOICE_SCHEME_SEPARATOR = '{{config('constants.invoice_scheme_separator')}}';
    //variable from app service provider
    APP.PUSHER_ENABLED = '{{$__is_pusher_enabled}}';
    @auth
        @php
            $user = Auth::user();
        @endphp
        APP.USER_ID = "{{$user->id}}";
    @else
        APP.USER_ID = '';
    @endauth
</script>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js?v=$asset_v"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js?v=$asset_v"></script>
<![endif]-->
<script src="{{ asset('js/vendor.js?v=' . $asset_v) }}"></script>

@if(file_exists(public_path('js/lang/' . session()->get('user.language', config('app.locale')) . '.js')))
    <script src="{{ asset('js/lang/' . session()->get('user.language', config('app.locale') ) . '.js?v=' . $asset_v) }}"></script>
@else
    <script src="{{ asset('js/lang/en.js?v=' . $asset_v) }}"></script>
@endif
@php
    $business_date_format = session('business.date_format', config('constants.default_date_format'));
    $datepicker_date_format = str_replace('d', 'dd', $business_date_format);
    $datepicker_date_format = str_replace('m', 'mm', $datepicker_date_format);
    $datepicker_date_format = str_replace('Y', 'yyyy', $datepicker_date_format);

    $moment_date_format = str_replace('d', 'DD', $business_date_format);
    $moment_date_format = str_replace('m', 'MM', $moment_date_format);
    $moment_date_format = str_replace('Y', 'YYYY', $moment_date_format);

    $business_time_format = session('business.time_format');
    $moment_time_format = 'HH:mm';
    if($business_time_format == 12){
        $moment_time_format = 'hh:mm A';
    }

    $common_settings = !empty(session('business.common_settings')) ? session('business.common_settings') : [];

    $default_datatable_page_entries = !empty($common_settings['default_datatable_page_entries']) ? $common_settings['default_datatable_page_entries'] : 25;
@endphp

<script>
    Dropzone.autoDiscover = false;
    moment.tz.setDefault('{{ Session::get("business.time_zone") }}');
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        @if(config('app.debug') == false)
            $.fn.dataTable.ext.errMode = 'throw';
        @endif
    });
    
    var financial_year = {
        start: moment('{{ Session::get("financial_year.start") }}'),
        end: moment('{{ Session::get("financial_year.end") }}'),
    }
    @if(file_exists(public_path('AdminLTE/plugins/select2/lang/' . session()->get('user.language', config('app.locale')) . '.js')))
    //Default setting for select2
    $.fn.select2.defaults.set("language", "{{session()->get('user.language', config('app.locale'))}}");
    @endif

    var datepicker_date_format = "{{$datepicker_date_format}}";
    var moment_date_format = "{{$moment_date_format}}";
    var moment_time_format = "{{$moment_time_format}}";

    var app_locale = "{{session()->get('user.language', config('app.locale'))}}";

    var non_utf8_languages = [
        @foreach(config('constants.non_utf8_languages') as $const)
        "{{$const}}",
        @endforeach
    ];

    var __default_datatable_page_entries = "{{$default_datatable_page_entries}}";

    var __new_notification_count_interval = "{{config('constants.new_notification_count_interval', 60)}}000";
</script>

@if(file_exists(public_path('js/lang/' . session()->get('user.language', config('app.locale')) . '.js')))
    <script src="{{ asset('js/lang/' . session()->get('user.language', config('app.locale') ) . '.js?v=' . $asset_v) }}"></script>
@else
    <script src="{{ asset('js/lang/en.js?v=' . $asset_v) }}"></script>
@endif

<script src="{{ asset('js/functions.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/common.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/app.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/help-tour.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/documents_and_note.js?v=' . $asset_v) }}"></script>

<!-- TODO -->
@if(file_exists(public_path('AdminLTE/plugins/select2/lang/' . session()->get('user.language', config('app.locale')) . '.js')))
    <script src="{{ asset('AdminLTE/plugins/select2/lang/' . session()->get('user.language', config('app.locale') ) . '.js?v=' . $asset_v) }}"></script>
@endif
@php
    $validation_lang_file = 'messages_' . session()->get('user.language', config('app.locale') ) . '.js';
@endphp
@if(file_exists(public_path() . '/js/jquery-validation-1.16.0/src/localization/' . $validation_lang_file))
    <script src="{{ asset('js/jquery-validation-1.16.0/src/localization/' . $validation_lang_file . '?v=' . $asset_v) }}"></script>
@endif

@if(!empty($__system_settings['additional_js']))
    {!! $__system_settings['additional_js'] !!}
@endif
@yield('javascript')

@if(Module::has('Essentials'))
  @includeIf('essentials::layouts.partials.footer_part')
@endif

<script type="text/javascript">
    $(document).ready( function(){
        var locale = "{{session()->get('user.language', config('app.locale'))}}";
        var isRTL = @if(in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl'))) true; @else false; @endif

        $('#calendar').fullCalendar('option', {
            locale: locale,
            isRTL: isRTL
        });
    });
</script>

<!-- COUROUSEL ICONS POUR MENU: -->
<!-- "animate()" est la fonction JavaScript fréquemment utilisées pour effectuer une animation avec l'ensemble des propriétés CSS. 
Pour ce menu à défilement horizontal, cette méthode est appelée avec la propriété CSS "scrollLeft": -->
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function() {
	  var menu = document.querySelector(".menu-inner-box");
	  var prev = document.getElementById("btn-menu-nav-previous");
	  var next = document.getElementById("btn-menu-nav-next");

	  // Function to toggle visibility based on screen width
	  function toggleButtonVisibility() {
		var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

		if (screenWidth <= 767) {
		  prev.style.display = "none";
		  next.style.display = "none";
		} else {
		  prev.style.display = "block"; // Adjust this based on your design
		  next.style.display = "block"; // Adjust this based on your design
		}
	  }

	  // Initial visibility check
	  toggleButtonVisibility();

	  // Update visibility on window resize
	  window.addEventListener("resize", toggleButtonVisibility);

	  // Scroll event listeners
	  prev.addEventListener("click", function() {
		menu.scrollBy({
		  left: -100,
		  behavior: 'smooth'
		});
	  });

	  next.addEventListener("click", function() {
		menu.scrollBy({
		  left: 100,
		  behavior: 'smooth'
		});
	  });
	});
</script>
<!-- FIN COUROUSEL ICONS POUR MENU -->

<!-- DEPLACER LE MENU "ACTIF" EN 4ème POSITION DE LA LISTE DES MENUS -->
<script>
	var sidebar = document.querySelector('.sidebar-menu.tree');
	var active = document.querySelector('.active');
	if (active) {
	  var fourthItem = sidebar.children[3];
	  sidebar.insertBefore(active, fourthItem);
	}
</script>
<!-- FIN DEPLACEMENT DU MENU "ACTIF" EN 4ème POSITION DE LA LISTE DES MENUS -->

<!-- DEBUT FILTREUR (Moteur de Recherche) "DROPDOWN" POUR LES MENUS ---- C'EST CE QUI EST UTILISE ACTUELLEMENT: -->
<script>
	// Function to filter the menu
	function menuFilterFunction(inputElement) {
		var filter = inputElement.value.toUpperCase();
		var ul = document.querySelector(".sidebar-menu");
		var li = ul.querySelectorAll("li");
		var matches = [];

		for (var i = 0; i < li.length; i++) {
			var a = li[i].querySelector("a");
			var span = a.querySelector("span");
			var txtValue = ((span ? span.textContent : "") + " " + a.textContent).toUpperCase();

			// Check if filter matches parent link or any child link
			if (txtValue.indexOf(filter) > -1) {
				matches.push(li[i].outerHTML);
			}
		}

		// Update dropdown content with filtered items
		var dropdownContent = inputElement.parentElement.querySelector(".dropdown-content");
		dropdownContent.innerHTML = matches.join('');

		// Show or hide dropdown content based on the number of filtered items
		dropdownContent.style.display = matches.length > 0 ? 'block' : 'none';
	}

	// Click event listener to close the dropdown when clicking outside
	document.addEventListener("click", function (event) {
		var dropdownContents = document.querySelectorAll(".dropdown-content");

		dropdownContents.forEach(function (dropdownContent) {
			if (!event.target.classList.contains("menuFilterInput") && !dropdownContent.contains(event.target)) {
				dropdownContent.style.display = 'none';
			}
		});
	});
</script>
<!-- FIN FILTREUR (Moteur de Recherche) "DROPDOWN" POUR LES MENUS -->

<script>
	// POUR LE MOTEUR DE RECHERCHE DES "max-width: 766px"
	document.addEventListener("DOMContentLoaded", function () {
		var searchForm = document.getElementById("searchForm");
		var searchBtn = document.getElementById("searchBtn");

		// Toggle search form on button click
		searchBtn.addEventListener("click", function () {
			if (searchForm.style.display === "none") {
				searchForm.style.display = "block";
			} else {
				searchForm.style.display = "none";
			}
		});
	});
</script>

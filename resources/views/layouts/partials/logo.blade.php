<div class="row text-center">
	@if(file_exists(public_path('uploads/logo.png')))
		<div class="col-xs-12">
			<a href="{{ url('/') }}" class=""><img src="/uploads/logo.png" class="img-rounded" alt="Logo" width="150" style="margin-bottom: 30px;"></a>
		</div>
	@else
    	<a href="{{ url('/') }}" class=""><h1 class="text-center page-header">{{ config('app.name', 'Worklx ERP') }}</h1></a>
    @endif
</div>
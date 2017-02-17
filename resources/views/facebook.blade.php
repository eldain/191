@extends('dashboard-template')
@section('title', 'Facebook Updates')

@section('scripts')
	<script src="/js/fb-script.js" charset="utf-8"></script>
@stop

@section('dashboard-title', 'Facebook Updates')
@section('dashboard-body')

<main class="mdl-layout__content content-background flex flex-column flex-wrap vh-100">
	<div class="button-holder flex z-1 absolute w-30 justify-between">
		<button class="flex-auto f5 mw4 pv1 bn br2 bg-black white" data-days="1" type="button" name="1day">1 Day</button>
		<button class="flex-auto f5 mw4 pv1 bn br2 bg-black white" data-days="10" type="button" name="10days">10 Days</button>
		<button class="flex-auto f5 mw4 pv1 bn br2 bg-black white" data-days="100" type="button" name="100days">100 Days</button>
	</div>

	<div class="main-chart flex justify-center items-center flex-auto bg-darker-grey shadow-2 br2 black ma3 w-70 h-100">
	</div>

	<div class="sub-chart-one flex-auto bg-darker-grey shadow-2 br2 black ma3 w-25 h1">
	</div>

	<div class="sub-chart-two flex-auto bg-darker-grey shadow-2 br2 black ma3 w-25 h1">
	</div>

	<div class="sub-chart-three flex-auto bg-darker-grey shadow-2 br2 black ma3 w-25 h1">
	</div>
</main>

@stop

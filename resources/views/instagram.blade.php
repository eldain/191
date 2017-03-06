@extends('dashboard-template')
@section('title', 'Instagram Updates')

@section('scripts')
	<script src="/js/instagram-script.js" charset="utf-8" async></script>
@stop

@section('dashboard-title')
Instagram Updates ({{ Auth::user()->instagram }})
@stop
@section('dashboard-body')

<main class="mdl-layout__content content-background flex flex-column flex-wrap vh-100">

	<div class="chart-loader bg-near-black absolute z-2 justify-center items-center o-50 dn">
		<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
			 <circle class="path" fill="none" stroke="#AB9657" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
		</svg>
	</div>
	
	<div class="button-holder flex z-1 absolute w-30 justify-between">
		<button class="flex-auto f5 mw4 pv1 bn br2 bg-black bg-gold white" data-days="30" type="button" name="30day">30 Days</button>
		<button class="flex-auto f5 mw4 pv1 bn br2 bg-black white" data-days="60" type="button" name="60days">60 Days</button>
		<button class="flex-auto f5 mw4 pv1 bn br2 bg-black white" data-days="90" type="button" name="90days">90 Days</button>
	</div>

	<div class="main-chart flex justify-center items-center flex-auto bg-darker-grey shadow-2 br2 black ma3 w-70 h-100">
	</div>

	<div class="sub-chart-one flex-auto bg-darker-grey shadow-2 br2 black ma3 w-25 h1">
	</div>

	<div class="sub-chart-two flex-auto bg-darker-grey shadow-2 br2 black ma3 w-25 h1">
	</div>
</main>

@stop

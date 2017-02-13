@extends('dashboard-template')
@section('title', 'Facebook Updates')

@section('scripts')
	<script src="/js/fb-script.js" charset="utf-8" async></script>
@stop

@section('dashboard-title', 'Facebook Updates')
@section('dashboard-body')

<main class="mdl-layout__content content-background flex flex-column flex-wrap vh-100">
	<div class="main-chart flex justify-center items-center flex-auto bg-gray shadow-2 br2 black ma3 w-70 h-100">
	</div>

	<div class="sub-chart-one flex-auto bg-gray shadow-2 br2 black ma3 w-25 h1">
	</div>

	<div class="sub-chart-two flex-auto bg-gray shadow-2 br2 black ma3 w-25 h1">
	</div>

	<div class="sub-chart-three flex-auto bg-gray shadow-2 br2 black ma3 w-25 h1">
	</div>
</main>

@stop

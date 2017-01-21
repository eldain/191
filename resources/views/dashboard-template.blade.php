@extends('base')
@section('title', 'Observation Deck')
@section('head')
	<link rel="stylesheet" href="/css/styles.css" media="screen" title="no title">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en"> -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://fonts.googleapis.com/css?family=Merriweather:400,700|Open+Sans:400,600" rel="stylesheet">
@stop
@section('body')
<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
	<header class="demo-header mdl-layout__header">
		<div class="mdl-layout__header-row">
			<span class="mdl-layout-title">@yield('dashboard-title')</span>
		</div>
	</header>
	<div class="demo-drawer mdl-layout__drawer">
		<header class="demo-drawer-header">
			<span>GigaSavvy</span>
		</header>
		<nav class="demo-navigation mdl-navigation">
			<a class="mdl-navigation__link" href="/dashboard"><i class="material-icons" role="presentation">home</i>Dashboard</a>
			<a class="mdl-navigation__link" href="/settings"><i class="material-icons" role="presentation">settings</i>Settings</a>
		</nav>
	</div>
	@yield('dashboard-body')
@stop

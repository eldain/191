@extends('dashboard-template')
@section('title', 'Settings')
@section('dashboard-title', 'Settings')
@section('dashboard-body')

<main class="mdl-layout__content content-background">
	<div class="mdl-grid demo-content justify-center items-center">
		<div class="mdl-card mdl-shadow--2dp mdl-card--horizontal mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
		<form action="#" class="pl4">
			<h2 class="off-white">General</h2>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="name">
				<label class="mdl-textfield__label off-white" for="name">Name</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="email">
				<label class="mdl-textfield__label off-white" for="email">Email</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="password">
				<label class="mdl-textfield__label off-white" for="password">Password</label>
			</div>
			<div class="mdl-grid demo-content pl0" style ="padding-bottom: 30px">
		<button type="button" name="button" class="mdl-button bg-gold mdl-shadow--2dp" style = "font-family: 'Montserrat'">Save</button>
	</div>
		</form>
		</div>


<div class="mdl-card mdl-shadow--2dp mdl-card--horizontal mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
		<form action="#" class="pl4">
			<h2 class="off-white">API Credentials</h2>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="facebook">
				<label class="mdl-textfield__label off-white" for="facebook">Facebook</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="instagram">
				<label class="mdl-textfield__label off-white" for="instagram">Instagram</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="twitter">
				<label class="mdl-textfield__label off-white" for="twitter">Twitter</label>
			</div>
			<div class="mdl-grid demo-content pl0" style ="padding-bottom: 30px">
		<button type="button" name="button" class="mdl-button bg-gold mdl-shadow--2dp" style = "font-family: 'Montserrat'">Save</button>
	</div>
		</form>
	</div>
	</div>


</main>

@stop

@extends('dashboard-template')
@section('title', 'Settings')
@section('dashboard-title', 'Settings')
@section('dashboard-body')

<main class="mdl-layout__content content-background">
	<div class="mdl-grid demo-content">
		<form action="#">
			<h2 class="white">General</h2>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="name">
				<label class="mdl-textfield__label white" for="name">Name</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="password">
				<label class="mdl-textfield__label white" for="password">Password</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="email">
				<label class="mdl-textfield__label white" for="email">Email</label>
			</div>

			<h2 class="white">API Credentials</h2>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="facebook">
				<label class="mdl-textfield__label white" for="facebook">Facebook</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="instagram">
				<label class="mdl-textfield__label white" for="instagram">Instagram</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="twitter">
				<label class="mdl-textfield__label white" for="twitter">Twitter</label>
			</div>
		</form>
	</div>

	<div class="mdl-grid demo-content">
		<button type="button" name="button" class="mdl-button white">Submit</button>
	</div>

</main>

@stop

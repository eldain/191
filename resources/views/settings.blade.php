@extends('dashboard-template') @section('title', 'Settings') @section('dashboard-title', 'Settings') @section('dashboard-body')

<main class="mdl-layout__content content-background">
	<div class="mdl-grid demo-content">
		<form action="#">
			<h2 class="white">General</h2>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample3">
				<label class="mdl-textfield__label white" for="sample3">Name</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample3">
				<label class="mdl-textfield__label white" for="sample3">Password</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample3">
				<label class="mdl-textfield__label white" for="sample3">Email</label>
			</div>
		</form>
	</div>

	<div class="mdl-grid demo-content">
		<form action="#">
			<h2 class="white">API Credentials</h2>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample3">
				<label class="mdl-textfield__label white" for="sample3">Facebook</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample3">
				<label class="mdl-textfield__label white" for="sample3">Instagram</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample3">
				<label class="mdl-textfield__label white" for="sample3">Twitter</label>
			</div>
		</form>
	</div>

	<div class="mdl-grid demo-content">
		<button type="button" name="button" class="mdl-button white">Submit</button>
	</div>

</main>

@stop

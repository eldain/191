@extends('dashboard-template')
@section('title', 'Settings')
@section('dashboard-title', 'Settings')
@section('dashboard-body')

<main class="mdl-layout__content content-background">
	<div class="mdl-grid demo-content justify-center items-center">
		<div class="mdl-card mdl-shadow--2dp mdl-card--horizontal mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
		<form action="{{ url('/updateUserGeneral') }}" method="POST"  class="pl4">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h2 class="off-white">General</h2>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="name" value="{{ Auth::user()->name }}">
				<label class="mdl-textfield__label off-white" for="name">Name</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="email" value="{{ Auth::user()->email }}">
				<label class="mdl-textfield__label off-white" for="email">Email</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="password">
				<label class="mdl-textfield__label off-white" for="password">Password</label>
			</div>
			<div class="mdl-grid demo-content pl0" style ="padding-bottom: 30px">
		<input type="submit" value="Save" class="mdl-button bg-gold mdl-shadow--2dp" style = "font-family: 'Montserrat'">
		</input>
	</div>
		</form>
		</div>


<div class="mdl-card mdl-shadow--2dp mdl-card--horizontal mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
		<form action="{{ url('/updateUserAPI') }}" method="POST" class="pl4">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h2 class="off-white">API Credentials</h2>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="facebook" value="{{ Auth::user()->facebook }}">
				<label class="mdl-textfield__label off-white" for="facebook">Facebook</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="instagram" value="{{ Auth::user()->instagram }}">
				<label class="mdl-textfield__label off-white" for="instagram">Instagram</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="twitter" value="{{ Auth::user()->twitter }}">
				<label class="mdl-textfield__label off-white" for="twitter">Twitter</label>
			</div>
			<div class="mdl-grid demo-content pl0" style ="padding-bottom: 30px">
		<input type="submit" value="Save" class="mdl-button bg-gold mdl-shadow--2dp" style = "font-family: 'Montserrat'">
		</input>
	</div>
		</form>
	</div>
	</div>


</main>

@stop

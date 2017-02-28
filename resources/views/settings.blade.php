@extends('dashboard-template')
@section('title', 'Settings')
@section('dashboard-title', 'Settings')
@section('scripts')
	<script src="/js/settings.js" charset="utf-8" async></script>
@stop
@section('dashboard-body')


<main class="mdl-layout__content content-background">
	<div class="flash-message">
		@foreach (['error', 'success'] as $msg)
			@if(Session::has('alert-' . $msg))
			<div class="mdl-grid demo-content justify-center items-center">
				<div class="mdl-card mdl-shadow--2dp mdl-card--horizontal mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing ">

				<h2 class="off-white">{{ Session::get('alert-' . $msg) }}</h2>
				</div>
			</div>
			@endif
	    @endforeach
	</div> <!-- end .flash-message -->

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
	</div>

<div class="mdl-grid demo-content justify-center items-center">
<button onclick="myFunction()" class="mdl-shadow--2dp br2 bn pa2 white bg-dark-gray" style = "font-family: 'Montserrat'">Advanced Settings</button>
</div>
<div id="myDIV">
<div class="mdl-grid demo-content justify-center items-center">
<div class="mdl-card mdl-shadow--2dp mdl-card--horizontal mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
		<form action="{{ url('/updateSocialSettings') }}" method="POST" class="pl4">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h2 class="off-white">Social Usernames</h2>
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


<div class="mdl-card mdl-shadow--2dp mdl-card--horizontal mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
		<form action="{{ url('/updateAPISettings') }}" method="POST" class="pl4">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h2 class="off-white">API Keys</h2>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="fb_api_key" value="{{ Auth::user()->fb_api_key }}">
				<label class="mdl-textfield__label off-white" for="fb_api_key">Facebook API ID</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="fb_api_secret" value="{{ Auth::user()->fb_api_secret }}">
				<label class="mdl-textfield__label off-white" for="fb_api_secret">Facebook API Secret</label>
			</div>
			<div class="mdl-grid demo-content pl0" style ="padding-bottom: 30px">
		<input type="submit" value="Save" class="mdl-button bg-gold mdl-shadow--2dp" style = "font-family: 'Montserrat'">
		</input>
	</div>
		</form>
	</div>
	</div>
</div>
</div>
</main>

@stop

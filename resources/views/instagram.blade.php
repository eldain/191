@extends('dashboard-template')
@section('title', 'Instagram Updates')

@section('dashboard-title', 'Instagram Updates')
@section('dashboard-body')

<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
		<h3>Instagram</h3>
		<?php
        $access_token = '220678271.feac92c.647e2f561b594603b48a4696dfbbc3bf';
        $json_url = "https://api.instagram.com/v1/users/220678271/?access_token=" . $access_token;
        $json = file_get_contents($json_url);
        $json_output = json_decode($json);
        var_dump($json_output);
        ?>	
	</div>
</main>

@stop
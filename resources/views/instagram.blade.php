@extends('dashboard-template')
@section('title', 'Instagram Updates')

@section('dashboard-title', 'Instagram Updates')
@section('dashboard-body')

<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
	<?php
                use App\MyInstagramApi;
                $instagram = new MyInstagramApi();
                echo '<h3>theguitarrevolution has ' . $instagram->getNumberOfFollowers('220678271') . ' followers.</h3>';
        ?>	
	</div>
</main>

@stop
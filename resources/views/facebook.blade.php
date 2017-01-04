@extends('dashboard-template')
@section('title', 'Facebook Updates')

@section('dashboard-title', 'Facebook Updates')
@section('dashboard-body')

<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
		<?php
			use App\MyFacebookApi;
			$fb = new MyFacebookApi();
			echo '<h3>GigaSavvy number of likes = ' . $fb->fbPageLikeCount('GigaSavvy') . '</h3>';
		?>
	</div>
</main>

@stop

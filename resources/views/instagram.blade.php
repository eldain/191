@extends('dashboard-template')
@section('title', 'Instagram Updates')

@section('dashboard-title', 'Instagram Updates')
@section('dashboard-body')

<main class="mdl-layout__content mdl-color--grey-100">
	<div class="mdl-grid demo-content">
		<h3>Instagram
		<?php
		use MetzWeb\Instagram\Instagram;

        $instagram = new Instagram(array(
            'apiKey'      => 'feac92c4402246d1b3aa77001c72e574',
            'apiSecret'   => 'd87070d9f2aa432e845434c908d367dd',
            'apiCallback' => 'https://rtdiprod.herokuapp.com/instagram'
        ));

        echo "<a href='{$instagram->getLoginUrl()}'>Login with Instagram</a>";

        // grab OAuth callback code
        if (isset($_GET['code'])){
            $code = $_GET['code'];
            $data = $instagram->getOAuthToken($code);

            echo '<br>Your username is: ' . $data->user->username;
        }

        ?>
		</h3>
	</div>
</main>

@stop
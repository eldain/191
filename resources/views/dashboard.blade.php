@extends('dashboard-template')

@section('scripts')
	<script src="/js/dashboard-script.js" charset="utf-8" async></script>
@stop

@section('dashboard-title', 'Dashboard')
@section('dashboard-body')
<main class="mdl-layout__content content-background flex">
	<div class="fb-card card bg-darker-grey w3 h5 flex-auto flex flex-column h-25 ma4 br2 shadow-2 pointer hover-bg-dark-gray">

		<div class="fb-loader bg-near-black absolute z-1 flex justify-center items-center o-80">
			<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
			   <circle class="path" fill="none" stroke="#AB9657" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
			</svg>
		</div>

		<div class="white ma3 f2">Facebook <span class="f3">({{ Auth::user()->facebook }})</span></div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">thumb_up</i><span id="fb-likes">-</span> total page likes</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">favorite</i><span id="fb-reactions">-</span> reactions</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">comment</i><span id="fb-comments">-</span> comments</div>
		<div class="txt-gold ma3">Across <span id="fb-posts">-</span> posts in <span id="fb-time-frame">-</span> days</div>


	</div>
	<div class="twitter-card card bg-darker-grey w3 h5 flex-auto flex flex-column h-25 ma4 br2 shadow-2 pointer hover-bg-dark-gray">

		<div class="twitter-loader bg-near-black absolute z-1 flex justify-center items-center o-80">
			<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
			   <circle class="path" fill="none" stroke="#AB9657" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
			</svg>
		</div>

		<div class="white ma3 f2">Twitter <span class="f3">({{ Auth::user()->twitter }})</span></div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">group</i><span id="twitter-followers">-</span> total followers</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">favorite</i><span id="twitter-favorites">-</span> favorites</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">cached</i><span id="twitter-retweets">-</span> retweets</div>
		<div class="txt-gold ma3">Across <span id="twitter-tweets">-</span> tweets in <span id="twitter-time-frame">-</span> days</div>

	</div>
	<div class="ig-card card bg-darker-grey w3 flex-auto flex flex-column h-25 ma4 br2 shadow-2 pointer hover-bg-dark-gray">

		<div class="ig-loader bg-near-black absolute z-1 flex justify-center items-center o-80">
			<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
				 <circle class="path" fill="none" stroke="#AB9657" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
			</svg>
		</div>

		<div class="white ma3 f2">Instagram <span class="f3">({{ Auth::user()->instagram }})</span></div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">group</i><span id="ig-followers">-</span> total followers</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">favorite</i><span id="ig-likes">-</span> likes</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">comment</i><span id="ig-comments">-</span> comments</div>
		<div class="txt-gold ma3">Across <span id="ig-posts">-</span> posts in <span id="ig-time-frame">-</span> days</div>

	</div>
</main>
@stop

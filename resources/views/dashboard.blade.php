@extends('dashboard-template')

@section('scripts')
	<script src="/js/dashboard-script.js" charset="utf-8" async></script>
@stop

@section('dashboard-title', 'Dashboard')
@section('dashboard-body')
<main class="mdl-layout__content content-background flex">
	<div class="fb-card card bg-darker-grey w3 h5 flex-auto ma4 br2 shadow-2 pointer hover-bg-dark-gray">

		<div class="w-100 h-100 bg-near-black z-1 flex justify-center items-center dn">
			<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
			   <circle class="path" fill="none" stroke="#AB9657" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
			</svg>
		</div>

		<div class="white ma3 f2">Facebook <span class="f3">({{ Auth::user()->facebook }})</span></div>
		<div class="white f3 ma3 mt4"><i class="material-icons txt-gold pr3">thumb_up</i><span id="fb-views">-</span> total page likes</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">favorite</i><span id="fb-reactions">-</span> reactions</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">comment</i><span id="fb-comments">-</span> comments</div>
		<div class="txt-gold ma3">Across <span id="fb-posts">-</span> posts in <span id="fb-time-frame">-</span> days</div>

	</div>
	<div class="card bg-darker-grey w3 h5 flex-auto ma4 br2 shadow-2 flex flex-column content-around">
		<div class="white ma3 f2">Twitter <span class="f3">({{ Auth::user()->twitter }})</span></div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">favorite</i>45 Favorites</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">comment</i>78 Retweets</div>
		<a class="link txt-gold ma3 pointer" href="/twitter">Across 16 tweets</a>
	</div>
	<div class="card bg-darker-grey w3 h5 flex-auto ma4 br2 shadow-2 flex flex-column content-around">
		<div class="white ma3 f2">Instagram <span class="f3">({{ Auth::user()->instagram }})</span></div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">favorite</i>45 Likes</div>
		<div class="white f3 ma3"><i class="material-icons txt-gold pr3">comment</i>78 Comments</div>
		<a class="link txt-gold ma3 pointer" href="/instagram">Across 16 posts</a>
	</div>
</main>
@stop

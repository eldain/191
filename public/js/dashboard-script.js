// Relevant dashboard page elements
const fbCard = document.querySelector(".fb-card");
const fbReactions = document.querySelector('#fb-reactions');
const fbComments = document.querySelector('#fb-comments');
const fbLikes = document.querySelector('#fb-likes');
const fbPosts = document.querySelector('#fb-posts');
const fbTimeFrame = document.querySelector('#fb-time-frame');

const twitterCard = document.querySelector(".twitter-card");
const twitterFollowers = document.querySelector('#twitter-followers');
const twitterFavorites = document.querySelector('#twitter-favorites');
const twitterRetweets = document.querySelector('#twitter-retweets');
const twitterTweets = document.querySelector('#twitter-tweets');
const twitterTimeFrame = document.querySelector('#twitter-time-frame');

fbCard.addEventListener("click", () => {
  window.location.href = '/facebook';
})
twitterCard.addEventListener("click", () => {
  window.location.href = '/twitter';
})

// Time frame... could eventually have this set in settings page, using PHP to retrieve?
let dayCount = 100;

// General utility functions
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function getTodaysDate(){
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();

  if(dd<10) {
      dd='0'+dd
  }

  if(mm<10) {
      mm='0'+mm
  }

  today = mm+'/'+dd+'/'+yyyy;
  return today;
}
function getStartDate(daysPassed){
  var today = new Date();
  today.setDate(today.getDate() - daysPassed);
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();

  if(dd<10) {
      dd='0'+dd
  }

  if(mm<10) {
      mm='0'+mm
  }

  today = mm+'/'+dd+'/'+yyyy;
  return today;
}

// Loader Functions
function startFBLoader(){
  var fbLoader = document.querySelector('.fb-loader');
  var loaderWidth = fbCard.clientWidth;
  var loaderHeight = fbCard.clientHeight;
  fbLoader.setAttribute('style', `height:${loaderHeight}px;width:${loaderWidth}px;`);
  fbLoader.classList.remove('dn');
  fbLoader.classList.add('flex');
}
function endFBLoader(){
  var fbLoader = document.querySelector('.fb-loader');
  fbLoader.classList.remove('flex');
  fbLoader.classList.add('dn');
}
function startTwitterLoader(){
  var twitterLoader = document.querySelector('.twitter-loader');
  var loaderWidth = twitterCard.clientWidth;
  var loaderHeight = twitterCard.clientHeight;
  twitterLoader.setAttribute('style', `height:${loaderHeight}px;width:${loaderWidth}px;`);
  twitterLoader.classList.remove('dn');
  twitterLoader.classList.add('flex');
}
function endTwitterLoader(){
  var twitterLoader = document.querySelector('.twitter-loader');
  twitterLoader.classList.remove('flex');
  twitterLoader.classList.add('dn');
}

// Facebook specific data manipulation functions
function getFBTotalReactions(data){
	var totalReactions = data.map(post => {
		return post.reactions
	})
	.reduce(function(acc, val) {
		return acc + val
	}, 0);
	return totalReactions;
}
function getFBTotalComments(data){
	var totalComments = data.map(post => {
		return post.comments
	})
	.reduce(function(acc, val) {
		return acc + val
	}, 0);
	return totalComments;
}
function getFBTotalPosts(data){
	var totalPosts = data.length;
	return totalPosts;
}

// Twitter specific data manipulation functions
function getTwitterFavorites(data){
	var favorites = data.map(tweet => {
		return tweet.favorite_count
	})
	.reduce(function(acc, val) {
		return acc + val
	}, 0);
	return favorites;
}
function getTwitterRetweets(data){
	var totalRetweets = data.map(tweet => {
		return tweet.retweet_count
	})
	.reduce(function(acc, val) {
		return acc + val
	}, 0);
	return totalRetweets;
}
function getTwitterTotalTweets(data){
	var totalTweets = data.length;
	return totalTweets;
}

// Get the Facebook data
function getFBData(start, end){
  startFBLoader();
  let myURL = `/fbGetFeedDateRange?user=${userFB}&since=${start}&until=${end}`
  return fetch(myURL)
    .then(resp => {
      if(resp.ok){
        return resp.json();
      }
      throw new Error('Network response was not ok.');
    })
    .then(value => {
			var fbTotalReactions = getFBTotalReactions(value);
			var fbTotalComments = getFBTotalComments(value);
			var fbTotalPosts = getFBTotalPosts(value);
 			fbReactions.innerHTML = numberWithCommas(fbTotalReactions);
			fbComments.innerHTML = numberWithCommas(fbTotalComments);
			fbPosts.innerHTML = fbTotalPosts;
			fbTimeFrame.innerHTML = dayCount;
      endFBLoader();
    })
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}
function getFBPageLikes(){
  let myURL = `/fbPageLikeCount?user=${userFB}&fbApiKey=${fbApiKey}&fbApiSecret=${fbApiSecret}`;
  fetch(myURL)
		.then(resp => {
			if(resp.ok){
				return resp.json();
			}
			throw new Error('Network response was not ok.');
		})
		.then(value => {
			fbLikes.innerHTML = numberWithCommas(value);
		})
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

// Get the Twitter Data
function getTwitterData(end){
  startTwitterLoader();
  let myURL = `/twGetTweets?user=${userTwitter}&until=${end}`;
  return fetch(myURL)
    .then(resp => {
      if(resp.ok){
        return resp.json();
      }
      throw new Error('Network response was not ok.');
    })
    .then(value => {
      var twitterTotalFavorites = getTwitterFavorites(value);
      var twitterTotalRetweets = getTwitterRetweets(value);
      var twitterTotalTweets = getTwitterTotalTweets(value);
 			twitterFavorites.innerHTML = numberWithCommas(twitterTotalFavorites);
			twitterRetweets.innerHTML = numberWithCommas(twitterTotalRetweets);
			twitterTweets.innerHTML = twitterTotalTweets;
			twitterTimeFrame.innerHTML = dayCount;
      endTwitterLoader();
    })
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}
function getTwitterFollowers(){
  let myURL = `/twGetFollowersCount?user=${userTwitter}`;
  fetch(myURL)
    .then(resp => {
      if(resp.ok){
        return resp.json();
      }
      throw new Error('Network response was not ok.');
    })
    .then(value => {
      twitterFollowers.innerHTML = numberWithCommas(value);
    })
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

// Actually call the functions
getFBData(getStartDate(dayCount), getTodaysDate());
getFBPageLikes();
getTwitterData(getStartDate(dayCount));
getTwitterFollowers();

// Repeat for "Realtime Data"
setInterval(() => {
  getFBData(getStartDate(dayCount), getTodaysDate());
  getFBPageLikes();
  getTwitterData(getStartDate(dayCount));
  getTwitterFollowers();
}, 60000);

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

const igCard = document.querySelector(".ig-card");
const igFollowers = document.querySelector('#ig-followers');
const igLikes = document.querySelector('#ig-likes');
const igComments = document.querySelector('#ig-comments');
const igPosts = document.querySelector('#ig-posts');
const igTimeFrame = document.querySelector('#ig-time-frame');

fbCard.addEventListener("click", () => {
  window.location.href = '/facebook';
})
twitterCard.addEventListener("click", () => {
  window.location.href = '/twitter';
})
igCard.addEventListener("click", () => {
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
function startIGLoader(){
  var igLoader = document.querySelector('.ig-loader');
  var loaderWidth = igCard.clientWidth;
  var loaderHeight = igCard.clientHeight;
  igLoader.setAttribute('style', `height:${loaderHeight}px;width:${loaderWidth}px;`);
  igLoader.classList.remove('dn');
  igLoader.classList.add('flex');
}
function endIGLoader(){
  var igLoader = document.querySelector('.ig-loader');
  igLoader.classList.remove('flex');
  igLoader.classList.add('dn');
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

// Instagram specific data manipulation functions
function getIGLikes(data){
	var likes = data.map(post => {
		return post.likes;
	})
	.reduce(function(acc, val) {
		return acc + val;
	}, 0);
	return likes;
}
function getIGComments(data){
	var totalComments = data.map(post => {
		return post.comments_count;
	})
	.reduce(function(acc, val) {
		return acc + val;
	}, 0);
	return totalComments;
}
function getIGTotalPosts(data){
	var totalPosts = data.length;
	return totalPosts;
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

// Get the Instagram Data
function getIGData(end){
  startIGLoader();
  let myURL = `/inGetRecentPosts?user=${userInstagram}&until=${end}`;
  return fetch(myURL)
    .then(resp => {
      if(resp.ok){
        return resp.json();
      }
      throw new Error('Network response was not ok.');
    })
    .then(value => {
      var igTotalLikes = getIGLikes(value);
      var igTotalComments = getIGComments(value);
      var igTotalPosts = getIGTotalPosts(value);
      igLikes.innerHTML = numberWithCommas(igTotalLikes);
      igComments.innerHTML = numberWithCommas(igTotalComments);
      igPosts.innerHTML = numberWithCommas(igTotalPosts);
      igTimeFrame.innerHTML = dayCount;
      endIGLoader();
    })
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}
function getIGFollowers(){
  let myURL = `/inGetNumberOfFollowers?user=${userInstagram}`;
  fetch(myURL)
    .then(resp => {
      if(resp.ok){
        return resp.json();
      }
      throw new Error('Network response was not ok.');
    })
    .then(value => {
      igFollowers.innerHTML = numberWithCommas(value);
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
getIGData(getStartDate(dayCount));
getIGFollowers();

// Repeat for "Realtime Data"
setInterval(() => {
  var startDate = getStartDate(dayCount);

  getFBData(startDate, getTodaysDate());
  getFBPageLikes();

  getTwitterData(startDate);
  getTwitterFollowers();

  getIGData(startDate);
  getIGFollowers();
}, 60000);

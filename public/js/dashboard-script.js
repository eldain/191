// Relevant dashboard page elements
const fbReactions = document.querySelector('#fb-reactions');
const fbComments = document.querySelector('#fb-comments');
const fbLikes = document.querySelector('#fb-views');
const fbPosts = document.querySelector('#fb-posts');
const fbTimeFrame = document.querySelector('#fb-time-frame');

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

// Get the Facebook data
function getFBData(start, end){
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
 			fbReactions.innerHTML = fbTotalReactions;
			fbComments.innerHTML = fbTotalComments;
			fbPosts.innerHTML = fbTotalPosts;
			fbTimeFrame.innerHTML = dayCount;
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

// Actually call the functions
getFBData(getStartDate(dayCount), getTodaysDate());
getFBPageLikes();

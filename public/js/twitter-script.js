// Remember that userTwitter is set on dashboard page

// Variables
const mainChart = document.querySelector('.main-chart');
const firstSubChart = document.querySelector('.sub-chart-one');
const secondSubChart = document.querySelector('.sub-chart-two');
const thirdSubChart = document.querySelector('.sub-chart-three');
const dayButtons = document.querySelectorAll(".button-holder button");
let dayRangeDefault = 30;

/*
Process:
- get data
- filter data for specific chart
- pass filtered data to google chart which...
- update/render panels with charts
*/

// Utility Functions
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
function startChartLoader(){
  var loaderSize = document.querySelector(".mdl-layout__content.content-background")
  var chartLoader = document.querySelector('.chart-loader');
  var loaderWidth = loaderSize.clientWidth;
  var loaderHeight = loaderSize.clientHeight;
  chartLoader.setAttribute('style', `height:${loaderHeight}px;width:${loaderWidth}px;`);
  chartLoader.classList.remove('dn');
  chartLoader.classList.add('flex');
}
function endChartLoader(){
  var chartLoader = document.querySelector('.chart-loader');
  chartLoader.classList.remove('flex');
  chartLoader.classList.add('dn');
}

function filterForRetweets(data){
  let retweetArray = data.map(post => {
    let date = new Date(post.created_at);
    let month = date.getMonth() + 1;
    let day = date.getDate();
    return [`${month}/${day}`, post.retweet_count]
  });
  return retweetArray.reverse();
}

function filterForFavorites(data){
  let favoritesArray = data.map(post => {
    let date = new Date(post.created_at);
    let month = date.getMonth() + 1;
    let day = date.getDate();
    return [`${month}/${day}`, post.favorite_count]
  });
  return favoritesArray.reverse();
}

function filterForAll(data){
  let allArray = data.map(post => {
    let date = new Date(post.created_at);
    let month = date.getMonth() + 1;
    let day = date.getDate();
    return [`${month}/${day}`, post.favorite_count, post.retweet_count]
  });
  return allArray.reverse();
}

function filterforURLS(data){
  let urlArray = data.map(post => {
    return post.url
  });
  return urlArray.reverse();
}

// Get the data
function getData(start, end){
  startChartLoader();
  let myURL = `/twGetTweets?user=${userTwitter}&until=${start}`
  return fetch(myURL)
    .then(resp => {
      if(resp.ok){
        return resp.json();
      }
      throw new Error('Network response was not ok.');
    })
    .then(value => {
      let allData = filterForAll(value);
      let favorites = filterForFavorites(value);
      let retweets = filterForRetweets(value);
      let urls = filterforURLS(value);
      drawMainChart(allData, urls);
      drawSubChartOne(favorites);
      drawSubChartTwo(retweets);
      endChartLoader();
    })
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(() => {
  let startDate = getStartDate(dayRangeDefault);
  let endDate = getTodaysDate();
  getData(startDate, endDate);
});

function drawMainChart(chartData, urls) {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Posts');
      data.addColumn('number', 'Favorites');
      data.addColumn('number', 'Retweets');

      // addRows format [[a,b],[c,d],...]
      data.addRows(chartData);

      var options = {
        'title': "Overall Twitter Trends ",
        titleTextStyle: {
          color: '#fff',
          fontSize: 20
        },
        legendTextStyle: { color: '#FFF' },
        hAxis: {
          title: 'Post Date',
          baselineColor: '#FFF',
          gridlineColor: '#FFF',
          textStyle:{color: '#FFF'},
          titleTextStyle: {color: '#FFF'}
        },
        vAxis: {
          title: 'Trends',
          baselineColor: '#FFF',
          gridlineColor: '#FFF',
          textStyle:{color: '#FFF'},
          titleTextStyle: {color: '#FFF'}
        },
        //need to figure out ability to resize
        width: mainChart.innerWidth,
        height: mainChart.innerHeight,
        colors: ['#BBA43F',"#57A773", "#AFA2FF"],
        backgroundColor: {
          fill: '#404040',
        }
      };

      var chart = new google.visualization.LineChart(mainChart);
      chart.draw(data, options);
      // a click handler which grabs some values then redirects the page
      google.visualization.events.addListener(chart, 'select', function() {
        // grab a few details before redirecting
        var selection = chart.getSelection();
        var row = selection[0].row;
        if (row != null) {
          var url = urls[row];
          var win = window.open(url, '_blank');
          if (win) {
              //Browser has allowed it to be opened
              win.focus();
          } else {
            location.href = url;
          }
        }
      });
}

function drawSubChartOne(chartData) {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Posts');
  data.addColumn('number', 'Favorites');

  // addRows format [[a,b],[c,d],...]
  data.addRows(chartData);

  var options = {
    'title': "Favorites",
    titleTextStyle: {
      color: '#fff',
      fontSize: 16
    },
    legendTextStyle: { color: '#FFF' },
    hAxis: {
      title: 'Posts',
      baselineColor: '#FFF',
      gridlineColor: '#FFF',
      textStyle:{color: '#FFF'},
      titleTextStyle: {color: '#FFF'}
    },
    vAxis: {
      title: 'Retweets',
      baselineColor: '#FFF',
      gridlineColor: '#FFF',
      textStyle:{color: '#FFF'},
      titleTextStyle: {color: '#FFF'}
    },
    //need to figure out ability to resize
    width: firstSubChart.innerWidth,
    height: firstSubChart.innerHeight,
    colors: ['#BBA43F'],
    backgroundColor: {
      fill: '#404040',
    }
  };

  var chart = new google.visualization.LineChart(firstSubChart);
  chart.draw(data, options);
}

function drawSubChartTwo(chartData) {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Posts');
  data.addColumn('number', 'Retweets');

  // addRows format [[a,b],[c,d],...]
  data.addRows(chartData);

  var options = {
    'title': "Retweets",
    titleTextStyle: {
      color: '#fff',
      fontSize: 16
    },
    legendTextStyle: { color: '#FFF' },
    hAxis: {
      title: 'Posts',
      baselineColor: '#FFF',
      gridlineColor: '#FFF',
      textStyle:{color: '#FFF'},
      titleTextStyle: {color: '#FFF'}
    },
    vAxis: {
      title: 'Favorites',
      baselineColor: '#FFF',
      gridlineColor: '#FFF',
      textStyle:{color: '#FFF'},
      titleTextStyle: {color: '#FFF'}
    },
    //need to figure out ability to resize
    width: secondSubChart.innerWidth,
    height: secondSubChart.innerHeight,
    colors: ["#57A773"],
    backgroundColor: {
      fill: '#404040',
    }
  };

  var chart = new google.visualization.LineChart(secondSubChart);
  chart.draw(data, options);
}

function drawSubChartThree(chartData) {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Posts');
  data.addColumn('number', 'Likes');

  // addRows format [[a,b],[c,d],...]
  data.addRows(chartData);

  var options = {
    'title': "Followers",
    titleTextStyle: {
      color: '#fff',
      fontSize: 16
    },
    legendTextStyle: { color: '#FFF' },
    hAxis: {
      title: 'Posts',
      baselineColor: '#FFF',
      gridlineColor: '#FFF',
      textStyle:{color: '#FFF'},
      titleTextStyle: {color: '#FFF'}
    },
    vAxis: {
      title: 'Shares',
      baselineColor: '#FFF',
      gridlineColor: '#FFF',
      textStyle:{color: '#FFF'},
      titleTextStyle: {color: '#FFF'}
    },
    //need to figure out ability to resize
    width: thirdSubChart.innerWidth,
    height: thirdSubChart.innerHeight,
    colors: ["#AFA2FF"],
    backgroundColor: {
      fill: '#404040',
    }
  };

  var chart = new google.visualization.LineChart(thirdSubChart);
  chart.draw(data, options);
}

// Event Listeners
dayButtons.forEach(button => button.addEventListener('click', (e) => {
  dayButtons.forEach(button => button.classList.remove("bg-gold"));
  button.classList.add("bg-gold");
  let startDate = getStartDate(e.target.dataset.days);
  let endDate = getTodaysDate();
  getData(startDate, endDate);
  dayRangeDefault = e.target.dataset.days;
}));

// Repeat for "Realtime Data"
setInterval(() => {
  let startDate = getStartDate(dayRangeDefault);
  let endDate = getTodaysDate();
  getData(startDate, endDate);
}, 60000);

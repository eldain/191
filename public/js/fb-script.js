// Remember that userFB is set on dashboard page

const mainChart = document.querySelector('.main-chart');
const firstSubChart = document.querySelector('.sub-chart-one');
const secondSubChart = document.querySelector('.sub-chart-two');
const thirdSubChart = document.querySelector('.sub-chart-three');
const dayButtons = document.querySelectorAll(".button-holder button");

/*
- get data
- filter data for specific chart
- pass filtered data to google chart which...
- update/render panels with charts
*/

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

function getData(start, end){
  startChartLoader();
  let myURL = `/fbGetFeedDateRange?user=${userFB}&since=${start}&until=${end}`
  return fetch(myURL)
    .then(resp => {
      if(resp.ok){
        return resp.json();
      }
      throw new Error('Network response was not ok.');
    })
    .then(value => {
      let allData = filterForAll(value);
      let reactions = filterForReactions(value);
      let comments = filterForComments(value);
      let shares = filterForShares(value);
      drawMainChart(allData);
      drawSubChartOne(reactions);
      drawSubChartTwo(comments);
      drawSubChartThree(shares);
      endChartLoader();
    })
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

function filterForComments(data){
  let commentArray = data.map(post => {
    let date = new Date(post.time);
    let month = date.getMonth() + 1;
    let day = date.getDate();
    return [`${month}/${day}`, post.comments]
  });
  return commentArray.reverse();
}

function filterForReactions(data){
  let reactionsArray = data.map(post => {
    let date = new Date(post.time);
    let month = date.getMonth() + 1;
    let day = date.getDate();
    return [`${month}/${day}`, post.reactions]
  });
  return reactionsArray.reverse();
}

function filterForShares(data){
  let sharesArray = data.map(post => {
    let date = new Date(post.time);
    let month = date.getMonth();
    let day = date.getDate();
    return [`${month}/${day}`, post.shares_count]
  });
  return sharesArray.reverse();
}

function filterForAll(data){
  let allArray = data.map(post => {
    let date = new Date(post.time);
    let month = date.getMonth() + 1;
    let day = date.getDate();
    return [`${month}/${day}`, post.reactions, post.comments, post.shares_count]
  });
  return allArray.reverse();
}

function getPageLikes(){
  let myURL = `/fbPageLikeCount?user=${userFB}&fbApiKey=${fbApiKey}&fbApiSecret=${fbApiSecret}`;
  fetch(myURL)
    .then(resp => console.log(resp.text()))
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(() => {
  let startDate = getStartDate(10);
  let endDate = getTodaysDate();
  getData(startDate, endDate, "comments");
});

function drawMainChart(chartData) {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Posts');
      data.addColumn('number', 'Reactions');
      data.addColumn('number', 'Comments');
      data.addColumn('number', 'Shares');

      // addRows format [[a,b],[c,d],...]
      data.addRows(chartData);

      var options = {
        'title': "Overall Facebook Trends ",
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
}

function drawSubChartOne(chartData) {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Posts');
  data.addColumn('number', 'Likes');

  // addRows format [[a,b],[c,d],...]
  data.addRows(chartData);

  var options = {
    'title': "Reactions",
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
      title: 'Reactions',
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
  data.addColumn('number', 'Likes');

  // addRows format [[a,b],[c,d],...]
  data.addRows(chartData);

  var options = {
    'title': "Comments",
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
      title: 'Comments',
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
    'title': "Shares",
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

dayButtons.forEach(button => button.addEventListener('click', (e) => {
  dayButtons.forEach(button => button.classList.remove("bg-gold"));
  button.classList.add("bg-gold");
  let startDate = getStartDate(e.target.dataset.days);
  let endDate = getTodaysDate();
  getData(startDate, endDate);
}));

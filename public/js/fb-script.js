// Remember that userFB is set on dashboard page

const mainChart = document.querySelector('.main-chart');
const firstSubChart = document.querySelector('.sub-chart-one');
const secondSubChart = document.querySelector('.sub-chart-two');
const thirdSubChart = document.querySelector('.sub-chart-three');

/*
- get data
- filter data for specific chart
- pass filtered data to google chart which...
- update/render panels with charts
*/

let startDate = "01/01/2016";
let endDate = "01/01/2017";

function getData(start, end, filter){
  let myURL = `/fbGetFeedDateRange?user=${userFB}&since=${start}&until=${end}`
  return fetch(myURL)
    .then(resp => {
      if(resp.ok){
        return resp.json();
      }
      throw new Error('Network response was not ok.');
    })
    .then(value => {
      if(filter == "comments"){
        let comments = filterForComments(value);
        drawMainChart(comments);
        drawSubChartOne(comments);
        drawSubChartTwo(comments);
        drawSubChartThree(comments);
      } else if(filter == "reactions"){
        let reactions = filterForReactions(value);
        drawLineColors(reactions);
      } else if(filter == "shares"){
        let shares = filterForComments(value);
        drawLineColors(shares);
      }
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

function filterforShares(data){
  let sharesArray = data.map(post => {
    let date = new Date(post.time);
    let month = date.getMonth();
    let day = date.getDate();
    return [`${month}/${day}`, post.shares]
  });
  return sharesArray.reverse();
}

function getPageLikes(){
  let myURL = `/fbPageLikeCount?user=${userFB}`;
  fetch(myURL)
    .then(resp => console.log(resp.text()))
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}


google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(() => {getData(startDate, endDate, "comments");});

function drawMainChart(chartData) {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Posts');
      data.addColumn('number', 'Likes');

      // addRows format [[a,b],[c,d],...]
      data.addRows(chartData);

      var options = {
        'title': "Test Title",
        titleTextStyle: {
          color: '#fff',
          fontSize: 20
        },
        legendTextStyle: { color: '#FFF' },
        hAxis: {
          title: 'Recent Posts',
          baselineColor: '#FFF',
          gridlineColor: '#FFF',
          textStyle:{color: '#FFF'},
          titleTextStyle: {color: '#FFF'}
        },
        vAxis: {
          title: 'Number of Likes',
          baselineColor: '#FFF',
          gridlineColor: '#FFF',
          textStyle:{color: '#FFF'},
          titleTextStyle: {color: '#FFF'}
        },
        //need to figure out ability to resize
        width: mainChart.innerWidth,
        height: mainChart.innerHeight,
        colors: ['#BBA43F'],
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
    legendTextStyle: { color: '#FFF' },
    hAxis: {
      title: 'Recent Posts',
      baselineColor: '#FFF',
      gridlineColor: '#FFF',
      textStyle:{color: '#FFF'},
      titleTextStyle: {color: '#FFF'}
    },
    vAxis: {
      title: 'Number of Likes',
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
    legendTextStyle: { color: '#FFF' },
    hAxis: {
      title: 'Recent Posts',
      baselineColor: '#FFF',
      gridlineColor: '#FFF',
      textStyle:{color: '#FFF'},
      titleTextStyle: {color: '#FFF'}
    },
    vAxis: {
      title: 'Number of Likes',
      baselineColor: '#FFF',
      gridlineColor: '#FFF',
      textStyle:{color: '#FFF'},
      titleTextStyle: {color: '#FFF'}
    },
    //need to figure out ability to resize
    width: secondSubChart.innerWidth,
    height: secondSubChart.innerHeight,
    colors: ['#BBA43F'],
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
    legendTextStyle: { color: '#FFF' },
    hAxis: {
      title: 'Recent Posts',
      baselineColor: '#FFF',
      gridlineColor: '#FFF',
      textStyle:{color: '#FFF'},
      titleTextStyle: {color: '#FFF'}
    },
    vAxis: {
      title: 'Number of Likes',
      baselineColor: '#FFF',
      gridlineColor: '#FFF',
      textStyle:{color: '#FFF'},
      titleTextStyle: {color: '#FFF'}
    },
    //need to figure out ability to resize
    width: thirdSubChart.innerWidth,
    height: thirdSubChart.innerHeight,
    colors: ['#BBA43F'],
    backgroundColor: {
      fill: '#404040',
    }
  };

  var chart = new google.visualization.LineChart(thirdSubChart);
  chart.draw(data, options);
}

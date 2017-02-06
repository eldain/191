// Remember that userFB is set on the page that loads this script page

const mainChart = document.querySelector('.main-chart');
let comments;
let reactions;

function getData(postCount){
  let myURL = `/fbGetFeedData?user=${userFB}&post_count=${postCount}`
  return fetch(myURL)
    .then(resp => {
      if(resp.ok){
        return resp.json();
      }
      throw new Error('Network response was not ok.');
    })
    .then(value => {
      comments = filterForComments(value);
      reactions = filterForReactions(value);
      drawLineColors(comments);
    })
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

let startDate = "01/01/2016";
let endDate = "01/01/2017";
function getDateData(start, end){
  let myURL = `/fbGetFeedDateRange?user=${userFB}&since=${start}&until=${end}`
  return fetch(myURL)
    .then(resp => {
      if(resp.ok){
        console.log(resp.json());
      }
      throw new Error('Network response was not ok.');
    })
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

// This works!
// A years worth of posts!
// getDateData(startDate, endDate);

function filterForComments(data){
  let commentArray = data.map(post => {
    let date = new Date(post.time);
    let month = date.getMonth();
    let day = date.getDate();
    return [`${month}/${day}`, post.comments]
  });
  return commentArray.reverse();
}

function filterForReactions(data){
  let reactionsArray = data.map(post => {
    let date = new Date(post.time);
    let month = date.getMonth();
    let day = date.getDate();
    return [`${month}/${day}`, post.reactions]
  });
  return reactionsArray.reverse();
}

function getPageLikes(){
  let myURL = `/fbPageLikeCount?user=${userFB}`;
  fetch(myURL)
    .then(resp => console.log(resp.text()))
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

function createChartData(){
  let i = 0;
  let testArray = [1,2,44,4,5,30,7,4,5,30,7]

  let newArray = testArray.map(x => {
    return [x];
  });

  newArray.forEach(item => {
    item.unshift(String(i));
    i++;
  });

  return newArray;
}


google.charts.load('current', {packages: ['corechart', 'line']});
// google.charts.setOnLoadCallback(drawLineColors);

function drawLineColors(chartData) {
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
        width: mainChart.innerWidth,
        height: mainChart.innerHeight,
        colors: ['#BBA43F'],
        backgroundColor: {
          fill: '#404040',
        }
      };

      var chart = new google.visualization.LineChart(document.querySelector('.main-chart'));
      chart.draw(data, options);
}

mainChart.addEventListener('click',() =>{
  getData(50);
});

// Remember that userFB is set on the page that loads this script page

const chartButton = document.querySelector('.chart-button');
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

      vAxis:{

       }

      var options = {
        hAxis: {
          title: 'Recent Posts',
          baselineColor: '#FFF',
          gridlineColor: '#FFF',
          textStyle:{color: '#FFF'}
        },
        vAxis: {
          title: 'Number of Likes',
          baselineColor: '#FFF',
          gridlineColor: '#FFF',
          textStyle:{color: '#FFF'}
        },
        width: 900,
        height: 400,
        colors: ['#BBA43F'],
        backgroundColor: {
          fill: '#404040',
          // or fill:'transparent'
        }
      };

      var chart = new google.visualization.LineChart(document.querySelector('#chart_div'));
      chart.draw(data, options);
}

chartButton.addEventListener('click',() =>{
  getData(50);
  chartButton.remove();
});

// Remember that userFB is set on the page that loads this script page

function getPageLikes(){
  let URL = `/fbPageLikeCount?user=${userFB}`;
  fetch(URL)
    .then(resp => console.log(resp.text()))
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

// Ideally would be able to call resp.json instead of .text, then pass that value to createChartData
function getReactions(postCount){
  let myURL = `/fbReactionsPerPost?user=${userFB}&post_count=${postCount}`;
  fetch(myURL)
    .then(resp => console.log(resp.text()))
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

function getComments(postCount){
  let URL = `/fbCommentsPerPost?user=${userFB}&post_count=${postCount}`;
  fetch(URL)
    .then(resp => console.log(resp.text()))
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

function createChartData(){
  let i = 0;
  let testArray = [1,2,44,4,5,30,7,3]

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
google.charts.setOnLoadCallback(drawLineColors);

function drawLineColors() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Posts');
      data.addColumn('number', 'Likes');

      // data.addRows([
      //   [0,2],  [1, 4],  [2, 5],  [3, 9]
      // ]);
      data.addRows(createChartData());

      var options = {
        hAxis: {
          title: 'Recent Posts',
        },
        vAxis: {
          title: 'Number of Likes'
        },
        width: 900,
        height: 400,
        colors: ['#759FFA']
      };

      var chart = new google.visualization.LineChart(document.querySelector('#chart_div'));
      chart.draw(data, options);
}

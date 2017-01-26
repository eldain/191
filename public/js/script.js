function test(){
  fetch('/fbReactionsPerPost?post_count=10')
    .then((resp) => console.log(resp.text()))
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}


// this one works, just open up the promise in the console and you'll see a zen saying. when you open up the test() promise from above, says you need to login again
function testOutside(){
  fetch('https://api.github.com/zen')
    .then((resp) => console.log(resp.text()))
    .catch(function(error) {
      console.log('There has been a problem with your fetch operation: ' + error.message);
    });
}

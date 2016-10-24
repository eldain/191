<!-- View stored in app/views/graph.php -->

<!DOCTYPE html>
<html class="ocks-org do-not-copy">
<meta charset="utf-8">
<title>Graph</title>
<style>

.x.axis line {
  shape-rendering: auto;
}

.line {
  fill: none;
  stroke: #000;
  stroke-width: 1.5px;
}

</style>
<script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script></script>
<script>

var n = 40,
    random = d3.random.normal(0, .2);

function chart(domain, interpolation, tick) {
  var data = d3.range(n).map(random);

  var margin = {top: 6, right: 0, bottom: 6, left: 40},
      width = 960 - margin.right,
      height = 120 - margin.top - margin.bottom;

  var x = d3.scale.linear()
      .domain(domain)
      .range([0, width]);

  var y = d3.scale.linear()
      .domain([-1, 1])
      .range([height, 0]);

  var line = d3.svg.line()
      .interpolate(interpolation)
      .x(function(d, i) { return x(i); })
      .y(function(d, i) { return y(d); });

  var svg = d3.select("body").append("p").append("svg")
      .attr("width", width + margin.left + margin.right)
      .attr("height", height + margin.top + margin.bottom)
      .style("margin-left", -margin.left + "px")
    .append("g")
      .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  svg.append("defs").append("clipPath")
      .attr("id", "clip")
    .append("rect")
      .attr("width", width)
      .attr("height", height);

  svg.append("g")
      .attr("class", "y axis")
      .call(d3.svg.axis().scale(y).ticks(5).orient("left"));

  var path = svg.append("g")
      .attr("clip-path", "url(#clip)")
    .append("path")
      .datum(data)
      .attr("class", "line")
      .attr("d", line);

  tick(path, line, data, x);
}

</script>
	
<p><b>interpolate the transform</b></p>

<script>(function() {

var transition = d3.select({}).transition()
    .duration(750)
    .ease("linear");

chart([0, n - 1], "linear", function tick(path, line, data, x) {
  transition = transition.each(function() {

    // push a new data point onto the back
    data.push(random());

    // redraw the line, and then slide it to the left
    path
        .attr("d", line)
        .attr("transform", null)
      .transition()
        .attr("transform", "translate(" + x(-1) + ")");

    // pop the old data point off the front
    data.shift();

  }).transition().each("start", function() { tick(path, line, data, x); });
});

})();</script>

<p><b>spline interpolation</b></p>

<script>(function() {

var transition = d3.select({}).transition()
    .duration(750)
    .ease("linear");

chart([1, n - 2], "basis", function tick(path, line, data, x) {
  transition = transition.each(function() {

    // push a new data point onto the back
    data.push(random());

    // redraw the line, and then slide it to the left, and repeat indefinitely
    path
        .attr("d", line)
        .attr("transform", null)
      .transition()
        .attr("transform", "translate(" + x(0) + ")");

    // pop the old data point off the front
    data.shift();

  }).transition().each("start", function() { tick(path, line, data, x); });
});

})();</script>

<p>D3’s built-in <a href="https://github.com/mbostock/d3/wiki/SVG-Axes">axes</a> and <a href="https://github.com/mbostock/d3/wiki/Time-Scales">time scales</a>. This chart, for example, shows your scrolling activity while reading this document over the last three minutes:

<script>(function() {

var n = 243,
    duration = 750,
    now = new Date(Date.now() - duration),
    count = 0,
    data = d3.range(n).map(function() { return 0; });

var margin = {top: 6, right: 0, bottom: 20, left: 40},
    width = 960 - margin.right,
    height = 120 - margin.top - margin.bottom;

var x = d3.time.scale()
    .domain([now - (n - 2) * duration, now - duration])
    .range([0, width]);

var y = d3.scale.linear()
    .range([height, 0]);

var line = d3.svg.line()
    .interpolate("basis")
    .x(function(d, i) { return x(now - (n - 1 - i) * duration); })
    .y(function(d, i) { return y(d); });

var svg = d3.select("body").append("p").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .style("margin-left", -margin.left + "px")
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

svg.append("defs").append("clipPath")
    .attr("id", "clip")
  .append("rect")
    .attr("width", width)
    .attr("height", height);

var axis = svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + height + ")")
    .call(x.axis = d3.svg.axis().scale(x).orient("bottom"));

var path = svg.append("g")
    .attr("clip-path", "url(#clip)")
  .append("path")
    .datum(data)
    .attr("class", "line");

var transition = d3.select({}).transition()
    .duration(750)
    .ease("linear");

d3.select(window)
    .on("scroll", function() { ++count; });

(function tick() {
  transition = transition.each(function() {

    // update the domains
    now = new Date();
    x.domain([now - (n - 2) * duration, now - duration]);
    y.domain([0, d3.max(data)]);

    // push the accumulated count onto the back, and reset the count
    data.push(Math.min(30, count));
    count = 0;

    // redraw the line
    svg.select(".line")
        .attr("d", line)
        .attr("transform", null);

    // slide the x-axis left
    axis.call(x.axis);

    // slide the line left
    path.transition()
        .attr("transform", "translate(" + x(now - (n - 1) * duration) + ")");

    // pop the old data point off the front
    data.shift();

  }).transition().each("start", tick);
})();

})()</script>

<p>Notice that the exiting tick marks smoothly fade-out, while the entering tick marks smoothly fade-in; this is handled automatically by the axis component. The process for transitioning the axis is the same as for the transform: update the scale’s domain, then apply linear easing.

<p>Questions or comments? These examples are available as <a href="https://gist.github.com/1642874">GitHub gists</a>. Find me on <a href="http://twitter.com/mbostock">Twitter</a> or stop by the <a href="https://groups.google.com/group/d3-js">d3-js group</a>.

<p>Random Text for better scrolling</p>
<p>Random Text for better scrolling</p>
<p>Random Text for better scrolling</p>
<p>Random Text for better scrolling</p>
<p>Random Text for better scrolling</p>
<p>Random Text for better scrolling</p>
<p>Random Text for better scrolling</p>
<p>Random Text for better scrolling</p>
<footer>
  <aside>January 19, 2012</aside>
  <a href="../" rel="author">Mike Bostock</a>
</footer>

<script>

GoogleAnalyticsObject = "ga", ga = function() { ga.q.push(arguments); }, ga.q = [], ga.l = +new Date;
ga("create", "UA-48272912-3", "ocks.org");
ga("send", "pageview");

</script>
<script async src="../highlight.min.js"></script>
<script async src="//www.google-analytics.com/analytics.js"></script>

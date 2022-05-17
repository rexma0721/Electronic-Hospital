google.charts.load('current', {'packages':['corechart','scatter']});
// 1. Basic
google.charts.setOnLoadCallback(basicChart);
// 2. animatingShapes
google.charts.setOnLoadCallback(animatingShapes);
// 3.Material scatter charts
google.charts.setOnLoadCallback(drawScatterChart);
// 4.Dual-Y charts
google.charts.setOnLoadCallback(drawScatterDualYXharts);
// 5. Top-X charts
google.charts.setOnLoadCallback(drawScatterTopXcharts);

// 1. Basic
function basicChart() {
  var data = google.visualization.arrayToDataTable([
    ['Age', 'Weight'],
    [ 8,      12],
    [ 4,      5.5],
    [ 11,     14],
    [ 4,      5],
    [ 3,      3.5],
    [ 6.5,    7]
  ]);

  var options = {
    title: 'Age vs. Weight comparison',
    hAxis: {title: 'Age', minValue: 0, maxValue: 15},
    vAxis: {title: 'Weight', minValue: 0, maxValue: 15},
    legend: 'none',
    width:'100%',
    height:480,
    colors: ['#ff9800']
  };

  var chart = new google.visualization.ScatterChart(document.getElementById('chart_scatterChart'));

  chart.draw(data, options);
}
// 2. animatingShapes
function animatingShapes() {
  var data = new google.visualization.DataTable();
  data.addColumn('number');
  data.addColumn('number');

  var radius = 100;
  for (var i = 0; i < 6.28; i += 0.1) {
    data.addRow([radius * Math.cos(i), radius * Math.sin(i)]);
  }

  // Our central point, which will jiggle.
  data.addRow([0, 0]);

  var options = {
    legend: 'none',
    colors: ['#087037'],
    pointShape: 'star',
    pointSize: 18,
    animation: {
      duration: 200,
      easing: 'inAndOut',
    },
    width:'100%',
    height:480
  };

  var chart = new google.visualization.ScatterChart(document.getElementById('animatedshapes_div'));

  // Start the animation by listening to the first 'ready' event.
  google.visualization.events.addOneTimeListener(chart, 'ready', randomWalk);

  // Control all other animations by listening to the 'animationfinish' event.
  google.visualization.events.addListener(chart, 'animationfinish', randomWalk);

  chart.draw(data, options);

  function randomWalk() {
    var x = data.getValue(data.getNumberOfRows() - 1, 0);
    var y = data.getValue(data.getNumberOfRows() - 1, 1);
    x += 5 * (Math.random() - 0.5);
    y += 5 * (Math.random() - 0.5);
    if (x * x + y * y > radius * radius) {
      // Out of bounds. Bump toward center.
      x += Math.random() * ((x < 0) ? 5 : -5);
      y += Math.random() * ((y < 0) ? 5 : -5);
    }
    data.setValue(data.getNumberOfRows() - 1, 0, x);
    data.setValue(data.getNumberOfRows() - 1, 1, y);
    chart.draw(data, options);
  }
}
// 3. Material scatter charts
function drawScatterChart () {
  var data = new google.visualization.DataTable();
  data.addColumn('number', 'Hours Studied');
  data.addColumn('number', 'Final');

  data.addRows([
    [0, 67], [1, 88], [2, 77],
    [3, 93], [4, 85], [5, 91],
    [6, 71], [7, 78], [8, 93],
    [9, 80], [10, 82],[0, 75],
    [5, 80], [3, 90], [1, 72],
    [5, 75], [6, 68], [7, 98],
    [3, 82], [9, 94], [2, 79],
    [2, 95], [2, 86], [3, 67],
    [4, 60], [2, 80], [6, 92],
    [2, 81], [8, 79], [9, 83],
    [3, 75], [1, 80], [3, 71],
    [3, 89], [4, 92], [5, 85],
    [6, 92], [7, 78], [6, 95],
    [3, 81], [0, 64], [4, 85],
    [2, 83], [3, 96], [4, 77],
    [5, 89], [4, 89], [7, 84],
    [4, 92], [9, 98]
  ]);

  var options = {
    width: '100%',
    height: 500,
    chart: {
      title: 'Students\' Final Grades',
      subtitle: 'based on hours studied'
    },
    hAxis: {title: 'Hours Studied'},
    vAxis: {title: 'Grade'},
    legend:{position:'left'},
    colors: ['#ffb300']
  };

  var chart = new google.charts.Scatter(document.getElementById('scatterchart_material'));

  chart.draw(data, google.charts.Scatter.convertOptions(options));
}
// 4.Dual-Y charts
function drawScatterDualYXharts () {

  var data = new google.visualization.DataTable();
  data.addColumn('number', 'Student ID');
  data.addColumn('number', 'Hours Studied');
  data.addColumn('number', 'Final');

  data.addRows([
    [0, 0, 67],  [1, 1, 88],   [2, 2, 77],
    [3, 3, 93],  [4, 4, 85],   [5, 5, 91],
    [6, 6, 71],  [7, 7, 78],   [8, 8, 93],
    [9, 9, 80],  [10, 10, 82], [11, 0, 75],
    [12, 5, 80], [13, 3, 90],  [14, 1, 72],
    [15, 5, 75], [16, 6, 68],  [17, 7, 98],
    [18, 3, 82], [19, 9, 94],  [20, 2, 79],
    [21, 2, 95], [22, 2, 86],  [23, 3, 67],
    [24, 4, 60], [25, 2, 80],  [26, 6, 92],
    [27, 2, 81], [28, 8, 79],  [29, 9, 83]
  ]);

  var options = {
    chart: {
      title: 'Students\' Final Grades',
      subtitle: 'based on hours studied'
    },
    width: '100%',
    height: 500,
    series: {
      0: {axis: 'hours studied'},
      1: {axis: 'final grade'}
    },
    axes: {
      y: {
        'hours studied': {label: 'Hours Studied'},
        'final grade': {label: 'Final Exam Grade'}
      }
    },
    colors: ['#43a047','#cddc39']
  };

  var chart = new google.charts.Scatter(document.getElementById('scatter_dual_y'));

  chart.draw(data, options);
}
// 5. Top-X charts
function drawScatterTopXcharts () {

  var data = new google.visualization.DataTable();
  data.addColumn('number', 'Hours Studied');
  data.addColumn('number', 'Final');

  data.addRows([
    [0, 67],  [1, 88],  [2, 77],
    [3, 93],  [4, 85],  [5, 91],
    [6, 71],  [7, 78],  [8, 93],
    [9, 80],  [10, 82], [0, 75],
    [5, 80],  [3, 90],  [1, 72],
    [5, 75],  [6, 68],  [7, 98],
    [3, 82],  [9, 94],  [2, 79],
    [2, 95],  [2, 86],  [3, 67],
    [4, 60],  [2, 80],  [6, 92],
    [2, 81],  [8, 79],  [9, 83],
    [3, 75],  [1, 80],  [3, 71],
    [3, 89],  [4, 92],  [5, 85],
    [6, 92],  [7, 78],  [6, 95],
    [3, 81],  [0, 64],  [4, 85],
    [2, 83],  [3, 96],  [4, 77],
    [5, 89],  [4, 89],  [7, 84],
    [4, 92],  [9, 98]
  ]);

  var options = {
    width: '100%',
    height: 500,
    chart: {
      title: 'Students\' Final Grades',
      subtitle: 'based on hours studied'
    },
    axes: {
      x: {
        0: {side: 'top'}
      }
    },
    colors: ['#f44336']
  };

  var chart = new google.charts.Scatter(document.getElementById('scatter_top_x'));

  chart.draw(data, google.charts.Scatter.convertOptions(options));
}

function redrawChart(){
  setTimeout(function () {
    basicChart();
    animatingShapes();
    drawScatterChart();
    drawScatterDualYXharts();
    drawScatterTopXcharts();
  }, 500);
}
// -------------------------------------
$(window).resize(function(){
  redrawChart();
});
$('.iconizedToggle').click(function(){
  redrawChart();
});
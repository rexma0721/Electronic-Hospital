
google.charts.load('current', {'packages':['corechart']});
// ----------------------------------------
// 1.A Simple Example
google.charts.setOnLoadCallback(drawChart);
// 2.Stacking Areas
google.charts.setOnLoadCallback(drawStackedChart);
// 3. 100% stacked
google.charts.setOnLoadCallback(draw100PerStackedChart);
// 4. Steped - Area
google.charts.setOnLoadCallback(steppedAreaChart);
// 5. Stacked Stepped Area Charts
google.charts.setOnLoadCallback(stackedSteppedAreaCharts);
// ----------------------------------------
// 1.A Simple Example
function drawChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Year', 'Sales', 'Expenses'],
	  ['2013',  1000,      400],
	  ['2014',  1170,      460],
	  ['2015',  660,       1120],
	  ['2016',  1030,      540]
	]);

	var options = {
	  title: 'Company Performance',
	  hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
	  vAxis: {minValue: 0},
	  height:480,
      colors:['#2088B2','#D86E3F'],
      legend: { position: 'bottom' }
	};

	var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}
// 2.Stacking Areas
function drawStackedChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Year', 'Sales', 'Expenses'],
	  ['2013',  1000,      400],
	  ['2014',  1170,      460],
	  ['2015',  660,       1120],
	  ['2016',  1030,      540]
	]);

	var options = {
	  title: 'Company Performance',
	  hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
	  vAxis: {minValue: 0},
	  height:480,
      colors:['#EDBD3E','#495E88'],      
	  isStacked: true,
	  legend: {position: 'top', maxLines: 3}
	};

	var chart = new google.visualization.AreaChart(document.getElementById('chart_stacked'));
	chart.draw(data, options);
}
// 3. 100% stacked
function draw100PerStackedChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Year', 'Sales', 'Expenses'],
	  ['2013',  1000,      400],
	  ['2014',  1170,      460],
	  ['2015',  660,       1120],
	  ['2016',  1030,      540]
	]);

	var options = {
	  title: 'Company Performance',
	  hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
	  vAxis: {
	  	minValue: 0,
        ticks: [0, .3, .6, .9, 1]
	  },
	  height:480,
      colors:['#085DAD','#21BEDE'],      
	  isStacked: 'relative',
	  legend: {position: 'top', maxLines: 3}
	};

	var chart = new google.visualization.AreaChart(document.getElementById('chart_stacked100'));
	chart.draw(data, options);
}
// 4. Steped - Area
function steppedAreaChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Director (Year)',  'Rotten Tomatoes', 'IMDB'],
	  ['Alfred Hitchcock (1935)', 8.4,         7.9],
	  ['Ralph Thomas (1959)',     6.9,         6.5],
	  ['Don Sharp (1978)',        6.5,         6.4],
	  ['James Hawes (2008)',      4.4,         6.2]
	]);

	var options = {
	  title: 'The decline of \'The 39 Steps\'',
	  vAxis: {title: 'Accumulated Rating'},
	  isStacked: true,
	  colors:['#FF8F00','#2B2B2B'],      
	  isStacked: true,
	  height:480,
	  legend: {position: 'bottom'}
	};

	var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_steppedAreaChart'));

	chart.draw(data, options);
}
// 5. Stacked Stepped Area Charts
function stackedSteppedAreaCharts() {
	var data = google.visualization.arrayToDataTable([
	  ['Director (Year)',  'Rotten Tomatoes', 'IMDB'],
	  ['Alfred Hitchcock (1935)', 8.4,         7.9],
	  ['Ralph Thomas (1959)',     6.9,         6.5],
	  ['Don Sharp (1978)',        6.5,         6.4],
	  ['James Hawes (2008)',      4.4,         6.2]
	]);

	var options = {
	  title: 'The decline of \'The 39 Steps\'',
	  isStacked: 'relative',
	  colors:['#FF8F00','#2B2B2B'],      
	  isStacked: true,
	  height:480,
	  legend: {position: 'bottom'},
	  vAxis: {
        minValue: 0,
        ticks: [0, .3, .6, .9, 1]
      }
	};

	var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_stackedSteppedAreaCharts'));

	chart.draw(data, options);
}

// -*------------------------------------
function redrawChart(){
  setTimeout(function () {
    drawChart();
	drawStackedChart();
	draw100PerStackedChart();
	steppedAreaChart();
	stackedSteppedAreaCharts();
  }, 800);
}
// -------------------------------------
$(window).resize(function(){
  redrawChart();
});
$('.iconizedToggle').click(function(){
  redrawChart();
});
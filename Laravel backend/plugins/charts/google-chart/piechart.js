google.charts.load('current', {'packages':['corechart']});
// ----------------------------------------------------
// 1. Example
google.charts.setOnLoadCallback(drawChart);
// 2. 3D pieChart
google.charts.setOnLoadCallback(drawChart3D);
// 3. Sliced
google.charts.setOnLoadCallback(drawSlicedChart);
// 4.pacman
google.charts.setOnLoadCallback(pacman);
// 5. Donute
google.charts.setOnLoadCallback(donutchart);
// ----------------------------------------------------
// 1.
function drawChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Task', 'Hours per Day'],
	  ['Work',     11],
	  ['Eat',      2],
	  ['Commute',  2],
	  ['Watch TV', 2],
	  ['Sleep',    7]
	]);

	var options = {
	  title: 'My Daily Activities',
	  height:480,
	  colors:['#5A8F29','#FF8F00','#3C7DC4','#2B2B2B','#99CCFF'],
	  legend: { position: 'bottom' }
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	chart.draw(data, options);
}
// 2.
function drawChart3D() {
	var data = google.visualization.arrayToDataTable([
	  ['Task', 'Hours per Day'],
	  ['Work',     11],
	  ['Eat',      2],
	  ['Commute',  2],
	  ['Watch TV', 2],
	  ['Sleep',    7]
	]);

	var options = {
	  	title: 'My Daily Activities',
	  	is3D: true,
		height:480,
		colors:['#EF597B','#EF597B','#73B66B','#FFCB18','#29A2C6'],
		legend: { position: 'bottom' }
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
	chart.draw(data, options);
}
// 3. Sliced
function drawSlicedChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Language', 'Speakers (in millions)'],
	  ['Assamese', 13], ['Bengali', 83], ['Bodo', 1.4],
	  ['Dogri', 2.3], ['Gujarati', 46], ['Hindi', 300],
	  ['Kannada', 38], ['Kashmiri', 5.5], ['Konkani', 5],
	  ['Maithili', 20], ['Malayalam', 33], ['Manipuri', 1.5],
	  ['Marathi', 72], ['Nepali', 2.9], ['Oriya', 33],
	  ['Punjabi', 29], ['Sanskrit', 0.01], ['Santhali', 6.5],
	  ['Sindhi', 2.5], ['Tamil', 61], ['Telugu', 74], ['Urdu', 52]
	]);

	var options = {
	  title: 'Indian Language Use',
	  legend: 'none',
	  pieSliceText: 'label',
	  slices: {  4: {offset: 0.2},
	            12: {offset: 0.3},
	            14: {offset: 0.4},
	            15: {offset: 0.5},
	  },
	  height:480,
	  colors:['#006666','#9DBCBC','#FFCC66','#F6A03D','#6B6B6B'],
	  legend: { position: 'bottom' }
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechart_sliced'));
	chart.draw(data, options);
}
// 4. Removed Sliced
function pacman() {
    var data = google.visualization.arrayToDataTable([
      ['Pac Man', 'Percentage'],
      ['', 75],
      ['', 25]
    ]);

    var options = {
      legend: 'none',
      pieSliceText: 'none',
      pieStartAngle: 135,
      tooltip: { trigger: 'none' },
      slices: {
        0: { color: '#FFCB18' },
        1: { color: 'transparent' }
      },
	  height:480,
	  // colors:['#EF597B','#EF597B','#73B66B','#FFCB18','#29A2C6'],
	  legend: { position: 'bottom' }
    };

    var chart = new google.visualization.PieChart(document.getElementById('pacman'));
    chart.draw(data, options);
}
// 5. Donute
function donutchart() {
	var data = google.visualization.arrayToDataTable([
	  ['Task', 'Hours per Day'],
	  ['Work',     11],
	  ['Eat',      2],
	  ['Commute',  2],
	  ['Watch TV', 2],
	  ['Sleep',    7]
	]);

	var options = {
	  title: 'My Daily Activities',
	  pieHole: 0.4,
	  height:480,
		colors:['#405774','#6787B0','#B1B17B','#CD6607','#F6A03D'],
		legend: { position: 'bottom' }
	};

	var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
	chart.draw(data, options);
}
// ----------------------------------------------------
function redrawChart(){
  setTimeout(function () {
    drawChart();
	drawChart3D();
	drawSlicedChart();
	pacman();
	donutchart();
  }, 800);
}
// -------------------------------------
$(window).resize(function(){
  redrawChart();
});
$('.iconizedToggle').click(function(){
  redrawChart();
});
google.charts.load('current', {'packages':['corechart']});
// 1. Example1
google.charts.setOnLoadCallback(drawVisualization);

// --------------------------------------------------
// 1. Example1
function drawVisualization() {
	// Some raw data (not necessarily accurate)
	var data = google.visualization.arrayToDataTable([
	 ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
	 ['2004/05',  165,      938,         522,             998,           450,      614.6],
	 ['2005/06',  135,      1120,        599,             1268,          288,      682],
	 ['2006/07',  157,      1167,        587,             807,           397,      623],
	 ['2007/08',  139,      1110,        615,             968,           215,      609.4],
	 ['2008/09',  136,      691,         629,             1026,          366,      569.6]
	]);

	var options = {
		title : 'Monthly Coffee Production by Country',
		vAxis: {title: 'Cups'},
		hAxis: {title: 'Month'},
		seriesType: 'bars',
		series: {5: {type: 'line'}},
		height:480,
		legend: { position: 'bottom' },
		colors:['#F2BC00','#FFF0BA','#FF542E','#CFD6DE','#ADC1D6']
	};

	var chart = new google.visualization.ComboChart(document.getElementById('visualization_combo'));
	chart.draw(data, options);
}
// -------------------------------------

// -------------------------------------
$(window).resize(function(){
	drawVisualization();
});
$('.iconizedToggle').click(function(){
  drawVisualization();
});
google.charts.load('current', {packages: ['corechart', 'bar']});
// 1. Basic column chart with default styling
google.charts.setOnLoadCallback(drawBasic);
// 2. Basic column chart with multiple series
google.charts.setOnLoadCallback(drawMultSeries);
// 3. Customizable column colors
google.charts.setOnLoadCallback(drawColColors);
//4.  Customizable axis and tick labels
google.charts.setOnLoadCallback(drawAxisTickColors);
// 5. Stacked columns
google.charts.setOnLoadCallback(drawStacked);
// 6. Annotations
google.charts.setOnLoadCallback(drawAnnotations);
// 7.Trendlines
google.charts.setOnLoadCallback(drawTrendlines);
// 8.Material
google.charts.setOnLoadCallback(drawMaterial);
// 9.Material - TitleSubtitle
google.charts.setOnLoadCallback(drawTitleSubtitle);
// 10. Material - DualY
google.charts.setOnLoadCallback(drawDualY);
// 11. Top X-axis
google.charts.setOnLoadCallback(drawTopX);
// 12. Extra : Color column
google.charts.setOnLoadCallback(drawColorCols);
// 13.  drawChart3Cols
google.charts.setOnLoadCallback(drawChart3Cols);

// -----------------------------------------------------------------------------
// 1. Basic column chart with default styling
function drawBasic() {
	var data = new google.visualization.DataTable();
		data.addColumn('timeofday', 'Time of Day');
		data.addColumn('number', 'Motivation Level');

	data.addRows([
		[{v: [8, 0, 0], f: '8 am'}, 1],
		[{v: [9, 0, 0], f: '9 am'}, 2],
		[{v: [10, 0, 0], f:'10 am'}, 3],
		[{v: [11, 0, 0], f: '11 am'}, 4],
		[{v: [12, 0, 0], f: '12 pm'}, 5],
		[{v: [13, 0, 0], f: '1 pm'}, 6],
		[{v: [14, 0, 0], f: '2 pm'}, 7],
		[{v: [15, 0, 0], f: '3 pm'}, 8],
		[{v: [16, 0, 0], f: '4 pm'}, 9],
		[{v: [17, 0, 0], f: '5 pm'}, 10],
	]);

	var options = {
		title: 'Motivation Level Throughout the Day',
		hAxis: {
		  title: 'Time of Day',
		  format: 'h:mm a',
		  viewWindow: {
		    min: [7, 30, 0],
		    max: [17, 30, 0]
		  }
		},
		vAxis: {
		  title: 'Rating (scale of 1-10)'
		},
		height:480,
    	legend: { position: 'bottom' }
	};

	var chart = new google.visualization.ColumnChart(document.getElementById('chart_columnBasic'));
	chart.draw(data, options);
}
// 2.Basic column chart with multiple series
function drawMultSeries() {
  var data = new google.visualization.DataTable();
  data.addColumn('timeofday', 'Time of Day');
  data.addColumn('number', 'Motivation Level');
  data.addColumn('number', 'Energy Level');

  data.addRows([
    [{v: [8, 0, 0], f: '8 am'}, 1, .25],
    [{v: [9, 0, 0], f: '9 am'}, 2, .5],
    [{v: [10, 0, 0], f:'10 am'}, 3, 1],
    [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
    [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
    [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
    [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
    [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
    [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
    [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
  ]);

  var options = {
    title: 'Motivation and Energy Level Throughout the Day',
    hAxis: {
      title: 'Time of Day',
      format: 'h:mm a',
      viewWindow: {
        min: [7, 30, 0],
        max: [17, 30, 0]
      }
    },
    vAxis: {
      title: 'Rating (scale of 1-10)'
    },
    height:480,
    legend: { position: 'bottom' }
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_columnMultipleSeries'));
  chart.draw(data, options);
}
// 3. Customizable column colors
function drawColColors() {
  var data = new google.visualization.DataTable();
  data.addColumn('timeofday', 'Time of Day');
  data.addColumn('number', 'Motivation Level');
  data.addColumn('number', 'Energy Level');

  data.addRows([
    [{v: [8, 0, 0], f: '8 am'}, 1, .25],
    [{v: [9, 0, 0], f: '9 am'}, 2, .5],
    [{v: [10, 0, 0], f:'10 am'}, 3, 1],
    [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
    [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
    [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
    [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
    [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
    [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
    [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
  ]);

  var options = {
    title: 'Motivation and Energy Level Throughout the Day',
    colors: ['#9575cd', '#33ac71'],
    hAxis: {
      title: 'Time of Day',
      format: 'h:mm a',
      viewWindow: {
        min: [7, 30, 0],
        max: [17, 30, 0]
      }
    },
    vAxis: {
      title: 'Rating (scale of 1-10)'
    },
    height:480,
    legend: { position: 'bottom' }
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_colColors'));
  chart.draw(data, options);
}
//4.  Customizable axis and tick labels
function drawAxisTickColors() {
  var data = new google.visualization.DataTable();
  data.addColumn('timeofday', 'Time of Day');
  data.addColumn('number', 'Motivation Level');
  data.addColumn('number', 'Energy Level');

  data.addRows([
    [{v: [8, 0, 0], f: '8 am'}, 1, .25],
    [{v: [9, 0, 0], f: '9 am'}, 2, .5],
    [{v: [10, 0, 0], f:'10 am'}, 3, 1],
    [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
    [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
    [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
    [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
    [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
    [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
    [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
  ]);

  var options = {
    title: 'Motivation and Energy Level Throughout the Day',
    focusTarget: 'category',
    height:480,
    legend: { position: 'top' ,alignment:'center'},
    colors:['#fea19a','#fec68a'],
    hAxis: {
      title: 'Time of Day',
      format: 'h:mm a',
      viewWindow: {
        min: [7, 30, 0],
        max: [17, 30, 0]
      },
      textStyle: {
        fontSize: 14,
        color: '#fec68a',
        bold: true,
        italic: false
      },
      titleTextStyle: {
        fontSize: 18,
        color: '#fea19a',
        bold: true,
        italic: false
      }
    },
    vAxis: {
      title: 'Rating (scale of 1-10)',
      textStyle: {
        fontSize: 18,
        color: '#E45641',
        bold: false,
        italic: false
      },
      titleTextStyle: {
        fontSize: 18,
        color: '#5D4C46',
        bold: true,
        italic: false
      }
    }
  };
  var chart = new google.visualization.ColumnChart(document.getElementById('chart_axisTickColors'));
  chart.draw(data, options);
}
// 5. Stacked columns
function drawStacked() {
  var data = new google.visualization.DataTable();
  data.addColumn('timeofday', 'Time of Day');
  data.addColumn('number', 'Motivation Level');
  data.addColumn('number', 'Energy Level');

  data.addRows([
    [{v: [8, 0, 0], f: '8 am'}, 1, .25],
    [{v: [9, 0, 0], f: '9 am'}, 2, .5],
    [{v: [10, 0, 0], f:'10 am'}, 3, 1],
    [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
    [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
    [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
    [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
    [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
    [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
    [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
  ]);

  var options = {
    title: 'Motivation and Energy Level Throughout the Day',
    isStacked: true,
    hAxis: {
      title: 'Time of Day',
      format: 'h:mm a',
      viewWindow: {
        min: [7, 30, 0],
        max: [17, 30, 0]
      }
    },
    vAxis: {
      title: 'Rating (scale of 1-10)'
    },
    height:480,
    colors:['#44B3C2','#F1A94E'],
    legend: { position: 'bottom' ,alignment:'center'},
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_stacked'));
  chart.draw(data, options);
}
// 6. Annotations
function drawAnnotations() {
  var data = new google.visualization.DataTable();
  data.addColumn('timeofday', 'Time of Day');
  data.addColumn('number', 'Motivation Level');
  data.addColumn({type: 'string', role: 'annotation'});
  data.addColumn('number', 'Energy Level');
  data.addColumn({type: 'string', role: 'annotation'});

  data.addRows([
    [{v: [8, 0, 0], f: '8 am'},   1, '1',  .25, '.2'],
    [{v: [9, 0, 0], f: '9 am'},   2, '2',   .5, '.5'],
    [{v: [10, 0, 0], f:'10 am'},  3, '3',    1,  '1'],
    [{v: [11, 0, 0], f: '11 am'}, 4, '4', 2.25,  '2'],
    [{v: [12, 0, 0], f: '12 pm'}, 5, '5', 2.25,  '2'],
    [{v: [13, 0, 0], f: '1 pm'},  6, '6',    3,  '3'],
    [{v: [14, 0, 0], f: '2 pm'},  7, '7', 3.25,  '3'],
    [{v: [15, 0, 0], f: '3 pm'},  8, '8',    5,  '5'],
    [{v: [16, 0, 0], f: '4 pm'},  9, '9',  6.5,  '6'],
    [{v: [17, 0, 0], f: '5 pm'}, 10, '10',  10, '10'],
  ]);

  var options = {
    title: 'Motivation and Energy Level Throughout the Day',
    annotations: {
      alwaysOutside: true,
      textStyle: {
        fontSize: 14,
        color: '#000',
        auraColor: 'none'
      }
    },
    hAxis: {
      title: 'Time of Day',
      format: 'h:mm a',
      viewWindow: {
        min: [7, 30, 0],
        max: [17, 30, 0]
      }
    },
    vAxis: {
      title: 'Rating (scale of 1-10)'
    },
    height:480,
    colors:['#7B8D8E','#5D4C46'],
    legend: { position: 'bottom' ,alignment:'center'}
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_annotations'));
  chart.draw(data, options);
}
// 7.Trendlines
function drawTrendlines() {
  var data = new google.visualization.DataTable();
  data.addColumn('timeofday', 'Time of Day');
  data.addColumn('number', 'Motivation Level');
  data.addColumn('number', 'Energy Level');

  data.addRows([
    [{v: [8, 0, 0], f: '8 am'}, 1, .25],
    [{v: [9, 0, 0], f: '9 am'}, 2, .5],
    [{v: [10, 0, 0], f:'10 am'}, 3, 1],
    [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
    [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
    [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
    [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
    [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
    [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
    [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
  ]);

  var options = {
    title: 'Motivation and Energy Level Throughout the Day',
    trendlines: {
      0: {type: 'linear', lineWidth: 5, opacity: .3},
      1: {type: 'exponential', lineWidth: 10, opacity: .3}
    },
    hAxis: {
      title: 'Time of Day',
      format: 'h:mm a',
      viewWindow: {
        min: [7, 30, 0],
        max: [17, 30, 0]
      }
    },
    vAxis: {
      title: 'Rating (scale of 1-10)'
    },
    height:480,
    colors:['#FF7A5A','#00AAA0'],
    legend: { position: 'bottom' ,alignment:'center'}
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_trendlines'));
  chart.draw(data, options);
}
// 8. Material
function drawMaterial() {
  var data = new google.visualization.DataTable();
  data.addColumn('timeofday', 'Time of Day');
  data.addColumn('number', 'Motivation Level');
  data.addColumn('number', 'Energy Level');

  data.addRows([
    [{v: [8, 0, 0], f: '8 am'}, 1, .25],
    [{v: [9, 0, 0], f: '9 am'}, 2, .5],
    [{v: [10, 0, 0], f:'10 am'}, 3, 1],
    [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
    [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
    [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
    [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
    [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
    [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
    [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
  ]);

  var options = {
    title: 'Motivation and Energy Level Throughout the Day',
    hAxis: {
      title: 'Time of Day',
      format: 'h:mm a',
      viewWindow: {
        min: [7, 30, 0],
        max: [17, 30, 0]
      }
    },
    vAxis: {
      title: 'Rating (scale of 1-10)'
    },
    height:480,
    colors:['#E5DBCF','#0F3B5F'],
    legend: { position: 'bottom' ,alignment:'center'}
  };

  var material = new google.charts.Bar(document.getElementById('chart_drawMaterial'));
  material.draw(data, options);
}
// 9.Material - TitleSubtitle
function drawTitleSubtitle() {
  var data = new google.visualization.DataTable();
  data.addColumn('timeofday', 'Time of Day');
  data.addColumn('number', 'Motivation Level');
  data.addColumn('number', 'Energy Level');

  data.addRows([
    [{v: [8, 0, 0], f: '8 am'}, 1, .25],
    [{v: [9, 0, 0], f: '9 am'}, 2, .5],
    [{v: [10, 0, 0], f:'10 am'}, 3, 1],
    [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
    [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
    [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
    [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
    [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
    [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
    [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
  ]);

  var options = {
    chart: {
      title: 'Motivation and Energy Level Throughout the Day',
      subtitle: 'Based on a scale of 1 to 10'
    },
    hAxis: {
      title: 'Time of Day',
      format: 'h:mm a',
      viewWindow: {
        min: [7, 30, 0],
        max: [17, 30, 0]
      }
    },
    vAxis: {
      title: 'Rating (scale of 1-10)'
    },
    height:480,
    colors:['#FF3333','#999999'],
  };

  var material = new google.charts.Bar(document.getElementById('chart_materialTitleSubtitle'));
  material.draw(data, options);
}
// 10. Material - DualY
function drawDualY() {
  var data = new google.visualization.DataTable();
  data.addColumn('timeofday', 'Time of Day');
  data.addColumn('number', 'Motivation Level');
  data.addColumn('number', 'Energy Level');

  data.addRows([
    [{v: [8, 0, 0], f: '8 am'}, 1, .25],
    [{v: [9, 0, 0], f: '9 am'}, 2, .5],
    [{v: [10, 0, 0], f:'10 am'}, 3, 1],
    [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
    [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
    [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
    [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
    [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
    [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
    [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
  ]);

  var options = {
    chart: {
      title: 'Motivation and Energy Level Throughout the Day',
      subtitle: 'Based on a scale of 1 to 10'
    },
    series: {
      0: {axis: 'MotivationLevel'},
      1: {axis: 'EnergyLevel'}
    },
    axes: {
      y: {
        MotivationLevel: {label: 'Motivation Level (1-10)'},
        EnergyLevel: {label: 'Energy Level (1-100)'}
      }
    },
    hAxis: {
      title: 'Time of Day',
      format: 'h:mm a',
      viewWindow: {
        min: [7, 30, 0],
        max: [17, 30, 0]
      }
    },
    vAxis: {
      title: 'Rating (scale of 1-10)'
    },
    height:480,
    colors:['#669999','#003333'],
  };

  var material = new google.charts.Bar(document.getElementById('chart_dualY'));
  material.draw(data, options);
}
// 11. Top X-axis
function drawTopX() {
  var data = new google.visualization.DataTable();
  data.addColumn('timeofday', 'Time of Day');
  data.addColumn('number', 'Motivation Level');
  data.addColumn('number', 'Energy Level');

  data.addRows([
    [{v: [8, 0, 0], f: '8 am'}, 1, .25],
    [{v: [9, 0, 0], f: '9 am'}, 2, .5],
    [{v: [10, 0, 0], f:'10 am'}, 3, 1],
    [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
    [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
    [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
    [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
    [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
    [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
    [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
  ]);

  var options = {
    chart: {
      title: 'Motivation and Energy Level Throughout the Day',
      subtitle: 'Based on a scale of 1 to 10'
    },
    axes: {
      x: {
        0: {side: 'top'}
      }
    },
    hAxis: {
      title: 'Time of Day',
      format: 'h:mm a',
      viewWindow: {
        min: [7, 30, 0],
        max: [17, 30, 0]
      }
    },
    vAxis: {
      title: 'Rating (scale of 1-10)'
    },
    height:480,
    colors:['#FFFF66','#3F5F5F'],
  };

  var material = new google.charts.Bar(document.getElementById('chart_topX'));
  material.draw(data, options);
}
// 12. Color column
function drawColorCols() {
	var data = google.visualization.arrayToDataTable([
	     ['Element', 'Density', { role: 'style' }],
	     ['Copper', 8.94, '#b87333'],            // RGB value
	     ['Silver', 10.49, 'silver'],            // English color name
	     ['Gold', 19.30, 'gold'],

	   ['Platinum', 21.45, 'color: #e5e4e2' ], // CSS-style declaration
	  ]);

	var options = {
		title: 'Motivation Level Throughout the Day',
		hAxis: {
		  title: 'Time of Day',
		  format: 'h:mm a',
		  viewWindow: {
		    min: [7, 30, 0],
		    max: [17, 30, 0]
		  }
		},
		vAxis: {
		  title: 'Rating (scale of 1-10)'
		},
		height:480,
    	legend: { position: 'bottom' }
	};

	var chart = new google.visualization.ColumnChart(document.getElementById('chart_colorCols'));
	chart.draw(data, options);
}
// 13. drawStuff
function drawChart3Cols() {
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Sales', 'Expenses', 'Profit'],
      ['2014', 1000, 400, 200],
      ['2015', 1170, 460, 250],
      ['2016', 660, 1120, 300],
      ['2017', 1030, 540, 350]
    ]);

    var options = {
      chart: {
        title: 'Company Performance',
        subtitle: 'Sales, Expenses, and Profit: 2014-2017',
      },
      bars: 'vertical',
      vAxis: {format: 'decimal'},
      height:480,
    	colors:['#333333','#FFCC00',"#669966"],
    };

    var chart = new google.charts.Bar(document.getElementById('chart_3cols'));

    chart.draw(data, google.charts.Bar.convertOptions(options));

  }
// -----------------------------------------------------------------------------
function redrawChart(){
  setTimeout(function () {
    drawBasic();
    drawMultSeries();
    drawColColors();
    drawAxisTickColors();
    drawStacked();
    drawAnnotations();
    drawTrendlines();
    drawMaterial();
    drawTitleSubtitle();
    drawDualY();
    drawTopX();
    drawColorCols();
    drawChart3Cols();
  }, 500);
}
// -------------------------------------
$(window).resize(function(){
  redrawChart();
});
$('.iconizedToggle').click(function(){
  redrawChart();
});
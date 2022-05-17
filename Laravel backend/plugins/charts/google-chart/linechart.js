google.charts.load('current', {packages: ['corechart', 'line']});
// 1. CallBack : Basic
google.charts.setOnLoadCallback(drawBasic);
// 2. CallBack : Multiline Color
google.charts.setOnLoadCallback(drawCurveTypes);
// 3. Crosshairs
google.charts.setOnLoadCallback(drawCrosshairs);
// 4. Trendlines
google.charts.setOnLoadCallback(drawTrendlines);
//  5.  LineStyles
google.charts.setOnLoadCallback(drawLineStyles);
// 6. Curving the Lines
google.charts.setOnLoadCallback(drawChartSales);
// 7. Material Line Charts
google.charts.setOnLoadCallback(linechart_material);
// 8.  Dual-Y Charts
google.charts.setOnLoadCallback(drawMaterialLine);
// 9. Top-X Charts
google.charts.setOnLoadCallback(drawTopxChart);
//1. BASIC LINE CHART
function drawBasic() {
  var data = new google.visualization.DataTable();
  data.addColumn('number', 'X');
  data.addColumn('number', 'Dogs');

  data.addRows([
    [0, 0],   [1, 10],  [2, 23],  [3, 17],  [4, 18],  [5, 9],
    [6, 11],  [7, 27],  [8, 33],  [9, 40],  [10, 32], [11, 35],
    [12, 30], [13, 40], [14, 42], [15, 47], [16, 44], [17, 48],
    [18, 52], [19, 54], [20, 42], [21, 55], [22, 56], [23, 57],
    [24, 60], [25, 50], [26, 52], [27, 51], [28, 49], [29, 53],
    [30, 55], [31, 60], [32, 61], [33, 59], [34, 62], [35, 65],
    [36, 62], [37, 58], [38, 55], [39, 61], [40, 64], [41, 65],
    [42, 63], [43, 66], [44, 67], [45, 69], [46, 69], [47, 70],
    [48, 72], [49, 68], [50, 66], [51, 65], [52, 67], [53, 70],
    [54, 71], [55, 72], [56, 73], [57, 75], [58, 70], [59, 68],
    [60, 64], [61, 60], [62, 65], [63, 67], [64, 68], [65, 69],
    [66, 70], [67, 72], [68, 75], [69, 80]
  ]);

  var options = {
    hAxis: {
      title: 'Time'
    },
    vAxis: {
      title: 'Popularity'
    },
    legend: { position: 'bottom' }
  };

  var chart = new google.visualization.LineChart(document.getElementById('chart_basicLine'));

  chart.draw(data, options);
}
//2. Multiline Color
function drawCurveTypes() {
  var data = new google.visualization.DataTable();
  data.addColumn('number', 'X');
  data.addColumn('number', 'Dogs');
  data.addColumn('number', 'Cats');

  data.addRows([
    [0, 0, 0],    [1, 10, 5],   [2, 23, 15],  [3, 17, 9],   [4, 18, 10],  [5, 9, 5],
    [6, 11, 3],   [7, 27, 19],  [8, 33, 25],  [9, 40, 32],  [10, 32, 24], [11, 35, 27],
    [12, 30, 22], [13, 40, 32], [14, 42, 34], [15, 47, 39], [16, 44, 36], [17, 48, 40],
    [18, 52, 44], [19, 54, 46], [20, 42, 34], [21, 55, 47], [22, 56, 48], [23, 57, 49],
    [24, 60, 52], [25, 50, 42], [26, 52, 44], [27, 51, 43], [28, 49, 41], [29, 53, 45],
    [30, 55, 47], [31, 60, 52], [32, 61, 53], [33, 59, 51], [34, 62, 54], [35, 65, 57],
    [36, 62, 54], [37, 58, 50], [38, 55, 47], [39, 61, 53], [40, 64, 56], [41, 65, 57],
    [42, 63, 55], [43, 66, 58], [44, 67, 59], [45, 69, 61], [46, 69, 61], [47, 70, 62],
    [48, 72, 64], [49, 68, 60], [50, 66, 58], [51, 65, 57], [52, 67, 59], [53, 70, 62],
    [54, 71, 63], [55, 72, 64], [56, 73, 65], [57, 75, 67], [58, 70, 62], [59, 68, 60],
    [60, 64, 56], [61, 60, 52], [62, 65, 57], [63, 67, 59], [64, 68, 60], [65, 69, 61],
    [66, 70, 62], [67, 72, 64], [68, 75, 67], [69, 80, 72]
  ]);

  var options = {
    colors: ['green', 'red'],
    is3D: true,
    hAxis: {
      title: 'Time'
    },
    vAxis: {
      title: 'Popularity'
    },
    series: {
      1: {curveType: 'function'}
    },
    width:'100%',
    legend: { position: 'bottom' }
  };

  var chart = new google.visualization.LineChart(document.getElementById('lineChart1'));
  chart.draw(data, options);
}
// 3. drawCrosshairs 
function drawCrosshairs() {
  var data = new google.visualization.DataTable();
  data.addColumn('number', 'X');
  data.addColumn('number', 'Dogs');
  data.addColumn('number', 'Cats');

  data.addRows([
    [0, 0, 0],    [1, 10, 5],   [2, 23, 15],  [3, 17, 9],   [4, 18, 10],  [5, 9, 5],
    [6, 11, 3],   [7, 27, 19],  [8, 33, 25],  [9, 40, 32],  [10, 32, 24], [11, 35, 27],
    [12, 30, 22], [13, 40, 32], [14, 42, 34], [15, 47, 39], [16, 44, 36], [17, 48, 40],
    [18, 52, 44], [19, 54, 46], [20, 42, 34], [21, 55, 47], [22, 56, 48], [23, 57, 49],
    [24, 60, 52], [25, 50, 42], [26, 52, 44], [27, 51, 43], [28, 49, 41], [29, 53, 45],
    [30, 55, 47], [31, 60, 52], [32, 61, 53], [33, 59, 51], [34, 62, 54], [35, 65, 57],
    [36, 62, 54], [37, 58, 50], [38, 55, 47], [39, 61, 53], [40, 64, 56], [41, 65, 57],
    [42, 63, 55], [43, 66, 58], [44, 67, 59], [45, 69, 61], [46, 69, 61], [47, 70, 62],
    [48, 72, 64], [49, 68, 60], [50, 66, 58], [51, 65, 57], [52, 67, 59], [53, 70, 62],
    [54, 71, 63], [55, 72, 64], [56, 73, 65], [57, 75, 67], [58, 70, 62], [59, 68, 60],
    [60, 64, 56], [61, 60, 52], [62, 65, 57], [63, 67, 59], [64, 68, 60], [65, 69, 61],
    [66, 70, 62], [67, 72, 64], [68, 75, 67], [69, 80, 72]
  ]);

  var options = {
    hAxis: {
      title: 'Time'
    },
    vAxis: {
      title: 'Popularity'
    },
    colors: ['#a52714', '#097138'],
    crosshair: {
      color: '#000',
      trigger: 'selection'
    },
    legend: { position: 'bottom' }
  };

  var chart = new google.visualization.LineChart(document.getElementById('chart_crosshairs'));

  chart.draw(data, options);
  chart.setSelection([{row: 38, column: 1}]);
}
//  4. Trendlines
function drawTrendlines() {
  var data = new google.visualization.DataTable();
  data.addColumn('number', 'X');
  data.addColumn('number', 'Dogs');
  data.addColumn('number', 'Cats');

  data.addRows([
    [0, 0, 0],    [1, 10, 5],   [2, 23, 15],  [3, 17, 9],   [4, 18, 10],  [5, 9, 5],
    [6, 11, 3],   [7, 27, 19],  [8, 33, 25],  [9, 40, 32],  [10, 32, 24], [11, 35, 27],
    [12, 30, 22], [13, 40, 32], [14, 42, 34], [15, 47, 39], [16, 44, 36], [17, 48, 40],
    [18, 52, 44], [19, 54, 46], [20, 42, 34], [21, 55, 47], [22, 56, 48], [23, 57, 49],
    [24, 60, 52], [25, 50, 42], [26, 52, 44], [27, 51, 43], [28, 49, 41], [29, 53, 45],
    [30, 55, 47], [31, 60, 52], [32, 61, 53], [33, 59, 51], [34, 62, 54], [35, 65, 57],
    [36, 62, 54], [37, 58, 50], [38, 55, 47], [39, 61, 53], [40, 64, 56], [41, 65, 57],
    [42, 63, 55], [43, 66, 58], [44, 67, 59], [45, 69, 61], [46, 69, 61], [47, 70, 62],
    [48, 72, 64], [49, 68, 60], [50, 66, 58], [51, 65, 57], [52, 67, 59], [53, 70, 62],
    [54, 71, 63], [55, 72, 64], [56, 73, 65], [57, 75, 67], [58, 70, 62], [59, 68, 60],
    [60, 64, 56], [61, 60, 52], [62, 65, 57], [63, 67, 59], [64, 68, 60], [65, 69, 61],
    [66, 70, 62], [67, 72, 64], [68, 75, 67], [69, 80, 72]
  ]);

  var options = {
    hAxis: {
      title: 'Time'
    },
    vAxis: {
      title: 'Popularity'
    },
    colors: ['#AB0D06', '#007329'],
    trendlines: {
      0: {type: 'exponential', color: '#333', opacity: 1},
      1: {type: 'linear', color: '#111', opacity: .3}
    },
    legend: { position: 'bottom' }

  };

  var chart = new google.visualization.LineChart(document.getElementById('chart_trendlines'));
  chart.draw(data, options);
}
//  5.  LineStyles
function drawLineStyles() {
  var data = new google.visualization.DataTable();
  data.addColumn('number', 'X');
  data.addColumn('number', 'Dogs');
  data.addColumn('number', 'Cats');

  data.addRows([
    [0, 0, 0],    [1, 10, 5],   [2, 23, 15],  [3, 17, 9],   [4, 18, 10],  [5, 9, 5],
    [6, 11, 3],   [7, 27, 19],  [8, 33, 25],  [9, 40, 32],  [10, 32, 24], [11, 35, 27],
    [12, 30, 22], [13, 40, 32], [14, 42, 34], [15, 47, 39], [16, 44, 36], [17, 48, 40],
    [18, 52, 44], [19, 54, 46], [20, 42, 34], [21, 55, 47], [22, 56, 48], [23, 57, 49],
    [24, 60, 52], [25, 50, 42], [26, 52, 44], [27, 51, 43], [28, 49, 41], [29, 53, 45],
    [30, 55, 47], [31, 60, 52], [32, 61, 53], [33, 59, 51], [34, 62, 54], [35, 65, 57],
    [36, 62, 54], [37, 58, 50], [38, 55, 47], [39, 61, 53], [40, 64, 56], [41, 65, 57],
    [42, 63, 55], [43, 66, 58], [44, 67, 59], [45, 69, 61], [46, 69, 61], [47, 70, 62],
    [48, 72, 64], [49, 68, 60], [50, 66, 58], [51, 65, 57], [52, 67, 59], [53, 70, 62],
    [54, 71, 63], [55, 72, 64], [56, 73, 65], [57, 75, 67], [58, 70, 62], [59, 68, 60],
    [60, 64, 56], [61, 60, 52], [62, 65, 57], [63, 67, 59], [64, 68, 60], [65, 69, 61],
    [66, 70, 62], [67, 72, 64], [68, 75, 67], [69, 80, 72]
  ]);
  var options = {
    hAxis: {
      title: 'Time'
    },
    vAxis: {
      title: 'Popularity'
    },
    colors: ['#a52714', '#097138'],
    series: {
      0: {
        lineWidth: 10,
        lineDashStyle: [5, 1, 5]
      },
      1: {
        lineWidth: 5,
        lineDashStyle: [7, 2, 4, 3]
      }
    },
    legend: { position: 'top',alignment:'center' }
  };

  var chart = new google.visualization.LineChart(document.getElementById('chart_lineStyles'));
  chart.draw(data, options);
}
// 6. Curving the Lines
function drawChartSales() {
  var data = google.visualization.arrayToDataTable([
    ['Year', 'Sales', 'Expenses'],
    ['2004',  1000,      400],
    ['2005',  1170,      460],
    ['2006',  660,       1120],
    ['2007',  1030,      540]
  ]);

  var options = {
    title: 'Company Performance',
    curveType: 'function',
    width:'100%',    
    legend: { position: 'bottom' }
  };

  var chart = new google.visualization.LineChart(document.getElementById('drawChartSales'));

  chart.draw(data, options);
}
// 7. Material Line Charts
function linechart_material() {
  var data = new google.visualization.DataTable();
  data.addColumn('number', 'Day');
  data.addColumn('number', 'Guardians of the Galaxy');
  data.addColumn('number', 'The Avengers');
  data.addColumn('number', 'Transformers: Age of Extinction');

  data.addRows([
    [1,  37.8, 80.8, 41.8],
    [2,  30.9, 69.5, 32.4],
    [3,  25.4,   57, 25.7],
    [4,  11.7, 18.8, 10.5],
    [5,  11.9, 17.6, 10.4],
    [6,   8.8, 13.6,  7.7],
    [7,   7.6, 12.3,  9.6],
    [8,  12.3, 29.2, 10.6],
    [9,  16.9, 42.9, 14.8],
    [10, 12.8, 30.9, 11.6],
    [11,  5.3,  7.9,  4.7],
    [12,  6.6,  8.4,  5.2],
    [13,  4.8,  6.3,  3.6],
    [14,  4.2,  6.2,  3.4]
  ]);

  var options = {
    chart: {
      title: 'Box Office Earnings in First Two Weeks of Opening',
      subtitle: 'in millions of dollars (Pound)',
    },
    width:'100%',
    legend: { position: 'right',alignment:'center' }
  };

  var chart = new google.charts.Line(document.getElementById('linechart_material'));

  chart.draw(data, options);
}
// 8. Dual-Y Charts
function drawMaterialLine() {

  var chartDiv = document.getElementById('materialLine');

  var data = new google.visualization.DataTable();
  data.addColumn('date', 'Month');
  data.addColumn('number', "Average Temperature");
  data.addColumn('number', "Average Hours of Daylight");

  data.addRows([
    [new Date(2014, 0),  -.5,  5.7],
    [new Date(2014, 1),   .4,  8.7],
    [new Date(2014, 2),   .5,   12],
    [new Date(2014, 3),  2.9, 15.3],
    [new Date(2014, 4),  6.3, 18.6],
    [new Date(2014, 5),    9, 20.9],
    [new Date(2014, 6), 10.6, 19.8],
    [new Date(2014, 7), 10.3, 16.6],
    [new Date(2014, 8),  7.4, 13.3],
    [new Date(2014, 9),  4.4,  9.9],
    [new Date(2014, 10), 1.1,  6.6],
    [new Date(2014, 11), -.2,  4.5]
  ]);

  var materialOptions = {
    chart: {
      title: 'Average Temperatures and Daylight in Iceland Throughout the Year'
    },
    height: 500,
    width:'100%',
    series: {
      // Gives each series an axis name that matches the Y-axis below.
      0: {axis: 'Temps'},
      1: {axis: 'Daylight'}
    },
    axes: {
      // Adds labels to each axis; they don't have to match the axis names.
      y: {
        Temps: {label: 'Temps (Celsius)'},
        Daylight: {label: 'Daylight'}
      }
    },
    legend: { position: 'left'}
  };
  function drawMaterialChart() {
    var materialChart = new google.charts.Line(chartDiv);
    materialChart.draw(data, materialOptions);
  }
  drawMaterialChart();
}
// 9. Top-X Charts
function drawTopxChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('number', 'Day');
    data.addColumn('number', 'Guardians of the Galaxy');
    data.addColumn('number', 'The Avengers');
    data.addColumn('number', 'Transformers: Age of Extinction');

    data.addRows([
      [1,  37.8, 80.8, 41.8],
      [2,  30.9, 69.5, 32.4],
      [3,  25.4,   57, 25.7],
      [4,  11.7, 18.8, 10.5],
      [5,  11.9, 17.6, 10.4],
      [6,   8.8, 13.6,  7.7],
      [7,   7.6, 12.3,  9.6],
      [8,  12.3, 29.2, 10.6],
      [9,  16.9, 42.9, 14.8],
      [10, 12.8, 30.9, 11.6],
      [11,  5.3,  7.9,  4.7],
      [12,  6.6,  8.4,  5.2],
      [13,  4.8,  6.3,  3.6],
      [14,  4.2,  6.2,  3.4]
    ]);

    var options = {
      chart: {
        title: 'Box Office Earnings in First Two Weeks of Opening',
        subtitle: 'in millions of dollars (USD)'
      },
      width: '100%',
      height: 500,
      axes: {
        x: {
          0: {side: 'top'}
        }
      }
    };

    var chart = new google.charts.Line(document.getElementById('line_top_x'));

    chart.draw(data, options);
}
function redrawBar(){
  setTimeout(function () {
    drawBasic();
    drawCurveTypes();
    drawCrosshairs();
    drawTrendlines();
    drawLineStyles();
    drawChartSales();
    linechart_material();
    drawMaterialLine();
    drawTopxChart();
  }, 800);
}
// -------------------------------------
$(window).resize(function(){
  redrawBar();
});
$('.iconizedToggle').click(function(){
  redrawBar();
});
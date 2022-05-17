google.charts.load('current', {packages: ['corechart', 'bar']});

// 1.Coloring bars
google.charts.setOnLoadCallback(drawBasic);
// 2. Mult Series
google.charts.setOnLoadCallback(drawMultSeries);
// 3. Customizable axis and tick labels
google.charts.setOnLoadCallback(drawAxisTickColors);
// 4. Stacked bars
google.charts.setOnLoadCallback(drawStacked);
// 5. Annotations
google.charts.setOnLoadCallback(drawAnnotations);
// 6.Basic Material bar chart
google.charts.setOnLoadCallback(drawMaterial);
// 7.Dual X-axes
google.charts.setOnLoadCallback(drawDualX);
//8. Right Y-axis
google.charts.setOnLoadCallback(drawRightY);
// -------------------------------------
// 1.Coloring bars
function drawBasic() {
  var data = google.visualization.arrayToDataTable([
    ['City', '2010 Population',],
    ['New York City, NY', 8175000],
    ['Los Angeles, CA', 3792000],
    ['Chicago, IL', 2695000],
    ['Houston, TX', 2099000],
    ['Philadelphia, PA', 1526000]
  ]);

  var options = {
    title: 'Population of Largest U.S. Cities',
    hAxis: {
      title: 'Total Population',
      minValue: 0
    },
    vAxis: {
      title: 'City'
    },
    height:480,
    legend: { position: 'bottom' }
  };

  var chart = new google.visualization.BarChart(document.getElementById('chart_basicBar'));

  chart.draw(data, options);
}
// 2. Mult Series
function drawMultSeries() {
  var data = google.visualization.arrayToDataTable([
    ['City', '2010 Population', '2000 Population'],
    ['New York City, NY', 8175000, 8008000],
    ['Los Angeles, CA', 3792000, 3694000],
    ['Chicago, IL', 2695000, 2896000],
    ['Houston, TX', 2099000, 1953000],
    ['Philadelphia, PA', 1526000, 1517000]
  ]);

  var options = {
    title: 'Population of Largest U.S. Cities',
    chartArea: {width: '50%'},
    hAxis: {
      title: 'Total Population',
      minValue: 0
    },
    vAxis: {
      title: 'City'
    },
    height:480,
    colors:['#FFCC00','#669966'],
    legend: { position: 'bottom' }
  };

  var chart = new google.visualization.BarChart(document.getElementById('chart_MultSeries'));
  chart.draw(data, options);
}
// 3. Customizable axis and tick labels
function drawAxisTickColors() {
  var data = google.visualization.arrayToDataTable([
    ['City', '2010 Population', '2000 Population'],
    ['New York City, NY', 8175000, 8008000],
    ['Los Angeles, CA', 3792000, 3694000],
    ['Chicago, IL', 2695000, 2896000],
    ['Houston, TX', 2099000, 1953000],
    ['Philadelphia, PA', 1526000, 1517000]
  ]);

  var options = {
    title: 'Population of Largest U.S. Cities',
    chartArea: {width: '50%'},
    height:480,
    colors:['#F6FA9C','#8CA93E'],
    legend: { position: 'bottom' },
    hAxis: {
      title: 'Total Population',
      minValue: 0,
      textStyle: {
        bold: true,
        fontSize: 12,
        color: '#4d4d4d'
      },
      titleTextStyle: {
        bold: true,
        fontSize: 18,
        color: '#4d4d4d'
      }
    },
    vAxis: {
      title: 'City',
      textStyle: {
        fontSize: 14,
        bold: true,
        color: '#848484'
      },
      titleTextStyle: {
        fontSize: 14,
        bold: true,
        color: '#848484'
      }
    }
  };
  var chart = new google.visualization.BarChart(document.getElementById('chart_axisTickColors'));
  chart.draw(data, options);
}
// 4. Stacked bars
function drawStacked() {
  var data = google.visualization.arrayToDataTable([
    ['City', '2010 Population', '2000 Population'],
    ['New York City, NY', 8175000, 8008000],
    ['Los Angeles, CA', 3792000, 3694000],
    ['Chicago, IL', 2695000, 2896000],
    ['Houston, TX', 2099000, 1953000],
    ['Philadelphia, PA', 1526000, 1517000]
  ]);

  var options = {
    title: 'Population of Largest U.S. Cities',
    chartArea: {width: '50%'},
    height:480,
    colors:['#FFCF75','#FF8000'],
    legend: { position: 'bottom' },
    isStacked: true,
    hAxis: {
      title: 'Total Population',
      minValue: 0,
    },
    vAxis: {
      title: 'City'
    }
  };
  var chart = new google.visualization.BarChart(document.getElementById('chart_stacked'));
  chart.draw(data, options);
}
// 5. Annotations
function drawAnnotations() {
  var data = google.visualization.arrayToDataTable([
    ['City', '2010 Population', '2000 Population'],
    ['New York City, NY', 8175000, 8008000],
    ['Los Angeles, CA', 3792000, 3694000],
    ['Chicago, IL', 2695000, 2896000],
    ['Houston, TX', 2099000, 1953000],
    ['Philadelphia, PA', 1526000, 1517000]
  ]);

  var data = google.visualization.arrayToDataTable([
    ['City', '2010 Population', {type: 'string', role: 'annotation'},
     '2000 Population', {type: 'string', role: 'annotation'}],
    ['New York City, NY', 8175000, '8.1M', 8008000, '8M'],
    ['Los Angeles, CA', 3792000, '3.8M', 3694000, '3.7M'],
    ['Chicago, IL', 2695000, '2.7M', 2896000, '2.9M'],
    ['Houston, TX', 2099000, '2.1M', 1953000, '2.0M'],
    ['Philadelphia, PA', 1526000, '1.5M', 1517000, '1.5M']
  ]);

  var options = {
    title: 'Population of Largest U.S. Cities',
    chartArea: {width: '50%'},
    height:480,
    colors:['#E18A07','#C0C0C0'],
    legend: { position: 'bottom' },
    annotations: {
      alwaysOutside: true,
      textStyle: {
        fontSize: 12,
        auraColor: 'none',
        color: '#555'
      },
      boxStyle: {
        stroke: '#ccc',
        strokeWidth: 1,
        gradient: {
          color1: '#f3e5f5',
          color2: '#f3e5f5',
          x1: '0%', y1: '0%',
          x2: '100%', y2: '100%'
        }
      }
    },
    hAxis: {
      title: 'Total Population',
      minValue: 0,
    },
    vAxis: {
      title: 'City'
    }
  };
  var chart = new google.visualization.BarChart(document.getElementById('chart_annotations'));
  chart.draw(data, options);
}
// 6.Basic Material bar chart
function drawMaterial() {
  var data = google.visualization.arrayToDataTable([
    ['City', '2010 Population', '2000 Population'],
    ['New York City, NY', 8175000, 8008000],
    ['Los Angeles, CA', 3792000, 3694000],
    ['Chicago, IL', 2695000, 2896000],
    ['Houston, TX', 2099000, 1953000],
    ['Philadelphia, PA', 1526000, 1517000]
  ]);

  var options = {
    chart: {
      title: 'Population of Largest U.S. Cities'
    },
    hAxis: {
      title: 'Total Population',
      minValue: 0,
    },
    vAxis: {
      title: 'City'
    },
    bars: 'horizontal',
    height:480,
    colors:['#9999CC','#FFFFCC'],
    legend: { position: 'bottom' }
  };
  var material = new google.charts.Bar(document.getElementById('chart_material'));
  material.draw(data, options);
}
// 7.Dual X-axes
function drawDualX() {
  var data = google.visualization.arrayToDataTable([
    ['City', '2010 Population', '2000 Population'],
    ['New York City, NY', 8175000, 8008000],
    ['Los Angeles, CA', 3792000, 3694000],
    ['Chicago, IL', 2695000, 2896000],
    ['Houston, TX', 2099000, 1953000],
    ['Philadelphia, PA', 1526000, 1517000]
  ]);

  var options = {
    chart: {
      title: 'Population of Largest U.S. Cities',
      subtitle: 'Based on most recent and previous census data'
    },
    hAxis: {
      title: 'Total Population'
    },
    vAxis: {
      title: 'City'
    },
    bars: 'horizontal',
    series: {
      0: {axis: '2010'},
      1: {axis: '2000'}
    },
    axes: {
      x: {
        2010: {label: '2010 Population (in millions)', side: 'top'},
        2000: {label: '2000 Population'}
      }
    },
    height:480,
    colors:['#99CC99','#9999CC']
  };
  var material = new google.charts.Bar(document.getElementById('chart_dualX'));
  material.draw(data, options);
}
//8. Right Y-axis
function drawRightY() {
  var data = google.visualization.arrayToDataTable([
    ['City', '2010 Population', '2000 Population'],
    ['New York City, NY', 8175000, 8008000],
    ['Los Angeles, CA', 3792000, 3694000],
    ['Chicago, IL', 2695000, 2896000],
    ['Houston, TX', 2099000, 1953000],
    ['Philadelphia, PA', 1526000, 1517000]
  ]);

  var options = {
    chart: {
      title: 'Population of Largest U.S. Cities',
      subtitle: 'Based on most recent and previous census data'
    },
    hAxis: {
      title: 'Total Population',
      minValue: 0,
    },
    vAxis: {
      title: 'City'
    },
    bars: 'horizontal',
    axes: {
      y: {
        0: {side: 'right'}
      }
    },
    height:480,
    colors:['#2088B2','#D86E3F']
  };
  var material = new google.charts.Bar(document.getElementById('chart_rightY'));
  material.draw(data, options);
}
function redrawBar(){
  setTimeout(function () {
    drawBasic();
    drawMultSeries();
    drawAxisTickColors();
    drawStacked();
    drawAnnotations();
    drawMaterial();
    drawDualX();
    drawRightY();
  }, 800);
}
// -------------------------------------
$(window).resize(function(){
  redrawBar();
});
$('.iconizedToggle').click(function(){
  redrawBar();
});
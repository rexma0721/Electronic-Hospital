// 1.Gauge
var gaugeChart = c3.generate({
  bindto:"#gauge-chart",
  data: {
    columns: [
      [ 'data', 91.4 ]
    ],
    type: 'gauge',
    onmouseover: function (d, i) { console.log("onmouseover", d, i, this); },
    onmouseout: function (d, i) { console.log("onmouseout", d, i, this); },
    onclick: function (d, i) { console.log("onclick", d, i, this); },
  },
  gauge: {
    label: {
      //format: function(value, ratio) {
      //return value;
      //},
      //show: false // to turn off the min/max labels.
    },
      //min: 0, // 0 is default, //can handle negative min e.g. vacuum / voltage / current flow / rate of change
      //max: 100, // 100 is default
      //units: ' %',
      //width: 39 // for adjusting arc thickness
  },
  color: {
    pattern: ['#FF0000', '#F6C600', '#60B044'], // the three color levels for the percentage values.
    threshold: {
      //unit: 'value', // percentage is default
      //max: 200, // 100 is default
      values: [30, 60, 90] // alternate first value is 'value'
    }
  }
});
// 2. Scatter
var scatterChart = c3.generate({
  bindto:"#scatter-chart",
  data: {
    xs: {
      setosa: 'setosa_x',
      versicolor: 'versicolor_x',
      virginica: 'virginica_x'
    },
    columns: [
      ["setosa_x", 3.5, 3.0, 3.2, 3.1, 3.6, 3.9, 3.4, 3.4, 2.9, 3.1, 3.7, 3.4, 3.0, 3.0, 4.0, 4.4, 3.9, 3.5, 3.8, 3.8, 3.4, 3.7, 3.6, 3.3, 3.4, 3.0, 3.4, 3.5, 3.4, 3.2, 3.1, 3.4, 4.1, 4.2, 3.1, 3.2, 3.5, 3.6, 3.0, 3.4, 3.5, 2.3, 3.2, 3.5, 3.8, 3.0, 3.8, 3.2, 3.7, 3.3],
      ["versicolor_x", 3.2, 3.2, 3.1, 2.3, 2.8, 2.8, 3.3, 2.4, 2.9, 2.7, 2.0, 3.0, 2.2, 2.9, 2.9, 3.1, 3.0, 2.7, 2.2, 2.5, 3.2, 2.8, 2.5, 2.8, 2.9, 3.0, 2.8, 3.0, 2.9, 2.6, 2.4, 2.4, 2.7, 2.7, 3.0, 3.4, 3.1, 2.3, 3.0, 2.5, 2.6, 3.0, 2.6, 2.3, 2.7, 3.0, 2.9, 2.9, 2.5, 2.8],
      ["virginica_x", 3.3, 2.7, 3.0, 2.9, 3.0, 3.0, 2.5, 2.9, 2.5, 3.6, 3.2, 2.7, 3.0, 2.5, 2.8, 3.2, 3.0, 3.8, 2.6, 2.2, 3.2, 2.8, 2.8, 2.7, 3.3, 3.2, 2.8, 3.0, 2.8, 3.0, 2.8, 3.8, 2.8, 2.8, 2.6, 3.0, 3.4, 3.1, 3.0, 3.1, 3.1, 3.1, 2.7, 3.2, 3.3, 3.0, 2.5, 3.0, 3.4, 3.0],
      ["setosa", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
      ["versicolor", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
      ["virginica", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
    ],
    type : 'scatter',
  },
  axis: {
    x: {
      label: 'Sepal.Width',
      tick: {
        fit: false
      }
    },
    y: {
      label: 'Petal.Width'
    }
  }
});
// 3. Combo Chart
var comboChart = c3.generate({
  bindto:"#combo-chart",
  data: {
    columns: [
      ['data1', 30, 20, 50, 40, 60, 50],
      ['data2', 200, 130, 90, 240, 130, 220],
      ['data3', 300, 200, 160, 400, 250, 250],
      ['data4', 200, 130, 90, 240, 130, 220],
      ['data5', 130, 120, 150, 140, 160, 150],
      ['data6', 90, 70, 20, 50, 60, 120],
    ],
    types: {
      data1: 'bar',
      data2: 'bar',
      data3: 'spline',
      data4: 'line',
      data5: 'bar',
      data6: 'area'
    },
    groups: [
      ['data1','data2']
    ]
  },
  axis: {
    x: {
      type: 'categorized'
    }
  }
});
// 4. Custom X-category
var custom_x_categorized = c3.generate({
  bindto: '#custom_x_categorized',
  data: {
    x : 'x',
    columns: [
      ['x', 'www.google.com', 'www.amazon.com', 'www.facebook.com', 'www.apple.com'],
      ['download', 30, 200, 100, 400],
      ['loading', 90, 100, 140, 200],
    ],
    groups: [
      ['download', 'loading']
    ],
    type: 'bar'
  },
  axis: {
    x: {
      type: 'categorized',
      label: 'X Label'
    },
    y: {
      label: {
        text: 'Y Label',
        position: 'outer-middle'
      }
    }
  }
});
setTimeout(function () {
  custom_x_categorized.load({
    columns: [
      ['x', 'www.yahoo.com', 'www.rakuten.com', 'www.mixi.com', 'www.sony.com'],
      ['download', 130, 300, 200, 470],
      ['loading', 190, 130, 240, 340],
    ],
  });
}, 1000);
setTimeout(function () {
  custom_x_categorized.load({
    columns: [
      ['x', 'www.hogehoge.com', 'www.aaaa.com', 'www.aaaa.com'],
      ['download', 130, 300, 200],
      ['loading', 190, 130, 240],
    ],
  });
}, 2000);

setTimeout(function () {
  custom_x_categorized.load({
    columns: [
      ['x', 'www.yahoo.com', 'www.rakuten.com', 'www.mixi.com', 'www.sony.com'],
      ['download', 130, 300, 200, 470],
      ['loading', 190, 130, 240, 340],
    ],
  });
}, 3000);

setTimeout(function () {
  custom_x_categorized.load({
    columns: [
      ['download', 30, 30, 20, 170],
      ['loading', 90, 30, 40, 40],
    ],
  });
}, 4000);

// 5.axes -range
var axes_range1 = c3.generate({
  bindto: '#axes_range1',
  data: {
    columns: [
      ['sample', 100, 200, 100, 400, 150, 250]
    ],
  },
  axis: {
    x: {
        min: -10,
        max: 10,
      }
    },
});
setTimeout(function () {
  axes_range1.axis.max({x: 20});
}, 1000);

setTimeout(function () {
  axes_range1.axis.min({x: -5});
}, 2000);

setTimeout(function () {
  axes_range1.axis.range({max: {x: 5}, min: {x: 0}});
}, 3000);
// 6.axes -range 2
var axes_range2 = c3.generate({
  bindto: '#axes_range2',
  data: {
    x: 'x',
    columns: [
      ['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
      ['sample', 100, 200, 100, 400, 150, 250]
    ],
  },
  axis: {
    x: {
        type: 'timeseries',
        min: new Date('2012-12-20'),
        max: '2013-03-01',
        tick : {
          format : "%Y-%m-%d %H:%M:%S" // https://github.com/mbostock/d3/wiki/Time-Formatting#wiki-format
        }
      }
    }
});
setTimeout(function () {
  axes_range2.axis.max({x: new Date('2013-02-01')});
}, 1000);

setTimeout(function () {
  axes_range2.axis.min({x: new Date('2012-12-01')});
}, 2000);

setTimeout(function () {
axes_range2.axis.range({max: {x: '2013-01-06'}, min: {x: '2013-01-01'}});
}, 3000);

setTimeout(function () {
  axes_range2.axis.max({y: 1000});
}, 4000);

setTimeout(function () {
  axes_range2.axis.min({y: -1000});
}, 5000);

setTimeout(function () {
  axes_range2.axis.range({max: {y: 400}, min: {y: 0}});
}, 6000);

function redrawChart(){
  setTimeout(function () {
    gaugeChart.resize();
    scatterChart.resize();
    comboChart.resize();
    custom_x_categorized.resize();
    axes_range1.resize();
    axes_range2.resize();
  }, 800);
}
redrawChart();
$('.iconizedToggle').click(function(){
  redrawChart();
});
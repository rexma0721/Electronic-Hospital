// 1. Basic Line chart
var lineChart1 = c3.generate({
  bindto: '#line-basic',
  data: {
    columns: [
      ['data1', 30, 200, 100, 400, 150, 250],
      ['data2', 50, 20, 10, 40, 15, 25]
    ],
    onclick: function (d, element) { console.log("onclick", d, element); },
    onmouseover: function (d) { console.log("onmouseover", d); },
    onmouseout: function (d) { console.log("onmouseout", d); },
  },
  /*color: {
    pattern: ['#c3c3c3', '#aec7e8']
  }*/
});

// 2. linechart Spline
var lineSpline = c3.generate({
  bindto: '#lineSpline',
  data: {
    columns: [
      ['data1', 30, 200, 100, 400, 150, 250],
      ['data2', 130, 100, 140, 200, 150, 50]
    ],
    types: {
      data1: 'spline',
      data2: 'spline'
    }
  }
});
// 3.Line step Chart
var chartStep = c3.generate({
  bindto:"#chartStep",
  data: {
    columns: [
      ['data1', 300, 350, 300, 0, 0, 0],
      //['data2', 130, 100, 140, 200, 150, 50]
    ],
    types: {
      data1: 'step',
      data2: 'area-step'
    },
    onclick: function (d) { console.log('clicked', d); }
  },
  subchart: {
    show: true
  },
});
setTimeout(function () {
  chartStep.load({
    columns: [
      ['data2', 130, 100, 140, 200, 150, 50]
    ]
  });
}, 1000);
// 4. TimeSeries Basic
var chartTimeseries = c3.generate({
  bindto: '#chart-timeseries',
  data: {
    x : 'date',
    xFormat : '%Y%m%d',
    columns: [
      //['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
      ['date', '20130101', '20130102', '20130103', '20130104', '20130105', '20130106'],
      ['sample', 30, 200, 100, 400, 150, 250],
      ['sample2', 130, 300, 200, 450, 250, 350]
    ]
  },
  axis : {
    x : {
      type : 'timeseries',
      tick : {
        //format : "%m/%d" // https://github.com/mbostock/d3/wiki/Time-Formatting#wiki-format
        format : "%e %b %y" // https://github.com/mbostock/d3/wiki/Time-Formatting#wiki-format
      }
    }
  }
});
setTimeout(function () {
  chartTimeseries.load({
    columns: [
      ['sample', 200, 130, 90, 240, 130, 100],
      ['sample2', 300, 200, 160, 400, 250, 250]
    ]
  });
}, 1000);
setTimeout(function () {
  chartTimeseries.load({
    columns: [
      ['date', '20140101', '20140201', '20140301', '20140401', '20140501', '20140601'],
      ['sample', 500, 630, 690, 440, 630, 900],
      ['sample2', 400, 600, 460, 200, 350, 450]
    ]
  });
}, 2000);

// 5. Line chart with descendent timeseries data
var dates = ['date',
  1401908040000,
  1401907980000,
  1401907920000,
  1401907860000,
  1401907800000,
  1401907740000,
  1401907680000,
  1401907620000,
  1401907560000,
  1401907500000
];

var descendentTimeseries = c3.generate({
  bindto: '#descendent-timeseries',
  data: {
    x : 'date',
    columns: [
      dates,
      ['data1', 30, 200, 100, 400, 150, 250, 30, 200, 100, 400],
      ['data2', 130, 300, 200, 450, 250, 350, 130, 300, 200, 450]
    ],
    types: {
      data1: 'bar',
    }
  },
  axis : {
    x : {
      type : 'timeseries',
      tick : {
        format : "%Y-%m-%d %H:%M:%S"
      }
    }
  }
});

/*setTimeout(function () {
  descendentTimeseries.load({
    columns: [
      ['sample', 200, 130, 90, 240, 130, 100],
      ['sample2', 300, 200, 160, 400, 250, 250]
    ]
  });
}, 1000);

setTimeout(function () {
  descendentTimeseries.load({
    columns: [
      ['date', '20140101', '20140201', '20140301', '20140401', '20140501', '20140601'],
      ['sample', 500, 630, 690, 440, 630, 900],
      ['sample2', 400, 600, 460, 200, 350, 450]
    ]
  });
}, 2000);*/

// 6. Line chart with timeseries data as Number
var rows = [["x","Views","GMV"]];
rows = rows.concat([[1398709800000,780,136],
        [1398450600000,812,134],
        [1399401000000,784,154],
        [1399228200000,786,135],
        [1399573800000,802,131],
        [1399487400000,773,166],
        [1399314600000,787,146],
        [1399919400000,1496,309],
        [1399833000000,767,138],
        [1399746600000,797,141],
        [1399660200000,796,146],
        [1398623400000,779,143],
        [1399055400000,794,140],
        [1398969000000,791,140],
        [1398882600000,825,107],
        [1399141800000,786,136],
        [1398537000000,773,143],
        [1398796200000,783,154],
        [1400005800000,1754,284]].sort(function (a, b) {
  return a[0] - b[0];
}));

var timeseriesDataNum = c3.generate({
  bindto: '#timeseriesData-number',
  data: {
    x : 'x',
    rows: rows
  },
  axis : {
    x : {
      type : 'timeseries',
      tick : {
        format : "%Y-%m-%d" // https://github.com/mbostock/d3/wiki/Time-Formatting#wiki-format
      }
    }
  }
});
// 7. Line chart with timeseries data as Date object
var timeseriesDataObj = c3.generate({
  bindto: '#timeseriesData-obj',
  data: {
    x : 'x',
    xFormat : '%Y%m%d',
    columns: [
      ['x', new Date('2013-01-01T00:00:00Z'), new Date('2013-01-02T00:00:00Z'), new Date('2013-01-03T00:00:00Z'), new Date('2013-01-04T00:00:00Z'), new Date('2013-01-05T00:00:00Z'), new Date('2013-01-06T00:00:00Z')],
      ['sample', 30, 200, 100, 400, 150, 250],
      ['sample2', 130, 300, 200, 450, 250, 350]
    ]
  },
  axis : {
    x : {
      type : 'timeseries',
      tick : {
        //format : "%m/%d" // https://github.com/mbostock/d3/wiki/Time-Formatting#wiki-format
        format : "%e %b %y" // https://github.com/mbostock/d3/wiki/Time-Formatting#wiki-format
      }
    }
  }
});

setTimeout(function () {
  timeseriesDataObj.load({
    columns: [
      ['sample', 200, 130, 90, 240, 130, 100],
      ['sample2', 300, 200, 160, 400, 250, 250]
    ]
  });
}, 1000);

setTimeout(function () {
  timeseriesDataObj.load({
    columns: [
      ['x', '20140101', '20140201', '20140301', '20140401', '20140501', '20140601'],
      ['sample', 500, 630, 690, 440, 630, 900],
      ['sample2', 400, 600, 460, 200, 350, 450]
    ]
  });
}, 2000);

setTimeout(function () {
  timeseriesDataObj.load({
    columns: [
      ['x', new Date('2014-01-02T00:00:00Z'), new Date('2014-02-02T00:00:00Z'), new Date('2014-03-02T00:00:00Z'), new Date('2014-04-02T00:00:00Z'), new Date('2014-05-02T00:00:00Z'), new Date('2014-06-02T00:00:00Z')],
      ['sample', 500, 630, 690, 440, 630, 900],
      ['sample2', 400, 600, 460, 200, 350, 450]
    ]
  });
}, 3000);

function redrawChart(){
  setTimeout(function () {
  lineChart1.resize();
  lineSpline.resize();
  chartStep.resize();
  chartTimeseries.resize();
  descendentTimeseries.resize();
  timeseriesDataNum.resize();
  timeseriesDataObj.resize();
  }, 800);
}
redrawChart();
$('.iconizedToggle').click(function(){
  redrawChart();
});
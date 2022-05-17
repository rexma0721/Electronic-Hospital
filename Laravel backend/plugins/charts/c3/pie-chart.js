var pieBasic = c3.generate({
  bindto:'#pie-basic',
  data: {
    columns: [
      //["setosa", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
      ["versicolor", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
      ["virginica", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
      ["setosa", 30],
      //["versicolor", 40],
      //["virginica", 50],
    ],
    type : 'pie',
    onmouseover: function (d, i) { console.log("onmouseover", d, i, this); },
    onmouseout: function (d, i) { console.log("onmouseout", d, i, this); },
    onclick: function (d, i) { console.log("onclick", d, i, this); },
  },
  axis: {
    x: {
      label: 'Sepal.Width'
    },
    y: {
      label: 'Petal.Width'
    }
  }
});

setTimeout(function () {
  pieBasic.load({
    columns: [
      ["setosa", 130],
    ]
  });
}, 1000);

setTimeout(function () {
  pieBasic.unload({
    ids: 'virginica'
  });
}, 2000);


 var sort = true;

var generate = function () { return c3.generate({
  bindto:'#pie-sort',
  data: {
    columns: [
//            ["setosa", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
      ["versicolor", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
      ["virginica", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
      ["setosa", 30],
//            ["versicolor", 40],
//            ["virginica", 50],
    ],
    type : 'pie',
  },
  axis: {
    x: {
      label: 'Sepal.Width'
    },
    y: {
      label: 'Petal.Width'
    }
  },
  pie: {
    sort: sort,
    onmouseover: function (d, i) { console.log(d, i); },
    onmouseout: function (d, i) { console.log(d, i); },
    onclick: function (d, i) { console.log(d, i); },
  }
}); }, chart = generate();

setTimeout(function () {
  chart.load({
    columns: [
      ["setosa", 130],
    ]
  });
}, 1000);

setTimeout(function () {
  chart.unload({
    ids: 'virginica'
  });
}, 2000);

setTimeout(function () {
  chart.load({
    columns: [
      ["new data", 300],
    ]
  });
}, 3000);

setTimeout(function () {
  sort = false;
  chart = generate();
}, 4000);

setTimeout(function () {
  chart.load({
    columns: [
      ["setosa", 130],
    ]
  });
}, 5000);

setTimeout(function () {
  chart.unload({
    ids: 'virginica'
  });
}, 6000);

setTimeout(function () {
  chart.load({
    columns: [
      ["new data", 300],
    ]
  });
}, 7000);



var donutChart = c3.generate({
  bindto:"#donut-chart",
  data: {
    columns: [
//            ["setosa", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
      ["versicolor", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
      ["virginica", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
      ["setosa", 30],
//            ["versicolor", 40],
//            ["virginica", 50],
    ],
    type : 'donut',
    onmouseover: function (d, i) { console.log("onmouseover", d, i, this); },
    onmouseout: function (d, i) { console.log("onmouseout", d, i, this); },
    onclick: function (d, i) { console.log("onclick", d, i, this); },
    order: null // set null to disable sort of data. desc is the default.
  },
  axis: {
    x: {
      label: 'Sepal.Width'
    },
    y: {
      label: 'Petal.Width'
    }
  },
  donut: {
    label: {
//            format: function (d, ratio) { return ""; }
    },
    title: "Iris Petal Width",
    width: 70
  }
});

setTimeout(function () {
  donutChart.load({
    columns: [
      ['data1', 30, 20, 50, 40, 60, 50],
    ]
  });
}, 1000);

setTimeout(function () {
  donutChart.unload({
    ids: 'virginica'
  });
}, 2000);

function redrawChart(){
  setTimeout(function () {
      pieBasic.resize();
      donutChart.resize();
  }, 800);
}
redrawChart();
$('.iconizedToggle').click(function(){
  redrawChart();
});
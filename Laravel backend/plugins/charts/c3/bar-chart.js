var chartBasic = c3.generate({
  bindto:'#bar-basic',
  data: {
    columns: [
      ['data1', 1030, 1200, 1100, 1400, 1150, 1250],
      ['data2', 2130, 2100, 2140, 2200, 2150, 1850]
      //['data1', 30, 200, 100, 400, 150, 250],
      //['data2', 130, 100, 140, 200, 150, 50]
    ],
    type: 'bar',
    onclick: function (d, element) { console.log("onclick", d, element); },
    onmouseover: function (d) { console.log("onmouseover", d); },
    onmouseout: function (d) { console.log("onmouseout", d); }
  },
  axis: {
    x: {
      type: 'categorized'
    }
  },
  bar: {
    width: {
      ratio: 0.3,
      // max: 30
    },
  }
});


var axis_x_type = 'category',
  axis_rotated = false;

var generate = function () { return c3.generate({
  bindto:'#bar-stack',
  data: {
    columns: [
      ['data1', 30, 200, 200, 400, 150, -250],
      ['data2', 130, -100, 100, 200, 150, 50],
      ['data3', 230, -200, 200, 0, 250, 250]
    ],
    type: 'bar',
    groups: [
      ['data1', 'data2']
    ]
  },
  axis: {
    x: {
      type: axis_x_type
    },
    rotated: axis_rotated
  },
  grid: {
    y: {
      lines: [{value:0}]
    }
  },
}); }, chart = generate();

function update1() {
  chart.groups([['data1', 'data2', 'data3']])
}

function update2() {
  chart.load({
    columns: [['data4', 100, 50, 150, -200, 300, -100]]
  });
}

function update3() {
  chart.groups([['data1', 'data2', 'data3', 'data4']])
}


setTimeout(update1, 1000);
setTimeout(update2, 2000);
setTimeout(update3, 3000);


setTimeout(function () {
axis_rotated = true;
chart = generate();
}, 4000);
setTimeout(update1, 5000);
setTimeout(update2, 6000);
setTimeout(update3, 7000);


setTimeout(function () {
axis_x_type = '';
axis_rotated = false;
chart = generate();
}, 8000);
setTimeout(update1, 9000);
setTimeout(update2, 10000);
setTimeout(update3, 11000);


setTimeout(function () {
axis_x_type = '';
axis_rotated = true;
chart = generate();
}, 12000);
setTimeout(update1, 13000);
setTimeout(update2, 14000);
setTimeout(update3, 15000);

function redrawBar(){
  setTimeout(function () {
      chartBasic.resize();
  }, 800);
}
redrawBar();
$('.iconizedToggle').click(function(){
  redrawBar();
});
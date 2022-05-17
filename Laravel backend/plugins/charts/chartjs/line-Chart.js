window.count = 0;
Chart.defaults.global.pointHitDetectionRadius = 1;
var customTooltips = function(tooltip) {
  // Tooltip Element
  var tooltipEl = $('#chartjs-tooltip');

  if (!tooltipEl[0]) {
    $('body').append('<div id="chartjs-tooltip"></div>');
    tooltipEl = $('#chartjs-tooltip');
  }

  // Hide if no tooltip
  if (!tooltip.opacity) {
    tooltipEl.css({
      opacity: 0
    });
    $('.chartjs-wrap canvas')
      .each(function(index, el) {
        $(el).css('cursor', 'default');
      });
    return;
  }

  $(this._chart.canvas).css('cursor', 'pointer');

  // Set caret Position
  tooltipEl.removeClass('above below no-transform');
  if (tooltip.yAlign) {
    tooltipEl.addClass(tooltip.yAlign);
  } else {
    tooltipEl.addClass('no-transform');
  }

  // Set Text
  if (tooltip.body) {
    var innerHtml = [
      (tooltip.beforeTitle || []).join('\n'), (tooltip.title || []).join('\n'), (tooltip.afterTitle || []).join('\n'), (tooltip.beforeBody || []).join('\n'), (tooltip.body || []).join('\n'), (tooltip.afterBody || []).join('\n'), (tooltip.beforeFooter || [])
      .join('\n'), (tooltip.footer || []).join('\n'), (tooltip.afterFooter || []).join('\n')
    ];
    tooltipEl.html(innerHtml.join('\n'));
  }

  // Find Y Location on page
  var top = 0;
  if (tooltip.yAlign) {
    if (tooltip.yAlign == 'above') {
      top = tooltip.y - tooltip.caretHeight - tooltip.caretPadding;
    } else {
      top = tooltip.y + tooltip.caretHeight + tooltip.caretPadding;
    }
  }

  var position = $(this._chart.canvas)[0].getBoundingClientRect();

  // Display, position, and set styles for font
  tooltipEl.css({
    opacity: 1,
    width: tooltip.width ? (tooltip.width + 'px') : 'auto',
    left: position.left + tooltip.x + 'px',
    top: position.top + top + 'px',
    fontFamily: tooltip._fontFamily,
    fontSize: tooltip.fontSize,
    fontStyle: tooltip._fontStyle,
    padding: tooltip.yPadding + 'px ' + tooltip.xPadding + 'px',
  });
};
var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var randomColorFactor = function() {
  let val=Math.round(Math.random() * 255);
  return val;
};
var randomColor = function(opacity) {
  return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
};
var randomScalingFactor = function() {
  return Math.round(Math.random() * 100);
};
var lineChartData = {
  labels: ["January", "February", "March", "April", "May", "June", "July"],
  datasets: [{
    label: "My First dataset",
    data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
  }, {
    label: "My Second dataset",
    data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
  }]
};
var config = {
  type: 'line',
  data: {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [{
          label: "My First dataset",
          data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
          fill: false,
          borderDash: [5, 5],
      }, {
          label: "My Second dataset",
          data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
          fill: false,
          borderDash: [5, 5],
      }, {
          label: "My Third dataset - No bezier",
          data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
          lineTension: 0,
          fill: false,
      }, {
          label: "My Fourth dataset",
          data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
          fill: false,
      }]
  },
  options: {
      responsive: true,
      maintainAspectRatio:false,
      legend: {
          position: 'bottom',
      },
      hover: {
          mode: 'label'
      },
      scales: {
          xAxes: [{
              display: true,
              scaleLabel: {
                  display: true,
                  labelString: 'Month'
              }
          }],
          yAxes: [{
              display: true,
              scaleLabel: {
                  display: true,
                  labelString: 'Value'
              }
          }]
      },
      title: {
          display: true,
          text: 'Chart.js Line Chart - Legend'
      }
  }
};

var config_lineLogarithmic = {
  type: 'line',
  data: {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [{
          label: "My First dataset",
          data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
          fill: false,
          borderDash: [5, 5],
      }, {
          label: "My Second dataset",
          data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
      }]
  },
  options: {
      responsive: true,
      maintainAspectRatio:false,
      title:{
          display:true,
          text:'Chart.js Line Chart - Logarithmic'
      },
      scales: {
          xAxes: [{
              display: true,
              gridLines: {
                  color: ['black', 'red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet']
              },
              scaleLabel: {
                  display: true,
                  labelString: 'x axis'
              }
          }],
          yAxes: [{
              display: true,
              type: 'logarithmic',
              scaleLabel: {
                  display: true,
                  labelString: 'y axis'
              }
          }]
      }
  }
};

var config_lineSkipPoints = {
  type: 'line',
  data: {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [{
          label: "My First dataset",
          // Skip a point in the middle
          data: [randomScalingFactor(), randomScalingFactor(), NaN, randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
          fill: true,
          borderDash: [5, 5],
      }, {
          label: "My Second dataset",

          // Skip first and last points
          data: [NaN, randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), NaN],
      }]
  },
  options: {
      responsive: true,
      maintainAspectRatio:false,
      title:{
          display:true,
          text:'Chart.js Line Chart - Skip Points'
      },
      tooltips: {
          mode: 'label',
      },
      hover: {
          mode: 'label'
      },
      scales: {
          xAxes: [{
              display: true,
              scaleLabel: {
                  display: true,
                  labelString: 'Month'
              }
          }],
          yAxes: [{
              display: true,
              scaleLabel: {
                  display: true,
                  labelString: 'Value'
              },
          }]
      }
  }
};
var config_pointSizes = {
    type: 'line',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "dataset - big points",
            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
            fill: false,
            borderDash: [5, 5],
            pointRadius: 15,
            pointHoverRadius: 10,
        }, {
            label: "dataset - individual point sizes",
            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
            fill: false,
            borderDash: [5, 5],
            pointRadius: [2, 4, 6, 18, 0, 12, 20],
        }, {
            label: "dataset - large pointHoverRadius",
            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
            fill: false,
            pointHoverRadius: 30,
        }, {
            label: "dataset - large pointHitRadius",
            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
            fill: false,
            pointHitRadius: 20,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio:false,
        legend: {
            position: 'bottom',
        },
        hover: {
            mode: 'label'
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Month'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        },
        title: {
            display: true,
            text: 'Chart.js Line Chart - Different point sizes'
        }
    }
};

$.each(config_pointSizes.data.datasets, function(i, dataset) {
    var background = randomColor(0.5);
    dataset.borderColor = background;
    dataset.backgroundColor = background;
    dataset.pointBorderColor = background;
    dataset.pointBackgroundColor = background;
    dataset.pointBorderWidth = 1;
});
$.each(lineChartData.datasets, function(i, dataset) {
  dataset.borderColor = randomColor(0.4);
  dataset.backgroundColor = randomColor(1);
  dataset.pointBorderColor = randomColor(0.7);
  dataset.pointBackgroundColor = randomColor(0.5);
  dataset.pointBorderWidth = 1;
});

$.each(config.data.datasets, function(i, dataset) {
  var background = randomColor(0.5);
  dataset.borderColor = background;
  dataset.backgroundColor = background;
  dataset.pointBorderColor = background;
  dataset.pointBackgroundColor = background;
  dataset.pointBorderWidth = 1;
});
$.each(config_lineLogarithmic.data.datasets, function(i, dataset) {
    dataset.borderColor = randomColor(0.4);
    dataset.backgroundColor = randomColor(0.5);
    dataset.pointBorderColor = randomColor(0.7);
    dataset.pointBackgroundColor = randomColor(0.5);
    dataset.pointBorderWidth = 1;
});
$.each(config_lineSkipPoints.data.datasets, function(i, dataset) {
    dataset.borderColor = randomColor(0.4);
    dataset.backgroundColor = randomColor(0.5);
    dataset.pointBorderColor = randomColor(0.7);
    dataset.pointBackgroundColor = randomColor(0.5);
    dataset.pointBorderWidth = 1;
});

function drawChart(){
  setTimeout(function(){

    // 1.customTooltips
    var chartEl = document.getElementById("chart1");
    window.myLine = new Chart(chartEl, {
      type: 'line',
      data: lineChartData,
      options: {
        responsive: true,
        maintainAspectRatio:false,
        title:{
          display:true,
          text:'Chart.js Line Chart - Custom Tooltips'
        },
        tooltips: {
          enabled: false,
          custom: customTooltips
        }
      }
    });

    // 2. Line Legend
    var lineLegend = document.getElementById("line-legend").getContext("2d");
    window.myLine = new Chart(lineLegend, config);

    var lineLogarithmic= document.getElementById("line-logarithmic").getContext("2d");
    window.myLine = new Chart(lineLogarithmic, config_lineLogarithmic);

    // 3.
    var lineMultiAxis = document.getElementById("line-multi-axis").getContext("2d");
    window.myLine = Chart.Line(lineMultiAxis, {
        data: lineChartData,
        options: {
            responsive: true,
            maintainAspectRatio:false,
            hoverMode: 'label',
            stacked: false,
            title:{
                display:true,
                text:'Chart.js Line Chart - Multi Axis'
            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        offsetGridLines: false
                    }
                }],
                yAxes: [{
                    type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                    display: true,
                    position: "left",
                    id: "y-axis-1",
                }, {
                    type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                    display: true,
                    position: "right",
                    id: "y-axis-2",

                    // grid line settings
                    gridLines: {
                        drawOnChartArea: false, // only want the grid lines for one axis to show up
                    },
                }],
            }
        }
    });
    // 4.
    var lineSkipPoints = document.getElementById("line-skip-points").getContext("2d");
    window.myLine = new Chart(lineSkipPoints, config_lineSkipPoints);
    // 5.
    var pointSizes = document.getElementById("different-point-sizes").getContext("2d");
    window.myLine = new Chart(pointSizes, config_pointSizes);
  },800);
}
window.onload = function() {
  drawChart();
};
$('.iconizedToggle').click(function(){
  drawChart();
});
$(window).resize(function(){
  drawChart();
});
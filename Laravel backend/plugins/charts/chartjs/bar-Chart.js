var randomScalingFactor = function() {
    return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
};
var randomColorFactor = function() {
    return Math.round(Math.random() * 255);
};
var randomColor = function() {
    return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.7)';
};

var barChartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "My First dataset",
            backgroundColor: "rgba(0,188,212,0.2)",
            borderColor: "rgba(0,188,212,1)",
            borderWidth: 1,
            hoverBackgroundColor: "rgba(0,188,212,0.4)",
            hoverBorderColor: "rgba(0,188,212,1)",
            data: [65, 59, 80, 81, 56, 55, 40],
        }
    ]
};
var barChartDataMultiAxis = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
        label: 'Dataset 1',
        backgroundColor: "rgba(220,220,220,0.5)",
        yAxisID: "y-axis-1",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }, {
        label: 'Dataset 2',
        backgroundColor: "rgba(151,187,205,0.5)",
        yAxisID: "y-axis-2",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }, {
        label: 'Dataset 3',
        backgroundColor: ["#7986cb", "#2196f3", "#29b6f6", "#00acc1", "#26a69a", "#ffd54f", "#ff6d00"],
        yAxisID: "y-axis-1",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }]
};

var barChartStackedData = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
        label: 'Dataset 1',
        backgroundColor: "rgba(100,255,218,0.5)",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }, {
        label: 'Dataset 2',
        backgroundColor: "rgba(244,255,129,0.5)",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }, {
        label: 'Dataset 3',
        backgroundColor: "rgba(151,187,205,0.5)",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }]

};

var dataComboBarLine = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
        type: 'bar',
        label: 'Dataset 1',
        backgroundColor: "rgba(100,255,218,0.5)",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
        borderColor: 'white',
        borderWidth: 2
    }, {
        type: 'line',
        label: 'Dataset 2',
        backgroundColor: "rgba(244,255,129,0.5)",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
        borderColor: 'white',
        borderWidth: 2
    }, {
        type: 'bar',
        label: 'Dataset 3',
        backgroundColor: "rgba(151,187,205,0.5)",
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }, ]

};


window.onload = function() {
    redrawBar();
};

function redrawBar(){
  setTimeout(function(){
        // 1. Basic 
        var basicBarChart = document.getElementById("basic-bar").getContext("2d");
        window.myBar = Chart.Bar(basicBarChart, {
            data: barChartData, 
            height:500,
            options: {
                responsive: true,
                maintainAspectRatio:false,
                hoverMode: 'label',
                hoverAnimationDuration: 400,
                stacked: false,
                title:{
                    display:true,
                    text:"Chart.js Bar Chart"
                },
                scales: {
                    yAxes: [{
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "left",
                        id: "y-axis-1",
                    }],
                }
            }
        });

        // 2. Multiline Bar
        var drawMultiAxisBar = document.getElementById("bar-multi-axis").getContext("2d");
        window.myBar2 = Chart.Bar(drawMultiAxisBar, {
            data: barChartDataMultiAxis, 
            options: {
                responsive: true,
                maintainAspectRatio:false,
                hoverMode: 'label',
                hoverAnimationDuration: 400,
                stacked: false,
                title:{
                    display:true,
                    text:"Chart.js Bar Chart - Multi Axis"
                },
                scales: {
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
                        gridLines: {
                            drawOnChartArea: false
                        }
                    }],
                }
            }
        });
        // 3.bar-stacked
        var barStacked = document.getElementById("bar-stacked").getContext("2d");
        window.myBar3 = new Chart(barStacked, {
            type: 'bar',
            data: barChartStackedData,
            options: {
                title:{
                    display:true,
                    text:"Chart.js Bar Chart - Stacked"
                },
                tooltips: {
                    mode: 'label'
                },
                responsive: true,
                maintainAspectRatio:false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }
        });

        var ctx = document.getElementById("comboBar-line").getContext("2d");
        window.myBar4 = new Chart(ctx, {
            type: 'bar',
            data: dataComboBarLine,
            options: {
                responsive: true,
                maintainAspectRatio:false,
                title: {
                    display: true,
                    text: 'Chart.js Combo Bar Line Chart'
                }
            }
        });
        
    },1000);
}
$('.iconizedToggle').click(function(){
  redrawBar();
});
/*$(window).resize(function(){
   redrawBar(); 
});*/
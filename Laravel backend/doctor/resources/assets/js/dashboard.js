/**
 * [chartColors : List of colors to be used in the chart]
 * @type {Object}
 */
window.chartColors = {
    primary:'rgb(42, 86, 198)',
    primarylight:'rgb(106, 130, 250)',
    primarydark:'rgb(0, 46, 148)',
    secondary:'rgb(233, 30, 99)',
    secondarylight:'rgb(255, 96, 144)',
    secondarydark:'rgb(176, 0, 58)',
    successcolor:'rgb(76, 175, 80)',
    successcolorlight:'rgb(128, 226, 126)',
    successcolordark:'rgb(8, 127, 35)',
    errorcolor:'rgb(244, 67, 54)',
    errorcolorlight:'rgb(255, 121, 97)',
    errorcolordark:'rgb(186, 0, 13)',
    warningcolor:'rgb(255, 152, 0)',
    warningcolorlight:'rgb(255, 201, 71)',
    warningcolordark:'rgb(198, 105, 0)',
    infocolor:'rgb(0, 188, 212)',
    infocolorlight:'rgb(98, 239, 255)',
    infocolordark:'rgb(0, 139, 163)'
};
var chartColors = window.chartColors;
var color = Chart.helpers.color;
/**
 * [randomScalingFactor : Random Scale to plot values on chart]
 * @param  {[type]} multipier [description]
 * @return {[type]}           [description]
 */
window.randomScalingFactor = function(multipier) {
    multipier = multipier || 100;
    return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * multipier);
}
window.randomScalingFactor2 = function() {
    return (Math.random() > 0 ? 1.5 : 1.0) * Math.round(Math.random() * 1000);
}
// VISITS AND SALES
var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var DAYS = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
var progress = document.getElementById('salesVisitProgress');
/**
 * [configVisitSales description]
 * @type {Object}
 */
var configVisitSales = {
    type: 'line',
    data: {
        labels: DAYS,
        datasets: [
            {
                label: "Visits",
                fill: false,
                borderColor: window.chartColors.primarylight,
                backgroundColor: window.chartColors.primary,
                data: [
                    randomScalingFactor(), 
                    randomScalingFactor(), 
                    randomScalingFactor(), 
                    randomScalingFactor(), 
                    randomScalingFactor(), 
                    randomScalingFactor(), 
                    randomScalingFactor()
                ]
            },
            {
                label: "Sales",
                fill: false,
                borderColor: window.chartColors.secondarylight,
                backgroundColor: window.chartColors.secondary,
                data: [
                    randomScalingFactor(), 
                    randomScalingFactor(), 
                    randomScalingFactor(), 
                    randomScalingFactor(), 
                    randomScalingFactor(), 
                    randomScalingFactor(), 
                    randomScalingFactor()
                ]
            }
        ]
    },
    options: {
        responsive: true,
        legend: {
            position: 'bottom',
        },
        title:{
            display:false,
            text: "Chart.js Line Chart - Animation Progress Bar"
        },
        animation: {
            duration: 2000,
            easing:'easeOutCirc',
            /*onProgress: function(animation) {
                progress.value = animation.animationObject.currentStep / animation.animationObject.numSteps;
            },
            onComplete: function(animation) {
                window.setTimeout(function() {
                    progress.value = 0;
                }, 2000);
            }*/
        }
    }
};
/**
 * [configRevenue description]
 * @type {Object}
 */
var configRevenue = {
    type: 'line',
    data: {
        labels: DAYS,
        datasets: [
        {
            label: "Revenue (In $)",
            backgroundColor: window.chartColors.successcolorlight,
            borderColor: window.chartColors.successcolor,
            data: [
                randomScalingFactor(200), 
                randomScalingFactor(200), 
                randomScalingFactor(200), 
                randomScalingFactor(200), 
                randomScalingFactor(200), 
                randomScalingFactor(200), 
                randomScalingFactor(200)
            ],
            fill: true,
        }
        ]
    },
    options: {
        responsive: true,
        legend: {
            display:false,
            position: 'bottom',
        },
        title:{
            display:false,
            text:'Revenue From Sales'
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        animation: {
            duration: 2000,
            easing:'easeOutCirc'
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: false,
                    labelString: 'Week'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Income (In Dollar)'
                }
            }]
        }
    }
};
/**
 * [TrafficSourceData description]
 * @type {Object}
 */
var TrafficSourceData = {
    labels: ["00:00", "04:00", "08:00", "12:00", "16:00", "20:00", "24:00"],
    datasets: [{
        type: 'line',
        label: 'Online',
        borderColor: window.chartColors.successcolor,
        borderWidth: 2,
        fill: false,
        data: [
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor()
        ]
    }, {
        type: 'bar',
        label: 'New Visitors',
        backgroundColor: window.chartColors.primary,
        data: [
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor()
        ],
        borderColor: 'white',
        borderWidth: 2
    }, {
        type: 'bar',
        label: 'New Session',
        backgroundColor: window.chartColors.secondary,
        data: [
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor()
        ]
    }]

};
var configTrafficSource = {
    type: 'bar',
    data: TrafficSourceData,
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Chart.js Combo Bar Line Chart'
        },
        tooltips: {
            mode: 'index',
            intersect: true
        }
    }
};

/**
 * Traffic Audiance
 */
var configTrafficAudiance = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
            ],
            backgroundColor: [
                window.chartColors.successcolorlight,
                window.chartColors.errorcolorlight,
                window.chartColors.warningcolorlight,
                window.chartColors.infocolorlight,
            ],
            label: 'Percentage'
        }],
        labels: [
            "Google",
            "CodigoForge",
            "Themeforest",
            "Referal",
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: true,
            position: 'bottom'
        },
    }
};
/**
 * Product Doughnut
 */
var configProductType = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
            backgroundColor: [
                window.chartColors.primarylight,
                window.chartColors.secondarylight,
                window.chartColors.warningcolorlight,
            ],
            label: 'Dataset 1'
        }],
        labels: [
            "HTML Template",
            "VueJS",
            "Laravel"
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: true,
            position: 'top'
        },
        title: {
            display: false,
            text: 'Chart.js Doughnut Chart'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

/**
 * 
 */
var productTypeSalesData = {
    labels: DAYS,
    datasets: [{
        label: 'HTML',
        backgroundColor: window.chartColors.successcolor,
        data: [
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor()
        ]
    },
    {
        label: 'VueJS',
        backgroundColor: window.chartColors.warningcolor,
        data: [
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor()
        ]
    },
    {
        label: 'Laravel',
        backgroundColor: window.chartColors.infocolor,
        data: [
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor(), 
            randomScalingFactor()
        ]
    }]
};
var productTypeSalesConf= {
    type: 'bar',
    data: productTypeSalesData,
    options: {
        legend: {
            display:true,
            position: 'bottom',
        },
        title:{
            display:false,
            text:"Chart.js Bar Chart - Stacked"
        },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        responsive: true,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }
};
/**
 * [onload : Loading Events]
 * @return {[type]} [description]
 */
window.onload = function() {
    var visitNsales = document.getElementById("salesVisit").getContext("2d");
    window.myLineVisits = new Chart(visitNsales, configVisitSales);

    /*var revenue = document.getElementById("revenue").getContext("2d");
    window.myLineRevenue = new Chart(revenue, configRevenue);*/

    var trafficSource = document.getElementById("trafficSource").getContext("2d");
    window.trafficSourceChart = new Chart(trafficSource, configTrafficSource);

    /*var productTypeDoughnut = document.getElementById("productTypeDoughnut").getContext("2d");
    window.productType = new Chart(productTypeDoughnut, configProductType);*/

    var productTypeSales = document.getElementById("productTypeSales").getContext("2d");
    window.productTypeSalesChart = new Chart(productTypeSales,productTypeSalesConf);
    // document.getElementById('js-legend').innerHTML = productTypeSalesChart.generateLegend();

    var trafficAudiance = document.getElementById("trafficAudiance").getContext("2d");
    window.trafficAudianceChart = new Chart(trafficAudiance, configTrafficAudiance);
    // document.getElementById('trafficAudianceLegend').innerHTML = trafficAudianceChart.generateLegend();
};

/**
 * [description]
 * @param  {[type]} ){                  configVisitSales.data.datasets.forEach(function(dataset) {        dataset.data [description]
 * @param  {[type]} 5000 [description]
 * @return {[type]}      [description]
 */
(function(){
    window.setInterval(function(){
        configVisitSales.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor();
            });
        });    
        window.myLineVisits.update();
        
        /*configRevenue.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor(200);
            });
        });
        window.myLineRevenue.update();*/

        TrafficSourceData.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor();
            });
        });

        window.trafficSourceChart.update();

        /*configProductType.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor();
            });
        });
        window.productType.update();*/

        productTypeSalesData.datasets.forEach(function(dataset, i) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor();
            });
        });
        window.productTypeSalesChart.update();

        configTrafficAudiance.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor();
            });
        });

        window.trafficAudianceChart.update();
    }, 5000);
    
})();

/**
 * SPARKLINE CHARTs
 */
$(".taskred75").sparkline([2,1,1], {type: 'pie',width: '20',
    height: '20',borderWidth:0,sliceColors: ['#f44336','#ffcdd2']});
$(".taskblue25").sparkline([-1,4,1], {type: 'pie',width: '20',
    height: '20',borderWidth:0,sliceColors: ['#82b1ff','#2962ff']});
$(".taskyellow50").sparkline([1,2,1], {type: 'pie',width: '20',
    height: '20',borderWidth:0,sliceColors: ['#ff6f00','#ffc107']});
$(".taskgreen").sparkline([1], {type: 'pie',width: '20',
    height: '20',borderWidth:0,sliceColors: ['#00e676']});

$(".progress1").sparkline([5,6,7,9,9,5,3,2,2,4,6,7], {
    type: 'line',
    lineColor: '#2a56c6',
    height: '20',
    width: '40',
    fillColor: '#6a82fa',
    spotColor: '#e91e63',
    minSpotColor: '#ff6090',
    maxSpotColor: '#b0003a',
    highlightSpotColor: '#4caf50',
    highlightLineColor: '#f44336',
    drawNormalOnTop: false});
$(".progress2").sparkline([5,5,3,2,2,4,6,7,6,7,9,9], {
    type: 'line',
    lineColor: '#2a56c6',
    height: '20',
    width: '40',
    fillColor: '#6a82fa',
    spotColor: '#e91e63',
    minSpotColor: '#ff6090',
    maxSpotColor: '#b0003a',
    highlightSpotColor: '#4caf50',
    highlightLineColor: '#f44336',
    drawNormalOnTop: false});
$(".progress3").sparkline([3,2,2,4,5,6,7,9,9,5,6,7], {
    type: 'line',
    lineColor: '#2a56c6',
    height: '20',
    width: '40',
    fillColor: '#6a82fa',
    spotColor: '#e91e63',
    minSpotColor: '#ff6090',
    maxSpotColor: '#b0003a',
    highlightSpotColor: '#4caf50',
    highlightLineColor: '#f44336',
    drawNormalOnTop: false});
$(".progress4").sparkline([7,9,3,2,5,6,9,5,2,4,6,7], {
    type: 'line',
    lineColor: '#2a56c6',
    height: '20',
    width: '40',
    fillColor: '#6a82fa',
    spotColor: '#e91e63',
    minSpotColor: '#ff6090',
    maxSpotColor: '#b0003a',
    highlightSpotColor: '#4caf50',
    highlightLineColor: '#f44336',
    drawNormalOnTop: false});

(function(){
    $('.carousel.carousel-slider').carousel({fullWidth: true});
    // JUST TO SHOW TOAST ON LOAD
    $(window).on('load',function() {
        setTimeout(function(){
            var $toastContent = $('<span>Hey, Welcome to Forge Admin</span>');
            var $navInfo = $('<span> Try different navs <i class="material-icons secondary-text left">settings</i>.</span>');
            Materialize.toast($toastContent, 4000,'',function(){  Materialize.toast($navInfo, 5000,'rounded') });
        },2011);
    });
})();
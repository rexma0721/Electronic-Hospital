google.charts.load('current', {'packages':['geochart']});

// 1.  drawRegionsMap
google.charts.setOnLoadCallback(drawRegionsMap);
// 2.  drawMarkersMap
google.charts.setOnLoadCallback(drawMarkersMap);
// 3. Text GeoCharts      
google.charts.setOnLoadCallback(drawRegionsMapText);
// 4. Coloring your chart
google.charts.setOnLoadCallback(drawRegionsColorMap);

// 1.  drawRegionsMap
function drawRegionsMap() {
  var data = google.visualization.arrayToDataTable([
    ['Country', 'Popularity'],
    ['Germany', 200],
    ['United States', 300],
    ['Brazil', 400],
    ['India', 900],
    ['Canada', 500],
    ['France', 600],
    ['RU', 700]
  ]);

  var options = {
    colorAxis: {
      colors: ['#e8eaf6','#80deea','#ffc107']
    }
  };

  var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

  chart.draw(data, options);
}
// 2.  drawMarkersMap
function drawMarkersMap() {
  var data = google.visualization.arrayToDataTable([
    ['City',   'Population', 'Area'],
    ['Rome',      2761477,    1285.31],
    ['Milan',     1324110,    181.76],
    ['Naples',    959574,     117.27],
    ['Turin',     907563,     130.17],
    ['Palermo',   655875,     158.9],
    ['Genoa',     607906,     243.60],
    ['Bologna',   380181,     140.7],
    ['Florence',  371282,     102.41],
    ['Fiumicino', 67370,      213.44],
    ['Anzio',     52192,      43.43],
    ['Ciampino',  38262,      11]
  ]);

  var options = {
    region: 'IT',
    displayMode: 'markers',
    colorAxis: {colors: ['#039be5','#fbc02d','#607d8b']}

  };

  var chart = new google.visualization.GeoChart(document.getElementById('chart_markersMap'));
  chart.draw(data, options);
}
// 3. Text GeoCharts      
function drawRegionsMapText() {
 var data = google.visualization.arrayToDataTable([
   ['Country', 'Popularity'],
   ['South America', 600],
   ['Canada', 500],
   ['France', 600],
   ['Russia', 700],
   ['Australia', 600]
 ]);
  var options = {
    displayMode: 'text',
    colorAxis: {
      colors: ['#039be5','#fbc02d','#607d8b']
    }
  };

 var chart = new google.visualization.GeoChart(document.getElementById('regionstext_div'));

 chart.draw(data, options);
}
// 4. Coloring your chart
function drawRegionsColorMap() {
  var data = google.visualization.arrayToDataTable([
    ['Country',   'Latitude'],
    ['Algeria', 36], ['Angola', -8], ['Benin', 6], ['Botswana', -24],
    ['Burkina Faso', 12], ['Burundi', -3], ['Cameroon', 3],
    ['Canary Islands', 28], ['Cape Verde', 15],
    ['Central African Republic', 4], ['Ceuta', 35], ['Chad', 12],
    ['Comoros', -12], ['Cote d\'Ivoire', 6],
    ['Democratic Republic of the Congo', -3], ['Djibouti', 12],
    ['Egypt', 26], ['Equatorial Guinea', 3], ['Eritrea', 15],
    ['Ethiopia', 9], ['Gabon', 0], ['Gambia', 13], ['Ghana', 5],
    ['Guinea', 10], ['Guinea-Bissau', 12], ['Kenya', -1],
    ['Lesotho', -29], ['Liberia', 6], ['Libya', 32], ['Madagascar', null],
    ['Madeira', 33], ['Malawi', -14], ['Mali', 12], ['Mauritania', 18],
    ['Mauritius', -20], ['Mayotte', -13], ['Melilla', 35],
    ['Morocco', 32], ['Mozambique', -25], ['Namibia', -22],
    ['Niger', 14], ['Nigeria', 8], ['Republic of the Congo', -1],
    ['Réunion', -21], ['Rwanda', -2], ['Saint Helena', -16],
    ['São Tomé and Principe', 0], ['Senegal', 15],
    ['Seychelles', -5], ['Sierra Leone', 8], ['Somalia', 2],
    ['Sudan', 15], ['South Africa', -30], ['South Sudan', 5],
    ['Swaziland', -26], ['Tanzania', -6], ['Togo', 6], ['Tunisia', 34],
    ['Uganda', 1], ['Western Sahara', 25], ['Zambia', -15],
    ['Zimbabwe', -18]
  ]);

  var options = {
    region: '002', // Africa
    colorAxis: {colors: ['#69f0ae', '#b0bec5', '#fbc02d']},
    backgroundColor: '#e0f7fa',
    datalessRegionColor: '#f3e5f5',
    defaultColor: '#c8e6c9',
  };

  var chart = new google.visualization.GeoChart(document.getElementById('geochart-colors'));
  chart.draw(data, options);
};
function redrawChart(){
  setTimeout(function () {
    drawRegionsMap();
    drawMarkersMap();
    drawRegionsMapText();
    drawRegionsColorMap();
  }, 500);
}
// -------------------------------------
$(window).resize(function(){
  redrawChart();
});
$('.iconizedToggle').click(function(){
  redrawChart();
});
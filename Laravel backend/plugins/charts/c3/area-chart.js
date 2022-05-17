// 1.Basic Chart
var areaBasic = c3.generate({
	bindto: '#area-basic',
	data: {
	  columns: [
	    ['data1', 300, 350, 300, 0, 0, 0],
	    ['data2', 130, 100, 140, 200, 150, 50]
	  ],
	  type: 'area'
	}
});
// 2.Area-spline chart
var areaSpline= c3.generate({
	bindto: '#area-spline',
	data: {
	  columns: [
	    ['data1', 300, 350, 300, 0, 0, 0],
	    ['data2', 130, 100, 140, 200, 150, 50]
	  ],
	  type: 'area-spline'
	}
});
// 3.Area-step chart
var areaStep= c3.generate({
	bindto: '#area-step',
	data: {
	  columns: [
	    ['data1', -300, 350, -300, 0, 0, 0],
	    ['data2', -130, -100, 140, -200, 150, -50]
	  ],
	  type: 'area-step'
	}
});
// 4.Stacked Area chart
var areaStacked= c3.generate({
	bindto: '#area-stacked',
	data: {
	  columns: [
	    ['data1', -300, 350, -300, 0, 0, 100],
	    ['data2', -130, 0, 140, -200, 150, -50]
	  ],
	  type: 'area',
	  groups: [['data1', 'data2']],
	}
});
// 5.Stacked Area-spline
var areaStackedSpline = c3.generate({
	bindto: '#area-stacked-spline',
	data: {
	  columns: [
	    ['data1', -300, -350, -300, 0, 0, -100],
	    ['data2', -130, 0, -140, -200, 0, -50]
	  ],
	  type: 'area-spline',
	  groups: [['data1', 'data2']],
	}
});
// 6.Stacked Area-step
var areaStackedStep = c3.generate({
	bindto: '#area-stacked-step',
	data: {
	  columns: [
	    ['data1', 300, 350, 300, 0, 0, 0],
	    ['data2', 130, 100, 140, 200, 150, 50]
	  ],
	  type: 'area-step',
	  groups: [['data1', 'data2']],
	}
});
function redrawChart(){
  setTimeout(function () {
	areaBasic.resize();
	areaSpline.resize();
	areaStep.resize();
	areaStacked.resize();
	areaStackedSpline.resize();
	areaStackedStep.resize();
  }, 800);
}
redrawChart();
$('.iconizedToggle').click(function(){
  redrawChart();
});
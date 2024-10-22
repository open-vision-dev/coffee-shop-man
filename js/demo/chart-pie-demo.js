// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
/*
// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Blue", "Red", "Yellow", "Green"],
    datasets: [{
      data: [12.21, 15.58, 11.25, 8.32],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});*/
            var ctx = document.getElementById("expenses_pie_chart");
            var myPieChart = new Chart(ctx, {
            type: 'pie',
            		data : {
			labels : ["8b2c928a4d7aa1501a70f4f1ae99f708","ee95e18efedfc5b5d7e5f1287cacf4a1","a5c875f0d4029bea2c502cedcd68b920","1150a9494695d604c9aa15213d3a273a","d7059659569f311721c7cf90aa368a75","7ea66368a8c4c43b0ee0cb968d3647e7","64d19b78faf5ac270749d0e262c8628a","5f827feafce737dd5135b623c776702e","0733f5275533597d2e0198400a013f2f","3da4f57788d85476a3a156cf9e51f427","695cf34ded505c38cdb4515ba53bcf87"]  ,
			dataset:[{
			data: [0.02,4.84,95.14,0,0,0,0,0,0,0,0] ,
			backgroundColor:['#007bff','#dc3545','#ffc107',"#2f2f26","#d6100e8","#3d2c9b","#44cc66","#3a1fca","#1895d0","#b05ce4","#2d74ca"] ,
			  }],
			}

            ,
            });
           console.log('chart was drawn');
google.load("visualization", "1", {packages: ["corechart"]});

$(function() {
    
    var data = google.visualization.arrayToDataTable([
          ['Director (Year)',  'Disponibles', 'Reservadas'],
          ['Alfred Hitchcock (1935)', 8.4,         7.9],
          ['Ralph Thomas (1959)',     6.9,         6.5],
          ['Don Sharp (1978)',        6.5,         6.4],
          ['James Hawes (2008)',      4.4,         6.2]
        ]);

        var options = {
          title: 'The decline of \'The 39 Steps\'',
          vAxis: {title: 'Accumulated Rating'},
          isStacked: true
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart'));
        chart.draw(data, options);
    
	/*
	$.ajax({
		type: "POST",
		url: "dashboard/getReservas",
		dataType:'json',
		success: function(data){
            
            var monthDesc =  ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
	    	var arrayD = new Array();
	    	arrayD.push(['Mes', 'Hombres', 'Mujeres', 'Todos']);
            arrayD.push([monthDesc[parseInt(data[3][0].mes - 1)], parseInt(data[3][0].hombre), parseInt(data[3][0].mujer), parseInt(data[3][0].total)]);
            arrayD.push([monthDesc[parseInt(data[2][0].mes - 1)], parseInt(data[2][0].hombre), parseInt(data[2][0].mujer), parseInt(data[2][0].total)]);
            arrayD.push([monthDesc[parseInt(data[1][0].mes - 1)], parseInt(data[1][0].hombre), parseInt(data[1][0].mujer), parseInt(data[1][0].total)]);
            arrayD.push([monthDesc[parseInt(data[0][0].mes - 1)], parseInt(data[0][0].hombre), parseInt(data[0][0].mujer), parseInt(data[0][0].total)]);
            
	        var data1 = google.visualization.arrayToDataTable(arrayD);
	        var chart1 = new google.visualization.LineChart(document.getElementById('chart_div'));
	        chart1.draw(data1, {legend: {position: 'top'}});
            
		}
	});*/

});
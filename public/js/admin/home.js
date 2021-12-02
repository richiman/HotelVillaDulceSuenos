$(function () {
    'use strict'


        $.ajax({
        url: document.location.protocol+'//'+document.location.host+""  +"/getaño" ,
        type: 'GET' ,
        dataType: 'html',
        }).done(function(respuesta){
            let r = JSON.parse(respuesta);
            var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
            // This will get the first returned node in the jQuery collection.
            var salesChart       = new Chart(salesChartCanvas);

            var salesChartData;
            salesChartData = {
                labels  : ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                datasets: [
                    {
                        label               : 'Año Pasado',
                        fillColor           : 'rgb(210, 214, 222)',
                        strokeColor         : 'rgb(210, 214, 222)',
                        pointColor          : 'rgb(210, 214, 222)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgb(220,220,220)',
                        data                : r.anterior
                    },
                    {
                        label               : 'Este Año',
                        fillColor           : 'rgba(60,141,188,0.9)',
                        strokeColor         : 'rgba(60,141,188,0.8)',
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : r.actual
                    }
                ]
            };

            var salesChartOptions = {
                // Boolean - If we should show the scale at all
                showScale               : true,
                // Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                // String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                // Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                // Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                // Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                // Boolean - Whether the line is curved between points
                bezierCurve             : true,
                // Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                // Boolean - Whether to show a dot for each point
                pointDot                : false,
                // Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                // Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                // Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                // Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                // Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                // String - A legend template
                legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio     : true,
                // Boolean - whether to make the chart responsive to window resizing
                responsive              : true
            };

            // Create the line chart
            salesChart.Line(salesChartData, salesChartOptions);
        })
        .fail(function(error){
            console.log(error);
        });

    $.ajax({
        url: document.location.protocol+'//'+document.location.host+""  +"/getrep" ,
        type: 'GET' ,
        dataType: 'html',
        }).done(function(respuesta){
            let r = JSON.parse(respuesta);
        var data = [
            {
                x: r.meses,
                y: r.pre,
                name: 'Pre-Reservas',
                type: 'bar'
            },{
                x: r.meses,
                y: r.res,
                name: "Reservas",
                type: 'bar'
            },{
                x: r.meses,
                y: r.hos,
                name: "Hospedajes",
                type: 'bar'
            },
        ];

        Plotly.newPlot('rep1', data);
        })
        .fail(function(error){
            console.log(error);
        });





});

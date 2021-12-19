$(function () {
    'use strict'
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

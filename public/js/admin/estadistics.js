$(function () {
    'use strict'
    var labels  = [];
    var datanumber  = [];
    var users
    $.ajax({
    url: document.location.protocol+'//'+document.location.host+""  +"/getreservas" ,
    type: 'GET' ,
    dataType: 'html',
    }).done(function(respuesta){
      let reservas = JSON.parse(respuesta);
      for (var i = 0; i < reservas.length; i++) {
         datanumber.push(reservas[i].total);
      }
    })
    .fail(function(error){
        console.log(error);
    });
  
    $.ajax({
    url: document.location.protocol+'//'+document.location.host+""  +"/getusuarios" ,
    type: 'GET' ,
    dataType: 'html',
    }).done(function(respuesta){
        let users = JSON.parse(respuesta);
        for (var i = 0; i < users.length; i++) {
           labels.push(users[i].nombre);
        }
        const data = {
          labels: labels,
          datasets: [{
            label: 'Ventas ',
            backgroundColor:['rgb(255,0,0, 0.8)',
                              'rgba(0,255,0, 0.8)',
                              'rgba(0,0,255, 0.8)',
                              'rgba(255,255,0, 0.8)',
                              'rgba(0,255,255, 0.8)',
                              'rgba(255,0,255, 0.8)',
                              'rgba(0,128,0, 0.5)',
                              'rgba(128,0,128, 0.8)'
                            ],
            borderColor:[     'rgb(255,0,0, 0.5)',
                              'rgba(0,255,0, 0.5)',
                              'rgba(0,0,255, 0.5)',
                              'rgba(255,255,0, 0.5)',
                              'rgba(0,255,255, 0.5)',
                              'rgba(255,0,255, 0.5)',
                              'rgba(0,128,0, 0.5)',
                              'rgba(128,0,128, 0.5)'
                        ],
            data: datanumber,
          }]
        };
        const config = {
          type: 'bar',
          data: data,
          options: {
            plugins: {

            },
            animateRotate: true,
            responsive: true,
            maintainAspectRatio: false,
          }
        };

        const ejecutivosChart = new Chart(
          document.getElementById('ejecutivosChart'),
          config
        );

    })
    .fail(function(error){
        console.log(error);
    });


});

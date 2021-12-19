$(document).ready(function () {
    $('select').selectpicker();

    $.ajax({
        url:document.location.protocol+'//'+document.location.host+""  +"/getcli",
        type:"get",
        data: {},
    }).done(function(json){
        var algo = "";
        algo += "<option value='' title=''>Buscar cliente</option>";
        for(var i in json){

            algo += "<option value='"+json[i].id+"' title='"+json[i].nombre+"'>"+json[i].nombre+" ( "+json[i].estado+")</option>";
        }

        $("#idCli").html(algo);
        $("#idCli").selectpicker("refresh");

    }).fail(function(){

    });
});
$(function(){
    var precios = [];

    var dias;
    $('#new').on('click',function () {
        $('#modal').modal('show');
    });
    $('#guardar').on('click',add);
    $('#salida').on('focusout',function () {
        let fecha1 = moment($("#llegada").val());
        let fecha2 = moment($('#salida').val());

        dias = fecha2.diff(fecha1, 'days');
    });

    $("#status").on("change",function () {
        if($("#status").val() == 3){
            $("#llegada").attr('readonly',true);
            var d = new Date();

            var month = d.getMonth()+1;
            var day = d.getDate();

            var output = d.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;
            $("#llegada").val(output);
        }else{
            $("#llegada").attr('readonly',false);
        }
    });

    $("#cuarto").on('change',function () {
        let cuartos  = $("#cuarto").val();
        let total = 0;
        for(let i = 0; i<cuartos.length; i++){
            for(let j in precios){
                if(precios[j].numero == cuartos[i]){
                    total += Number(precios[j].costo);
                }
            }

        }

        $('#total').val(`${total}`);
    });

    $("#adultos").on('focusout',async function(){
        precios = [];
        var data = new FormData(document.getElementById("formReservacion"));
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+""  +"/gethabitacionesdisponibles",
            type:"get",
            data: {llegada:$('#llegada').val(),salida:$("#salida").val(),adultos:$("#adultos").val()},
        }).done(function(json){
            /*var algo = "";
               for(var i in json){
                   let costo = json[i].pa;

                   algo += "<option value='"+json[i].numero+"' title='"+json[i].numero+"'>"+json[i].numero+" ( "+json[i].capacidad+" personas) " +
                       "$"+costo+" por noche</option>";

                   precios.push({"numero":json[i].numero,"costo":costo});
                }

                $("#cuarto").html(algo);
                $("#cuarto").selectpicker("refresh");*/

            let render = "";
            json.forEach((item) => {
                precios.push({"numero":item.numero,"costo":item.TOTAL});
                render += `<option value="${item.numero}" title="${item.numero}">${item.numero} (${item.capacidad} personas - Total $${item.TOTAL})</option>`;
            });

            $("#cuarto").html(render);
            $("#cuarto").selectpicker("refresh")

        }).fail(function(){

        });
    });

    $('#btnReservacion').on('click',function () {
        $("#btnReservacion").attr('disabled',true);
        var data = new FormData(document.getElementById("formReservacion"));
        data.append('cuartos',$("#cuarto").val());

        $.ajax({
            url:document.location.protocol+'//'+document.location.host+""  +"/reservar",
            type:"POST",
            data: data,
            contentType:false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(json){
            if(json.code == 200) {
                Swal.fire({
                    title: "DATOS DE RESERVACION",
                    text: "LA RESERVASION HA SIDO GUARDADA",
                    type: "success",
                })
                    .then(function() {
                        window.location.replace(document.location.protocol+'//'+document.location.host+""  +"/adminreserva");
                    });
            }else if(json.code == 404){
                alert("Usuario no encontrado");
            }else{
                alert("Error en el servidor, por favor intentelo mas tarde")
            }
        }).fail(function(){

        });
    })
});

function changeFecha(){

    $('#salida').val($('#llegada').val());
}

function add(){
    var data = new FormData(document.getElementById("form-Cliente"));
    $.ajax({
        url:document.location.protocol+'//'+document.location.host+""  +"/newcliente",
        type:"POST",
        data: data,
        contentType:false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function(json){
        if(json.code == 200) {
            Swal.fire({
                title: "DATOS DE RESERVACION",
                text: "EL CLIENTE HA SIDO REGISTRADO",
                type: "success",
            })
                .then(function() {
                    window.location.reload();
                });
        }else if(json.code == 404){
            alert("Usuario no encontrado");
        }else{
            alert("Error en el servidor, por favor intentelo mas tarde")
        }
    }).fail(function(){

    });
}

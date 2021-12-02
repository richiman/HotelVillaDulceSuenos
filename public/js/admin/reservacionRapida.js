$(function(){
    var dias;
    $('#salida').on('focusout',function () {
        let fecha1 = moment($("#llegada").val());
        let fecha2 = moment($('#salida').val());

        dias = fecha2.diff(fecha1, 'days');
    });

    $("#cuarto").on('focusout',function () {
        let texto  = $("#cuarto").select().text();
        let cuartos  = $("#cuarto").val();
        let total = 0;

        for(let i = 0; i<cuartos.length; i++){
            let c = texto.split(cuartos[i]+"");
            let text = c[1].substr('16','4');
            total += Number(text.trim())*dias;
        }

        $('#total').val(total);
    });

    $("#adultos").on('focusout',async function(){
        var data = new FormData(document.getElementById("formReservacion"));
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+""  +"/gethabitacionesdisponibles",
            type:"get",
            data: {llegada:$('#llegada').val(),salida:$("#salida").val(),adultos:$("#adultos").val()},
        }).done(function(json){
            var algo = "";
            for(var i in json){
                let costo = json[i].pa;

                algo += "<option value='"+json[i].numero+"'>"+json[i].numero+" ( "+json[i].capacidad+" personas) " +
                    "$"+json[i].TOTAL+" por noche</option>";
                      console.log(json[i].TOTAL);

            }

            $("#cuarto").html(algo);
        }).fail(function(){

        });
    });

    $('#btnReservacion').on('click',function () {
        $("#btnReservacion").attr('disabled',true);
        var data = new FormData(document.getElementById("formReservacion"));
        data.append('cuartos',$("#cuarto").val());

        $.ajax({
            url:document.location.protocol+'//'+document.location.host+""  +"/senEdit/"+$("#idR").val(),
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

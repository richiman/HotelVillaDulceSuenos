$(function(){
    $('#registrar').on('click',function () {
        var data = new FormData(document.getElementById("formRegistrar"));
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+""  +"/registrar/"+$('#cuarto').val(),
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
                    text: "LA FECHA DE SALIDA SE HA MODIFICADO",
                    type: "success",
                })
                    .then(function() {
                        window.location.replace(document.location.protocol+'//'+document.location.host+""  +"/status");
                    });
            }else if(json.code == 404){
                alert("Usuario no encontrado");
            }else{
                alert("Error en el servidor, por favor intentelo mas tarde");
                console.log(json.error);
            }
        }).fail(function(){

        });
    })
});

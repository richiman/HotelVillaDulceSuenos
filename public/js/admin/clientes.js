$(document).ready(function(){
    $('#new').on('click',function () {
        $('#modal').modal('show');
    });


    $('#guardar').on('click',add);
    $.ajax({
        url: document.location.protocol+'//'+document.location.host+""  +"/getclientes" ,
        type: 'GET'
    })
        .done(function(respuesta){
            $("#datos").append(respuesta);
        })
        .fail(function(error){
            console.log(error);
        });


        $('#registrar').on('click',function () {
            var data = new FormData(document.getElementById("form1"));
            $.ajax({
                url:document.location.protocol+'//'+document.location.host+""  +"/editarcliente/"+$('#id').val(),
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
                        title: "DATOS DE USUARIO",
                        text: "LA INFORMACION DEL CLIENTE HA SIDO ACTUALIZADA",
                        type: "success",
                    })
                        .then(function() {
                          window.location.reload();
                        });
                }else if(json.code == 404){
                    alert("clinte no encontrado");
                    console.log(json.error);
                }else{
                    alert("Error en el servidor, por favor intentelo mas tarde");
                    console.log(json.error);
                }
            }).fail(function(){

            });
        });
});

function editCliente(id) {
        document.location.replace(document.location.protocol+'//'+document.location.host+""  +"/editcli/"+id);
}

function buscar_datos(consulta){

}

function add(){
    var data = new FormData(document.getElementById("formAdd"));
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

function deleteCliente(id){
    Swal.fire({
        title: 'ATENCION?',
        text: "¿Esta seguro que desea eliminar el cliente?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI',
        cancelButtonText: 'NO'
    }).then((result) => {
        console.log(result);
        if (result.value) {
            var data = new FormData(document.getElementById("formAdd"));
            $.ajax({
                url:document.location.protocol+'//'+document.location.host+""  +"/deletecliente/"+id,
                type:"POST",
                data: data,
                contentType:false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function(json){
                if(json.code == 200) {
                    Swal.fire(
                        'Eliminado!',
                        'El Cliente ha sido eliminado correctamente.',
                        'success'
                    ).then(function() {
                            window.location.reload();
                        });
                }else if(json.code == 404){
                    alert("Cliente no encontrado");
                }else if(json.code == 500){
                }else{
                    alert("Error en el servidor, por favor intentelo mas tarde");
                }
            }).fail(function(){

            });
        }
    })

}

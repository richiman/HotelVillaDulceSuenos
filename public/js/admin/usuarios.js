$(function(){

    $('#btnModal').on('click',function () {
       $("#myModal").modal('show');
    });

    $('#registrar').on('click',function () {
        var data = new FormData(document.getElementById("form1"));
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+""  +"/editarusuario/"+$('#id').val(),
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
                    text: "LA INFORMACION DEL USUARIO HA SIDO ACTUALIZADA",
                    type: "success",
                })
                    .then(function() {
                        window.location.reload();
                    });
            }else if(json.code == 404){
                alert("Usuario no encontrado");
            }else{
                alert("Error en el servidor, por favor intentelo mas tarde");
                console.log(json.error);
            }
        }).fail(function(){

        });
    });

    $('#guardar').on('click',function () {
        var data = new FormData(document.getElementById("formAdd"));
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+""  +"/addusuario",
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
                    text: "EL USUARIO HA SIDO REGISTRADO",
                    type: "success",
                })
                    .then(function() {
                        window.location.reload();
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

function edit(id) {
        document.location.replace(document.location.protocol+'//'+document.location.host+""  +"/editusr/"+id);
}

function deleteusr(id){
    Swal.fire({
        title: 'ATENCION?',
        text: "¿Esta seguro que desea eliminar el usuario?",
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
                url:document.location.protocol+'//'+document.location.host+""  +"/deleteusr/"+id,
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
                        'El Usuario ha sido eliminado correctamente.',
                        'success'
                    ).then(function() {
                            window.location.reload();
                        });
                }else if(json.code == 404){
                    alert("Usuario no encontrado");
                }else{
                    alert("Error en el servidor, por favor intentelo mas tarde");
                    console.log(json.error);
                }
            }).fail(function(){

            });
        }
    })

}

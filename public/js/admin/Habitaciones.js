$(function () {
    $("#add").on('click',function () {
       $("#modalHabitacion").modal('show');
    });

    $('#de').on('change',function () {
       $("#a").val($("#de").val());
    });

    $('#guardar').on('click',function () {
        var data = new FormData(document.getElementById("form-Habitaciones"));
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+""  +"/newhabitacion",
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
                    text: "LA HABITACION A SIDO REGISTRADA",
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

    $('#regCosto').on('click',function () {
        var data = new FormData(document.getElementById("form-costos"));
        $.ajax({
            url:document.location.protocol+'//'+document.location.host+""  +"/newcosto",
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
                    title: "Costo Registrado",
                    text: "El costo ha sido registrado correctamente",
                    type: "success",
                })
                    .then(function() {
                        $('#tablacostos').dataTable().api().ajax.reload(null,false);
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

    $('#opc').on('change',function (item) {
       if($("#opc").prop('checked')){
           $("#bloque").prop('hidden',true);
           $("#individual").prop('hidden',false);
           $("#opc").val($("#opc").prop('checked'));
       }else{
           $("#bloque").prop('hidden',false);
           $("#individual").prop('hidden',true);
           $("#opc").val($("#opc").prop('checked'));
       }
    });


});

function clear() {
    $("#numero").val('');
    $("#capacidad").val(0);
    $("#c1").val(0);
    $("#c2").val(0);
    $("#c3").val(0);
    $("#c4").val(0);
    $("#c5").val(0);
    $("#c6").val(0);
}

function editar() {
    var data = new FormData(document.getElementById("form-edit"));
    $.ajax({
        url:document.location.protocol+'//'+document.location.host+""  +"/edithabitacion/"+$('#idH').val(),
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
                text: "LA HABITACION A SIDO ACTUALIZADA",
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
}

function eliminar(id){
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
        if (result.value) {
            //var data = new FormData(document.getElementById("formAdd"));
            $.ajax({
                url:document.location.protocol+'//'+document.location.host+""  +"/deleteroom/"+id,
                type:"POST",
                data: [],
                contentType:false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function(json){
                if(json.code == 200) {
                    console.log('simon');
                    Swal.fire(
                        'Eliminada!',
                        'La Habitacion ha sido eliminada correctamente.',
                        'success'
                    ).then(function() {
                        window.location.reload();
                    });
                }else if(json.code == 500){

                }else{
                    alert("Error en el servidor, por favor intentelo mas tarde");
                    console.log(json.error);
                }
            }).fail(function(){
                Swal.fire(
                    'Error!',
                    'La Habitacion no se pudo eliminar, revise que no contenga reservaciones.',
                    'error'
                ).then(function() {
                    window.location.reload();
                });
            });
        }
    })
}

function editModal(id,numero,capacidad,tipo,c1,c2,c3,c4,c5,c6,pa) {
    $("#idH").val(id);
    $("#ec").val(capacidad);
    $("#en").val(numero);
    if (tipo == 'villa') {
        tipo = 'v';
    }else{
        tipo = 's';
    }
    $("#et").val(tipo);
    $("#eco1").val(c1);
    $("#eco2").val(c2);
    $("#eco3").val(c3);
    $("#eco4").val(c4);
    $("#eco5").val(c5);
    $("#eco6").val(c6);

    $("#epa").val(pa);

    $("#modalEdit").modal('show');
}

function adminCostos() {
    $("#tablacostos").DataTable().destroy();
    $('#tablacostos').DataTable({
        "retrieve": true,
        "paging": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": document.location.protocol+'//'+document.location.host+""  +"/getcostos",
            "type": "GET"
        },
        "columns": [
            { "data": "numero"},
            { "data": "de" },
            { "data": "a" },
            { "data": "costo" },
            { "data": function (data) {
                let button = "<div align='center'><button class='btn btn-danger btn-sm' onclick='deletePrice("+data['id']+")'><i class='fa fa-trash-o'></i></button></div>";
                return button;
            }}
        ]
    }).clear();
    $('#modalCostos').modal('show');

}

function deletePrice(id) {
    Swal.fire({
        title: 'ATENCION?',
        text: "¿Esta seguro que desea eliminar?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI',
        cancelButtonText: 'NO'
    }).then((result) => {
        if (result.value) {
            //var data = new FormData(document.getElementById("formAdd"));
            $.ajax({
                url:document.location.protocol+'//'+document.location.host+""  +"/costodelete/"+id,
                type:"POST",
                data: [],
                contentType:false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function(json){
                if(json.code == 200) {
                    Swal.fire(
                        'Eliminado!',
                        'Se elimino de manera correcta.',
                        'success'
                    ).then(function() {
                        $('#tablacostos').dataTable().api().ajax.reload(null,false);
                    });
                }else if(json.code == 500){

                }else{
                    alert("Error en el servidor, por favor intentelo mas tarde");
                    console.log(json.error);
                }
            }).fail(function(){
                Swal.fire(
                    'Error!',
                    'La Habitacion no se pudo eliminar, revise que no contenga reservaciones.',
                    'error'
                ).then(function() {
                    window.location.reload();
                });
            });
        }
    })
}

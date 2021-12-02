$(document).ready(function(){
    buscar_datos();
});

function buscar_datos(consulta){
    $('#tabla').DataTable({
        "retrieve": true,
        "paging": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": document.location.protocol+'//'+document.location.host+""  +"/busqueda" ,
            "type": "GET"
        },
        "columns": [
            { "data": "folio" },
            { "data": "nombre" },
            { "data": "telefono" },
            { "data": "correo" },
            { "data": "fechallegada" },
            { "data": "fechasalida" },
            { "data": "adultos" },
            { "data": "ninos" },
            { "data": "numero" },
            { "data": "price" },
            { "data": "comentario" },
            { "data": function (data) {
                let confirmar = "";
                let editar = "";
                    let button = "";

                    if(data['status']=="2"){
                        if( data['confirmado'] == false){
                            if($("#tipoempleado").val() == "1"){
                                confirmar = "<button class='btn btn-primary btn-sm' onclick='confirmar("+data['id']+")'>Confirmar</button>";
                            }
                        }else{
                            if(data["fechallegada"] <= formatDate()){
                                confirmar = "<button class='btn btn-success btn-sm' onclick='hospedar("+data['id']+")'>Hospedar</button>";
                            }
                        }
                    }
                    if(data['status']=="1"){
                        confirmar = "<button class='btn btn-warning btn-sm' onclick='hospedar("+data['id']+")'>Reservar</button>";
                    }

                    if($("#tipoempleado").val() == "1"){
                        editar = "<a class='btn btn-secondary btn-sm' href='https://villadulcesuenos.com/editreserva/"+data['id']+"' ><i class='fa fa-edit'></i></a>";
                        button = "<button class='btn btn-danger btn-sm' onclick='eliminar(" + data['id'] + ")'><i class='fa fa-trash-o'></i></button>";
                    }

                    let salida = "<div align='center'>" +
                        confirmar+"<br>"+editar+button+
                        "</div>";
                    return salida;
            }},
            { "data": "name" },
            { "data": "created_at" },
        ],
        aaSorting:[[4,'asc']],
        createdRow:function (row,data,dataIndex) {
            switch(data['status']){
                case '1': $(row).addClass('bg-primary');
                    break;

                case '2': $(row).addClass('bg-warning');
                    break;

                case '3': $(row).addClass('bg-success');
                    break;
                default: $(row).addClass('bg-success');
            }
        }
    });
}

function eliminar(id){
    $.ajax({
        url: document.location.protocol+'//'+document.location.host+""  +"/deletereserva/"+id ,
        type: 'delete' ,
        dataType: 'json',
    })
        .done(function(respuesta){
            if(respuesta['code']==200){
                $('#tabla').dataTable().api().ajax.reload(null,false);
            }
        })
        .fail(function(){
            console.log("error");
        });
}

function hospedar(id){
    $.ajax({
        url: document.location.protocol+'//'+document.location.host+""  +"/hospedar/"+id ,
        type: 'post' ,
        dataType: 'json',
    })
        .done(function(respuesta){
            if(respuesta['code']==200){
                $('#tabla').dataTable().api().ajax.reload(null,false);
            }
        })
        .fail(function(){
            console.log("error");
        });
}

function confirmar(id){
    $.ajax({
        url: document.location.protocol+'//'+document.location.host+""  +"/confirmar/"+id ,
        type: 'post' ,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
        .done(function(respuesta){
            if(respuesta['code']==200){
                $('#tabla').dataTable().api().ajax.reload(null,false);
            }
        })
        .fail(function(){
            console.log("error");
        });
}

function formatDate() {
    var d = new Date(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

$(document).on('keyup','#caja_busqueda', function(){
    var valor = $(this).val();
    if (valor != "") {
        buscar_datos(valor);
    }else{
        buscar_datos();
    }
});

function printTable() {
    var doc = new jsPDF('landscape');
    // It can parse html:
    doc.autoTable({html: '#tabla'});

    // Or use javascript directly:

    doc.save('reservas.pdf');
}

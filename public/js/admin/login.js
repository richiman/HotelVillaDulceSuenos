$(function(){
   $('#btnLogin').on('click',function () {
       var data = new FormData(document.getElementById("loginForm"));
       $.ajax({
           url:document.location.protocol+'//'+document.location.host+""  +"/dologin",
           type:"POST",
           data: data,
           contentType:false,
           processData: false,
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       }).done(function(json){
           if(json.code == 200) {
               window.location.replace(document.location.protocol+'//'+document.location.host+""  +"/adminreserva");
           }else if(json.code == 404){
               alert("Usuario no encontrado");
           }else{
               alert("Error en el servidor, por favor intentelo mas tarde")
           }
       }).fail(function(){

       });
   })
});

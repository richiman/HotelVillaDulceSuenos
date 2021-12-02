$(function () {
   $("#fecha").on("change",function () {
       window.location.replace(document.location.protocol+'//'+document.location.host+"/status/"+$("#fecha").val());
   });
});

function imprimir() {
    html2canvas($("#contenido"),{
        onrendered:function(canvas){

            var img=canvas.toDataURL("image/png");
            var doc = new jsPDF('landscape');
            doc.addImage(img,'JPEG',20,20);
            doc.save('estatus.pdf');
        }

    });
}

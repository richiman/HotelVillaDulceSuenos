<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Reservacion</title>
</head>
<body>
<div align="center">
    <img src="{{asset('/img/logo.png')}}" alt="">
</div>
<p>Estimado(a) Sr(a). {{$cliente->nombre}}</p>
<p>Gracias por su eleccion en Villas Dulce Sueños, esperamos cumplir con sus espectativas.</p>
<br>
<p>El folio de su reservación es:</p>
<div align="center">
    <h2>{{$reserva->folio}}</h2>
</div>
<br>
<p>Reservando la habitación para el periodo de {{substr($reserva->fechallegada,0,10).' a '.substr($reserva->fechasalida,0,10)}}</p>
<br>

</body>
</html>

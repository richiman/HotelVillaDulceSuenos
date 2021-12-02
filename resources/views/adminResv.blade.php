@extends('layout.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@stop


@section('content')
    @include('partials.navbar', ['ventana' => 'Administracion de Reservaciones','name'=>'AdminReservas'])
    <input type="hidden" id="tipoempleado" value="{{$empleado->tipo}}">

    <br>

    <!--contenido del menu Inicia---->

    <section class="principal">

        <div class="container ">
            <div class="row">
                <label style="background: #0275d8; color: #0275d8">[----------------------]</label>
                <label>Pre-Reservas</label>
            </div>
            <div class="row">
                <label style="background: #f0ad4e; color: #f0ad4e">[----------------------]</label>
                <label>Reservas</label>
            </div>
            <div class="row">
                <label style="background: #bdecb6; color: #bdecb6">[----------------------]</label>
                <label>Hospedados</label>
            </div>
        </div>

        <div class="container">
            <button class="btn btn-dark" onclick="printTable()">imprimir</button>
        </div>

        <div id="datos" class="col" style="overflow-y: scroll;">
            <table id='tabla' class='table table-striped table-bordered' style='width:100%'>
                <thead class='thead-light'>
                <tr id='titulo'>
                    <th scope='col'>FOLIO</th>
                    <th scope='col'>NOMBRE</th>
                    <th scope='col'>TELEFONO</th>
                    <th scope='col'>CORREO</th>
                    <th scope='col'>LLEGA</th>
                    <th scope='col'>SALE</th>
                    <th scope='col'>ADULTOS</th>
                    <th scope='col'>NIÑOS</th>
                    <th scope='col'>CUARTO</th>
                    <th scope='col'>PRECIO</th>
                    <th scope='col'>COMENTARIOS</th>
                    <th scope='col'>Opciones</th>
                    <th scope='col'>Registrado</th>
                    <th scope='col'>Fecha de Registro</th>
                </tr>
                </thead>
            </table>
        </div>


    </section>
@stop

@section('script')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/jspdf@1.5.3/dist/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.2.4/dist/jspdf.plugin.autotable.js"></script>
    <script type="text/javascript" src="{{asset('/js/admin/adminResv.js')}}"></script>
@stop

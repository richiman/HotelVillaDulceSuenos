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

        <div class="container">
            <div class="d-flex justify-content-around">
                <label class="rounded shadow" style="background: #007bff; color: #007bff">[-----------<label class="text-light font-weight-bold">Pre-Reservas</label>-----------]</label>
                <label class="rounded shadow" style="background: #ffc107; color: #ffc107">[------------<label class="text-light font-weight-bold">Reservas</label>----------]</label>
                <label class="rounded shadow" style="background: #28a745; color: #28a745">[------------<label  class="text-light font-weight-bold">Hospedados</label>----------]</label>
                <button class="btn btn-dark shadow" onclick="printTable()">imprimir</button>
            </div>
        </div>
        <div id="datos" class="col-md-12" style="overflow-y: scroll;">
            <table   id='tabla' class='table table-striped table-sm table-bordered  ' style='width:100%'>
                <thead class='thead-light'>
                <tr id='titulo'>
                    <th scope='col'>FOLIO</th>
                    <th scope='col'>NOMBRE</th>
                    <th scope='col'>TELEFONO</th>
                    <th scope='col'>CORREO</th>
                    <th scope='col'>LLEGA</th>
                    <th scope='col'>SALE</th>
                    <th scope='col'>A</th>
                    <th scope='col'>Cuar</th>
                    <th scope='col'>P$</th>
                    <th scope='col'>PS$</th>
                    <th scope='col'>COMENTARIOS</th>
                    <th scope='col'>Opciones</th>
                    <th scope='col'>Registrado Por</th>
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

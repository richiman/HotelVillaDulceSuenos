@extends('layout.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@stop
@section('content')
    @include('partials.navbar', ['ventana' => 'Clientes','name'=>'clientes'])

    <br>

    <section class="principal ">
        <div align="center" class="container">
            <button class="btn btn-success" id="new"><i class="fa fa-user-plus"></i> Agregar</button>

            <button class="btn btn-dark" onclick="printTable()">imprimir</button>
        </div>

        <div class="d-flex justify-content-center">
          <div id="datos" class="col-md-10  ">

          </div>
        </div>



    </section>

    <style type="text/css">
        .modal-backdrop.show{
            opacity: 0.5;
        }

        .modal-backdrop{
            background-color: rgba(0,0,0,.0001) !important;
        }

    </style>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cliente</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="formAdd">
                            <div class="row col-md-12">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono">
                                </div>
                                <div class="col-md-6">
                                    <label for="correo">Correo</label>
                                    <input type="email" class="form-control" id="correo" name="correo">
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <label for="estado">Estado</label>
                                <input type="text" class="form-control" id="estado" name="estado">
                            </div>
                            <div class="row col-md-12">
                                <label for="estado">Vehiculo</label>
                                <input type="text" class="form-control" id="vehiculo" name="vehiculo">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelar">Cancelar</button>
                    <button type="button" class="btn btn-success" id="guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="{{asset('/js/admin/clientes.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/jspdf@1.5.3/dist/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.2.4/dist/jspdf.plugin.autotable.js"></script>
    <script type="text/javascript" src="{{asset('/js/admin/adminResv.js')}}"></script>
@stop

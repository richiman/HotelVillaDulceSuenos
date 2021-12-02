@extends('layout.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop
@section('content')
    @include('partials.navbar', ['ventana' => "Habitaciones",'name'=>'habitaciones'])
    <br>
    <div class="container" align="right">
        <button class="btn btn-secondary" onclick="adminCostos()">Costos</button>
        <button class="btn btn-success" id="add"><i class="fa fa-plus"></i> Agregar Habitacion</button>
    </div>
    <br>
    <div class="container">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <row>
                    <th style="text-align: center">Numero</th>
                    <th style="text-align: center">Capacidad</th>
                    <th style="text-align: center">Tipo</th>
                    <th style="text-align: center">Costo Activo</th>
                    <th style="text-align: center">acciones</th>
                </row>
            </thead>
            <tbody>
                @foreach($habitaciones as $habitacion)
                    <tr>
                        <th style="text-align: center">{{$habitacion->numero}}</th>
                        <th style="text-align: center">{{$habitacion->capacidad}}</th>
                        <th style="text-align: center">{{$habitacion->tipo}}</th>
                        <th style="text-align: center">{{'$'.$habitacion->pa}}</th>

                        <th style="text-align: center">
                            <div align="center">
                                <button class="btn btn-warning"  onclick="editModal(
                                    '{{$habitacion->id}}',
                                    '{{$habitacion->numero}}',
                                    '{{$habitacion->capacidad}}',
                                    '{{$habitacion->tipo}}',
                                    '{{$habitacion->c1}}',
                                    '{{$habitacion->c2}}',
                                    '{{$habitacion->c3}}',
                                    '{{$habitacion->c4}}',
                                    '{{$habitacion->c5}}',
                                    '{{$habitacion->c6}}',
                                    '{{$habitacion->pactivo}}'
                                )"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger" onclick="eliminar('{{$habitacion->id}}')"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <style type="text/css">
        .modal-backdrop.show{
            opacity: 0.5;
        }

        .modal-backdrop{
            background-color: rgba(0,0,0,.0001) !important;
        }

    </style>
    <div class="modal" tabindex="-1" role="dialog" id="modalHabitacion">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Habitacion</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="form-Habitaciones">
                            <div class="row">
                                <label for="numero">Numero</label>
                                <input type="text" class="form-control" name="numero" id="numero">
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="capacidad">Capacidad</label>
                                    <input type="number" class="form-control" name="capacidad" id="capacidad" value="0">
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label for="tipo">Tipo</label>
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value="v">Villa</option>
                                        <option value="s">Suite</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="c1">Costo 1</label>
                                    <input type="number" class="form-control" name="c1" id="c1" value="0">
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <label for="c2">Costo 2</label>
                                    <input type="number" class="form-control" name="c2" id="c2" value="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="c1">Costo 3</label>
                                    <input type="number" class="form-control" name="c3" id="c3" value="0">
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <label for="c2">Costo 4</label>
                                    <input type="number" class="form-control" name="c4" id="c4" value="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="c1">Costo 5</label>
                                    <input type="number" class="form-control" name="c5" id="c5" value="0">
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <label for="c2">Costo 6</label>
                                    <input type="number" class="form-control" name="c6" id="c6" value="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="pa">Costo Activo</label>
                                    <select name="pa" id="pa" class="form-control selectpicker" >
                                        <option value="1">Costo 1</option>
                                        <option value="2">Costo 2</option>
                                        <option value="3">Costo 3</option>
                                        <option value="4">Costo 4</option>
                                        <option value="5">Costo 5</option>
                                        <option value="6">Costo 6</option>
                                    </select>
                                </div>
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

    <div class="modal" tabindex="-1" role="dialog" id="modalEdit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Habitacion</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="form-edit">
                            <input type="hidden" id="idH">
                            <div class="row">
                                <label for="numero">Numero</label>
                                <input type="text" class="form-control" name="numero" id="en">
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="capacidad">Capacidad</label>
                                    <input type="number" class="form-control" name="capacidad" id="ec" value="0">
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label for="tipo">Tipo</label>
                                    <select name="tipo" id="et" class="form-control">
                                        <option value="v">Villa</option>
                                        <option value="s">Suite</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="c1">Costo 1</label>
                                    <input type="number" class="form-control" name="c1" id="eco1" value="0">
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <label for="c2">Costo 2</label>
                                    <input type="number" class="form-control" name="c2" id="eco2" value="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="c1">Costo 3</label>
                                    <input type="number" class="form-control" name="c3" id="eco3" value="0">
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <label for="c2">Costo 4</label>
                                    <input type="number" class="form-control" name="c4" id="eco4" value="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="c1">Costo 5</label>
                                    <input type="number" class="form-control" name="c5" id="eco5" value="0">
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <label for="c2">Costo 6</label>
                                    <input type="number" class="form-control" name="c6" id="eco6" value="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="pa">Costo Activo</label>
                                    <select name="pa" id="epa" class="form-control">
                                        <option value="1">Costo 1</option>
                                        <option value="2">Costo 2</option>
                                        <option value="3">Costo 3</option>
                                        <option value="4">Costo 4</option>
                                        <option value="5">Costo 5</option>
                                        <option value="6">Costo 6</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="ecancelar">Cancelar</button>
                    <button type="button" class="btn btn-success" onclick="editar()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal " tabindex="-1" role="dialog" id="modalCostos">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tmc">Costos</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="form-costos">
                            <div class="row">
                                    <input type="checkbox" class="form-control" data-toggle="toggle" data-on="Individual" data-off="Por Bloque"
                                     data-width="150" data-onstyle="success" data-offstyle="primary" id="opc" name="opc">
                            </div>
                            <br>
                            <div>
                                <div id="bloque" class="row">
                                    <div class="col-md-6">
                                        <label>Tipo</label>
                                        <select name="tipo" id="tipo" class="selectpicker">
                                            <option value="s">Suite</option>
                                            <option value="v">Villa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Capacidad</label>
                                        <select name="capacidad" id="capacidad" class="selectpicker">
                                            <option value="2">2</option>
                                            <option value="4">4</option>
                                            <option value="6">6</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="individual" class="row" hidden>
                                    <div class="col-md-6">
                                        <label>Habitacion</label>
                                        <select name="habitacion" id="habitacion" class="selectpicker" data-live-search="true">
                                            @foreach($habitaciones as $h)
                                                <option value="{{$h->id}}">{{$h->numero}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="de">De</label>
                                    <input type="date" class="form-control" id="de" name="de">
                                </div>
                                <div class="col-md-6">
                                    <label for="a">A</label>
                                    <input type="date" class="form-control" id="a" name="a">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="cpf">Costo</label>
                                    <select name="cpf" id="cpf" class="selectpicker">
                                        <option value="1">Costo 1</option>
                                        <option value="2">Costo 2</option>
                                        <option value="3">Costo 3</option>
                                        <option value="4">Costo 4</option>
                                        <option value="5">Costo 5</option>
                                        <option value="6">Costo 6</option>
                                    </select>
                                </div>
                                <div class="col-md-4 center">
                                  <button class="btn btn-success " id="regCosto">Registrar</button>
                            </div>
                          </div>
                        </form>

                        <br>

                        <table class="table table-responsive-sm  text-center" id="tablacostos">
                            <thead>
                            <tr class="text-center">
                                <th>Habitacion</th>
                                <th>De</th>
                                <th>A</th>
                                <th  >Costo</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="ecancelar">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->


    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{asset('js/admin/Habitaciones.js')}}"></script>
@stop

@extends('layout.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    @include('partials.navbar', ['ventana' => 'Reservar','name'=>'reservar'])

    <div class="container" style="">
        <div class="d-flex justify-content-around " >
            <form id="formReservacion">
                {{csrf_field()}}
                <div style="font-size : 24px;" class="text-center">Llene los datos del Hospedaje  </div>
                <div style="display: flex; padding-bottom: 18px;width : 450px;">
                    <div class="col-md-11">Cliente<span style="color: red;"> *</span><br/>
                        <select name="idCli" id="idCli" class="selectpicker form-control" data-live-search="true">

                        </select>
                    </div>
                    <div class="col-md-2">
                        <br>
                        <button class="btn btn-secondary" id="new"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div style="display: flex; padding-bottom: 18px;width : 450px;">
                    <div style=" margin-left : 1%; margin-right : 0; width : 70%;">Accion a Realizar<span style="color: red;"> *</span><br/>
                        <select name="status" id="status" class="selectpicker">
                            <option value="1">Pre-Reserva</option>
                            <option value="2">Reserva</option>
                            <option value="3">Hospedado</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex; padding-bottom: 18px;width : 450px;">
                    <div style=" margin-left : 0; margin-right : 1%; width : 49%;">Fecha llegada<span style="color: red;"> *</span><br/>
                        <input  type="date" id="llegada" style="width: 100%;" class="form-control"
                                name="txtfechallegada" required="" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" onchange="changeFecha()">
                    </div>
                    <div style=" margin-left : 1%; margin-right : 0; width : 49%;">Fecha salida<span style="color: red;"> *</span><br/>
                        <input type="date" id="salida"  style="width: 100%;" class="form-control"
                               name="txtfechasalida"  required="" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}">
                    </div>
                </div>
                <div style="display: flex; padding-bottom: 18px;width : 450px;">
                    <div style=" margin-left : 0; margin-right : 1%; width : 49%;">Numero adultos<span style="color: red;"> *</span><br/>
                        <input type="number" id="adultos" style="width: 100%;" class="form-control" name="txtcantidadadultos" required value="1"
                               min="1" pattern="^[0-9]+">
                    </div>
                    <div style=" margin-left : 1%; margin-right : 0; width : 49%;">Numero niños<span style="color: red;"> *</span><br/>
                        <input type="number"  style="width: 100%;" class="form-control" name="txtnumeroninos" id="ninos" required value="0"
                               min="0" pattern="^[0-9]+">
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect2">Seleccione la habitacion disponible</label>
                    <select name="cuarto" multiple class="form-control" id="cuarto" data-live-search="true">

                    </select>
                </div>

                <div class="container" style="padding: 1%">
                    <label for="total">Total</label>
                    <input type="text" id="total" name="total" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Tipo de Reservacion</label>
                    <br>
                    <select name="reco" id="reco" class="selectpicker" data-live-search="true">
                        <option value="RD">Directa</option>
                        <option value="RDV">Directa(Venta)</option>
                        <option value="RT">Tripticos y Tarjetas</option>
                        <option value="RR">Recomendación</option>
                        <option value="RC">Coyote</option>
                        <option value="RA">Agencias</option>
                        <option value="RI">Internet</option>
                        <option value="RV">Revistas</option>
                        <option value="RF">Facebook</option>
                        <option value="RRA">Radio</option>
                        <option value="OTAs">OTAs</option>
                    </select>
                </div>

                <div class="row">
                    <label for="txtcomentario">Comentarios</label>
                    <textarea name="txtcomentario" id="txtcomentario" cols="20" class="form-control" rows="5"></textarea>
                </div>
                <br>
                <div style="visibility: hidden"  >Num. Tel<span style="color: red;"> *</span><br/>
                    <input type="text" id="data_4"   class="form-control" name="txtnum" required="" autocomplete="off">
                </div>
                <div style="visibility: hidden" >Correo<span style="color: red;"> *</span><br/>
                    <input type="text" id="data_5"   class="form-control" name="txtcorreo" required="" autocomplete="off"
                        placeholder="Si no cuenta con correo ingresar un guion -">
                </div>
            </form>
        </div>
        <div class=" text-center">
            <input type="submit" class="btn btn-lg btn-success  center-block" name="guardar" id="btnReservacion" >
        </div>
        <br>

    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="form-Cliente">
                            <div class="row col-md-12">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono">
                                </div>
                                <div class="col-md-6">
                                    <label for="correo">Correo</label>
                                    <input type="email" class="form-control" id="correo" name="correo">
                                </div>
                            </div>
                            <div class="row col-md-5">
                                <label for="estado">Estado</label>
                                <input type="text" class="form-control" id="estado" name="estado">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelar">Cancelar</button>
                    <button type="button" class="btn btn-success" id="guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

@stop


@section('script')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="{{asset('/js/admin/reservacion.js')}}"></script>
@stop

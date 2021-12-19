@extends('layout.admin')



@section('content')
    @include('partials.navbar', ['ventana' => 'Reservar','name'=>'reservar'])

    <div class="container" style="">
        <div class="d-flex justify-content-around " >
            <form id="formReservacion">
                {{csrf_field()}}
                <input type="hidden" value="{{$id}}" id="idR">
                <div style="font-size : 24px;" class="text-center">Llene los datos del Hospedaje  </div>
                <div style="display: flex; padding-bottom: 18px;width : 450px;">
                    <div style=" margin-left : 0; margin-right : 1%; width : 100%;">Nombre Completo<span style="color: red;"> *</span><br/>
                        <input type="text" id="data_2"  style="width: 100%;" class="form-control"
                               name="txtnombres" required="" autocomplete="off" value="{{$reserva->nombre}}" readonly>
                    </div>
                </div>
                <div style="padding-bottom: 18px;">Num. Tel<span style="color: red;"> *</span><br/>
                    <input type="text" id="data_4" style="width : 450px;" class="form-control"
                           name="txtnum" required="" autocomplete="off" readonly value="{{$reserva->telefono}}">
                </div>
                <div style="padding-bottom: 18px;">Correo<span style="color: red;"> *</span><br/>
                    <input type="text" id="data_5"  style="width : 450px;" class="form-control" name="txtcorreo" required="" autocomplete="off"
                           placeholder="Si no cuenta con correo ingresar un guion -" value="{{$reserva->correo}}" readonly>
                </div>
                <div style="display: flex; padding-bottom: 18px;width : 450px;">
                    <div style=" margin-left : 0; margin-right : 1%; width : 49%;">Fecha llegada<span style="color: red;"> *</span><br/>
                        <input  type="date" id="llegada" style="width: 100%;" class="form-control"
                                name="txtfechallegada" required="" min="{{date('Y-m-d')}}" value="{{$reserva->fechallegada}}" onchange="changeFecha()">
                    </div>
                    <div style=" margin-left : 1%; margin-right : 0; width : 49%;">Fecha salida<span style="color: red;"> *</span><br/>
                        <input type="date" id="salida"  style="width: 100%;" class="form-control"
                               name="txtfechasalida"  required="" min="{{date('Y-m-d')}}" value="{{$reserva->fechasalida}}">
                    </div>
                </div>
                <div style="display: flex; padding-bottom: 18px;width : 450px;">
                    <div style=" margin-left : 0; margin-right : 1%; width : 49%;">Numero adultos<span style="color: red;"> *</span><br/>
                        <input type="number" id="adultos" style="width: 100%;" class="form-control" name="txtcantidadadultos"
                               required value="{{$reserva->adultos}}" min="1" pattern="^[0-9]+">
                    </div>
                    <div style=" margin-left : 1%; margin-right : 0; width : 49%;">Numero niños<span style="color: red;"> *</span><br/>
                        <input type="number"  style="width: 100%;" class="form-control" name="txtnumeroninos" id="ninos" required value="{{$reserva->ninos}}"
                               min="0" pattern="^[0-9]+">
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect2">Seleccione la habitacion disponible</label>
                    <select name="cuarto" multiple class="form-control" id="cuarto">

                    </select>
                </div>

                <div class="container" style="padding: 1%">
                    <label for="total">Total</label>
                    <input type="text" id="total" name="total" class="form-control" readonly>
                </div>
                <div class="container" style="padding: 1%">
                    <label for="total">Total sugerido</label>
                    <input type="text" id="totalS" name="totalS" class="form-control" >
                </div>

                <br>

            </form>
        </div>

        <div class=" text-center">
            <input type="submit" class="btn btn-lg btn-success  center-block" name="guardar" id="btnReservacion" >
        </div>
        <br>

    </div>

@stop


@section('script')
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="{{asset('/js/admin/reservacionRapida.js')}}"></script>
@stop

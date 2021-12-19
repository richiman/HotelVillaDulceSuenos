@extends('layout.admin')

@section('content')
    @include('partials.navbar', ['ventana' => "Informacion de la Habitacion",'name'=>'roominfo'])


    <div class="d-flex justify-content-around ">
        <form id="formRegistrar">
            {{csrf_field()}}
            <input type="hidden" value="{{$hospedaje->id}}" id="cuarto">
            <div style="padding-bottom: 18px;font-size : 24px;" class="text-center"><h1>Habitacion: {{$cliente->numero}}</h1>

            </div>
            <div style="padding-bottom: 18px;font-size : 24px;" class="text-center"><h4>Porcentaje de ocupacion:</h4>

            </div>
            <div style="display: flex; padding-bottom: 18px;width : 450px;">
                <div style=" margin-left : 0; margin-right : 1%; width : 100%;">Nombre Hueped: <span
                        style="color: red;"> *</span><br/>

                    <input type="text" id="data_2" style="width: 100%;" class="form-control" name="txtnombres" required=""
                           value="{{$hospedaje->nombre}}" readonly>
                </div>
            </div>
            <div style="display: flex; padding-bottom: 18px;width : 450px;">
                <div style=" margin-left : 0; margin-right : 1%; width : 100%;">Vehiculo: <span
                        style="color: red;"> *</span><br/>
                    <input type="text"  style="width: 100%;" class="form-control"  required=""
                           value="{{$hospedaje->vehiculo}}" readonly>
                </div>
            </div>
            <div style="padding-bottom: 18px;">Num. Tel<span style="color: red;"> *</span><br/>
                <input type="text" id="data_4" style="width : 450px;" class="form-control" name="txtnum"
                       value="{{$hospedaje->telefono}}" required="" readonly>
            </div>

            <div style="display: flex; padding-bottom: 18px;width : 450px;">
                <div style=" margin-left : 0; margin-right : 1%; width : 49%;">Fecha llegada<span
                        style="color: red;"> *</span><br/>
                    <input type="date" id="data_2" style="width: 100%;" class="form-control" name="txtfechallegada"
                           required="" value="{{$hospedaje->fechallegada}}" readonly>
                </div>
                <div style=" margin-left : 1%; margin-right : 0; width : 49%;">Fecha salida<span
                        style="color: red;"> *</span><br/>
                    <input type="date" id="data_3" style="width: 100%;" class="form-control" name="txtfechasalida"
                           required="" value="{{$hospedaje->fechasalida}}" min="{{date('Y-m-d')}}">
                </div>
            </div>
        </form>

    </div>

    <div class=" text-center">
        <input type="submit" class="btn btn-lg btn-success  center-block" name="registrar" value="Registrar" id="registrar">
    </div>

    <br>
@stop

@section('script')
    <script src="{{asset('js/admin/roomInfo.js')}}"></script>
@stop

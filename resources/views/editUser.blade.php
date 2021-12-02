@extends('layout.admin')


@section('content')
    <br>

    <div class="container d-flex  justify-content-center" >
        <form id="form1">
            {{csrf_field()}}
            <input type="hidden" id="id" value="{{$empleado->id}}">
            <div style="padding-bottom: 18px;font-size : 24px;" class="text-center">Edite los datos del Usuario</div>
            <div style="display: flex; padding-bottom: 18px;width : 450px;">
                <div style=" margin-left : 0; margin-right : 1%; width : 25%;">Identificador<span style="color: red;"> *</span><br/>

                    <input type="text" id="data_2"  style="width: 100%;" class="form-control" name="txtid" required="" value="{{$empleado->id}}" readonly="">
                </div>
                <div style=" margin-left : 0; margin-right : 1%; width : 75%;">Nombre<span style="color: red;"> *</span><br/>

                    <input type="text" id="data_2"  style="width: 100%;" class="form-control" name="txtnombres" required="" value="{{$empleado->nombre}}">
                </div>

            </div>
            <div style="padding-bottom: 18px;">User<span style="color: red;"> *</span><br/>
                <input type="text" id="data_4" style="width : 450px;" class="form-control" name="txtusuario" required=""value="{{$empleado->user}}" >
            </div>
            <div style="padding-bottom: 18px;">Clave<span style="color: red;"> *</span><br/>
                <input type="text" id="data_5"  style="width : 450px;" class="form-control" name="txtcontra" required="" value="{{$empleado->password}}" >
            </div>

            <div style=" margin-left : 0; margin-right : 1%; width : 49%;">Correo<span style="color: red; " > </span>
                <input type="text" id="data_5"  style="width : 450px;" class="form-control" name="txtcorreo" required="" value="{{$empleado->correo}}" >

            </div>


            <br>
            <div >Telefono<span style="color: red;"> *</span><br/>
                <input type="text" id="data_3"  style="width: 100%;" class="form-control" name="txttelefono" required="" value="{{$empleado->telefono}}">

            </div>
            <br>
            <div class="form-group">
                <label>Tipo</label>
                <select name="txttipo" class="form-control"  required>
                    <option value="">SELECCIONE ROL</option>
                    @if ($empleado->tipo == 1)
                        <option value="1" selected>ADMIN</option>
                        @else
                        <option value="1">ADMIN</option>
                    @endif

                    @if ($empleado->tipo == 2)
                        <option value="2" selected>RECEPCION</option>
                    @else
                        <option value="2">RECEPCION</option>
                    @endif

                    @if ($empleado->tipo == 3)
                        <option value="3" selected>TRABAJADOR</option>
                    @else
                        <option value="3">TRABAJADOR</option>
                    @endif

                </select>

            </div>

        </form>
        <br>

    </div>
    <div class=" text-center">
        <input type="submit" class="btn btn-lg btn-success  center-block" id="registrar" value="Editar" >

    </div>
@stop



@section('script')
    <script src="{{asset('/js/admin/usuarios.js')}}"></script>
@stop




@extends('layout.admin')
@section('content')

<br>
    <div class="container ">
      <div class="row">
        <div class="col-sm"></div>
        <div class="colalign-self-center">
        <form id="form1">
            {{csrf_field()}}
            <input type="hidden" id="id" value="{{$cliente->id}}">
            <div style="padding-bottom: 18px;font-size : 24px;" class="text-center">Edite los datos del cliente</div>
             <div class="form-group">
               <label for="exampleInputEmail1">ID:</label>
               <input type="text" id="data_2"   class="form-control  col-md" name="txtid" required="" value="{{$cliente->id}}" readonly="">
               <small id="emailHelp" class="form-text text-muted">Identificador unico de cliente.</small>
             </div>
             <div class="form-group">
             <label for="exampleInputEmail1">Nombre:</label>
             <input type="text" id="data_1"   class="form-control col-md" name="txtnombre"   required="" value="{{$cliente->nombre}}">
             <small id="emailHelp" class="form-text text-muted">Nombre completo con apellidos.</small>
             </div>

             <div class="form-group">
             <label >Numero :</label>
             <input type="text" id="data_3" class="form-control col-md" name="txttelefono" required="" value="{{$cliente->telefono}}">
             <small id="emailHelp" class="form-text text-muted">Numero para contacto en caso de necesitarlo.</small>
             </div>

             <div class="form-group">
             <label >Correo :</label>
             <input type="text" id="data_2" class="form-control col-md" name="txtcorreo"   required="" value="{{$cliente->correo}}">
             <small id="emailHelp" class="form-text text-muted">Correo electronico para contacto en caso de necesitarlo.</small>
             </div>

             <div class="form-group">
             <label >Estado :</label>
             <input type="text" id="data_4" class="form-control col-md" name="txtestado"   required="" value="{{$cliente->estado}}">
             <small id="emailHelp" class="form-text text-muted">Datos de aportacion a la base de datos para promocion.</small>
             </div>

             <div class="form-group">
             <label >Vehiculo :</label>
             <input type="text" id="data_5" class="form-control col-md" name="txtvehiculo"   required="" value="{{$cliente->vehiculo}}">
             <small id="emailHelp" class="form-text text-muted">Datos del vehiculo del cliente.</small>
             </div>

                <div class=" text-center">
                    <input type="submit" class="btn btn-lg btn-success  center-block" id="registrar" value="Editar" >
                </div>
        </form>
        <br>
        </div>
        <div class="col-sm"></div>
    </div>
  </div>

@stop
@section('script')
    <script src="{{asset('/js/admin/clientes.js')}}"></script>
@stop

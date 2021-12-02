@extends('layout.admin')

@section('content')
    @include('partials.navbar', ['ventana' => 'Usuarios','name'=>'usuarios'])
    <br>
    <div class="container col-md-12">
        <div class="table-wrapper">
            <div class="table-title">
                <div>
                    <div align="right">
                        <btn id="btnModal" class="btn btn-success" >
                            <i class="fa fa-plus"></i>
                            Añadir usuario
                        </btn>
                    </div>
                </div>
            </div>
            <br>
            <table class="table table-striped table-hover">
                <thead>
                <tr>

                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Tipo de usuario</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $contador = 1;
                foreach ($empleados as $row){ // aca puedes hacer la consulta e iterarla con each.





                ?>
                <tr>

                    <td>{{$row->nombre}}</td>
                    <td>{{$row->user}}</td>
                    <td>{{$row->password}}</td>
                    <td>{{$row->correo}}</td>
                    <td>{{$row->telefono}}</td>
                    <td>{{$row->tipo}}</td>
                    <td>
                        <form method="POST" action="editUser.php">
                            <input type="hidden" name="ide" value="<?php echo $row->id; ?>">
                            <input type="hidden" name="nombres" value="<?php echo $row->NombreE; ?>">
                            <input type="hidden" name="apellidos" value="<?php echo $row->ApellidoE; ?>">
                            <input type="hidden" name="usuario" value="<?php echo $row->usuario; ?>">
                            <input type="hidden" name="Contra" value="<?php echo $row->Contra; ?>">
                            <input type="hidden" name="email" value="<?php echo $row->Correo; ?>">
                            <input type="hidden" name="Telefono" value="<?php echo $row->Telefono; ?>">
                            <input type="hidden" name="Privilegios" value="<?php echo $row->Privilegios; ?>">
                        </form>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" onclick="edit({{$row->id}})">Editar</button></td>
                    <td><a class="btn btn-danger text-white btn-sm" onclick="deleteusr({{$row->id}})" style="text-decoration:none">Borrar</a></td>
                </tr>


                <?php $contador = $contador + 1;  } ?>
                </tbody>
            </table>

        </div>
    </div>
    <!-- Edit Modal HTML -->
    <style type="text/css">
        .modal-backdrop.show{
            opacity: 0.5;
        }

        .modal-backdrop{
            background-color: rgba(0,0,0,.0001) !important;
        }

    </style>

    <div>
        <div id="myModal" class="modal" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Añadir empleado</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="formAdd">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="txtnombre" required>
                            </div>
                            <div class="form-group">
                                <label>User</label>
                                <input type="text" class="form-control" name="txtusuario" required>
                            </div>
                            <div class="form-group">
                                <label>Clave</label>
                                <input type="passord" class="form-control" name="txtclave" required>
                            </div>
                            <div class="form-group">
                                <label>Correo</label>
                                <input type="email" class="form-control" name="txtcorreo" required>
                            </div>
                            <div class="form-group">
                                <label>Telefono</label>
                                <input class="form-control" name="txttelefono" required></input>
                            </div>
                            <div class="form-group">
                                <label>Tipo</label>
                                <select name="txttipo" class="form-control" required>
                                    <option value="">SELECCIONE ROL</option>
                                    <option value="1">ADMIN</option>
                                    <option value="2">RECEPCION</option>
                                    <option value="3">TRABAJADOR</option>
                                </select>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" id="guardar" name="guardar">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{asset('/js/admin/usuarios.js')}}"></script>
@endsection

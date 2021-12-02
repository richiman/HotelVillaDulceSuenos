@extends('layout.admin')

@section('content')

    <style> .square {
            float: left;
            position: relative;
            width: 10%;

            /* = width for a 1:1 aspect ratio */
            margin: 1%;
            overflow: hidden;
        }

    </style>
    @include('partials.navbar', ['ventana' => "Estado del Hotel",'name'=>'status'])
    <br>

    <div class="container">
        <div class="row  text-center">
            <div class="col-md-12" id="contenido">
                <div align="center">
                    <form id="ffecha">
                        <input type="date" class="form-control" name="fecha" id="fecha" style="width: 20%" value="{{$f}}">
                    </form>
                </div>
                <div style="margin-top: 50px; font-size: 32px;">
                    Porcentaje ocupado:
                    <?php
                    if(number_format($porcentajeOcupado,2) >= 0 && number_format($porcentajeOcupado,2) < 40) {
                        echo "<span style='color: white; padding: 5px 8px; border-radius: 5px;' class='bg-danger'>" . number_format($porcentajeOcupado,2) . "</span>";
                    } elseif(number_format($porcentajeOcupado,2) >= 40 && number_format($porcentajeOcupado,2) < 80) {
                        echo "<span style='color: white; padding: 5px 8px; border-radius: 5px;' class='bg-warning'>" . number_format($porcentajeOcupado,2) . "</span>";
                    }elseif(number_format($porcentajeOcupado,2) >= 80) {
                        echo "<span style='color: white; padding: 5px 8px; border-radius: 5px;' class='bg-success'>" . number_format($porcentajeOcupado,2) . "</span>";
                    }
                    ?> %
                </div>
                <br>
                <?php  foreach ($habitaciones as $row){ // aca puedes hacer la consulta e iterarla con each. 	?>
                <?php switch($row['Estado']):
                case 1: ?>
                <div onclick="" style="cursor: pointer;" alt="Ver reservasiones"
                     class="square bg-success text-white  rounded ">
                    <div>
                        <small>Habitación: </small><br />

                        <small>Disponible </small>
                    </div>
                    <div class="text-center  ">
                        <h3>{{$row['numero']}}</h3>


                    </div>
                </div>
                <?php break; ?>
                <?php case 2: ?>
                <div onclick="location.href='/roominfo?&cod=<?php echo $row['numero']; ?>'"
                     style="cursor: pointer;" class="square bg-danger text-white rounded">
                    <div>
                        <small>Habitación: </small><br />

                        <small>Ocupada </small>
                    </div>
                    <div class="text-center text-white rounded">
                        <h3>  <?php echo $row['numero'] ?></h3>
                    </div>
                </div>
                <?php break; ?>
                <?php case 3: ?>
                <div onclick="location.href='/roominfo?&cod=<?php echo $row['numero']; ?>'"
                     style="cursor: pointer;" class="square text-white bg-warning rounded">
                    <div>
                        <small>Habitación: </small><br />

                        <small>Salida </small>
                    </div>
                    <div class="text-center ">
                        <h3><?php echo $row['numero'] ?></h3>
                    </div>
                </div>
                <?php break; ?>
                <?php endswitch; ?> <?php } ?>
            </div>

        </div>
    </div>
    <div align="center">
        <button class="btn btn-success" onclick="imprimir()">Imprimir</button>
    </div>
@stop

@section("script")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://unpkg.com/jspdf@1.5.3/dist/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.2.4/dist/jspdf.plugin.autotable.js"></script>
    <script src="{{asset('/js/admin/status.js')}}"></script>
@endsection

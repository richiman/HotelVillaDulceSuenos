@extends('layout.admin')

@section('content')
    @include('partials.navbar', ['ventana' => "Servicio de Limpieza",'name'=>'limpieza'])
    <!--- navbar --->
    <br>
    <!--contenido del menu Inicia---->
    <div class="container text-center">

        <div id="tbl">
            <table class="table table table-fit table-bordered" id="tabla">
                <thead class="thead-light">
                <tr>
                    <th scope="col">{{date('Y-m-d')}}</th>
                    <th scope="col" rowspan="2">Tipo</th>
                    <th scope="col" rowspan="2">Status</th>
                    <th scope="col" rowspan="2">Folio</th>
                    <th scope="col" colspan="2">Limpieza</th>
                    <th scope="col" rowspan="2">Salida</th>
                    <th scope="col" rowspan="2">Entrada</th>
                    <th scope="col" rowspan="2">Encargada</th>
                    <th scope="col" rowspan="2">Nota</th>

                </tr>
                <tr>
                    <th scope="col">Habitacion</th>
                    <th>Si</th>
                    <th>No</th>
                </tr>
                </thead>
                <?php  foreach ($habitaciones as $key => $row){?>
                <tbody>
                <tr>
                    <td  scope="row">{{$key}}</td>
                    <td>{{$row["habitacionTipo"]}}</td>

                    <td>
                        @php
                        if(isset($row["salida"]["status"]) && $row["salida"]["status"] == 3 && $diaHoy == $row["salida"]["fechasalida"] ) {
                            echo "Salida";
                        } elseif(isset($row["salida"]["status"]) && $row["salida"]["status"] == 3 && $diaHoy != $row["salida"]["fechasalida"]) {
                            echo "Ocupada";
                        } else {
                            echo $row["salida"]["status"];
                        }
                        @endphp
                    </td>
                    <td>{{$row["salida"]["folio"]}}</td>
                    <td contenteditable="true" style="text-transform: uppercase; font-weight: bold;" onkeyup="cambio()"></td>
                    <td contenteditable="true" style="text-transform: uppercase; font-weight: bold;" onkeyup="cambio()"></td>
                    <td contenteditable="true" style="text-transform: uppercase; font-weight: bold;" onkeyup="cambio()">{{$diaHoy == $row["salida"]["fechasalida"] ? $row["salida"]["folio"] : ''}}</td>
                    <td contenteditable="true" style="text-transform: uppercase; font-weight: bold;" onkeyup="cambio()">{{$row["llegada"]["folio"]}}</td>
                    <td style="width: 20%; font-weight: bold;" contenteditable="true" onkeyup="cambio()">
                    <td style="width: 20%; font-weight: bold;" contenteditable="true" onkeyup="cambio()">

                    </td>
                </tr>
                <?php  } ?>
                </tbody>
            </table>
        </div>
        <button id="export" class="btn btn-success">Generar PDF</button>
    </div>

@stop


@section('script')
    <script src="https://rawcdn.githack.com/FuriosoJack/TableHTMLExport/v2.0.0/src/tableHTMLExport.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>

    <script>




        $("#export").on('click',function () {
            var sTable = document.getElementById('tbl').innerHTML;

            var style = "<style>";
            style = style + "label {font-weight: bold; font-size: 25px; text-align: center;}";
            style = style + "table {width: 100%;font: 17px Calibri;}";
            style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
            style = style + "padding: 2px 3px;text-align: center;}";
            style = style + "</style>";

            // CREATE A WINDOW OBJECT.
            var win = window.open('', '', 'height=700,width=700');

            win.document.write('<html><head>');
            win.document.write('<title></title>');   // <title> FOR PDF HEADER.
            win.document.write('<label>Limpieza</label>');   // <title> FOR PDF HEADER.
            win.document.write('<br>');   // <title> FOR PDF HEADER.
            win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
            win.document.write('</head>');
            win.document.write('<body>');
            win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
            win.document.write('</body></html>');

            win.document.close(); 	// CLOSE THE CURRENT WINDOW.

            win.print();    // PRINT THE CONTENTS.

        });



    </script>
@stop

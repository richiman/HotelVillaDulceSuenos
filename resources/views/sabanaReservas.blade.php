@extends('layout.admin')
@section('styles')
    <style>
        @media print {
            @page {
                size: landscape
            }
        }

        table,
        td,
        th {
            border: 1px solid black;

        }
    </style>
@endsection
@section('content')
    @include('partials.navbar', ['ventana' => 'Sabana de Reservas','name'=>'SabanaReservas'])

    @php
        switch ($mes) {
        case '01':
        $mesname = "Enero";
        break;
        case '02':
        $mesname = "Febrero";
        break;
        case '03':
        $mesname = "Marzo";
        break;
        case '04':
        $mesname = "Abril";
        break;
        case '05':
        $mesname = "Mayo";
        break;
        case '06':
        $mesname = "Junio";
        break;
        case '07':
        $mesname = "Julio";
        break;
        case '08':
        $mesname = "Agosto";
        break;
        case '09':
        $mesname = "Septiembre";
        break;
        case '10':
        $mesname = "Octubre";
        break;
        case '11':
        $mesname = "Noviembre";
        break;
        case '12':
        $mesname = "Diciembre";
        break;
        }

    @endphp
    <br>
    <script>
    window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}
    </script>
    <div class="row d-flex justify-content-around">
        <form action="{{action('WebController@previusMonth')}}" method="GET">
            <button type="submit" class="btn btn-primary">&larr;Anterior</button>
        </form>
        <h3 align="center"><a href="#">{{$mesname}}</a></h3>
        <form action="{{action('WebController@nextMonth')}}" method="GET">
            <button class="btn btn-primary">Siguiente&rarr;</button>
        </form>
    </div>
    <br>

    <style>
        .wrap-dias-mes {
            width: 100%;
            height: auto;
            overflow: auto;

            display: table;
        }

        .habitacion-mes {
            width: 100px;
            float: left;
            text-align: center;

        }

        .habitacion-mes small {
            display: grid;
            cursor: pointer;
            align-items: center;
            /*height: 98%;
            width: 99.5%;*/
            height: 100%;
            width: 100%;
        }

        .dias-mes {
            width: 140px;
            height: 80px;
            overflow: auto;
            float: left;
            text-align: center;
            display: grid;
            align-items: center;
        }

        .dias-mes small {
            display: grid;
        }

        .reservam:hover {
            opacity: 0.7;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $(document).ready(() => {
            function formatFecha(fecha) {
                let fuch = new Date(fecha + "T12:00:00");
                var day = fuch.getDate();

                var monthIndex = fuch.getMonth();
                var months = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
                var year = fuch.getFullYear();
                return day + ' ' + months[monthIndex] + ' ' + year;
            }

            mesActual = $("#mes").val();
            anoMesActual = $("#ano").val() + $("#mes").val();
            diasDelMes = $("#dias_del_mes").val();
            $('#lista-reservaciones>div').each(function () {
                let elemento = $(this);
                let dataTipo = $(this).attr("data-tipo");

                let color = $(this).attr("data-color");

                let prev = $(this).prev();
                let next = $(this).next();

                let folio = $(this).attr("data-folio");

                let dias = $(this).attr("data-dias");
                let diaInicio = $(this).attr("data-inicio-dia");
                let diaFin = $(this).attr("data-fin-dia");

                let mesInicio = $(this).attr("data-mes-inicio");
                let mesFin = $(this).attr("data-mes-salida");

                let anoInicio = $(this).attr("data-ano-inicio");
                let anoFin = $(this).attr("data-ano-salida");

                let anoMesInicio = anoInicio + mesInicio;
                let anoMesSalida = anoFin + mesFin;

                $(elemento).click(() => {
                    if (elemento.attr("data-folio")) {
                        $("#modal-datos-reserva").modal("show");
                        cliente_nombre = $(this).data('cliente-nombre');
                        cliente_correo = $(this).data('cliente-correo');
                        cliente_telefono = $(this).data('cliente-telefono');

                        reservacion_folio = $(this).data('reservacion-folio');
                        reservacion_fecha_llegada = formatFecha($(this).data('reservacion-fecha-llegada'));
                        reservacion_fecha_salida = formatFecha($(this).data('reservacion-fecha-salida'));
                        reservacion_adultos = $(this).data('reservacion-adultos');
                        reservacion_ninos = $(this).data('reservacion-ninos');
                        reservacion_id = $(this).data('reservacion-ninos');

                        $("#cliente-nombre").text(cliente_nombre);
                        $("#cliente-correo").text(cliente_correo);
                        $("#cliente-telefono").text(cliente_telefono);

                        $("#reservacion-folio").text(reservacion_folio);
                        $("#reservacion-fecha-llegada").text(reservacion_fecha_llegada);
                        $("#reservacion-fecha-salida").text(reservacion_fecha_salida);
                        $("#reservacion-adultos").text(reservacion_adultos);
                        $("#reservacion-ninos").text(reservacion_ninos);
                    }
                });


                if (dataTipo == "reservacion") {
                    if (anoMesActual == anoMesInicio && diaInicio == diasDelMes && anoMesSalida == anoMesActual) {
                        elemento.css({
                            "width": `70px`,
                            "margin-right": 0,
                            "margin-left": 0
                        });

                    } else if (anoMesInicio < anoMesActual && anoMesSalida > anoMesActual) {

                        for (let i = 1; i < parseInt(diasDelMes); i++) {
                            $(this).next().remove();
                        }

                        elemento.css({
                            "width": `calc(140px * ${parseInt(diasDelMes)})`,
                            "margin-right": 0,
                            "margin-left": 0
                        });
                    } else if (anoMesInicio == anoMesActual && anoMesSalida > anoMesActual) {
                        if ($(this).prev().attr('data-tipo') == "libre" || (parseInt($(this).prev().attr('data-fin-dia')) == parseInt($(this).attr('data-inicio-dia')) - 1)) {
                            elemento.css({
                                "margin-left": `70px`,
                            });
                        }
                        for (let i = diaInicio; i < (parseInt(diasDelMes)); i++) {
                            $(this).next().remove();
                        }

                        elemento.css({
                            "width": `calc(140px * ${parseInt(diasDelMes) - parseInt(diaInicio)} + 70px)`,
                        });

                    } else if (anoMesInicio < anoMesActual && anoMesSalida == anoMesActual) {
                        console.log("POS SIMONA");
                        console.log(folio);
                        for (let i = 0; i < parseInt(diaFin) - 1; i++) {
                            if($(this).next().attr('data-tipo') == "libre") {
                                $(this).next().remove();
                            }
                        }

                        if ($(this).prev().attr('data-tipo') == "reservacion" && parseInt($(this).attr('data-inicio-dia')) == parseInt($(this).prev().attr('data-fin-dia')) + 1) {
                            elemento.css({
                                "margin-left": "70px",
                            });
                        }

                        if ($(this).next().attr("data-tipo") == "libre") {
                            elemento.css({
                                "margin-right": `70px`,
                            });
                        }

                        if ($(this).next().attr("data-tipo") == "reservacion" && (parseInt($(this).attr('data-fin-dia')) + 1) == parseInt($(this).next().attr('data-inicio-dia'))) {
                            elemento.css({
                                "margin-right": `70px`,
                            });
                        }

                        elemento.css({
                            "width": `calc(140px * ${parseInt(diaFin)} - 70px)`,
                        });

                    } else {
                        for (let i = 0; i < (parseInt(dias)); i++) {
                            if ($(this).next().attr('data-tipo') == "libre") {
                                $(this).next().remove();
                            }
                        }

                        elemento.css({
                            "width": `calc(140px * ${parseInt(dias) == 0 ? 1 : parseInt(dias)})`,
                            "margin-right": `${parseInt(dias) == 0 ? 0 : "70px"}`,
                            "margin-left": `${parseInt(dias) == 0 ? 0 : "70px"}`
                        });

                        if ($(this).prev().attr("data-tipo") == "reservacion" && $(this).attr('data-inicio-dia') == $(this).prev().attr('data-fin-dia')) {
                            elemento.css({
                                "margin-left": 0
                            });
                        }

                        if ($(this).next().attr("data-tipo") == "reservacion" && $(this).attr('data-fin-dia') == $(this).next().attr('data-inicio-dia')) {
                            elemento.css({
                                "margin-right": 0
                            });
                        }

                        if ($(this).next().attr('data-tipo') == "reservacion" && parseInt($(this).attr('data-fin-dia')) == parseInt($(this).next().attr('data-inicio-dia')) + 1) {
                            elemento.css({
                                "margin-right": "70px",
                            });
                        }
                    }

                    elemento.children('small').css({
                        "background-color": color
                    });
                }

            });
        });
    </script>

    <div class="container" style="
    min-width: calc(100% - 15px);
    max-width: calc(100% - 15px);
    margin-right: 15px;
    overflow-x: auto;">
        <div
            style="overflow-x: auto; width: calc({{$diasdelmes}} * 140px + 100px); background-color: #555199; color: white; display: flex;">
            <div style="align-self: center;" class="habitacion-mes">Habitación</div>
            <?php $dias_ES = array("Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"); ?>
            <?php $dias_EN = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"); ?>

            @for($dia=1; $dia<=$diasdelmes; $dia++)
                @if(date('D',strtotime($year.'-'.$mes.'-'.$dia)) == "Sat" ||
                    date('D',strtotime($year.'-'.$mes.'-'.$dia)) == "Fri" ||
                    date('D',strtotime($year.'-'.$mes.'-'.$dia)) == "Thu")
                    <div style="color: #ff4258;" class="dias-mes">{{$dia}}
                        <small>{{$dia_ES = str_replace($dias_EN, $dias_ES, date('D', strtotime($year.'-'.$mes.'-'.$dia)))}}</small>
                    </div>
                @else
                    <div class="dias-mes">{{$dia}}
                        <small>{{$dia_ES = str_replace($dias_EN, $dias_ES, date('D', strtotime($year.'-'.$mes.'-'.$dia)))}}</small>
                    </div>
                @endif
            @endfor
        </div>

        <input type="hidden" id="dias_del_mes" value="{{$diasdelmes}}"/>
        <input type="hidden" id="mes" value="{{$mes}}"/>
        <input type="hidden" id="ano" value="{{$ano}}"/>

        @foreach($sabana as $key0 => $val)
            <div
                style="width: calc({{$diasdelmes}} * 140px + 100px); background-color: #bcb9ff; color: white; display: flex;"
                class="habitacion-mes">
                <div style="align-self: center;" class="habitacion-mes">
                    {{$key0}}
                </div>

                <div id="lista-reservaciones">

                    @foreach($val as $key => $val2)
                        @if(count($val2) < 1)
                            <div style="cursor: inherit;" data-toggle="tooltip"
                                 data-placement="top"
                                 title="Habitación: {{$key0}}" data-tipo="libre" class="dias-mes">
                                @if(date('D',strtotime($key)) == "Sat" ||
                                date('D',strtotime($key)) == "Fri" ||
                                date('D',strtotime($key)) == "Thu")
                                    <div style="border-radius: 25px; background-color: #ff4259; width: 25px; margin: auto; color: white;">
                                        {{date('j', strtotime($key))}}
                                    </div>
                                @else
                                    <div>
                                        {{date('j', strtotime($key))}}
                                    </div>
                                @endif
                            </div>
                        @else
                            @foreach($val2 as $reservacion)


                                <div
                                    data-tipo="reservacion"
                                    data-folio="{{$reservacion->folio}}"

                                    data-dias="{{$reservacion->dias}}"
                                    data-inicio-dia="{{$reservacion->dia}}"
                                    data-fin-dia="{{$reservacion->dia_fin}}"
                                    data-color="{{$reservacion->color}}"
                                    data-cliente-nombre="{{$reservacion->nombre}}"
                                    data-cliente-correo="{{$reservacion->correo}}"
                                    data-cliente-telefono="{{$reservacion->telefono}}"
                                    data-reservacion-adultos="{{$reservacion->adultos}}"
                                    data-reservacion-folio="{{$reservacion->folio}}"
                                    data-reservacion-ninos="{{$reservacion->ninos}}"
                                    data-reservacion-fecha-llegada="{{$reservacion->fechallegada}}"
                                    data-reservacion-fecha-salida="{{$reservacion->fechasalida}}"
                                    data-mes-salida="{{$reservacion->mes_salida}}"
                                    data-mes-inicio="{{$reservacion->mes_inicio}}"
                                    data-ano-inicio="{{$reservacion->ano_inicio}}"
                                    data-ano-salida="{{$reservacion->ano_salida}}"
                                    data-tipo="reservacion"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-html="true"
                                    title="Folio:{{$reservacion->folio}} Habitación:{{$key0}} Estado:{{$reservacion->confirmado}}"
                                    class="dias-mes reservam">
                                    <small>
                                        <b>{{$reservacion->folio}}</b>
                                    </small>
                                </div>

                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div id="modal-datos-reserva" class="modal  fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Información de reservación folio: <span id="datos-folio"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 style="text-align: center;">Información del cliente</h5>
                        </div>
                        <div class="col-sm-6">
                            <label>Nombre</label>
                            <div id="cliente-nombre"></div>
                        </div>
                        <div class="col-sm-6">
                            <label>Correo</label>
                            <div id="cliente-correo"></div>
                        </div>
                        <div class="col-sm-6">
                            <label>Teléfono</label>
                            <div id="cliente-telefono"></div>
                        </div>
                        <div class="col-sm-12">
                            <h5 style="text-align: center;">Información de la reserva</h5>
                            <h5 style="text-align: center;">Tipo:</h5>
                        </div>
                        <div class="col-sm-12">
                            <label>Folio</label>
                            <div id="reservacion-folio"></div>
                        </div>
                        <div class="col-sm-6">
                            <label>Fecha de llegada</label>
                            <div id="reservacion-fecha-llegada"></div>
                        </div>
                        <div class="col-sm-6">
                            <label>Fecha de salida</label>
                            <div id="reservacion-fecha-salida"></div>
                        </div>
                        <div class="col-sm-6">
                            <label>Adultos</label>
                            <div id="reservacion-adultos"></div>
                        </div>
                        <div class="col-sm-6">
                            <label>Niños</label>
                            <div id="reservacion-ninos"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section("script")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://unpkg.com/jspdf@1.5.3/dist/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.2.4/dist/jspdf.plugin.autotable.js"></script>
    <script type="text/javascript" src="{{asset('/js/jquery.thead-1.1.js')}}"></script>
    <script>
        $(function () {
            $('table').thead();
        });

        function imprimir() {
            html2canvas($("#contenido"), {
                onrendered: function (canvas) {
                    var img = canvas.toDataURL("image/png");
                    console.log(img);

                }

            });
        }
    </script>
@stop

<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Empleado;
use App\Habitacion;
use App\Hospedaje;
use App\Hospedajem;
use App\Mail\Email as ReservaEmail;
use App\Precio_Fecha;
use App\Prereserva;
use App\Reserva;
use App\Reservam;
use App\Visita;
use Illuminate\Http\Request;
//use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Cookie\CookieJar;
use Yajra\DataTables\DataTables;

class WebController extends Controller
{

    //------------------------PAGES
    //no modificar
    function login(Request $request)
    {
        $cookie = $request->cookie('hvdsSession');
        if ($cookie == null) {
            return view('home');
        }
        return redirect(route('menu'));
    }

    //listo
    function getmenu(Request $request, CookieJar $cookieJar)
    {
        $cookieJar->queue(cookie('f', null, 180));
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Empleado::findOrFail($id);
        $tipos = [];
        $visitas = Visita::all();
        $counter = 0;
        foreach ($visitas as $visita) {
            $counter = $counter + $visita->count;
        }
        $c = 0;
        $directa = Reserva::where('tipo', '=', 'RD')->count();
        $c = $directa;
        $tyt = Reserva::where('tipo', '=', 'RT')->count();
        $c = ($c >= $tyt) ? $c : $tyt;
        $rec = Reserva::where('tipo', '=', 'RR')->count();
        $c = ($c >= $rec) ? $c : $rec;
        $coyote = Reserva::where('tipo', '=', 'RC')->count();
        $c = ($c >= $coyote) ? $c : $coyote;
        $age = Reserva::where('tipo', '=', 'RA')->count();
        $c = ($c >= $age) ? $c : $age;
        $int = Reserva::where('tipo', '=', 'RI')->count();
        $c = ($c >= $int) ? $c : $int;
        $rev = Reserva::where('tipo', '=', 'RV')->count();
        $c = ($c >= $rev) ? $c : $rev;
        $fa = Reserva::where('tipo', '=', 'RF')->count();
        $c = ($c >= $fa) ? $c : $fa;
        $rad = Reserva::where('tipo', '=', 'RRA')->count();
        $c = ($c >= $rad) ? $c : $rad;
        $otas = Reserva::where('tipo', '=', 'OTAs')->count();
        $c = ($c >= $otas) ? $c : $otas;


        $x = ($directa == 0) ? 0 : ($directa / $c) * 100;
        array_push($tipos, ['name' => "Directa", "value" => $directa, 'porcentaje' => $x]);

        $x = ($tyt == 0) ? 0 : ($tyt / $c) * 100;
        array_push($tipos, ['name' => "Tripticos Y Tarjetas", "value" => $tyt, 'porcentaje' => $x]);

        $x = ($rec == 0) ? 0 : ($rec / $c) * 100;
        array_push($tipos, ['name' => "Recomendacion", "value" => $rec, 'porcentaje' => $x]);

        $x = ($coyote == 0) ? 0 : ($coyote / $c) * 100;
        array_push($tipos, ['name' => "Coyote", "value" => $coyote, 'porcentaje' => $x]);

        $x = ($age == 0) ? 0 : ($age / $c) * 100;
        array_push($tipos, ['name' => "Agencias", "value" => $age, 'porcentaje' => $x]);

        $x = ($int == 0) ? 0 : ($int / $c) * 100;
        array_push($tipos, ['name' => "Internet", "value" => $int, 'porcentaje' => $x]);

        $x = ($rev == 0) ? 0 : ($rev / $c) * 100;
        array_push($tipos, ['name' => "Revistas", "value" => $rev, 'porcentaje' => $x]);

        $x = ($fa == 0) ? 0 : ($fa / $c) * 100;
        array_push($tipos, ['name' => "Facebook", "value" => $fa, 'porcentaje' => $x]);

        $x = ($rad == 0) ? 0 : ($rad / $c) * 100;
        array_push($tipos, ['name' => "Radio", "value" => $rad, 'porcentaje' => $x]);

        $x = ($otas == 0) ? 0 : ($otas / $c) * 100;
        array_push($tipos, ['name' => "OTAs", "value" => $otas, 'porcentaje' => $x]);

        $hoy = date('Y-m-d');
        $entradas = Reserva::where('tipo', '=', 3)->where('fechallegada', '=', $hoy)->count();
        $salidas = Reserva::where('tipo', '=', 3)->where('fechasalida', '=', $hoy)->count();

        return view('menu', ["empleado" => $user, 'tipos' => $tipos,
            "entradas" => $entradas, "salidas" => $salidas, 'counter' => $counter]);
    }

    //listo
    function reservacionesPage(Request $request)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Empleado::findOrFail($id);
        $habitaciones = Habitacion::all();

        return view('reservacion', ["empleado" => $user, 'habitaciones' => $habitaciones]);
    }

    //se elimino
    function hospedajeRapidoPage(Request $request)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Empleado::findOrFail($id);
        $habitaciones = Habitacion::where('estado', '=', 1)->get();
        return view('hospedajeRapido', ["empleado" => $user, 'habitaciones' => $habitaciones]);
    }



    //pendiente aun no se sabe si va a quedar igual
    function statusPageP(Request $request, $fecha)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Empleado::findOrFail($id);
        $habitaciones = Habitacion::orderBy('numero', 'ASC')->get();
        $totalOcupado = 0;
        foreach ($habitaciones as $habitacion) {
            $hoy = $fecha;
            $hospedajeLlegada = Reserva::where('fechallegada', $hoy)
                ->where('idHabitacion', '=', $habitacion->id)
                ->first();

            $hospedajeSalida = Reserva::where('fechallegada', '<=', $hoy)
                ->where('fechasalida', '>=', $hoy)
                ->where('idHabitacion', '=', $habitacion->id)
                ->first();

            if($hospedajeSalida) {
                if($hospedajeSalida->fechasalida == $hoy) {
                    if($hospedajeLlegada) {
                        $totalOcupado += 1;
                        $habitacion->Estado = 2;
                    } else {
                        $habitacion->Estado = 3;
                    }
                } else {
                    $totalOcupado += 1;
                    $habitacion->Estado = 2;
                }
            } else {
                $habitacion->Estado = 1;
            }
        }
        $porcentajeOcupado = ($totalOcupado * 100) / count($habitaciones);
        return view('status', ["empleado" => $user, 'habitaciones' => $habitaciones, 'f' => $fecha, 'hoy' => $hoy, 'porcentajeOcupado' => $porcentajeOcupado]);
    }

    function statusPage(Request $request)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Empleado::findOrFail($id);
        $habitaciones = Habitacion::orderBy('numero', 'ASC')->get();
        $totalOcupado = 0;
        foreach ($habitaciones as $habitacion) {
            $hoy = date('Y-m-d');

            $hospedajeLlegada = Reserva::where('fechallegada', $hoy)
                ->where('idHabitacion', '=', $habitacion->id)
                ->first();

            $hospedajeSalida = Reserva::where('fechallegada', '<=', $hoy)
                ->where('fechasalida', '>=', $hoy)
                ->where('idHabitacion', '=', $habitacion->id)
                ->first();

            if($hospedajeSalida) {
                if($hospedajeSalida->fechasalida == $hoy) {
                    if($hospedajeLlegada) {
                        $totalOcupado += 1;
                        $habitacion->Estado = 2;
                    } else {
                        $habitacion->Estado = 3;
                    }
                } else {
                    $totalOcupado += 1;
                    $habitacion->Estado = 2;
                }
            } else {
                $habitacion->Estado = 1;
            }
        }
        $porcentajeOcupado = ($totalOcupado * 100) / count($habitaciones);
        return view('status', ["empleado" => $user, 'habitaciones' => $habitaciones, "f" => $hoy, "hoy" => $hoy, 'porcentajeOcupado' => $porcentajeOcupado]);
    }

    //complemento de el status
    function rommInfoPage(Request $request)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Empleado::findOrFail($id);
        $cliente = Habitacion::where('numero', '=', $request->cod)->first();
        $hoy = date('Y-m-d');
        $hospedaje = Reserva::select('Reservaciones.id', 'c.nombre', 'c.telefono', 'fechallegada', 'fechasalida')
            ->where('fechallegada', '<=', $hoy)
            ->where('fechasalida', '>=', $hoy)
            ->where('idHabitacion', '=', $cliente->id)
            ->join('Clientes as c', 'c.id', 'Reservaciones.idCliente')
            ->first();

        $hospedaje->fechallegada = substr($hospedaje->fechallegada, 0, 10);
        $hospedaje->fechasalida = substr($hospedaje->fechasalida, 0, 10);

        return view('roomInfo', ["empleado" => $user, 'cliente' => $cliente, 'hospedaje' => $hospedaje]);
    }

    //listo

    function createDateRangeArray($strDateFrom, $strDateTo)
    {
        $aryRange = array();
        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            do {
                array_push($aryRange, date('Y-m-d', $iDateFrom));

                $iDateFrom += 86400;
            } while ($iDateFrom <= $iDateTo);
        }
        return $aryRange;
    }

    function sabanaReservaDevelux(Request $request, CookieJar $cookieJar)
    {
        $diasdelmes = date("t");
        $f = date('Y-m-d');
        $fecha = $request->cookie('f');
        if ($fecha != null) {
            $mes = date("m", strtotime($fecha));
            $diasdelmes = date("t", strtotime($fecha));
        } else {
            $mes = date("m", strtotime($f));
            $cookieJar->queue(cookie('f', $f, 180));
        }
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Empleado::findOrFail($id);
        $habitaciones = Habitacion::orderBy('capacidad', 'ASC')
            ->orderBy('tipo', 'DESC')->orderBy('numero', 'ASC')->get();
        $year = date("Y", strtotime($fecha));
        $ano = date("y", strtotime($fecha));
        $month = date("m", strtotime($fecha));
        $ini = date("Y-m-d", strtotime($year . '-' . $month . '-01'));
        $fin = date("Y-m-d", strtotime($year . '-' . $month . '-' . $diasdelmes));

        $colores = array(
            "#d23972",
            "#398cd2",
            "#39d292",
            "#d24739",
            "#dadc2b",
            "#7c69c5",
            "#aa6ec3",
            "#4bb1b1",
            "#7be688",
            "#cce67b",
            "#e6b17b",
            "#a26464",
            "#B7C68B",
            "#FFFD96",
            "#DC453D",
            "#FFB447",
            // OTRO RANDOM
            "#FF68DD",
            "#FF62B0",
            "#FE67EB",
            "#E469FE",
            "#FF7575",
            "#FF79E1",
            "#FF73B9",
            "#FE67EB",
            "#FF8A8A",
            "#FF86E3",
            "#FF86C2",
            "#FE8BF0",
            "#EA8DFE",
            "#DD88FD",
            "#FF9797",
            "#FF97E8",
            "#FF97CB",
            "#FE98F1",
            "#ED9EFE",
            "#E29BFD",
            "#FFA8A8",
            "#FFACEC",
            "#FFA8D3",
            "#FEA9F3",
            "#EFA9FE",
            "#E7A9FE",
            "#FFBBBB",
            "#FFACEC",
            "#FFBBDD",
            "#FFBBF7",
            "#F2BCFE",
            "#EDBEFE",
            "#FFCECE",
            "#FFC8F2",
            "#FFC8E3",
            "#FFCAF9",
            "#F5CAFF",
            "#F0CBFE",
        );

        $reservas = DB::select("
        select r.*, c.nombre, c.correo, c.telefono, h.numero as numHab, h.id as idHab
        from Reservaciones r
        inner join Habitaciones h
        on h.id = r.idHabitacion
        inner join Clientes c
            on c.id = r.idCliente
        where
            (convert(concat(DATE_FORMAT(r.fechallegada, '%Y'),DATE_FORMAT(r.fechallegada, '%m')), unsigned integer)
            <convert(concat(DATE_FORMAT('$ini', '%Y'),DATE_FORMAT('$fin', '%m')), unsigned integer) and
            convert(concat(DATE_FORMAT(r.fechasalida, '%Y'),DATE_FORMAT(r.fechasalida, '%m')), unsigned integer)>
            convert(concat(DATE_FORMAT('$ini', '%Y'),DATE_FORMAT('$fin', '%m')), unsigned integer))
            or
            (r.fechallegada between '$ini' and '$fin'
            or
            r.fechasalida between '$ini' and '$fin')
            order by h.capacidad asc, h.tipo desc, h.numero asc, r.fechallegada asc;
        ");


        $foliosColores = [];
        foreach ($reservas as $reserva) {
            if (!in_array($reserva->folio, array_column($foliosColores, "folio"))) {
                $colorElegido = array_rand($colores, 1);
                $reservasFolios["folio"] = $reserva->folio;
                $reservasFolios["color"] = $colores[$colorElegido];
                array_push($foliosColores, $reservasFolios);
            }
        }

        $mes = $month;
        $anio = $year;
        $fechaP = "$anio-$mes-01";
        $fechaU = date("Y-m-t", strtotime("$anio-$mes-01"));
        $aFechas = $this->createDateRangeArray($fechaP, $fechaU);

        $resultado = [];
        $betados = [];
        foreach ($aFechas as $fecha0) {
            $iFecha = strtotime($fecha0);
            foreach ($habitaciones as $habitacion) {
                $resultado[$habitacion->numero][$fecha0] = array();
                foreach ($reservas as $reserva) {
                    $d1 = strtotime($reserva->fechallegada);
                    $d2 = strtotime($reserva->fechasalida);
                    if ($reserva->idHabitacion == $habitacion->id && $iFecha >= $d1 && $iFecha <= $d2 && !in_array($reserva, $betados)) {
                        $diaInicio = new \DateTime($reserva->fechallegada);
                        $diaFin = new \DateTime($reserva->fechasalida);
                        $diferencia = $diaInicio->diff($diaFin);
                        $llegadaReserva = date("j", strtotime($reserva->fechallegada));
                        $salidaReserva = date("j", strtotime($reserva->fechasalida));
                        $mesSalida = date("m", strtotime($reserva->fechasalida));
                        $anoSalida = date("y", strtotime($reserva->fechasalida));
                        $mesInicio = date("m", strtotime($reserva->fechallegada));
                        $anoInicio = date("y", strtotime($reserva->fechallegada));
                        $reserva->dia = $llegadaReserva;
                        $reserva->mes_salida = $mesSalida;
                        $reserva->mes_inicio = $mesInicio;
                        $reserva->ano_salida = $anoSalida;
                        $reserva->ano_inicio = $anoInicio;
                        $reserva->dia_fin = $salidaReserva;
                        $reserva->dias = $diferencia->days;
                        $buscarFolio = array_search($reserva->folio, array_column($foliosColores, "folio"));
                        $reserva->color = $foliosColores[$buscarFolio]["color"];
                        $reserva->adultos = $reserva->adultos;
                        $reserva->ninos = $reserva->ninos;
                        $resultado[$habitacion->numero][$fecha0][] = $reserva;
                        array_push($betados, $reserva);
                    }
                }
            }
        }

        $sabana = $resultado;

        return view('sabanaReservas', ["empleado" => $user, "mes" => $mes, 'diasdelmes' => $diasdelmes,
            'habitaciones' => $habitaciones, 'reservas' => $reservas, "year" => $year, 'sabana' => $sabana, 'ano' => $ano
        ]);
    }

    //listo
    function cleaningPage(Request $request)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Empleado::findOrFail($id);
        $habitaciones = Habitacion::orderBy('numero', 'ASC')->get();
        $limpieza = [];
        $diaHoy = date("Y-m-d");
        foreach ($habitaciones as $habitacion) {
            $hoy = date("Y-m-d");

            $hospedajeSalida = Reserva::where('fechallegada','<=',$hoy)
                ->where('fechasalida','>=',$hoy)
                ->where('idHabitacion', '=', $habitacion->id)
                ->orderBy('fechallegada', 'ASC')
                ->first();

            $hospedajeLlegada = Reserva::where('fechallegada', $hoy)
                ->where('idHabitacion', '=', $habitacion->id)
                ->orderBy('fechallegada', 'DESC')
                ->first();
            $limpieza[$habitacion["numero"]]["salida"] = $hospedajeSalida;
            $limpieza[$habitacion["numero"]]["llegada"] = $hospedajeLlegada;
            $limpieza[$habitacion["numero"]]["habitacionTipo"] = $habitacion["tipo"];
        }

        return view('cleaning', ["empleado" => $user, 'habitaciones' => $limpieza, 'diaHoy' => $diaHoy]);
    }

    function usuariosPage(Request $request)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Empleado::findOrFail($id);
        $empleados = Empleado::all();

        return view('usuarios', ["empleado" => $user, 'empleados' => $empleados]);
    }


    function getClientes(Request $request)
    {
        $salida = "";
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $empleado = Empleado::findOrFail($id);

        $query = Cliente::all();

        if ($query != null) {

            $salida .= "<table id='tabla' class='table table-striped table-bordered' style='width:100%'>
           <thead class='thead-light'>
            <tr id='titulo'>
                        <th scope='col'>NOMBRE</th>
                        <th scope='col'>TELEFONO</th>
                        <th class='text-center ' scope='col'>CORREO</th>
                        <th scope='col'>Procedencia</th>
                        <th scope='col'>Vehiculo</th>
                        <th class='text-center' scope='col'>Editar</th>
                        <th class='text-center' scope='col'>Borrar</th>
                  </tr>
                </thead>
            <tbody>";
            foreach ($query as $fila) {
                $salida .= "<tr>
                              <td>" . $fila->nombre . "</td>
                              <td>" . $fila->telefono . "</td>
                              <td>" . $fila->correo . "</td>
                              <td>" . $fila->estado . "</td>
                              <td>" . $fila->vehiculo . "</td>
                              <td class='text-center'><a class='btn btn-warning text-white btn-sm' onclick='editCliente($fila->id)' style='text-decoration:none'>Editar</a></td>
                              <td class='text-center'><a class='btn btn-danger text-white btn-sm' onclick='deleteCliente($fila->id)' style='text-decoration:none'>Borrar</a></td>
                            </tr>";

            }
            $salida .= "</tbody>

            </table>
                    <script>
                $('#tabla').DataTable();
                    </script>";
        } else {
            $salida .= "NO HAY INFORMACION";
        }
        return $salida;
    }
    function editUsuarioPage(Request $request, $ide)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Empleado::findOrFail($ide);
        $empleado = Empleado::where('id', '=', $id)->first();

        return view('editUser', ["empleado" => $user, 'empleados' => $empleado]);
    }
    function editClientePage(Request $request, $ide)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Cliente::findOrFail($ide);
        $cliente = Empleado::where('id', '=', $id)->first();

        return view('editCliente', ["cliente" => $user, 'empleado' => $cliente]);
    }


    function habitacionesPage(Request $request)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);

        $habitaciones = Habitacion::orderBy('numero', 'ASC')->get();

        foreach ($habitaciones as $habitacion) {
            $habitacion->pactivo = $habitacion->pa;
            switch ($habitacion->pa) {
                case 1:
                    $habitacion->pa = $habitacion->c1;
                    break;
                case 2:
                    $habitacion->pa = $habitacion->c2;
                    break;
                case 3:
                    $habitacion->pa = $habitacion->c3;
                    break;
                case 4:
                    $habitacion->pa = $habitacion->c4;
                    break;
                case 5:
                    $habitacion->pa = $habitacion->c5;
                    break;
                case 6:
                    $habitacion->pa = $habitacion->c6;
                    break;
            }
            if ($habitacion->tipo == 'v') {
                $habitacion->tipo = 'villa';
            } else {
                $habitacion->tipo = "Suite";
            }
        }
        $empleado = Empleado::findOrFail($id);
        return view('rooms', ['habitaciones' => $habitaciones, "empleado" => $empleado]);
    }

    function clientesPage(Request $request)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);

        $empleado = Empleado::findOrFail($id);
        return view('clientes', ["empleado" => $empleado]);
    }

    function editReserva(Request $request, $id)
    {
        $cookie = $request->cookie('hvdsSession');
        $ide = base64_decode($cookie);

        $empleado = Empleado::findOrFail($ide);

        $reserva = Reserva::select('nombre', 'telefono', 'correo', 'fechallegada', 'fechasalida', 'numero',
            'adultos', 'ninos', 'price')
            ->where('Reservaciones.id', '=', $id)
            ->join('Clientes as c', 'c.id', 'Reservaciones.idCliente')
            ->join('Habitaciones as h', 'h.id', 'Reservaciones.idHabitacion')
            ->first();

        return view('editReserva', ["empleado" => $empleado, "reserva" => $reserva, 'id' => $id]);
    }

    //-------------------------DATA

    function getCli()
    {
        $clientes = Cliente::all();

        return Response::json($clientes);
    }

    function getCostos()
    {
        try {
            $hoy = date("Y-m-d");
            $users = Precio_Fecha::select('de', 'a', 'costo', 'numero', 'precios_fecha.id')
                ->where('a', '>=', $hoy)
                ->join('Habitaciones as h', 'idHabitacion', 'h.id')
                ->get();
            return Datatables::of(collect($users))->make(true);
        } catch (Exception $e) {
            return Response::json($e->getMessage());
        }
    }

    function busqueda(Request $request)
    {
        $salida = "";
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $empleado = Empleado::findOrFail($id);
        $hoy = date("Y-m-d");


        $query = Reserva::select('c.nombre', 'folio', 'c.telefono', 'Reservaciones.id', 'price',
            'fechallegada', 'fechasalida', 'numero', 'adultos', 'ninos', 'c.correo', 'status', 'confirmado', 'comentario', 'created_at', 'e.nombre as name')
            ->where('fechasalida', '>=', $hoy)
            ->join('Clientes as c', 'c.id', 'Reservaciones.idCliente')
            ->join('Habitaciones as h', 'h.id', 'Reservaciones.idHabitacion')
            ->join('Empleados as e', 'e.id', 'Reservaciones.idEmpleado')
            ->orderBy('fechallegada', 'ASC')->get();

        return Datatables::of(collect($query))->make(true);
    }


    function deleteClient($id)
    {
        try {

            Cliente::destroy($id);

            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'error' => $e]);
        }
    }

    function nextMonth(Request $request, CookieJar $cookieJar)
    {
        $fecha = $request->cookie('f');

        $year = date("Y", strtotime($fecha));
        $month = date("m", strtotime($fecha));
        $cookieJar->queue(cookie('f', date("Y-m-d", strtotime($year . '-' . $month . '-01 +1 month'))));
        return redirect(route('sabana.reserva'));
    }

    function previusMonth(Request $request, CookieJar $cookieJar)
    {
        $fecha = $request->cookie('f');

        $year = date("Y", strtotime($fecha));
        $month = date("m", strtotime($fecha));
        $cookieJar->queue(cookie('f', date("Y-m-d", strtotime($year . '-' . $month . '-01 -1 month'))));
        return redirect(route('sabana.reserva'));
    }

    //-------------------------POST

    function newCosto(Request $request)
    {
        try {
            if ($request->opc == true) {
                $costo = new Precio_Fecha;

                $costo->idHabitacion = $request->habitacion;

                $h = Habitacion::where('id', '=', $request->habitacion)->first();
                switch ($request->cpf) {
                    case 1:
                        $costo->costo = $h->c1;
                        break;
                    case 2:
                        $costo->costo = $h->c2;
                        break;
                    case 3:
                        $costo->costo = $h->c3;
                        break;
                    case 4:
                        $costo->costo = $h->c4;
                        break;
                    case 5:
                        $costo->costo = $h->c5;
                        break;
                    case 6:
                        $costo->costo = $h->c6;
                        break;
                }
                $costo->de = $request->de;
                $costo->a = $request->a;

                $costo->save();
            } else {
                $hs = Habitacion::where('tipo', '=', $request->tipo)->where('capacidad', '=', $request->capacidad)->get();

                foreach ($hs as $h) {
                    $costo = new Precio_Fecha;

                    $costo->idHabitacion = $h->id;
                    $costo->de = $request->de;
                    $costo->a = $request->a;
                    $costo->costo = $request->cpf;

                    $costo->save();
                }
            }

            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'data' => $e->getMessage()]);
        }
    }

    function doLogin(Request $request)
    {
        $empleado = Empleado::where('user', '=', $request->user)
            ->where('password', '=', $request->pass)->first();

        if ($empleado == null) {
            return Response::json(['code' => 404, 'data' => 'Usuario no encontrado']);
        } else {
            $id = $empleado->id;
            $idEncripted = base64_encode($id);
            $cookie = Cookie::make('hvdsSession', $idEncripted, 180);
            return Response::json(['code' => 200, 'data' => $empleado])->withCookie($cookie);
        }
    }

    function addCliente(Request $request)
    {
        try {
            $cliente = new Cliente;
            $cliente->nombre = $request->nombre;
            $cliente->telefono = $request->telefono;
            $cliente->correo = $request->correo;
            $cliente->estado = $request->estado;

            $cliente->save();
            return Response::json(['code' => 200, 'data' => 'Cliente Registrado']);
        } catch (Exception $e) {
            return Response::json(['code' => 404, 'data' => $e->getMessage()]);
        }
    }

    //ya se modifico
    function Reservar(Request $request)
    {
        try {
            $cookie = $request->cookie('hvdsSession');

            $id = base64_decode($cookie);
            $cuartos = explode(',', $request->cuartos);

            $folio = uniqid();
            $folio = strtoupper($folio);
            $folio = substr($folio, 5, 11);

            $f = $folio . '';

            $hoy = date('Y-m');
            $hoy = $hoy . '-01';
            $hoy = date('Y-m-d', strtotime($hoy));


            foreach ($cuartos as $cuarto) {
                $habitacion = Habitacion::where('numero', '=', $cuarto)->first();

                $reserva = new Reserva;

                $reserva->folio = $f;
                $reserva->idEmpleado = $id;
                $reserva->idCliente = $request->idCli;
                $reserva->idHabitacion = $habitacion->id;
                $reserva->fechallegada = $request->txtfechallegada;
                $reserva->fechasalida = $request->txtfechasalida;
                $reserva->adultos = $request->txtcantidadadultos;
                $reserva->ninos = $request->txtnumeroninos;
                $reserva->status = $request->status;
                $reserva->tipo = $request->reco;
                $reserva->confirmado = false;
                $reserva->comentario = $request->txtcomentario;
                $reserva->price = $request->total;
                $reserva->save();
            }

            if ($request->status == 1) {
                $pre = Prereserva::where('fecha', '=', $hoy)->first();
                if ($pre != null) {
                    $pre->count = $pre->count + 1;
                    $pre->save();
                } else {
                    $pre = new Prereserva;
                    $pre->fecha = $hoy;
                    $pre->count = 1;
                    $pre->save();
                }
            }
            if ($request->status == 2) {
                $res = Reservam::where('fecha', '=', $hoy)->first();
                if ($res != null) {
                    $res->count = $res->count + 1;
                    $res->save();
                } else {
                    $res = new Reservam;
                    $res->fecha = $hoy;
                    $res->count = 1;
                    $res->save();
                }
            }
            if ($request->status == 3) {
                $hos = Hospedajem::where('fecha', '=', $hoy)->first();
                if ($hos != null) {
                    $hos->count = $hos->count + 1;
                    $hos->save();
                } else {
                    $hos = new Hospedajem;
                    $hos->fecha = $hoy;
                    $hos->count = 1;
                    $hos->save();
                }
            }

              //se envia el correo a los que reservan
                    $reserva = Reserva::where('folio', '=', $folio)->first();
                    $cliente = Cliente::find($reserva->idCliente);
                    $habitacion = Habitacion::findOrFail($reserva->idHabitacion);

                    $data = array('email' => $cliente->correo,'reserva' => $reserva, 'cliente' => $cliente, 'habitacion' => $habitacion);
                    Mail::send('utils.mail', $data, function ($message) use ($data) {
                        $message->from('reservas@villadulcesuenos.com', 'Tenemos una nueva reservación');
                        $message->to($data["email"]);
                        $message->subject('Nueva reservación');
                        $message->attach('politicas_2020.pdf', [
                            'as' => 'politicas_2020.pdf',
                            'mime' => 'application/pdf',
                        ]);
                    });

            return Response::json(['code' => 200, 'data' => 'Reservacion Registrada']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function testCorreo(Request $request)
    {
        try {
            $folio = $request->folio;
            $reserva = Reserva::where('folio', '=', $folio)->first();
            $cliente = Cliente::find($reserva->idCliente);
            $habitacion = Habitacion::findOrFail($reserva->idHabitacion);

            $data = array('email' => 'jm_mazariegos@yahoo.com.mx', 'reserva' => $reserva, 'cliente' => $cliente, 'habitacion' => $habitacion);
            Mail::send('utils.mail', $data, function ($message) use ($data) {
                $message->from('reservas@villadulcesuenos.com', 'Tenemos una nueva reservación');
                $message->to($data["email"]);
                $message->subject('Nueva reservación');
                $message->attach('politicas_2020.pdf', [
                    'as' => 'politicas_2020.pdf',
                    'mime' => 'application/pdf',
                ]);
            });


        } catch (\Swift_TransportException $e) {
            return $e->getMessage();
            Log::debug(__METHOD__ . "Error Enviando email" . $e);
        }
    }

    //listo
    function adminReservaPage(Request $request)
    {
        $cookie = $request->cookie('hvdsSession');
        $id = base64_decode($cookie);
        $user = Empleado::findOrFail($id);


        return view('adminResv', ["empleado" => $user]);
    }

    function senEdit(Request $request, $id)
    {
        try {

            $reserva = Reserva::findOrFail($id);
            $habitacion = Habitacion::where('numero', '=', $request->cuarto)->first();

            $reserva->fechallegada = $request->txtfechallegada;
            $reserva->fechasalida = $request->txtfechasalida;
            $reserva->adultos = $request->txtcantidadadultos;
            $reserva->ninos = $request->txtnumeroninos;
            $reserva->price = $request->total;
            $reserva->save();

            if ($request->status == 2) {
                if (false !== strpos($request->txtcorreo, "@") && false !== strpos($request->txtcorreo, ".")) {
                    Mail::to($request->txtcorreo)->send(new Email($reserva->folio));
                }
            }

            return Response::json(['code' => 200, 'data' => 'Reservacion Registrada']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //falta editar para que se mande el id en lugar del folio
    function DeleteReserva($id)
    {
        Reserva::destroy($id);

        return Response::json(['code' => 200]);;
    }

    // listo
    function Registrar(Request $request, $id)
    {
        try {

            $reserva = Reserva::findOrFail($id);

            $reserva->fechasalida = $request->txtfechasalida;

            $reserva->save();

            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'error' => $e]);
        }
    }
    function editarCliente($id, Request $request)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->nombre = $request->txtnombre;
            $cliente->telefono = $request->txttelefono;
            $cliente->correo = $request->txtcorreo;
            $cliente->estado = $request->txtestado;
            $cliente->vehiculo = $request->txtvehiculo;
            $cliente->save();

            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'error' => $e]);
        }
    }

    function editarUsuario($id, Request $request)
    {
        try {
            $empleado = Empleado::findOrFail($id);
            $empleado->nombre = $request->txtnombres;
            $empleado->user = $request->txtusuario;
            $empleado->password = $request->txtcontra;
            $empleado->correo = $request->txtcorreo;
            $empleado->telefono = $request->txttelefono;
            $empleado->tipo = $request->txttipo;
            $empleado->save();
            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'error' => $e]);
        }
    }






    //listo
    function addUsuario(Request $request)
    {
        try {

            $empleado = new Empleado;

            $empleado->nombre = $request->txtnombre;
            $empleado->user = $request->txtusuario;
            $empleado->password = $request->txtclave;
            $empleado->correo = $request->txtcorreo;
            $empleado->telefono = $request->txttelefono;
            $empleado->tipo = $request->txttipo;
            $empleado->fincion = '';

            $empleado->save();

            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'error' => $e]);
        }
    }

    //listo
    function deleteUSR($id)
    {
        try {

            Empleado::destroy($id);

            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'error' => $e]);
        }
    }

    //listo
    function hospedar(Request $request, $id)
    {
        try {
            $cookie = $request->cookie('hvdsSession');
            $idE = base64_decode($cookie);
            $user = Empleado::findOrFail($idE);
            $reserva = Reserva::where('id', '=', $id)->first();

            $cliente = Cliente::findOrFail($reserva->idCliente);

            $correo = $cliente->correo;

            $id = $reserva->id;
            if ($reserva->status == 1) {
                $reserva->status = 2;
                $reserva->save();

                //Mail::to('necro213a@gmail.com')->send(new Email());
            } else {

                $reserva->status = 3;
                $reserva->save();

            }

            if (false !== strpos($correo, "@") && false !== strpos($correo, ".")) {
                Mail::to($correo)->send(new Email($reserva->folio));
            }

            return Response::json(['code' => 200]);

        } catch (Exception $e) {
            return Response::json(['code' => 500, 'error' => $e]);
        }
    }

    //listo

    function getHabitacionesDisponibles(Request $request)
    {
        $adultos = $request->adultos;
        $llegada = date('Y-m-d', strtotime($request->llegada));
        $salida = date('Y-m-d', strtotime($request->salida));

        $habitaciones = Habitacion::with('precios')
            ->where('capacidad', '>=', $adultos)
            ->orderBy('capacidad', 'ASC')
            ->orderBy('tipo', 'DESC')
            ->get();


        $habit = [];
        foreach ($habitaciones as $habitacion) {
            $habit[$habitacion["numero"]]["id"] = $habitacion["id"];
            $habit[$habitacion["numero"]]["numero"] = $habitacion["numero"];
            $habit[$habitacion["numero"]]["capacidad"] = $habitacion["capacidad"];
            $habit[$habitacion["numero"]]["precios"] = [];

            foreach ($habitacion->precios as $precios) {
                $llegadaPrecio = date('Y-m-d', strtotime($precios->de));
                $salidaPrecio = date('Y-m-d', strtotime($precios->a));
                $diasAqui = 1;

                for ($i = $llegadaPrecio; $i <= $salidaPrecio; $i = date('Y-m-d', strtotime($i . "+ 1 days"))) {
                    if ($llegada < $i && $salida > $i) {
                        $habit[$habitacion["numero"]]["precios"][$precios->id]["llegada"] = $precios->de;
                        $habit[$habitacion["numero"]]["precios"][$precios->id]["salida"] = $precios->a;
                        $habit[$habitacion["numero"]]["precios"][$precios->id]["dias"] = $diasAqui;
                        $habit[$habitacion["numero"]]["precios"][$precios->id]["costo"] = $habitacion["c$precios->costo"];
                        $total0 = ($habitacion["c$precios->costo"] * $diasAqui);
                        $habit[$habitacion["numero"]]["precios"][$precios->id]["total"] = $total0;
                        $habit[$habitacion["numero"]]["precios"][$precios->id]["fechas"][] = $i;
                        $diasAqui++;
                    } else if ($llegada == $i) {
                        $habit[$habitacion["numero"]]["precios"][$precios->id]["llegada"] = $precios->de;
                        $habit[$habitacion["numero"]]["precios"][$precios->id]["salida"] = $precios->a;
                        $habit[$habitacion["numero"]]["precios"][$precios->id]["dias"] = 1;
                        $habit[$habitacion["numero"]]["precios"][$precios->id]["costo"] = $habitacion["c$precios->costo"];
                        $total0 = ($habitacion["c$precios->costo"] * 1);
                        $habit[$habitacion["numero"]]["precios"][$precios->id]["total"] = $total0;

                        $habit[$habitacion["numero"]]["precios"][$precios->id]["fechas"][] = $i;
                        $diasAqui++;
                    }
                }
            }
        }

        $i = 0;
        $todasReservas = [];
        foreach ($habit as $habita) {

            $reservas = Reserva::select("numero", "fechallegada", 'fechasalida')
                ->where("numero", '=', $habita["numero"])
                ->where('fechallegada', '<=', $request->llegada)
                ->where('fechasalida', '>', $request->llegada)
                ->join('Habitaciones as h', 'h.id', '=', 'Reservaciones.idHabitacion')
                ->first();
            if ($reservas == []) {
                $reservas = Reserva::select("numero", "h.id")
                    ->where("numero", '=', $habita["numero"])
                    ->where('fechallegada', '<', $request->salida)
                    ->where('fechasalida', '>=', $request->salida)
                    ->join('Habitaciones as h', 'h.id', '=', 'Reservaciones.idHabitacion')
                    ->first();

                if ($reservas == []) {
                    $reservas = Reserva::select("numero", "h.id")
                        ->where("numero", '=', $habita["numero"])
                        ->where('fechallegada', '>=', $request->llegada)
                        ->where('fechasalida', '>=', $request->llegada)
                        ->where('fechallegada', '<=', $request->salida)
                        ->where('fechasalida', '<=', $request->salida)
                        ->join('Habitaciones as h', 'h.id', '=', 'Reservaciones.idHabitacion')
                        ->first();

                    if ($reservas == []) {
                        $total = 0;
                        $costo = 0;
                        foreach ($habita["precios"] as $hPr) {
                            $total += $hPr["total"];
                        }
                        $habita["TOTAL"] = $total;
                        $habita[$i] = $habita;
                        if(count($habita["precios"]) > 0) {
                            array_push($todasReservas, $habita[$i]);
                        }

                    }
                }
            }
            $i++;
        }


        return $todasReservas;
    }

    //listo
    function logout(Request $request)
    {
        return redirect(route('login'))->withCookie(Cookie::forget('hvdsSession'));
    }

    function newHabitacion(Request $request)
    {
        try {

            $h = new Habitacion;
            $h->numero = $request->numero;
            $h->capacidad = $request->capacidad;
            $h->tipo = $request->tipo;
            $h->c1 = $request->c1;
            $h->c2 = $request->c2;
            $h->c3 = $request->c3;
            $h->c4 = $request->c4;
            $h->c5 = $request->c5;
            $h->c6 = $request->c6;
            $h->pa = $request->pa;
            $h->save();

            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'error' => $e]);
        }
    }

    function deleteRoom($id)
    {
        try {

            Habitacion::destroy($id);

            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'error' => $e]);
        }
    }

    function editHabitacion(Request $request, $id)
    {
        try {

            $h = Habitacion::findOrFail($id);
            $h->numero = $request->numero;
            $h->capacidad = $request->capacidad;
            $h->tipo = $request->tipo;
            $h->c1 = $request->c1;
            $h->c2 = $request->c2;
            $h->c3 = $request->c3;
            $h->c4 = $request->c4;
            $h->c5 = $request->c5;
            $h->c6 = $request->c6;
            $h->pa = $request->pa;
            $h->save();

            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'error' => $e]);
        }
    }

    function Confirmar($id)
    {
        try {

            $reserva = Reserva::findOrFail($id);
            $reserva->confirmado = true;
            $reserva->save();

            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'error' => $e]);
        }

    }

    function getThisYearRes()
    {
        $año = date("Y");
        $añoa = $año - 1;
        $actual = [];
        $ant = [];
        $respuesta = [];

        $primero = date('Y-m-d', strtotime($año . '-01-01'));
        $segundo = date('Y-m-d', strtotime($año . '-01-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);
        $primero = date('Y-m-d', strtotime($año . '-02-01'));
        $segundo = date('Y-m-d', strtotime($año . '-02-28'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);
        $primero = date('Y-m-d', strtotime($año . '-03-01'));
        $segundo = date('Y-m-d', strtotime($año . '-03-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);
        $primero = date('Y-m-d', strtotime($año . '-04-01'));
        $segundo = date('Y-m-d', strtotime($año . '-04-30'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);
        $primero = date('Y-m-d', strtotime($año . '-05-01'));
        $segundo = date('Y-m-d', strtotime($año . '-05-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);
        $primero = date('Y-m-d', strtotime($año . '-06-01'));
        $segundo = date('Y-m-d', strtotime($año . '-06-30'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);
        $primero = date('Y-m-d', strtotime($año . '-07-01'));
        $segundo = date('Y-m-d', strtotime($año . '-07-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);
        $primero = date('Y-m-d', strtotime($año . '-08-01'));
        $segundo = date('Y-m-d', strtotime($año . '-08-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);
        $primero = date('Y-m-d', strtotime($año . '-09-01'));
        $segundo = date('Y-m-d', strtotime($año . '-09-30'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);
        $primero = date('Y-m-d', strtotime($año . '-10-01'));
        $segundo = date('Y-m-d', strtotime($año . '-10-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);
        $primero = date('Y-m-d', strtotime($año . '-11-01'));
        $segundo = date('Y-m-d', strtotime($año . '-11-30'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);
        $primero = date('Y-m-d', strtotime($año . '-12-01'));
        $segundo = date('Y-m-d', strtotime($año . '-12-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($actual, $n);

        $primero = date('Y-m-d', strtotime($añoa . '-01-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-01-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);
        $primero = date('Y-m-d', strtotime($añoa . '-02-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-02-28'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);
        $primero = date('Y-m-d', strtotime($añoa . '-03-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-03-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);
        $primero = date('Y-m-d', strtotime($añoa . '-04-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-04-30'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);
        $primero = date('Y-m-d', strtotime($añoa . '-05-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-05-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);
        $primero = date('Y-m-d', strtotime($añoa . '-06-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-06-30'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);
        $primero = date('Y-m-d', strtotime($añoa . '-07-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-07-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);
        $primero = date('Y-m-d', strtotime($añoa . '-08-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-08-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);
        $primero = date('Y-m-d', strtotime($añoa . '-09-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-09-30'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);
        $primero = date('Y-m-d', strtotime($añoa . '-10-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-10-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);
        $primero = date('Y-m-d', strtotime($añoa . '-11-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-11-30'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);
        $primero = date('Y-m-d', strtotime($añoa . '-12-01'));
        $segundo = date('Y-m-d', strtotime($añoa . '-12-31'));
        $n = Reserva::where('fechallegada', '>=', $primero)->where('fechallegada', '<=', $segundo)->count();
        array_push($ant, $n);


        return Response::json(['actual' => $actual, 'anterior' => $ant]);
    }

    function getRep()
    {
        $f = date("Y-m");
        $f = date("Y-m-d", strtotime($f . '-01'));
        $fecha = date("Y-m-d", strtotime($f . '-11 month'));

        $reservas = [];
        $prereservas = [];
        $hospedajes = [];
        $fechas = [];

        while (strtotime($fecha) <= strtotime($f)) {
            $p = Prereserva::where('fecha', '=', $fecha)->first();
            $r = Reservam::where('fecha', '=', $fecha)->first();
            $h = Hospedajem::where('fecha', '=', $fecha)->first();

            if ($p != null) {
                array_push($prereservas, $p->count);
            } else {
                array_push($prereservas, 0);
            }

            if ($r != null) {
                array_push($reservas, $r->count);
            } else {
                array_push($reservas, 0);
            }

            if ($h != null) {
                array_push($hospedajes, $h->count);
            } else {
                array_push($hospedajes, 0);
            }
            $month = date("M", strtotime($fecha));
            array_push($fechas, $this->formatFecha($month));
            $fecha = date("Y-m-d", strtotime($fecha . '+1 month'));

        }
        return Response::json(["res" => $reservas, "pre" => $prereservas, 'hos' => $hospedajes, 'meses' => $fechas]);
    }

    function deletePrice($id)
    {
        try {
            Precio_Fecha::destroy($id);
            return Response::json(['code' => 200]);
        } catch (Exception $e) {
            return Response::json(['code' => 500, 'data' => $e->getMessage()]);
        }
    }

    function getEntradasSalidas()
    {
        $hoy = date('Y-m-d');
        $entradas = Reserva::where('tipo', '=', 3)->where('fechallegada', '=', $hoy)->count();
        $salidas = Reserva::where('tipo', '=', 3)->where('fechasalida', '=', $hoy)->count();

        return Response::json(["entradas" => $entradas, "salidas" => $salidas]);
    }

    function formatFecha($name)
    {
        switch ($name) {
            case "Oct":
                return "Octubre";
                break;
            case "Nov":
                return "Noviembre";
                break;
            case "Dec":
                return "Diciembre";
                break;
            case "Jan":
                return "Enero";
                break;
            case "Feb":
                return "Febrero";
                break;
            case "Mar":
                return "Marzo";
                break;
            case "Apr":
                return "Abril";
                break;
            case "May":
                return "Mayo";
                break;
            case "Jun":
                return "Junio";
                break;
            case "Jul":
                return "Julio";
                break;
            case "Aug":
                return "Agosto";
                break;
            case "Sep":
                return "Septiembre";
                break;
        }
    }

}

@extends('layout.admin')

@section('content')
    <!-- Content Header (Page header) -->
    @include('partials.navbar', ['ventana' => 'Estadisticas','name'=>'menu'])

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <br>
                        <br>
                        <br>
                        <h5>Reservas</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-plus-o"></i>
                    </div>
                    <a href="{{route('reservacion')}}" class="small-box-footer">ir <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <br><br><br>

                        <h5>Administracion de Resrvaciones</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <a href="{{route('adminReservaciones')}}" class="small-box-footer">ir <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
                <!-- small box -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <br><br><br>

                        <h5>Sabana de Reservaciones</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-check-o"></i>
                    </div>
                    <a href="{{route('sabana.reserva')}}" class="small-box-footer">ir <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <br>
                        <br>
                        <br>

                        <h5>Usuarios</h5>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('usuarios')}}" class="small-box-footer">ir <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <hr>
        <div class="row">
            <div class="col-md-4" align="center">
                <div class="small-box bg-purple-gradient">
                    <div class="inner">
                        <br>
                        <br>
                        <h3>{{$entradas}}</h3>

                        <br>
                        <h5>Entradas programadas</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4" align="center">
                <div class="small-box bg-purple-gradient">
                    <div class="inner">
                        <br>
                        <br>
                        <h3>{{$salidas}}</h3>

                        <br>
                        <h5>Salidas programadas</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-out"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4" align="center">
                <div class="small-box bg-purple-gradient">
                    <div class="inner">
                        <br>
                        <br>
                        <h3>{{$counter}}</h3>

                        <br>
                        <h5>Visitas a la pagina</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pagelines"></i>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reporte de Reservaciones</h3>


                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center">
                                    <strong>Comparacion de reservaciones de este año contra el pasado</strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                        </div>
                        <br>
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <strong>Estadisticos de reservacion</strong>
                                    </p>
                                    @foreach($tipos as $tipo)

                                    <div class="progress-group">
                                        <span class="progress-text">{{$tipo['name']}}</span>
                                        <span class="progress-number">{{$tipo['value']}}</span>

                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-aqua" style="width: {{$tipo['porcentaje']}}%"></div>
                                        </div>
                                    </div>
                                        <br>
                                    @endforeach

                                </div>
                                <!-- /.col -->
                            </div>

                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    <!-- /.content -->
        <hr>

        <div class="row">
            <div id="rep1">

            </div>
        </div>
@stop

@section('script')
    <!-- ChartJS -->
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script src="{{asset('bower_components/chart.js/Chart.js')}}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{asset('/js/admin/home.js')}}"></script>
        <script>

        </script>
@stop

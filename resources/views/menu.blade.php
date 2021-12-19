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
        <div class="row">
          <div class="col-md-12">
              <div class="box" id="imprimible" >
                  <div class="box-header with-border text-center">
                      <h3 class="text-center">Estadisticos de ejecutivos</h3>
                  </div>
                  <div class="box-body">
                          <div class="row"  style="height:600px;">
                              <div class="col-md-6">
                                  <canvas id="ejecutivosChart"></canvas>
                              </div>
                              <div class="col-md-6">
                                <h3 class="text-center">Lista de ventas por ejecutivo</h3>
                                  <div class="row">
                                  <div class="col-md">
                                <ul class="list-group">
                                  @foreach ($usuarios as $value)
                                      <li class="list-group-item"><small>{{ $value->nombre }}</small></li>
                                  @endforeach
                                </ul>
                              </div>
                              <div class="col-md">
                                <ul class="list-group">
                                @foreach ($reservas as $value)
                                    <li class="list-group-item">{{ $value->total }}</li>
                                @endforeach
                                </ul>
                                </div>
                                </div>
                              </div>
                          </div>
                  </div>
              </div>
          </div>
        </div>
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="text-center">Reporte de Reservaciones</h3>
                    </div>
                    <div class="box-body">
                        <br>
                            <div class="row">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <p class="text-center">
                                        <strong>Comparacion de reservaciones de este año contra el pasado</strong>
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="chart">
                                        <canvas id="salesChart" ></canvas>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div id="rep1">
                    </div>
                </div>
            </div>
        </div>
@stop

@section('script')
    <!-- ChartJS -->
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script src="{{asset('bower_components/chart.js/Chart.js')}}"></script>
        <script src="{{asset('/js/admin/home.js')}}"></script>
        <script src="{{asset('/js/admin/estadistics.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stop

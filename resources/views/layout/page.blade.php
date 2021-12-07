<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Villas Dulces Sueños</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    @yield('styles')
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>
<body>
<!-- Preloader -->
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- /Preloader -->
<!-- Header Area Start -->
<header class="header-area">
    <!-- Search Form -->
    <!-- Top Header Area Start -->

    <div class="top-header-area">
        <div class="container">
            <div class="row">
                <div class="col-8">

                    <div class="top-header-content">
                        <a href="#"><i class="icon_phone "></i> <span>01 (327) 274 2246 / (327) 274 2294</span></a>
                        <a href="#"><i class="icon_mail "></i> <span>villasdulcesuenos@hotmail.com</span></a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="top-header-content">
                        <!-- Top Social Area -->
                        <div class="top-social-area ml-auto">
                            <a href="https://www.facebook.com/Villas-Dulce-Sue%C3%B1os-275521032907394/"><i class="fab fa-facebook-square" style="font-size:20px;"></i></a>
                            <a href="https://www.instagram.com/villasdulcesuenos"><i class="fab fa-instagram" style="font-size:20px;"></i></a>
                            <a href=" https://wa.me/+523221491491?text=Me%20gustaría%20saber%20mas%20informacion%20de%20su%20hotel"><i class="fab fa-whatsapp" style="font-size:20px;"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Top Header Area End -->
    <!-- Main Header Start -->
    <div class="main-header-area">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Classy Menu -->
                <nav class="classy-navbar justify-content-between" id="robertoNav">
                    <!-- Logo -->
                    <a class="nav-brand" href="index.html"><img src="img/logo.png" alt=""></a>
                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- Menu Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul id="nav">


                                <li><a href="#section1">Habitaciones</a></li>
                                <li><a href="#section2">Servicios</a></li>
                                <li><a href="#galeria">Galeria</a></li>
                                <li><a href="#section3">Ubicacion</a></li>
                                <li><a href="#section4">Contacto</a></li>
                            </ul>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header Area End -->
<!-- CONTENT -->
@yield('content')
<!-- CONTENT -->
<!-- Footer Area Start -->
<footer class="footer-area section-padding-80-0">
    <!-- Main Footer Area -->
    <!-- Copywrite Area -->
 <section id="section4">

        <div class="copywrite-content">
            <div class="row align-items-center">
                <div class="col-12 ">




                      <ul class="list-group ">
                        <li class="list-group-item ">
                          <i class="fa fa-map-marker fa-x2"></i>
                          <a class="pl-3">Rtno. Jacarandas 7, 63724 Rincón de Guayabitos, Nay., México</a>
                        </li>
                        <li class="list-group-item  ">
                          <i class="fa fa-phone fa-x2"></i>
                          <span class="pl-3">WhatsApp: +52-322-14-91-491</span>
                        </li>
                        <li class="list-group-item  ">
                          <i class="fa fa-envelope fa-x2"></i>
                          <a class="pl-3" >villasdulcesuenos@hotmail.com</a>
                        </li>
                      </ul>


                    <div class="copywrite-text">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                            All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>

                    </div>
                </div>

            </div>
        </div>
</section>
    </div>
</footer>
<script src="{{asset('js/jquery.min.js')}}"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/roberto.bundle.js')}}"></script>
<script src="{{asset('js/default-assets/active.js')}}"></script>
@yield('script')
</body>
</html>

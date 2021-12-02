@extends('layout.page')
@section('content')
<!-- Welcome Area Start -->
<!-- 1. Add latest jQuery and fancybox files -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>


	<link href="https://fonts.googleapis.com/css?family=Alegreya:700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400" rel="stylesheet">
	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />



<style> 
.yourDiv{
    position: fixed;
        overflow: hidden;
        z-index: 2400;
        opacity: 1;
        right: 1px;
        top: 700px !important;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -ms-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
        background-color:#9860BD;
        border-radius: 25px 0px 0px 25px;
        padding:5px;
}


#galeria {
            margin: 1rem auto;
            width:100%;
            max-width:960px;
            column-count: 4;
        }
        
        * Móviles en horizontal o tablets en vertical */

@media (max-width: 767px) { 
    #galeria {
        columns:2;
    }

}
        
/* Móviles en vertical */

@media (max-width: 480px) {
    #galeria {
        columns: 1;
    }
}
        </style>
<section class="welcome-area">


  <section class="welcome-area">
        <div class="welcome-slides owl-carousel">
            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(img/banner3.png);" data-img-url=".img/banner3.png">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <!-- Welcome Text -->
                            <div class="col-12">
                                <div class="welcome-text text-center">
                                    <h2 data-animation="fadeInLeft" data-delay="10ms">Hotel </h2>
                                    <h2 data-animation="fadeInLeft" data-delay="50ms">Villas dulce sueños</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</section>
<br>
<br>
<br>
<!-- checkin Out form -->
    <div class="yourDiv " id="booking" class="section">
		
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<form class="text-light">
							<div class="row no-margin">
								<div class="col-md-3 text-center">
										<h2> Reservar</h2>
								</div>
								<div class="col-md-7">
									<div class="row no-margin">
										<div class="col-md-4">
											<div class="form-group">
												<span class="form-label">Check In</span>
												<input class="form-control" type="date">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<span class="form-label">Check out</span>
												<input class="form-control" type="date">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<span class="form-label">Adultos</span>
												<select class="form-control">
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
													<option>6</option>
												</select>
												<span class="select-arrow"></span>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<span class="form-label">Niños</span>
												<select class="form-control">
													<option>0</option>
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
													<option>6</option>
												</select>
												<span class="select-arrow"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-btn">
										<button class="btn btn-success">Check availability</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		
	</div>
    
    <!-- checkin Out form -->

<!-- Welcome Area End -->
<!-- Our Room Area Start -->
<section  id="section1" class="roberto-rooms-area">
    <h1 class="text-center">Habitaciones</h1>
    <br>
    
    
    <div class="rooms-slides owl-carousel">
        <div class="single-room-slide d-flex align-items-center">
            <!-- Thumbnail -->
            <div class="room-thumbnail h-100 bg-img" style="background-image: url(img/villa2.jpg);"></div>
            <!-- Content -->
            <div class="room-content">
                <h2 data-animation="fadeInUp" data-delay="50ms">Villa 2 Pers</h2>
                
                <ul class="room-feature" data-animation="fadeInUp" data-delay="50ms">
                    <li><h3> Descripcion:</h3> <a class="text-justify" >Tiene el espacio necesario e ideal para quienes buscan tener un lugar tranquilo para descansar en su viaje, pues, cuenta con una cama matrimonial, cocina equipada con utensilios básicos, estufa, refrigerador, ventilador, aire acondicionado y tv con cable.</a></li>
                   
                </ul>
                <a href="https://youtu.be/5suE5mSLODE " target="_blank" class="btn roberto-btn mt-30" data-animation="fadeInUp" data-delay="700ms">Ver video</a>
            </div>
        </div>
        <div class="single-room-slide d-flex align-items-center">
            <!-- Thumbnail -->
            <div class="room-thumbnail h-100 bg-img" style="background-image: url(img/suit2.jpg);"></div>
            <!-- Content -->
            <div class="room-content">
                <h2 data-animation="fadeInUp" data-delay="50ms">Suite 2 Pers </h2>
                
                <ul class="room-feature" data-animation="fadeInUp" data-delay="50ms">
                   <li><h3> Descripcion:</h3> <a  class="text-justify">Ideal para disfrutar de unas cálidas vacaciones, cuento con una cama Queen, cocina integral equipada con utensilios básicos, estufa, refrigerador, ventilador, aire acondicionado y tv con cable; además de tener un balcón donde podrás disfrutar una agradable vista hacia la alberca.</a></li>
                </ul>
                <a href="https://youtu.be/LFaCJIpt_6I" target="_blank" class="btn roberto-btn mt-30" data-animation="fadeInUp" data-delay="700ms">Ver video</a>
            </div>
        </div>
        <div class="single-room-slide d-flex align-items-center">
            <!-- Thumbnail -->
            <div class="room-thumbnail h-100 bg-img" style="background-image: url(img/villapara4.JPG);"></div>
            <!-- Content -->
            <div class="room-content"50ms>
                <h2 data-animation="fadeInUp" data-delay="50ms">Villa 4 Pers </h2>
               
                <ul class="room-feature" data-animation="fadeInUp" data-delay="50ms">
                    <li><h3> Descripcion:</h3> <a class="text-justify"> Nuestras habitaciones están totalmente equipadas para satisfacer sus necesidades y garantizar una cálida estadía. Nuestra villa cuenta con sala, cocina equipada con utensilios básicos, ventilador, aire acondicionado, una recámara con dos camas matrimoniales y tv con cable.</a></li>
                </ul>
                <a href="https://youtu.be/J06dO8mEl3c" target="_blank" class="btn roberto-btn mt-30" data-animation="fadeInUp" data-delay="700ms">Ver video</a>
            </div>
        </div>
        <div class="single-room-slide d-flex align-items-center">
            <!-- Thumbnail -->
            <div class="room-thumbnail h-100 bg-img" style="background-image: url(img/suit4.jpg);"></div>
            <!-- Content -->
            <div class="room-content">
                <h2 data-animation="fadeInUp" data-delay="50ms">Suit 4 Pers</h2>
                
                <ul class="room-feature" data-animation="fadeInUp" data-delay="50ms">
                    <li><h3> Descripcion:</h3> <a class="text-justify">Cuenta con 2 camas matrimoniales. Cocina equipada con utensilios básicos, refrigerador, aire acondicionado, tv con cable, ventilador.</a></li>
                </ul>
                <a href="https://youtu.be/783LWIR2-jk" target="_blank" class="btn roberto-btn mt-30" data-animation="fadeInUp" data-delay="700ms">Ver video</a>
            </div>
        </div>
        <div class="single-room-slide d-flex align-items-center">
            <!-- Thumbnail -->
            <div class="room-thumbnail h-100 bg-img" style="background-image: url(img/villa6.jpg);"></div>
            <!-- Content -->
            <div class="room-content">
                <h2 data-animation="fadeInUp" data-delay="50ms">Villa 6 Pers</h2>
                <ul class="room-feature" data-animation="fadeInUp" data-delay="50ms">
                  <li><h3> Descripcion:</h3> <a class="text-justify">Ideal para pasar agradables momentos y convivir en familia, cuenta con sala, cocina integral equipada con utensilios básicos, ventilador, aire acondicionado, baño completo, tv con cable y DOS recámaras totalmente independientes; la primera con UNA cama matrimonial: la segunda con DOS camas matrimoniales.</a></li>
                </ul>
                <a href="https://youtu.be/QNYsh69bDhQ" target="_blank"  class="btn roberto-btn mt-30" data-animation="fadeInUp" data-delay="700ms">Ver video</a>
            </div>
        </div>
        <div class="single-room-slide d-flex align-items-center">
            <!-- Thumbnail -->
            <div class="room-thumbnail h-100 bg-img" style="background-image: url(img/villa4.jpg);"></div>
            <!-- Content -->
            <div class="room-content">
                <h2 data-animation="fadeInUp" data-delay="50ms">Suite 6 Pers</h2>
                <ul class="room-feature" data-animation="fadeInUp" data-delay="50ms">
                 <li><h3> Descripcion:</h3> <a class="text-justify">Un lujo perfecto con un ambiente acogedor para nuestras familias, cuenta con dos camas queen size y dos sofás individuales, televisión, ventilador, aire acondicionado, cocina integral equipada con utensilios básicos, baño de lujo, amplia sala cocina, comedor, balcón privado con vista a la avenida jacarandas y balcón común con vista a la alberca.</a></li>
                </ul>
                <a href="https://youtu.be/m0NFG9tWu1o" target="_blank" class="btn roberto-btn mt-30" data-animation="fadeInUp" data-delay="700ms" >Ver video</a>
            </div>
        </div>
    </div>
</section>
    <!--Galery-->
   
    <br><br>
     <h1 class="text-center">Galeria</h1>
    <section id="galeria">
        
    <div class="container">
        <div class="row">
    <a data-fancybox="gallery" href="img/f2.JPG"><img src="img/sm/f2.jpg"></a>
    <a data-fancybox="gallery" href="img/f4.jpg"><img src="img/sm/f4.jpg"></a>
    <a data-fancybox="gallery" href="img/f5.jpg"><img src="img/sm/f5.jpg"></a>
    <a data-fancybox="gallery" href="img/f6.jpg"><img src="img/sm/f6.jpg"></a>
    <a data-fancybox="gallery" href="img/f7.jpg"><img src="img/sm/f7.jpg"></a>
    <a data-fancybox="gallery" href="img/f8.jpg"><img src="img/sm/f8.jpg"></a>
    <a data-fancybox="gallery" href="img/f9.jpg"><img src="img/sm/f9.jpg"></a>
    <a data-fancybox="gallery" href="img/f10.jpg"><img src="img/sm/f10.jpg"></a>
    <a data-fancybox="gallery" href="img/f11.jpg"><img src="img/sm/f11.jpg"></a>
    <a data-fancybox="gallery" href="img/f12.jpg"><img src="img/sm/f12.jpg"></a>
    <a data-fancybox="gallery" href="img/f13.jpg"><img src="img/sm/f13.jpg"></a>
    <a data-fancybox="gallery" href="img/f14.jpg"><img src="img/sm/f14.jpg"></a>
    </div>
  </di>
  </section>
    
    


<br>
    <br><br>
        <!--SERVICIOS-->
<section  id="section2" >
 
      <div class="container">
            <h1 class="text-center">Servicios</h1>
      	<div class="row">
 
 			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

 					<div class="box-part text-center">

                         <i class="fa fa-tint fa-3x" aria-hidden="true"></i>

 						<div class="title">
 							<h4>ALBERCA</h4>
 						</div>

 						<div class="text">
 							<span>Alberca con bar y camastros para que usted pueda descansar y disfrutar los rayos del sol.</span>
 						</div>



 					 </div>
 				</div>

 				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

 					<div class="box-part text-center">

 					    <i class="fa fa-car fa-3x" aria-hidden="true"></i>

 						<div class="title">
 							<h4>ESTACIONAMIENTO</h4>
 						</div>

 						<div class="text">
 							<span>Contamos también con estacionamiento y amplios jardines.</span>
 						</div>



 					 </div>
 				</div>

 				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

 					<div class="box-part text-center">

                         <i class="fa fa-wifi fa-3x" aria-hidden="true"></i>

 						<div class="title">
 							<h4>WI-FI</h4>
 						</div>

 						<div class="text">
 							<span>Para que no pierda la conexión, contamos con Internet Wi Fi</span>
 						</div>



 					 </div>
 				</div>
 		</div>
     </div>

    
</section>

<br>
    <br><br>
    <section id="section3" >
        <h1 class="text-center">Ubicacion</h1>
         <div id="myButton" onclick="window.location = 'https://goo.gl/maps/sttqwfHzS1ycqay16';"   class="container  d-flex justify-content-around">
            
             <div> 
        <iframe  src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d476685.6456279401!2d-105.442959!3d21.02842!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe414933fa9da3484!2sVillas%20Dulce%20Sue%C3%B1os!5e0!3m2!1ses-419!2sus!4v1574395837412!5m2!1ses-419!2sus" width="1000" height="400" frameborder="0" style="border:0;" allowfullscreen="1"></iframe></div>
    </div>
    </section>
    <br>
    <br><br>
<!-- Our Room Area End -->
@endsection

      
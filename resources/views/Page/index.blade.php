<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Portal web CBA</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!--favicon-->
      <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
      <!-- bootstrap css -->
      @vite(['resources/sass/app.scss', 'resources/js/app.js'])
      <!-- style css -->
      <link rel="stylesheet" href="{{asset('css/plantilla/index.css')}}">
      <!-- Responsive-->
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{asset('css/plantilla/jquery.mCustomScrollbar.min.css')}}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="{{asset('imgp/loading.gif')}}" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="d-flex">
                  <div class="">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="index.html"><img src="{{asset('imgp/logo2.png')}}" alt="logo" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="d-flex justify-content-end align-items-center" style="flex: 1">
                    @guest
                        <ul class="d-flex">
                            <li class="nav-item">
                                <a href="{{route('login')}}" class="login_btn nav-item">Iniciar sesión</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('register')}}" class="login_btn nav-item">Crear cuenta</a>
                            </li>
                        </ul>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-black bg-white px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @can('Dashboard')
                                    <a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a>
                                @endcan
                                <a class="dropdown-item" href="{{route('perfil')}}">Configuracion</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">Cerrar sesion</button>
                                </form>
                            </div>
                        </li>
                    @endguest
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- inicio -->
      <section class="banner_main">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-xl-6 col-lg-6 col-md-6 ">
                   <div class="text-bg">
                     <h1>Conoce nuestros programas</h1>
                     <span>
                        CBA centro de oportunidades. <br> 
                     </span>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6 col-md-6 padding_lert2">
                 
                  <div class="text-img">
                     <center><figure>
                        <img src="{{asset('imgp/mmm.png')}}" alt="fondo1"/>
                     </figure></center>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- fin del inicio -->
        <!-- objetivo -->
      <div class="about">
         <div class="container">
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  <div class="titlepage">
                     <span>Objetivo</span>
                     <h2>Como ayudarte a conocer más del CBA</h2>
                     <p>Nosotros estamos buscando tu comodidad a la hora de inscribirte en el CBA tratando de enseñar todas las ventajas de contar con nosotros y para que tomes la decisión de estudiar con nosotros <br><br>Por este medio te brindamos una total asesoria para que sepas la duración como se implementaran los raps que se estaran enseñando si se decide conocer la especialidad de ADSO
                        queremos que otros estudiantes como nosotros conozcan por que nosotros elegimos estudiar esto y por que es tan bueno tanto en la vida laboral como genera buenos ingresos economicos.
                         <br><br>los usuarios que deseen conocer diferentes caracteristicas de nuestro servicio los invitamos a seguir visualizando nuestra pagina y conocer un poco mas del </p>
                    <p><b>Centro de biotecnologia agropecuario.</b></p>
                  </div>
               </div>
            </div>
            <div class="row">
            <div class="">
                <div class="about_box">
                    <figure><img src="{{asset('imgp/administración 1.jpg')}}" alt="#"/></figure>
                </div>
            </div>
            </div>
        </div>
    </div>
           
         <!-- fin del objetivo -->
      <!-- programas -->
      <div class="classified">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <span>CONOCE MÁS</span>
                     <h2>PODRAS VISUALIZAR MÁS A FONDO SOBRE NUESTROS PROGRAMAS</h2>
                  </div>
               </div>
            </div>
                <div class="row">
                    @foreach ($Programas as $programa)
                        <div class="col-xl-4 col-lg-4 col-md-4 margin_bott">
                            <div class="classified_box">
                                <figure><img src="{{Storage::url($programa->imagen)}}" alt="#"/></figure>
                                <a href="{{route('landingPage', $programa->slug)}}"><h3>{{$programa->NombrePrograma}}</h3></a>
                                <p>{{$programa->DescripcionCorta}} </p>
                            </div>
                        </div>
                    @endforeach
                </div>  
               <br>
               <br>
               <div style="text-align: center">
                  <a href="">
                    <button class="btn success" >Agregar Programa</button>
                    </a>
                </div> 
      <div id="contact" class="contact">
         <div class="container">
            <div class="row d_flex">
               <div class="col-md-6">
                  <div class="contact_box">
                     <div class="titlepage">
                        <span>Contactanos</span>
                        <h2>Contacta con nosotros</h2>
                     </div>   
                     <p>
                        Dirección: <br>
                        Kilómetro 7, vía Mosquera <br>
                        Telefono: <br>
                        (601) 154-62323 <br>
                        Email: <br>
                        insymadsoportal@gmail.com 
                     </p>                       
                  </div>
               </div>
               <div class="col-md-6">
                  <form  class="main_form">
                     <div class="row">
                        <div class="col-md-12 ">
                           <input class="contactus" placeholder="Nombre" type="text" name="Name"> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Número celular" type="tel" name="celular"> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Correo" type="email" name="email">                          
                        </div>
                        <div class="col-md-12">
                           <textarea name="mensaje" id="mensaje" cols="10" rows="2" placeholder="Escriba su mensaje" class="textarea" ></textarea>
                        </div>
                        <div class="col-sm-12">
                           <button class="send_btn">Enviar</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- fin de comtactanos -->
      <!-- Carrusel -->
      <div class="testimonial">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Nosotros</h2>
                     <p>un poco de nuestra historia y lo que queremos hacer</p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  <div id="myCarousel" class="carousel slide testimonial_Carousel " data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                     </ol>
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <div class="container">
                              <div class="carousel-caption ">
                                 <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-12 margin_boot">
                                       <div class="test_box1">
                                          <figure><img src="{{asset('imgp/tecnoly.jpg')}}" alt="#"/></figure>
                                       </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-8 col-md-12">
                                       <div class="test_box">
                                          <i><img src="{{asset('imgp/te1.png')}}" alt="#"/></i>
                                          <p>
                                             Adso se encarga de desarrolla competencias en: Habilidades de comunicación oral y escrita. Conocimiento y manejo de tecnologías 
                                             que soportan el desarrollo de software. Habilidades para el análisis, diseño y desarrollo de aplicativos de software, especialmente
                                             web y dispositivos móviles.
                                          </p>
                                          <i class="flot_right"><img src="{{asset('imgp/te2.png')}}" alt="#"/></i>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="container">
                              <div class="carousel-caption">
                                 <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-12 margin_boot">
                                       <div class="test_box1">
                                          <figure><img src="{{asset('imgp/tecnoly.jpg')}}" alt="#"/></figure>
                                       </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-8 col-md-12">
                                       <div class="test_box">
                                          <i><img src="{{asset('imgp/te1.png')}}" alt="#"/></i>
                                          <p>
                                             Queremos que los nuevos aprendices que deseen ingresar al sena se sientan seguros de lo que elijen conozcan un poco más del CBA 
                                             donde puedan hacer un mini recorrido por los diferentes apartados que les ofrecemos y como nuevos siempre tenemos preguntas queremos 
                                             saber un poco mas de donde estaremos estudiando entre otras cosas y que mejor que nosotros para ayudarles con eso.
                                          </p>
                                          <i class="flot_right"><img src="{{asset('imgp/te2.png')}}" alt="usuario"/></i>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="container">
                              <div class="carousel-caption">
                                 <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-12 margin_boot">
                                       <div class="test_box1">
                                          <figure><img src="{{asset('imgp/tecnoly.jpg')}}" alt="usuario"/></figure>
                                       </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-8 col-md-12">
                                       <div class="test_box">
                                          <i><img src="{{asset('imgp/te1.png')}}" alt="#"/></i>
                                          <p>
                                             Nuestro publico objetivo es los aprendices nuevos y que los que ya ingresaron se orienten un poco sobre todo lo que veran en lo que estan estudiando 
                                             con los espacios que cuenta el sena,con lo que el sena les puede ofrecer para empezar una vida laboral y tener todos los conocimientos necesarios con anticipacion 
                                             para terminar satisfactoriamente sus estudios y
                                          </p>
                                          <i class="flot_right"><img src="{{('imgp/te2.png')}}" alt="usuario"/></i>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                     <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                     <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         
      </div>
      <!-- Fin del carrusel-->
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4644.341978578333!2d-74.21820092438342!3d4.695709041699507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9d58cf6e291b%3A0x8946ec678fcf04b4!2sSENA%20Mosquera%20-%20Centro%20de%20Biotecnología%20Agropecuaria%20(CBA)!5e1!3m2!1ses-419!2sco!4v1716822480771!5m2!1ses-419!2sco" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <!--  Final -->
      <footer >
         <div class="d-flex justify-content-center gap-2 align-items-center text-white border-top wow fadeIn">
            <p class="mb-0 py-3 small">&copy; Copyright <script>document.write(new Date().getFullYear())</script></p>
            <p class="small">Todos los derechos reservados</p>
        </div>
      </footer>
      <!-- Fin del final -->
      <!-- Javascript files-->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      <script src="{{asset('js/plantilla/bootstrap.bundle.min.js')}}"></script>
      <!-- sidebar -->
      <script src="{{asset('js/plantilla/custom.js')}}"></script>
</body>
</html>

@extends('layouts.app')
@section('title', 'Portal')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/inicio.css') }}">
      <!-- bootstrap css -->
      <!-- style css -->
      <link rel="stylesheet" href="/css/plantilla2/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="/css/plantilla2/responsive.css">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="/css/plantilla2/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]-->
      
@endsection

@section('content')
    <h1 class="text-center text-sena-green">{{$programa->NombrePrograma}}</h1>
    <p class="text-center">{{$programa->Descripcion}}</p><br><br>
    <div class="loader_bg">
         <div class="loader"><img src="/imgp/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
      <section class="banner_main">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-xl-6 col-lg-6 col-md-6 ">
                   <div class="text-bg">
                     <h1>Análisis Y desarrollo de software</h1>
                     <span>
                        Nuevos avances, nuevas tecnologías 
                        y más conocimientos. <br> 
                     </span>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6 col-md-6 padding_lert2">
                 
                  <div class="text-img">
                     <figure><img src="/imgp/fondo1.png" alt="fondo1"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </section>
      
      
@endsection

@section('Scripts')
<!-- end footer -->
      <!-- Javascript files-->
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <script src="/js/plantilla2/jquery.min.js"></script>
      <script src="/js/plantilla2/popper.min.js"></script>
      <script src="/js/plantilla2/bootstrap.bundle.min.js"></script>
      <script src="/js/plantilla2/jquery-3.0.0.min.js"></script>
      <script src="/js/plantilla2/plugin.js"></script>
      <!-- sidebar -->
      <script src="/js/plantilla2/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="/js/plantilla2/custom.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
@endsection
<div>
    <header id="inicio" class="container__cover div__offset">
        <div class="cover">
            <section class="text__cover">
                <h1>Instructores del CBA en el programa {{$programa->NombrePrograma}}</h1>
            </section>
        </div>
</header>
    <div class="container__about div__offset">
        <div class="about" id="buscar">
            <div class="text__about">
                <h1>Buscar Instructor</h1>
                <p> Nuestra función de búsqueda rápida te ayudará a encontrar fácilmente a los instructores del SENA que se ajusten a tus necesidades y preferencias.</p><br>
                <form action="#swipe" method="GET" class="filtro-form">
                    <input type="text" name="instructor" placeholder="Nombre del instructor">
                    <button type="submit">Buscar</button>
                  </form>
            </div>   
            <div class="image__about">
                <img src="{{Storage::url('imagenes/logo.png')}}" alt="">
            </div>
        </div>
    </div>
    <div class="container__trust container__card-primary" id="areas">
        <div class="trust card__primary">
            <div class="text__trust text__card-primary">
                
                <h1>Áreas de Estudio </h1>
                <p>Explora nuestras diversas áreas de estudio.Utiliza nuestros filtros por área de estudio para encontrar instructores especializados en el campo que te interese.</p>
            </div>
            <div class="container__trust container__box-cardPrimary">
            <div class='card__trust box__card-primary'><img src='img/user.png' alt><br><a href="?area=#swipe">Todas las carreras</a></div>
            {{-- <?php
    // Consulta para obtener las carreras disponibles
    $consultaCarreras = "SELECT DISTINCT area FROM tinstructores";
    $resultadoCarreras = mysqli_query($conexion, $consultaCarreras);
    
    while ($filaCarrera = mysqli_fetch_assoc($resultadoCarreras)) {
      $carrera = $filaCarrera["area"];
      $selected = ($carrera == $filtroCarrera) ? "selected" : "";
      echo "<div class='card__trust box__card-primary'>
      <img src='img/user.png' alt=''>
      <br>
      <a href='?area=$carrera#swipe' $selected>$carrera</a>
    </div>";
    }
    ?>
    </div>
    </div>
    
    <section id="swipe" class="swiper mySwiper">
    <h2>Listado de instructores</h2>
    <div class="swiper-wrapper">
    <?php
    // Consulta SQL con filtro de carrera y búsqueda rápida
    $consulta = "SELECT * FROM tinstructores";
    if (!empty($filtroCarrera)) {
    $consulta .= " WHERE area = '$filtroCarrera'";
    }
    
    if (isset($_GET['instructor'])) {
    $instructor = $_GET['instructor'];
    $consulta .= " WHERE (nombres LIKE '$instructor' OR apellidos LIKE '$instructor')";
    }
    
    $resultado = mysqli_query($conexion, $consulta);
    
    while ($fila = mysqli_fetch_assoc($resultado)) {
    $id = $fila["ID"];
    $nombres = $fila["nombres"];
    $apellidos = $fila["apellidos"];
    $area = $fila["area"];
    $imagen = $fila["imagen"];
    echo "
    <div class='card swiper-slide'>
      <div class='card__image'>
        <img src='$imagen' alt='card image'>
      </div>
      <div class='card__content'>
        <span class='card__title'>$nombres $apellidos</span>
        <span class='card__instructor'>$area</span>
        <a href='info_instructor.php?id=$id'>Ver Información</a>
        <a  href='?id=$id#form_editar' id='btn-editar'>Editar</a>
        <a href='?eliminar=$id'>Eliminar</a><br>
      </div>
    </div>";
    }
    // Verificar si se ha enviado el ID del registro a eliminar
    ?>
    </div>
    </section>
    <?php
    /*form editar*/
    if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo '<section class="form">
    <form action="#swipe" id="form_editar" method="POST" enctype="multipart/form-data">
    <h2>Editar Instructor</h2>
    <label for="nombres">Nombres:</label>
    <input type="text" name="nombres" value="'.$fila_profesor['nombres'].'" required><br>
    
    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" value="'.$fila_profesor['apellidos'].'" required><br>
    
    <label for="correo_electronico">Correo Electrónico:</label>
    <input type="email" name="correo_electronico" value="'.$fila_profesor['correo_electronico'].'" required><br>
    
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" value="'.$fila_profesor['telefono'].'" required><br>
    
    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen"><br>
    
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required>'.$fila_profesor['descripcion'].'</textarea><br>
    
    <label for="especialidad">Especialidad:</label>
    <input type="text" name="especialidad" value="'.$fila_profesor['especialidad'].'" required><br>
    
    <label for="area">Area:</label>
    <input type="text" name="area" value="'.$fila_profesor['area'].'" required><br>
    
    <label for="competencias">Competencias (separadas por guion "-"):</label>
    <textarea name="competencias" required>'.$fila_profesor['competencias'].'</textarea><br>
    
    <label for="jornada">Jornada:</label>
    <select name="jornada" required>
    <option value="manana" '.($fila_profesor['jornada'] === 'manana' ? 'selected' : '').'>mañana</option>
    <option value="tarde" '.($fila_profesor['jornada'] === 'tarde' ? 'selected' : '').'>tarde</option>
    <option value="mixta" '.($fila_profesor['jornada'] === 'mixta' ? 'selected' : '').'>mixta</option>
    <option value="nocturna" '.($fila_profesor['jornada'] === 'nocturna' ? 'selected' : '').'>nocturna</option>
    </select><br>
    
    <input type="submit" name="envio_editar" value="Actualizar Información">
    </form>
    </section>';
    }
    ?> --}}
    
    <section class="form" id="form_nuevo">
    <form action="#swipe" method="POST"  enctype="multipart/form-data">
    <h2>Informacion Basica</h2>
    <label for="nombres">Nombres:</label>
    <input type="text" name="nombres"  required><br>
    
    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" required><br>
    
    <label for="correo_electronico">Correo Electrónico:</label>
    <input type="email" name="correo_electronico" required><br>
    
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono"  required><br>
    
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required></textarea><br>
    
    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen" required><br>
    
    <label for="especialidad">Especialidad:</label>
    <input type="text" name="especialidad" required><br>
    
    <label for="area">Area:</label>
    <input type="text" name="area" required><br>
    
    <label for="competencias">Competencias (separadas por guion "-"):</label>
    <textarea name="competencias" required></textarea><br>
    
    <label for="jornada">Jornada:</label>
    <select name="jornada" required>
    <option value="manana" >mañana</option>
    <option value="tarde">tarde</option>
    <option value="mixta">mixta</option>
    <option value="nocturna">nocturna</option>
    </select><br>
    <input type="submit" name="envio" value="Ingresar nuevo instructor">
    </form>
    </section>
</div>

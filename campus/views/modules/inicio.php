<!-- Header -->
<header class="masthead">
    <div class="container">
  <img class="img-fluid" src="img/escudo.png" alt="EscudoColegio5159">
        <div class="intro-text">
            <span class="name">Bienvenidos</span>
            <hr class="star-light">
        </div>
    </div>
</header>

<?php

//echo $_SESSION["typeUser"];
if(isset($_SESSION["typeUser"])){
	switch ($_SESSION["typeUser"]) {
      case 'Preceptor/a':
            include "views/modules/portada/inicioPreceptor.php";
            break;
      case 'Director/a':
            include "views/modules/portada/inicioDirector.php";
            break;
      case 'Alumno':
            include "views/modules/portada/inicioAlumno.php";
            break;
      case 'Admin':
            include "views/modules/portada/inicioAdmin.php";
            break;
      default:
      # code...
      break;
    }
    }

?>



<!--<br><br>

    <div class="container">

          <div class="starter-template">

              <center>
              <h3>Bienvenidos</h3>
<br><img src="img/escudo.png" alt="EscudoColegio5159">
</center>
          </div>

        </div>
<br><br>

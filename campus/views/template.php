<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Campus DBMS-Conectar</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="views/css/shop-homepage.css" rel="stylesheet">
    <link href="views/css/misEstilos.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
		<?php
	//echo $_SESSION["typeUser"];
	  //<link rel="stylesheet" href="views/bootstrap/bootstrap.min.css">

	if(isset($_SESSION["typeUser"])){
		switch ($_SESSION["typeUser"]) {
			case 'Admin':
				include "modules/navegacion/navAdmin.php";
				break;
			case 'Alumno':
					include "modules/navegacion/navAlumno.php";
					break;
			case 'Docente':
					include "modules/navegacion/navDocente.php";
					break;
			case 'Preceptor/a':
							include "modules/navegacion/navPreceptor.php";
							break;
			case 'Director/a':
							include "modules/navegacion/navDirector.php";
							break;
			case 'Vicedirector/a':
							include "modules/navegacion/navVicedirector.php";
							break;
				default:
				# code...
				break;
		}
	}else{
		include "modules/navegacion/navInicial.php";
	}
	?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h4 class="my-4"><img height="80" src="img/iconos/iconoCurso.png" alt="">Mis Cursos</h4>
          <div class="list-group">
            <a href="#" class="list-group-item"><img class="img-fluid float-right" src="img/iconos/boton-de-reproduccion.png" ></img>Category 1</a>
            <a href="#" class="list-group-item"><img class="img-fluid float-right" src="img/iconos/boton-de-reproduccion.png" ></img>Category 2</a>
            <a href="#" class="list-group-item"><img class="img-fluid float-right" src="img/iconos/boton-de-reproduccion.png" ></img>Category 3</a>
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="img/carrusel/scratch.png" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="img/carrusel/servidores.png" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="img/carrusel/fotografia.png" alt="Third slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="img/carrusel/PERFECT.png" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="img/cursos/scratchCurso.png" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Programando con Scratch</a>
                  </h4>
                  <h5>Próximamente</h5>
                  <h6><b>A cargo de: Margarita Ruiz</b></h6>
                  <p class="card-text">Crea historias, juegos y animaciones....</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="img/cursos/linuxCurso.png" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Operador GNU/Linux</a>
                  </h4>
                  <h5>Próximamente</h5>
                  <h6><b>A cargo de: Claudio Sosa</b></h6>
                  <p class="card-text">Profundiza tus conocimientos y se capaz de administrar los procesos del sistema operativo. Aprende comandos Unix y GNU...</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="img/cursos/fotografia.png" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Fotografía y Edición digital</a>
                  </h4>
                  <h5>Próximamente</h5>
                  <h6><b>A cargo de:Julio Vidaurre - Claudia Bautista</b></h6>
                  <p class="card-text">Curso de fotografia y edicion digital......</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Item Four</a>
                  </h4>
                  <h5>$24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Item Five</a>
                  </h4>
                  <h5>$24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Item Six</a>
                  </h4>
                  <h5>$24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>

          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>DBMS-Conectar</title>
   	<meta charset="utf-8" />
   	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   	<meta name="description" content="Sistema de administración de base de datos de Conectar Salta">
   	<meta name="keywords" content="conectar,dbms,salta">
   	<link rel="shortcut icon" href="img/iconos/favicon.ico">
   	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="gmap/gmaps.js"></script>
  <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css" />

   	<link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>
   	<link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
   	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
   	<link rel="stylesheet" href="css/estilos.css"/>
	</head>
	<body>
		<div id="principal">
			<header id="encabezado">
            <?php
					if (file_exists($path_modulo6))
		       		include ($path_modulo6);
					else
		       		die ('error al cargar el modulo');
      			?>
      	</header>
         <nav id="menu">
                <?php
                if (file_exists($path_modulo2))
		       		include ($path_modulo2);
                else
		       		die ('error al cargar el modulosssss');
      			?>
         </nav>
         <section id="central">
         	<article>
         		<?php
	   	 			if (file_exists($path_modulo7))
		   	    		include ($path_modulo7);
		   			else
		       			die ('error al cargar el modulo');
      			?>
      		</article>
			</section>
    		<aside id="derecha">
	 			<?php
	    		if (file_exists($path_modulo4))
		       		include ($path_modulo4);
		   	else
		       		die ('error al cargar el modulo');
      			?>
			</aside>
        	<footer id="pie">
        		<?php
       			if (file_exists($path_modulo5))
	       			include ($path_modulo5);
	 				else
	       			die ('error al cargar el modulo');
      		?>
			</footer>
		</div>
	</body>
</html>

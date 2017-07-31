<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
    		<title>DBMS-Conectar</title>
       	<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
       	<meta name="description" content="Sistema de administración de base de datos de Conectar Salta">
       	<meta name="keywords" content="conectar,dbms,salta">
       	<link rel="shortcut icon" href="img/iconos/logo_icono.png">
				<script src="js/jquery-3.1.0.min.js"></script>
			 <script src="js/bootstrap.min.js"></script>

				<script type="text/javascript" src="jquery/jquery.tablesorter.js"></script>
				<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
				<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	        <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>
       	<link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
       	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
       	<link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>

				<link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
				<script src="js/fileinput.min.js"></script>
				<script src="js/locales/es.js"></script>
        <!-- Optional theme -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
				-->
	</head>
	<body>
    		<div class="container">
    			   <header>

          	 </header>
						 <article>
							 <?php
						 if (file_exists($path_modulo6))
								 include ($path_modulo6);
						 else
								 die ('error al cargar el modulo');
						 ?>
					 </article>
					 <?php

					 if (isset($_SESSION["nombre"])) {
             echo '<nav class="navbar navbar-inverse" >';

                    if (file_exists($path_modulo2))
    		       		     include ($path_modulo2);
                    else
    		       		     die ('error al cargar el modulosssss');
												echo '</nav>';

												echo '<article>';

					 						 if (file_exists($path_modulo1))
					 								 include ($path_modulo1);
					 						 else
					 								 die ('error al cargar el modulo');

					 					 echo '</article>';
											}

	   		 		?>
             <div class="row">
                 	<article>
                 		<?php
        	   	 			if (file_exists($path_modulo7))
        		   	    		include ($path_modulo7);
        		   			else
        		       			die ('error al cargar el modulo');
              			?>
              		</article>
    			   </div>

              <footer>
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

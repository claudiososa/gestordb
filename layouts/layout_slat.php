<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
    		<title>Cóndor</title>
       	<meta charset="utf-8" />
				<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
       	<meta name="description" content="Sistema de administración de base de datos de Conectar Salta">
       	<meta name="keywords" content="conectar,dbms,salta">
       	<link rel="shortcut icon" href="includes/mod_cen/css/login/condor.png">

				<?php
				if ($_SESSION['tipo']=='admin' OR $_SESSION['tipo']=='PRUEBA' OR $_SESSION['tipo']=='Coordinador') {
					?>
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
					<script src="js/jquery-3.1.0.min.js"></script>
					<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
					<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

					<script type="text/javascript" src="new/js/jsPortada.js"></script>
					<link href="new/img/open-iconic-master/font/css/open-iconic-bootstrap.css" rel="stylesheet">
					<link rel="stylesheet" href="new/css/style.css">

					<script type="text/javascript" src="jqueryui/jquery-ui.min.js"></script>
					<script src="js/jquery-ui.js"></script>
					<link rel="stylesheet" href="css/jquery-ui.css">
					<link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
					<script src="js/fileinput.min.js"></script>
					<script src="js/locales/es.js"></script>
					<link rel="stylesheet" href="css/style.css"/>
					<?php
				}else{
					?>
					<script src="js/jquery-3.1.0.min.js"></script>
					<script type="text/javascript" src="jqueryui/jquery-ui.min.js"></script>
					<script src="js/bootstrap.min.js"></script>
					<link rel="stylesheet" href="css/bootstrap.css?1"/>
					<script type="text/javascript" src="jquery/jquery.tablesorter.js"></script>
					<link rel="stylesheet" href="css/jquery-ui.css">
					<script src="js/jquery-ui.js"></script>


					<script src="tablas/xlsx.core.min.js"></script>
	        <script src="tablas/FileSaver.min.js"></script>

	        <script src="tablas/tableexport.min.js"></script>
					<!--<script src="tablas/js-xlsx-master/dist/xlsx.core.min.js"></script>
					<script src="tablas/Blob.min.js"></script>
					<script src="tablas/FileSaver.js-master/FileSaver.min.js"></script>
					<script src="tablas/TableExport-master/dist/js/tableexport.min.js"></script>-->




	       	<link rel="stylesheet" href="css/style.css"/>

					<script type="text/javascript" src="js/wow.min.js"></script>
					<link rel="stylesheet" href="css/animate.min.css">

					<link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
					<script src="js/fileinput.min.js"></script>
					<script src="js/locales/es.js"></script>
					<link rel="stylesheet" href="includes/mod_cen/css/login.css"/>
					<?php
				}

				?>



        <!-- Optional theme -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
				-->
	</head>
	<body>

		<?php
		 if ($_SESSION['tipo'] <> 'Coordinador' AND $_SESSION['tipo'] <> 'admin') {
		  if (file_exists($path_modulo6)){
		 	include ($path_modulo6);
		  }else{
		 	die ('error al cargar el modulosssss');
		  } 
	     }

					 if ($_SESSION['tipo']=='admin' OR $_SESSION['tipo']=='Coordinador') {
             // echo '<nav class="navbar navbar-default" >';

                    if (file_exists($path_modulo2)){

    		       		     include ($path_modulo2);
                    }else{
    		       		     die ('error al cargar el modulosssss');
										}
							// echo '</nav>';
							// echo '<article>';

							 if (file_exists($path_modulo1))
		 								 include ($path_modulo1);
	 						 else
		 								 die ('error al cargar el modulo');


		 					 // echo '</article>';
						 }else{

									 echo '<nav class="navbar navbar-default" >';

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

						<!-- se comenta ROW Y article para portada admin-->
             <!-- <div class="row"> -->
                 	<!-- <article> -->
                 		<?php
        	   	 			if (file_exists($path_modulo7))
        		   	    		include ($path_modulo7);
        		   			else
        		       			die ('error al cargar el modulo');
              			?>
              		<!-- </article> -->
    			   <!-- </div> -->

              <footer>
            		<?php
           			if (file_exists($path_modulo5))
    	       			include ($path_modulo5);
    	 				  else
    	       			die ('error al cargar el modulo');
          		  ?>
    			   </footer>
    		<!-- </div> -->

	</body>
</html>

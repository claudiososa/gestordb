<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
    		<title>Cóndor</title>
       	<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
       	<meta name="description" content="Sistema de administración de base de datos de Conectar Salta">
       	<meta name="keywords" content="conectar,dbms,salta">
       	<link rel="shortcut icon" href="includes/mod_cen/css/login/condor.png">
				<script src="js/jquery-3.1.0.min.js"></script>
				<script type="text/javascript" src="jqueryui/jquery-ui.min.js"></script>
			 <script src="js/bootstrap.min.js"></script>

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
        <link rel="stylesheet" href="css/bootstrap.css?1"/>
				<script type="text/javascript" src="js/wow.min.js"></script>
				<link rel="stylesheet" href="css/animate.min.css">

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

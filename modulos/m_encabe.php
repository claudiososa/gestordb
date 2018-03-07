	<?php 
		if (!empty($_GET['ide']))
		{
		$id=$_GET['ide']; 
		switch ($ide) { 
			case 1: 
				include("includes/mod_encabe/cambiante.php"); 
				break;
			//   default: 
			 //      include("pagina_por_defecto.php"); 
			// estado default .. nos determina el estado 
			// "si no es ninguna opcion de las anteriores". 
		} 
		}
			else {
			include("includes/mod_encabe/principal.php"); 
			//echo "modulo principal de contenidos";
			}
	?>

	<?php 
		if (!empty($_GET['idp']))
		{
		$id=$_GET['idp']; 
		switch ($idp) { 
			case 1: 
				include("includes/mod_pie/cambiante.php"); 
				break;
			//   default: 
			 //      include("pagina_por_defecto.php"); 
			// estado default .. nos determina el estado 
			// "si no es ninguna opcion de las anteriores". 
		} 
		}
			else {
			include("includes/mod_pie/principal.php"); 
			//echo "modulo principal de contenidos";
			}
	?>
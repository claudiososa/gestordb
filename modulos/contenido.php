	<?php 
		if (!empty($_GET['id']))
		{
		$id=$_GET['id']; 
		switch ($id) { 
			case 1: 
				include("includes/mod_con/form_aviso.php"); 
				break;
			case 2: 
				include("includes/mod_con/pro_aviso.php"); 
				break;
			case 3: 
				include("includes/mod_con/listaxcategoria.php"); 
				break;
			case 4: 
				include("includes/mod_con/mostraranuncio.php"); 
				break;
			case 5: 
				include("includes/mod_con/buscar.php"); 
				break;
			case 6: 
				include("includes/mod_con/paginas.php"); 
				break;

			//default:                           
			 //      include("pagina_por_defecto.php"); 
			// estado default .. nos determina el estado 
			// "si no es ninguna opcion de las anteriores". 
		} 
		}
			else {
			include("includes/mod_con/principal.php"); 
			//echo "modulo principal de contenidos";
			}
	?>
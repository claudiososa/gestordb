	<?php 
		if (!empty($_GET['tit']))
		{
		 $result=mysql_query("select * from avisos where avi_num ='$_GET[anuncio]'");
		 //mysql_query("SET NAMES 'utf8'"); 
		 $row=mysql_fetch_row($result);	
		 include("includes/mod_tit/cambiante.php"); 
			//   default: 
			 //      include("pagina_por_defecto.php"); 
			// estado default .. nos determina el estado 
			// "si no es ninguna opcion de las anteriores". 
		}else {
			include("includes/mod_tit/principal.php"); 
			//echo "modulo principal de contenidos";
			}
	?>

	<?php 
		if (!empty($_GET['id']) AND isset($_SESSION["tipo"]))
		{	
		$id=$_GET['id'];
		$men=$_GET['men']; 
		switch ($men){
			case "personas":
				switch ($id) { 
					case 1: 
						include("includes/mod_der/persona/persona_ver.php"); 
						break;
					case 2: 
						include("includes/mod_der/persona/persona_vermas.php"); 
						break;
					case 3:
						//include("includes/mod_der/persona/persona_editar.php");
						break;
					case 4:
						//include("includes/mod_der/persona/persona_editado.php");
						break;
					case 5:
						include("includes/mod_der/persona/persona_eliminar.php");
						break;
					case 7:
						include("includes/mod_der/persona/persona_agregar.php");
						break;
					case 8:
						include("includes/mod_der/persona/persona_agregado.php");
						break;	
				}
				break;			
				
			case "referentes":
				switch ($id) { 
					case 1: 
						include("includes/mod_der/referente_ver.php"); 
						break;
					case 2: 
						include("includes/mod_der/referente_vermas.php"); 
						break;
					case 3:
						//include("includes/mod_der/referente_editar.php");
						break;
					case 4:
						include("includes/mod_der/referente_editado.php");
						break;
					case 5:
						include("includes/mod_der/referente_eliminar.php");
						break;
					case 6:
						include("includes/mod_der/referente_cambiaretj.php");
						break;	
					case 7:
						//include("includes/mod_der/referente_agregar.php");
						break;
				}
				break;
				
			case "escuelas":
				switch ($id) { 
					case 1: 
						if($_SESSION['tipo']=='admin') {
							include("includes/mod_der/admin/l_crear.php"); 
						}						
						break;
					case 2: 
						include("includes/mod_der/escuela_vermas.php"); 
						break;
					case 3:
						//include("includes/mod_der/escuela_editar.php");
						break;
					case 4:
						//include("includes/mod_der/escuela_editado.php");
						break;
					case 5:
						include("includes/mod_der/escuela_eliminar.php");
						break;
				}
				break;
				
			case "rtis":
				switch ($id) { 
					case 1: 
						include("includes/mod_der/rti_ver.php"); 
						break;
					case 2: 
						include("includes/mod_der/rti_vermas.php"); 
						break;
					case 3:
						//include("includes/mod_der/rti_editar.php");
						break;
					case 4:
						include("includes/mod_der/rti_editado.php");
						break;
					case 5:
						include("includes/mod_der/rti_eliminar.php");
						break;
					case 6:
						include("includes/mod_der/rti_editarescuela.php");
						break;	
				}
				break;
			case "admin":
				switch ($id) { 
				case 1: 
						include("includes/mod_der/admin/l_crear.php"); 
						break;
				case 2: 
						//include("includes/mod_cen/referente_ett.php"); 
						break;		
									
				}	
				break;
				
			case "dires":
				switch ($id) { 
					case 1: 
						include("includes/mod_der/director_ver.php"); 
						break;
					case 2: 
						include("includes/mod_der/director_vermas.php"); 
						break;
					case 3:
						include("includes/mod_der/director_editar.php");
						break;
					case 4:
						include("includes/mod_der/director_editado.php");
						break;
					case 5:
						include("includes/mod_der/director_eliminar.php");
						break;
					case 6:
						include("includes/mod_der/director_editarescuela.php");
						break;	
				}
				break;
			}
		}	
			else {
			include("includes/mod_der/principal.php"); 
			//echo "modulo principal de contenidos";
			}
	?>

	<?php
	   if(isset($_SESSION["referenteId"]))
		{
		switch ($_SESSION['tipo']) {
			case "ETT":
				include("includes/mod_men/ett.php");
				break;
			case "ETJ":
				include("includes/mod_men/etj.php");
				break;
			case "admin":
				include("includes/mod_men/admin.php");
				break;
			case "Coordinador":
				include("includes/mod_men/coordinador.php");
				break;
			case "Primaria":
				include("includes/mod_men/primaria.php");
				break;
			case "Supervisor-Secundaria":
				include("includes/mod_men/supervisor-secundaria.php");
				break;
			case "Supervisor-General-Secundaria":
					include("includes/mod_men/supervisor-general-secundaria.php");
					break;
			case "Supervisor-Nivel-Superior":
				include("includes/mod_men/supervisor-nivel-superior.php");
				break;
			case "CoordinadorPmi":
					include("includes/mod_men/coordinadorPmi.php");
					break;
			case "ATT":
					include("includes/mod_men/att.php");
					break;
			case "CoordinadorFaciilitador":
							include("includes/mod_men/coordinadorPmi.php");
							break;
			case "Facilitador":
							include("includes/mod_men/facilitador.php");
							break;
			case "Relevamiento":
									include("includes/mod_men/relevamiento.php");
									break;
			case "DirectorNivelSecundario":
									include("includes/mod_men/directorNivelSecundario.php");
									break;
			case "DirectorNivelSuperior":
									include("includes/mod_men/directorNivelSuperior.php");
									break;
			case "SupervisorGeneralSuperior":
									include("includes/mod_men/supervisorGeneralSuperior.php");
									break;
			case "Secretariodegestion":
								include("includes/mod_men/secretariodegestion.php");
								break;
			case "buscador":
							include("includes/mod_men/buscador.php");
							break;
			}
		}
			else {
			include("includes/mod_men/principal.php");
			}
	?>

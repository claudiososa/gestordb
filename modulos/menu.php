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
			case "CoordinadorFacilitador":
							include("includes/mod_men/coordinadorfacilitador.php");
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
			case 'SupervisorGeneralAdultos':
						include_once('includes/mod_men/supervisorGeneralAdultos.php');
						break;
			case 'DirectorNivelAdultos':
						include_once('includes/mod_men/directorNivelAdultos.php');
						break;
			case 'SupervisorAdultos':
						include_once('includes/mod_men/supervisorAdultos.php');
						break;
			case 'CoordinadorEducacionFisica':
						include_once('includes/mod_men/coordinadorEducacionFisica.php');
						break;
			case 'ReferenteEducacionFisica':
                        include_once('includes/mod_men/referenteEducacionFisica.php');
						break;
			//Vistas generales y de prueba para supervisores primaria,director nivel,coordinadores. 03/12/17
			case 'DNP':
							include_once('includes/mod_men/directorNivelPrimaria.php');
							break;
			case 'SNP':
							include_once('includes/mod_men/supervisoresPrimaria.php');
							$_SESSION["tipoN"]=4;
							break;
			case 'SEP':
							include_once('includes/mod_men/supervisoresPrimaria.php');
								$_SESSION["tipoN"]=5;
							break;
			case 'SI':
							include_once('includes/mod_men/supervisoresPrimaria.php');
							break;
			case 'SH':
							include_once('includes/mod_men/supervisoresPrimaria.php');
							break;
			case 'SR':
						include_once('includes/mod_men/supervisoresPrimaria.php');
						break;
			case 'CP':
							include_once('includes/mod_men/coordinadoresPrimaria.php');
							break;
			case 'SSPL':
							include_once('includes/mod_men/subSecretarioPlaneamiento.php');
							break;
			case 'CPPL':
							include_once('includes/mod_men/coordinadorPlanLectura.php');
							break;
			case 'ETTPL':
							include_once('includes/mod_men/ettPlanLectura.php');
							break;
			}
		}
			else {
			include("includes/mod_men/principal.php");
			}
	?>

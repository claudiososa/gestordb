
<link rel="stylesheet" href="includes/mod_cen/css/login.css"/>
<?php
include_once("clases/login.php");
if(isset($_POST["username"]))
	{
		$username=$_POST["username"];
		$password=$_POST["password"];
		$ingreso= new Login($username, $password);

		if(isset($username) && isset($password))
		{
			//var_dump($username);
			//echo $username."<br>".$password;
			$prueba=$ingreso->iniciarSesion();

		}

		if(isset($_SESSION["referenteId"]))
		{
			//echo session_id();
			echo '<script type="text/javascript">';
   		echo 'function redireccion(){';
			echo 'window.location="index.php"};';
			echo 'setTimeout ("redireccion()", 0); //el tiempo expresado en milisegundos';
			echo '</script>';
		}else {
			echo '<script type="text/javascript">';
   		echo 'function redireccion(){';
			echo 'window.location="index.php?error"};';
			echo 'setTimeout ("redireccion()", 0); //el tiempo expresado en milisegundos';
			echo '</script>';
		}
	} elseif(!isset($_SESSION["referenteId"])){

		if(isset($_GET["error"]	)) {
			echo "Usuario o Contraseña incorrecto";
		}

		?>


		<!--<script type="text/javascript" src="includes/mod_cen/formularios/js/form_login.js"></script>-->
		<br>
		<div class="container" >
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-sm-offset-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<img class="usuarioSvg img-responsive"src="includes/mod_cen/css/login/logoCondor.png" alt="">
							<hr>

							<!-- <h4 cl>Inicio de Sesión:</h4> -->
							<form action="" name="iniciosesion"method="POST">
										<div class="form-group input-group">
							      	<span class="input-group-addon userLog"><i class="glyphicon glyphicon-user" style="color:#068587"></i></span>
											<input class="form-control inputLog" type="text" name="username" autofocus=""placeholder="Ingrese Usuario" id="formulario-login"  size="50" required>
										</div>

										<div class="form-group input-group" >
							        <span class="input-group-addon userLog"><i class="glyphicon glyphicon-lock" style="color:#068587"></i></span>
							        <input class="form-control inputLog" type="password" name="password" placeholder="Ingrese Contraseña" size="50" required >
						    		</div>

							    	<div class="form-group" "input-group" >
							        <button class="btn btn-lg btn-primary btn-block btnLog" type="submit" id="btnvalidar" value="Ingresar">Ingresar</button>
								  	</div>
							</form>


							</div>

						</div>

					</div>

				</div>

			</div>
			<hr>
<section>
	<footer>
		<h3>Aprender Conectados - Salta</h3>
		<div class="container ">
			<div class="row redes">
				<div class="col-md-2">
					<a href="https://twitter.com/SaltaConectados?lang=es"class="twitter" target="_blank"><img onmouseout="this.src='includes/mod_cen/css/login/twitter1.svg';" onmouseover="this.src='includes/mod_cen/css/login/twitter.svg';" src="includes/mod_cen/css/login/twitter1.svg" class="twitter"alt="twitter Aprender Conectados Salta"></a>

				</div>

				<div class="col-md-2">
					<a href="https://www.facebook.com/AprenderConectadosSalta/?ref=br_rs" target="_blank"><img onmouseout="this.src='includes/mod_cen/css/login/facebook1.svg';"onmouseover="this.src='includes/mod_cen/css/login/facebook.svg';" src="includes/mod_cen/css/login/facebook1.svg"  class="facebook"alt="Facebook Aprender Conectados Salta"></a>

				</div>

				<div class="col-md-2 ">
					<a href="https://www.instagram.com/aprenderconectadossalta/" target="_blank"><img onmouseout="this.src='includes/mod_cen/css/login/instagram1.svg';"onmouseover="this.src='includes/mod_cen/css/login/instagram.svg';"src="includes/mod_cen/css/login/instagram1.svg" class="instagram"alt="Instagram Aprender Conectados Salta"></a>

				</div>

			</div>

		</div>

	</footer>
</section>


	    <!-- <div class="row">



	    <div class="col-md-4 col-md-offset-4">
			<div class="well well-sm">
	<form action="" name="iniciosesion"method="POST">
		<legend class="text-center header" style="color: #068587">Inicio de Sesión</legend>

			<div class="form-group input-group">
	      <span class="input-group-addon"><i class="glyphicon glyphicon-user" style="color:#068587"></i></span>
			<input class="form-control" type="text" name="username" autofocus=""placeholder="Ingrese Usuario" style="border-color:rgba(6, 133, 135, 0.55)" id="formulario-login"  size="50" required>
			</div>

			<div id="alerta" style="display:none;"></div>
					<div class="form-group input-group" >
	        <span class="input-group-addon"><i class="glyphicon glyphicon-lock" style="color:#068587"></i></span>
	        <input class="form-control" type="password" name="password" placeholder="Ingrese Contraseña" style="border-color:rgba(6, 133, 135, 0.55)"size="50" required >
	    </div>

	    <div class="form-group" "input-group" >
	        <button class="btn btn-lg btn-primary btn-block" type="submit" id="btnvalidar" value="Ingresar" style="background-color:#068587;border-color: #068587;">Ingresar</button>
		  </div>
	</form>
</div>
</div>

	    </div> -->

	</div>
	<script type="text/javascript">
	$(".twitter").mouseover(function(){
    });

	</script>
	<?php
	}
		if(isset($_SESSION["referenteId"])) {

			switch ($_SESSION["tipo"]) {
				case 'CoordinadorFaciilitador':
					include_once('includes/mod_cen/portada/coordinadorfacilitador.php');
					break;
				case 'Facilitador':
					include_once('includes/mod_cen/portada/facilitador.php');
					break;
				case 'ATT':
					include_once('includes/mod_cen/portada/att.php');
					break;
				case 'ETT':
					include_once('includes/mod_cen/portada/ett.php');
					break;
				case 'ETJ':
					include_once('includes/mod_cen/portada/etj.php');
					break;
				case 'Coordinador':
					include_once('includes/mod_cen/portada/coordinador.php');
					break;
			 case 'CoordinadorPmi':
						include_once('includes/mod_cen/portada/coordinadorpmi.php');
						break;
				case 'Supervisor-Secundaria':
						include_once('includes/mod_cen/portada/supervisor-secundaria.php');
						break;
				case 'Supervisor-Nivel-Superior':
					include_once('includes/mod_cen/portada/Supervisor-Nivel-Superior.php');
					break;
				case 'DirectorNivelSecundario':
					include_once('includes/mod_cen/portada/directorNivelSecundario.php');
					break;
				case 'Supervisor-General-Secundaria':
					include_once('includes/mod_cen/portada/supervisorGeneralSecundaria.php');
					break;
				case 'DirectorNivelSuperior':
						include_once('includes/mod_cen/portada/directorNivelSuperior.php');
						break;
				case 'SupervisorGeneralSuperior':
						include_once('includes/mod_cen/portada/supervisorGeneralSuperior.php');
						break;
				case 'SupervisorGeneralAdultos':
						include_once('includes/mod_cen/portada/supervisorGeneralAdultos.php');
						break;
				case 'DirectorNivelAdultos':
						include_once('includes/mod_cen/portada/directorNivelAdultos.php');
						break;
				case 'SupervisorAdultos':
						include_once('includes/mod_cen/portada/supervisorAdultos.php');
						break;
				case 'buscador':
						include("includes/mod_cen/portada/buscador.php");
						break;
				case 'Facilitador':
				    include_once('includes/mod_cen/portada/facilitador.php');
				    break;
				case 'CoordinadorFacilitador':
						    include_once('includes/mod_cen/portada/coordinadorfacilitador.php');
						    break;
				case 'CoordinadorEducacionFisica':
				    include_once('includes/mod_cen/portada/coordinadorEducacionFisica.php');
				    break;
				case 'ReferenteEducacionFisica':
						    include_once('includes/mod_cen/portada/referenteEducacionFisica.php');
						    break;
				//Vistas generales y de prueba para supervisores primaria,director nivel,coordinadores. 03/12/17
				case 'DNP':
						    include_once('includes/mod_cen/portada/directorNivelPrimaria.php');
						    break;
				case 'SNP':
							  include_once('includes/mod_cen/portada/supervisoresPrimaria.php');
							  break;
				case 'SEP':
							  include_once('includes/mod_cen/portada/supervisoresPrimaria.php');
							  break;
				case 'CP':
							  include_once('includes/mod_cen/portada/coordinadoresPrimarias.php');
							  break;
				case 'SGP':
								include_once('includes/mod_cen/portada/sgp.php');
								break;
				case 'SI':
							  include_once('includes/mod_cen/portada/supervisoresPrimaria.php');
								 break;
				case 'SH':
				 			  include_once('includes/mod_cen/portada/supervisoresPrimaria.php');
				 			  break;
				case 'CE':
								 include_once('includes/mod_cen/portada/coordinadoresPrimarias.php');
							  break;
				case 'CI':
								 include_once('includes/mod_cen/portada/coordinadoresPrimarias.php');
								 break;
			  case 'CH':
				 				 include_once('includes/mod_cen/portada/coordinadoresPrimarias.php');
				 				 break;
			 case 'SR':
				 				  include_once('includes/mod_cen/portada/supervisoresPrimaria.php');
				 				  break;
				case 'SP':
								 	include_once('includes/mod_cen/portada/supervisoresPrimaria.php');
								  break;
				case 'SP':
				  			 	include_once('includes/mod_cen/portada/subSecretarioPlaneamiento.php');
								  break;
				case 'CPPL':
				  			 	include_once('includes/mod_cen/portada/coordinadorPlanLectura.php');
								  break;
				case 'ETTPL':
				  			 	include_once('includes/mod_cen/portada/ettPlanLectura.php');
								  break;
				case 'CAS':
				  			 	include_once('includes/mod_cen/portada/cas.php');
								  break;
				case 'CU':
									include_once('includes/mod_cen/portada/cu/cu.php');
									break;
				case 'COORCONECT':
									include_once('includes/mod_cen/portada/coordinadorConect.php');
									break;

				default:
					include_once('includes/mod_cen/portada/portadaAdmin.php');
					break;
			}
		}
			//include_once('includes/mod_cen/portada.php');

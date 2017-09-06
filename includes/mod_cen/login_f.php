
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

	    </div>

	</div>
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


				default:
					include_once('includes/mod_cen/portada/portadaAdmin.php');
					break;
			}
		}
			//include_once('includes/mod_cen/portada.php');

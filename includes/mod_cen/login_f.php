
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
		<div class="container" >
	    <div class="row">
	    <div class="Absolute-Center is-Responsive">
	    <div class="col-md-4 col-md-offset-4">
	<form action="" name="iniciosesion"method="POST">
		<label class="">Inicio de Sesión</label>

			<div class="form-group input-group">
	      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input class="form-control" type="text" name="username" autofocus=""placeholder="Ingrese Usuario" id="formulario-login"  size="50" required>
			</div>

			<div id="alerta" style="display:none;"></div>
					<div class="form-group input-group">
	        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	        <input class="form-control" type="password" name="password" placeholder="Ingrese Contraseña" size="50" required>
	    </div>

	    <div class="form-group" "input-group">
	        <button class="btn btn-lg btn-primary btn-block" type="submit" id="btnvalidar" value="Ingresar">Ingresar</button>
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


				default:
					include_once('includes/mod_cen/portada.php');
					break;
			}
		}
			//include_once('includes/mod_cen/portada.php');

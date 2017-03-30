<?php
include_once("clases/login.php");

if($_POST["username"])
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

		<div class="container">

			<form class="form-horizontal" name="iniciosesion" action="" method="POST">
				<div class="form-group">
					<label class="col-md-12 col-md-offset-2">Inicio de Sesión</label>
				</div>
				<div class="form-group">

					<label class="control-label col-md-2">Usuario</label>
					<div class="col-md-10">
						<div class="row">
							 <div class="col-sm-5">
								<input type="text" class="form-control"  name="username" placeholder="Usuario" autofocus>
							 </div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">Contraseña</label>
					<div class="col-md-10">
						<div class="row">
							 <div class="col-sm-5">
								<input class="form-control" type="password" placeholder="Contraseña" name="password">
							 </div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-2">
						<input class="btn btn-primary" type="submit" value="Ingresar">
					</div>
				</div>
			</form>
		</div>
	<?php
	}
		if(isset($_SESSION["referenteId"])) {

			switch ($_SESSION["tipo"]) {
				case 'ETT':
					include_once('includes/mod_cen/portada/ett.php');
					break;
				case 'ETJ':
					include_once('includes/mod_cen/portada/etj.php');
					break;
				case 'Coordinador':
					include_once('includes/mod_cen/portada/coordinador.php');
					break;
				case 'Supervisor':
					include_once('includes/mod_cen/portada/supervisor-secundaria.php');
					break;
				case 'Supervisor-Nivel-Superior':
					include_once('includes/mod_cen/portada/Supervisor-Nivel-Superior.php');
					break;

				default:
					include_once('includes/mod_cen/portada.php');
					break;
			}
		}
			//include_once('includes/mod_cen/portada.php');

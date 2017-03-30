<?php
include_once("clases/login.php");
if($_POST)
	{
		$username=$_POST["username"];
		$password=$_POST["password"];

		/*$username_limpio = mysqli_real_escape_string($username);
		var_dump($username_limpio);*/
		$ingreso= new Login($username, $password);

		if(isset($username) && isset($password))
		{
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

			<div class="col-md-12">

					<a href="#" class="btn btn-primary">Aviso - DBMS Conectar <br></a>
			</div>

			<div class="col-md-12">
			 <label for="">
				 Se encuentra en mantenimiento<br>
			 Disculpe las molestias.<br>
			 </label>



			</div>
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

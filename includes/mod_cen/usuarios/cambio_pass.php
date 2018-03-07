<?php
include_once("includes/mod_cen/clases/login.php");

if($_POST)
{
	$login=new Login($_SESSION["username"],null,NULL);
	$buscarPass=$login->passActual();
	$contraActual=$buscarPass->getPassword();
	$dato=$_POST["contra_actual"];
	//echo $dato;	
	if(md5($dato)==$contraActual) {
		if($_POST["contra_nueva"]==$_POST["contra_nueva2"]) {
			$pass=new Login($_SESSION["username"],$_POST["contra_nueva"],null);			
			$cambio=$pass->cambioPass();	
			if ($cambio==1){
				//echo "<h1>La contraseña fue modificada con éxito</h1>";
				?>
				<script type="text/javascript">
			      function redireccion(){window.location="?men=personas&id=2";}
			      setTimeout ("redireccion()", 0); //el tiempo expresado en milisegundos
				</script>
				<?php		
			}			
		}else {
			echo "<h1>contraseña nueva no coinciden</h1><br><br>";		
		}
	}else {	
			 	
	 	echo "<h1>Contraseña actual incorrecta</h1><br><br>";
	}
}
include_once("includes/mod_cen/formularios/f_cambio_pass.php");
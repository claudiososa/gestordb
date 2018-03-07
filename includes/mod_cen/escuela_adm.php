<?php
		include_once('clases/adm.php');
		include_once('clases/escuela.php');
		include_once('clases/localidades.php');
		
		if(isset($_GET['escuelaId'])) {$escuelaId=$_GET['escuelaId'];}
		if(isset($_POST['escuelaId'])){$escuelaId=$_POST['escuelaId'];}
		
		$escuela= new Escuela($escuelaId);
		$datos = $escuela->getContacto();
		
		$adm= new Adm(null,$escuelaId);      
		$adm_buscar= $adm->buscar();
		$existe=mysqli_num_rows($adm_buscar);
		if($existe==1) {
			$datoadm=mysqli_fetch_object($adm_buscar);		
		}
	
    	if(isset($_POST['escuelaId']))
		{
			$escuelaId=$_POST['escuelaId'];
 			$estado=$_POST['estado'];
 			$servidor=$_POST['servidor'];
 			$router=$_POST['router'];
 			$pizarraDigital=$_POST['pizarraDigital'];
			$proyector=$_POST['proyector'];
			$impresora=$_POST['impresora'];
 			$ups=$_POST['ups'];
 			$camaraFoto=$_POST['camaraFoto'];
 			$pendrive=$_POST['pendrive'];
 			$cantidadNetbook=$_POST['cantidadNetbook'];
 			$netMarca=$_POST['netMarca'];
 			$netFunciona=$_POST['netFunciona'];
 			$netFalla=$_POST['netFalla'];
 			$migraHuayra=$_POST['migraHuayra'];
 			$observaciones=$_POST['observaciones'];
			if($existe==1) {
				$crearAdm= new Adm($datoadm->admId,$escuelaId,$estado,$servidor,$router,$pizarraDigital,$proyector,$impresora,$ups,$camaraFoto,$pendrive,$cantidadNetbook,$netMarca,$netFunciona,$netFalla,$migraHuayra,$observaciones);										
				$modi_Adm= $crearAdm->editar();
				if($modi_Adm==1){
					echo "Los datos fueron guardados correctamente";			
					echo '<script type="text/javascript">';
   				echo 'function redireccion(){';
					echo 'window.location="index.php?mod=slat&men=user&id=3"};';
					echo 'setTimeout ("redireccion()", 1000); //el tiempo expresado en milisegundos';
					echo '</script>';							
				  }
				}
			if($existe==0) 
			{
				$crearAdm= new Adm(null,$escuelaId,$estado,$servidor,$router,$pizarraDigital,$proyector,$impresora,$ups,$camaraFoto,$pendrive,$cantidadNetbook,$netMarca,$netFunciona,$netFalla,$migraHuayra,$observaciones);						
				$modi_Adm= $crearAdm->agregar();
				if($modi_Adm==1){
					echo "Los datos fueron guardados correctamente";			
					echo '<script type="text/javascript">';
   				echo 'function redireccion(){';
					echo 'window.location="index.php?mod=slat&men=user&id=3"};';
					echo 'setTimeout ("redireccion()", 1000); //el tiempo expresado en milisegundos';
					echo '</script>';						
				  }
			}
		}else{		
			include_once("formularios/f_adm.php");
		}
			
?>
		

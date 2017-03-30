<?php 
	ini_set("memory_limit", "32M");
	$subcat=$_POST[subcat];
	$cate=$_POST[cate];
	$tit=$_POST[titulo];
	$avi=$_POST[anuncio];
	$ema=$_POST[email];
	$ter=$_POST[terminos];
	$fecha=date('Y-m-d');
	$nombrePe = $_FILES['imagen']['name'];
    $nombreArchivo = $_FILES['imagen']['name'];
    $foto= $_FILES['imagen']['name'];
	$tipo_archivo = $_FILES['imagen']['type']; 
	$tamano_archivo = $_FILES['imagen']['size'];
	if ($ter<>"on"){
		$ter="no";
	}
	//compruebo si las características del archivo son las que deseo 
    if (strlen($nombreArchivo)==0){
        $nombreArchivo="default.jpg";
        $consulta="INSERT INTO avisos (avi_cat,avi_sub,avi_fec,avi_tit,avi_avi,avi_ema,avi_foto,avi_ter) VALUE
('$cate','$subcat','$fecha','$tit','$avi','$ema','$nombreArchivo','$ter')";
		$result=mysql_query($consulta)or die("Query failed:$query");				
		echo "<div><img src='images/iconos/ok.png' height='50' width='50'></div>";
		echo "<div class='ok'>Los datos fueron cargados con exito</div>"; 
    }else{
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 9000000000))) { 
		    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 1000 Kb máximo.</td></tr></table>"; 
		}else{ 
			$prefijo = substr(md5(uniqid(rand())),0,6);
			$nombreArchivo=$prefijo."_".$nombreArchivo;
			$result1=mysql_query("select * from categoria where cat_num='$cate' limit 1");
		$filacate=mysql_fetch_row($result1);
			$nombreNuevo="./images/".$filacate[1]."/".$nombreArchivo;
		    //if (move_uploaded_file($HTTP_POST_FILES['imagen']['tmp_name'], $nombreArchivo)){
		    if (copy(($_FILES['imagen']['tmp_name']),$nombreNuevo)){
		    	list($ancho,$alto)=getimagesize($nombreNuevo);
			
		    	$imagenPe=imagecreatetruecolor(78,61);
		    	
			$imagen=imagecreatefromjpeg($nombreNuevo);
		    	imagecopyresampled($imagenPe,$imagen,0,0,0,0,78,61,$ancho,$alto);
		    	$imagep2="./images/".$filacate[1]."/".$filacate[1]."/".$nombreArchivo;
		    	imagejpeg($imagenPe,$imagep2,100);
		    	//copy($imagenPe,$imagep2);
		    	//echo "<div><img src=$imagenPe></div>";
						   	
		    	$imagenGr=imagecreatetruecolor(425,340);
			
			$imagengrande=imagecreatefromjpeg($nombreNuevo);
			imagecopyresampled($imagenGr,$imagengrande,0,0,0,0,425,340,$ancho,$alto);
			$imageg3="./images/".$filacate[1]."/".$nombreArchivo;
						imagejpeg($imagenGr,$imageg3,100);
			
		    	$consulta="INSERT INTO avisos (avi_cat,avi_sub,avi_fec,avi_tit,avi_avi,avi_ema,avi_foto,avi_ter) VALUE
('$cate','$subcat','$fecha','$tit','$avi','$ema','$nombreArchivo','$ter')";
$result=mysql_query($consulta)or die("Query failed:$query");				
			  echo "<div><img src='/images/iconos/ok.png' height='50' width='50'></div>";
			  echo "<div class='ok'>Los datos fueron cargados con exito</div>"; 
		    }else{ 
		       echo "Ocurrió algún error al subir el fichero. No pudo guardarse."; 
		    } 
		} 
	}

?>
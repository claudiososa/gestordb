<div class="lista"><div class="filalista">Ultimos anuncios publicados</div>
<?php
	$result=mysql_query("select distinct * from avisos  where avi_cat <> 4 order by avi_num desc");
    //$result=mysql_query("select * from avisos order by avi_num desc");
	mysql_query("SET NAMES 'utf-8'"); 
	$cantTotal=mysql_num_rows($result)+1;
	//***************************************************************
	// Verificación de numero pagina e inicialización de variables
	if (isset($_GET[ha])){
		$f=(($_GET[ha]-1)*10);	
                mysql_data_seek($result, $f);
		$cantFilas=$f+10;
		$enlaceActual=round($cantFilas/10,0);
		if ($cantFilas>$cantTotal){
			$resto=$cantFilas-$cantTotal;
			$resto--;
			$cantFilas=$cantFilas-$resto;
		}
	}else {
			mysql_data_seek($result,0);
			$f=1;
			$ha=1;
			$cantFilas=11;
			$enlaceActual=round($cantFilas/11,0);
	}
	$filaRestante=$cantFilas*$_GET[ha];
	//**********************************************************
	//mostrar lista de ultimos anuncios.
	for ($f;$f<$cantFilas;$f++){
		$row=mysql_fetch_row($result);
                $ultimafila=$row[0];
		$categori=$row[2];
		$result1=mysql_query("select * from categoria where cat_num='$categori' limit 1");
		$filacate=mysql_fetch_row($result1);
		$tit=urls_amigables($row[4]);
		$vacio=strlen($row[7]); 
		if ($row[7]<>"default.jpg" and $vacio>0){
			$image="<a href='/$row[0]/$tit.html'><img src='/images/$filacate[1]/$filacate[1]/$row[7]' width='78' height='61' alt='$row[4]' border='0'></a>";
		}else {
			$image="<br>Anuncio<br>Sin Imagen";
		}
		$longAnuncio=strlen($row[5]);
		if ($longAnuncio>130){
			$ultimaPalabra=strpos($row[5], " ",110);
			if ($ultimaPalabra==FALSE){
			$ultimaPalabra=99;
			}
			$anuncioRedu=substr($row[5],0,$ultimaPalabra)." ...";
		}else {
			$anuncioRedu=$row[5];
		}
		$id=4;
		$modulo="inicio";
		$avi=$row[0];
		//$tit=$row[3];
		
		echo "<div class='listado'>".
		"<div class='list_izq'>$image</div>".
		"<div class='list_der'><div class='list_der1'><a href='/$row[0]/$tit.html'>$row[4]</a></div><div class='list_der2'>Categoria: $filacate[1]</div><div class='list_der3'>$anuncioRedu</div></div></div>";
	}
	//**************************************************************************
	//muestro de numero de paginas disponibles. 
if ($cantTotal>9){
	$enlaces=round($cantTotal/11,0)+1;	
	echo "<div class='indice'>";
	echo "Paginas :";
	for ($p=1;$p<=$enlaces;$p++){
		if ($p<>$enlaceActual){
			echo "<a href='index.php?ha=$p'>$p</a>";
		}else {
			echo $p;
		}
				
	}
	echo "</div>";	
}
?>
</div>
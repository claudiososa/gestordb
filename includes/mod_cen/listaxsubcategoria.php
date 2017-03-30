<?php 
$categori= $_GET[subcatego];
$result2=mysql_query("select * from subcate where sub_nom='$categori' limit 1");
$tablacate=mysql_fetch_row($result2);
$num_subcategoria=$tablacate[0];
$result=mysql_query("select * from avisos where avi_sub=$num_subcategoria order by avi_num desc");
mysql_query("SET NAMES 'utf8'");
$cantAnuncio=mysql_num_rows($result);

$categoriaActual=$tablacate[1];
$result3=mysql_query("select * from categoria where cat_num=$categoriaActual limit 1");
$nom_cate=mysql_fetch_row($result3);

if (mysql_num_rows($result)==false or mysql_num_rows($result)==0){
  echo "<div class='lista'><div class='filalista'>No existe todavia anuncio en esta Subcategoria</div></div>";

}else{
?>

<div class="lista"><div class="filalista">Ultimos anuncios publicados sobre <?php echo $tablacate[2]; ?></div>
<?php
 
if ($cantAnuncio<21){
	//echo "pasa por aqui";
	//echo $cantAnuncio;
	$f=0;
for ($f;$f<$cantAnuncio;$f++){
	$row=mysql_fetch_row($result);
	$tit=urls_amigables($row[4]);
	$vacio=strlen($row[7]); 
	$cateactual=$tablacate[1];
	$subactual=$row[3];
	/*$result1=mysql_query("select * from subcate where sub_num=$subactual limit 1");
	$filacate=mysql_fetch_row($result1);*/
	
	if ($row[7]<>"default.jpg" and $vacio>0){
		
		$image="<a href='/$row[0]/$tit.html'><img src='/images/$nom_cate[1]/$nom_cate[1]/$row[7]' width='78' height='61' alt='$row[4]' border='0'></a>";
	}else {
		$image="<br>Anuncio<br>Sin Imagen";
	}
	$longAnuncio=strlen($row[5]);
	if ($longAnuncio>130){
		$ultimaPalabra=strpos($row[5], " ",110);
		//echo $ultimaPalabra;
		if ($ultimaPalabra==FALSE){
			$ultimaPalabra=99;
		}
		$anuncioRedu=substr($row[5],0,$ultimaPalabra)." ...";
	}else {
		$anuncioRedu=$row[5];
	}
	
	
	echo "<div class='listado'>".
	"<div class='list_izq'>$image</div>".
	"<div class='list_der'><div class='list_der1'><a href='/$row[0]/$tit.html'>$row[4]</a></div><div class='list_der2'>Categoria: $nom_cate[1] - $tablacate[2] </div><div class='list_der3'>$anuncioRedu</div></div></div>";
	
	
} 

}else{


//echo "<div class='filalista'><div id='numero'>Nº</div><div id='foto'>Foto</div><div id='titulo'>Titulo</div><div id='anuncio'>Anuncio</div><div id='fecha'>Fecha</div></div>";
$cantTotal=$cantAnuncio;
if (isset($_GET[ha])){
	$f=(($_GET[ha]-1)*20);	
	mysql_data_seek($result, $f);
	$cantFilas=$f+20;
	$enlaceActual=round($cantFilas/21,0);
	if ($cantFilas>$cantTotal){
		$resto=$cantFilas-$cantTotal;
		$resto--;
		$cantFilas=$cantFilas-$resto;
	}
}else {
	mysql_data_seek($result,0);
	$f=1;
	$ha=1;
	$cantFilas=21;
	$enlaceActual=round($cantFilas/21,0);
}
$filaRestante=$cantFilas*$_GET[ha];

for ($f;$f<$cantFilas;$f++){
	$row=mysql_fetch_row($result);
	if ($row==false){
		break;
	}
	
	$vacio=strlen($row[7]);
	$tit=urls_amigables($row[4]);
	/*$result1=mysql_query("select * from subcate where sub_nom='$categori' limit 1");
	$filacate=mysql_fetch_row($result1);
	$cateactual=$filacate[1];
	$result2=mysql_query("select * from categoria where cat_num=$cateactual limit 1");
	$filacate2=mysql_fetch_row($result2);*/
	if ($row[7]<>"default.jpg" and $vacio>0){
		$image="<a href='/$row[0]/$tit.html'><img src='/images/$nom_cate[1]/$nom_cate[1]/$row[7]' width='78' height='61' alt='$row[4]' border='0'></a>";
	}else {
		$image="<br>Anuncio<br>Sin Imagen";
	}
	$longAnuncio=strlen($row[5]);
	if ($longAnuncio>130){
		$ultimaPalabra=strpos($row[5], " ",110);
		//echo $ultimaPalabra;
		if ($ultimaPalabra==FALSE){
			$ultimaPalabra=99;
		}
		$anuncioRedu=substr($row[5],0,$ultimaPalabra)." ...";
	}else {
		$anuncioRedu=$row[5];
	}
	
	
	echo "<div class='listado'>".
	"<div class='list_izq'>$image</div>".
	"<div class='list_der'><div class='list_der1'><a href='/$row[0]/$tit.html'>$row[4]</a></div><div class='list_der2'>Categoria: $nom_cate[1] - $tablacate[2] </div><div class='list_der3'>$anuncioRedu</div></div></div>";
	
	
} 
if ($cantTotal>19){
	$enlaces=round($cantTotal/21,0)+1;	
	
	echo "<div class='indice'>";
	echo "Paginas :";
	for ($p=1;$p<=$enlaces;$p++){
		if ($p<>$enlaceActual){
			echo "<a href='/subcategoria/$categori-$p.htm'>$p</a>";
		}else {
			echo $p;
		}
				
	}
	echo "</div>";	
}
}
?>
</div>
<?php }?>
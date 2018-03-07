<div><div class="filalista">Detalle del anuncio</div>
<div id="face-pag-mostrar"><a href='http://www.facebook.com/sharer.php?u=<? echo "http://www.publicasalta.com.ar/$row[0]/$tit.html&t=$tit'"?>name="fb_share" type="button">Compartir en Facebook</a>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script> </div>
<?php
    $numanuncio=$_GET[anuncio];
	
    $result=mysql_query("select * from avisos where avi_num =$numanuncio");
	mysql_query("SET NAMES 'utf8'"); 
	$row=mysql_fetch_row($result);
	$categori=$row[2];
        $subc=$row[3];
	//**********************************************************
	//mostrar lista de ultimos anuncios.
	$vacio=strlen($row[7]); 
	if ($row[7]<>"default.jpg" and $vacio>0){
		$result1=mysql_query("select * from categoria where cat_num=$categori limit 1");
		$filacate=mysql_fetch_row($result1);
                $imagep="<img src='/images/$filacate[1]/$filacate[1]/$row[7]' width='78' height='61' alt='$row[4]' border='0'>";
		$imageg="<img src='/images/$filacate[1]/$row[7]' width='425' height='460' alt='$row[4]' border='0'>";
                $result2=mysql_query("select * from subcate where sub_num=$subc limit 1");
		$filasubc=mysql_fetch_row($result2);
	}else {
                $result1=mysql_query("select * from categoria where cat_num=$categori limit 1");
		$filacate=mysql_fetch_row($result1);
                $result2=mysql_query("select * from subcate where sub_num=$subc limit 1");
		$filasubc=mysql_fetch_row($result2);
                $imagep="<br>Anuncio<br>Sin Imagen";
		$imageg=" ";
	}
	$tit=urls_amigables($row[4]);	
echo "<div class='muestraAnuncio'>".
	"<div class='list_izq'>$imagep</div>".
	"<div class='muestraAnuncio_der'>
	<div class='list_der1'><a href='/$row[0]/$tit.html'>$row[4]</a></div>
	<div class='list_der2'>Categoria: $filacate[1] - $filasubc[2]</div><div class='list_der3'>$row[5]</div></div></div>";?>
	<?//echo "<div><a href='http://www.facebook.com/sharer.php?u=http://www.publicasalta.com.ar/$row[0]/$tit.html&t=$tit' target='blank'>Compartir en Facebook</a></div>";?>

<?echo "<div class='imageng'>$imageg</div>";?>

</div>
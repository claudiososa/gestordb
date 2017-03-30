<div id="stylized" class="myform">

<?php
$subcate=$_GET[subcate];
$resultado=mysql_query("SELECT * FROM subcate WHERE sub_cat=$subcate");
?>
<form id="form" name="form" method="post" enctype="multipart/form-data" action="/index.php?id=2">
<h1>Nuevo Clasificado Gratis</h1>
<p>Ingrese datos correctos.</p>
<label>SubCategoria
<span class="small">Selecciona </span>
</label>

<select name="subcat">
<?php 

$numFilas=mysql_num_rows($resultado);
for ($i=1;$i<=$numFilas;$i++){
$fila=mysql_fetch_row($resultado);
$valor=$fila[0];
echo "<option value='".$valor."'>$fila[2]</option>";
}
//<option value="compro">Compro</option>

echo "</select>";
$valorcate=$fila[1];
echo "<input type='hidden' name='cate' value='".$valorcate."'>";
?>


<label>Titúlo
<span class="small">Ingrese un titulo para su anuncio</span>
</label>
<input type="text" name="titulo" id="titulo" />

<label>Anuncio
<span class="small">Detalle de su anuncio</span>
</label>
<textarea name="anuncio" id="anuncio" cols="20" rows="6"></textarea>

<label>Correo Electronico
<span class="small">Ingrese un dirección valida</span>
</label>
<input type="text" name="email" id="email" />

<label>Imagen
<span class="small">opcional</span>
</label>
<input type="file" name="imagen" id="imagen" />

<label>Terminos y Condiciones de uso
<span class="small"></span>
</label>
<textarea rows="7" cols="20">Como usuario del servicio me comprometo a no ingresar información inexacta. Acepto todas las consecuencias legales que pueda incurrir al colocar mi anuncio. El website no se hace responsable por los anuncios ingresados por los usuarios. Corresponde a cada anunciante ingresar datos reales</textarea>

<label>Estoy de acuerdo con los términos de uso
</label>
<input type="checkbox" name="terminos" id="terminos" />

<button type="submit">Publicar Anuncio</button>
<div class="spacer"></div>

</form>
</div>
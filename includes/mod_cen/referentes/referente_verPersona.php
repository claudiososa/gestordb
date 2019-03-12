<script type = "text/javascript" src = "includes/mod_cen/referentes/js/fotoPerfil.js"></script>
<style type="text/css">
hr {
		border-top: 2px solid #FFC61B;
	}

</style>

<?php
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
?>
<div class="container wow flipInX">
	<div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/la-busqueda-de-empleo (1).png"></div><h4><b>Búsqueda de Referentes</b> <img class="img-responsive img-circle" onclick="history.back()" align="right" src="includes/mod_cen/portada/imgPortadas/back/flecha-buscar-rti.png"></h4>



	<hr>
</div>
<div class="container">
<br>
	<br>
	<br>
	<form class="form-horizontal" action='' method='POST'>

		<div class="form-group">
			<label class="control-label col-md-2">Apellido</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="apellido" placeholder="Ingrese apellido" autofocus>
					 </div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Nombre</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="nombre" placeholder="Ingrese nombre" autofocus>
					 </div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Departamento</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
<?php
$departamento = new Departamentos();
$total = $departamento->getTotal();
echo "<select class='form-control' name='localidadId'>";
echo "<option value=0>Ninguno</option>";
for ($val = 2; $val <= $total; $val++) {
    $departamento = new Departamentos($val);
    $dato = $departamento->getDepartamento();
    echo "<option value='" . $dato->getDepartamentoId() . "' >" . $dato->getDescripcion() . "</option>";
}
echo "</select>";
?>
					 </div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-2 col-md-offset-2">
				<input type='submit' class="btn btn-primary" value='Buscar'>
			</div>
		</div>
	</form>
</div>
<div class="table-responsive">
<div class="container">
<?php
//var_dump($_POST);
if ($_POST) {
    $apellido = $_POST["apellido"];
    $nombre = $_POST["nombre"];
    $localidadId = $_POST["localidadId"];
    if ($apellido == "") {
        $apellido = NULL;
    }
    if ($nombre == "") {
        $nombre = NULL;
    }
    if ($localidadId == "0") {
        $localidadId = NULL;
    }

    $persona = new Persona(NULL, $apellido, $nombre, null, null, null, null, null, null, null, null, null, $localidadId, null);
    $resultado = $persona->buscar();

    echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
    echo "<thead>";
    echo "<tr><th>Foto</th>";
    echo "<th>Apellido</th>";
    echo "<th>Nombre</th>";
    echo "<th>DNI</th>";
    echo "<th>Email</th>";
    echo "<th>Teléfono Fijo</th>";
    echo "<th>Teléfono Movil</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($fila = mysqli_fetch_object($resultado)) {
            echo "<tr>";
            echo "<td>";
            //var_dump($fila);
            $nomArchivoFoto = "./img/perfil/";

            if ($fila->fotoPerfil == "") {
                $nomArchivoFoto .= "0000.jpg";
            } else {
                $nomArchivoFoto .= $fila->fotoPerfil;
            }
            $fotoArchivo = substr($nomArchivoFoto, 13);
            echo "<a href='#' id='perfil" . $fotoArchivo . "'><img  src='$nomArchivoFoto'  alt='perfil' id='foto" . $fila->personaId . "' class=' img-responsive img-circle' style= 'width: 45px; height: 45px;display:block;margin:auto;' ></a>";
            //var_dump($nomArchivoFoto);
            echo "</td>";
            echo "<td>" . $fila->apellido . "</td>";
            echo "<td>" . $fila->nombre . "</td>";
            echo "<td>" . $fila->dni . "</td>";
            echo "<td>" . $fila->email . "</td>";
            echo "<td>" . $fila->telefonoC . "</td>";
            echo "<td>" . $fila->telefonoM . "</td>";
            echo "</tr>";
            echo "\n";
        }

} else {
    $persona = new Persona(NULL);
}
echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";
?>
<div class="modal fade" id="fotoPerfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
		<!--**** Inicio de Header **** -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

				<h4 class="modal-title" id="myModalLabel">
				<br>
				</h4>

			</div><!--./modal-header-->


			<!-- ***** MODAL BODY ****-->

			<div class="modal-body" id="modal-body" >

			</div>
			<!-- **** FIN MODAL BODY ****-->
			<!-- **** INICIO MODAL FOOTER ****-->

			<div class="modal-footer" id="modal-footer">

				<div id="divButton">
					<button type="button" class="btn btn-default footerButton" data-dismiss="modal">Cerrar</button>
				</div>
				<div id="respuestasContenido"></div>
			</div>
			<!-- **** FIN MODAL FOOTER ****-->

			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<center>
 <img class="img-responsive img-circle wow bounceInRight" onclick="history.back()"  src="includes/mod_cen/portada/imgPortadas/back/flecha-buscar-rti.png"></center>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#myTable").tablesorter();
    }
    );
</script>
<script type="text/javascript" src="includes/mod_cen/portada/js/animatePortadas.js"></script>


<script type="text/javascript" src="includes/mod_cen/migracion_servidores/js/registrar_migracion.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script> -->
<!-- <script type="text/javascript" src="includes/mod_cen/escuelas/js/agregaMisEscuelasSupervisor.js"></script> -->
<script type="text/javascript">
    let referenteId = '<?php echo $_SESSION['referenteId'];?>'
    let tipoR = '<?php echo $_SESSION['tipo'];?>'
    let reports = 'AS'
</script>

<?php
    include_once("includes/mod_cen/clases/escuela.php");    
    include_once("includes/mod_cen/clases/MigracionServidores.class.php");    

    echo '<div class="container wow flipInX">';
    echo'<div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/busqueda (3).png"></div><h4><b>Registrar escuela migrada</b></h4>';

    echo '<hr>';
    echo'</div>';
    echo'<br>';
    echo'<br>';
    echo'<br>';

?>
<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-6'>
            <?php include_once("includes/mod_cen/formularios/f_buscar_escuela_simple.php");
            if(($_POST)){
                $cue=$_POST["cue"];
                $numero=$_POST["numero"];
                $nombre=$_POST["nombre"];
                $localidadId=$_POST["localidadId"];
                $escuela=new Escuela(NULL,null,$cue,$numero,$nombre,null,null,$localidadId,null);
                $resultado = $escuela->buscar();
                $resultado2= $escuela->buscar();
                $cantidadEscuela=mysqli_num_rows($resultado2);
                $primero=0;
                $cantidad=0;
                ?>
                <table class='table'>
                    <tr>
                        <td>Id</td>
                        <td>Numero</td>
                        <td>Cue</td>
                        <td>Nombre</td>
                        <td>Accion</td>
                    </tr>
                <?php
                    while ($row = mysqli_fetch_object($resultado)){
                        echo "<tr>";
                        echo "<td class='id'>$row->escuelaId</td>";
                        echo "<td class='numero'>$row->numero</td>";
                        echo "<td class='cue'>$row->cue</td>";
                        echo "<td class='nombre'>$row->nombre</td>";
                        echo "<td><button id='registrar$row->escuelaId' data-toggle='modal' data-target='#modalRegistrar' class='btn btn-warning'>Registrar</button></td>";
                        echo "</tr>";
                    }
            
                    
                    ?>
                </table>
                <?php
            
            }else{
                $escuela=new Escuela(NULL);
            }
            ?>
        </div>
        <div class='col-md-6'>
            <p class='alert alert-warning'>Mis migraciones registradas</p>
            <?php
                $migra = new MigracionServidores (null,null,null,$_SESSION['referenteId']);
                $buscarMigra = $migra->buscar();

                ?>
                <table class='table' id='misMigraciones'>
                    <thead>                    
                        <tr>
                            <td>Id</td>
                            <td>Numero</td>
                            <td>Cue</td>
                            <td>Nombre</td>
                            <td>Accion</td>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                while ($row = mysqli_fetch_object($buscarMigra)) {
                    echo "<tr>";
                        echo "<td class='id'>$row->escuelaId</td>";
                        echo "<td class='numero'>$row->numero</td>";
                        echo "<td class='cue'>$row->cue</td>";
                        echo "<td class='nombre'>$row->nombre</td>";
                        echo "<td><button id='editar$row->escuelaId' data-toggle='modal' data-target='#modalRegistrar' class='btn btn-warning'>Editar</button></td>";
                    echo "</tr>";
                }
                echo '</tbody>';
            ?>
            </table>
        </div>
    </div>
</div>


<!-- //Modal de edicion y creacion de registardion de migracion -->

<div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<!--**** Inicio de Header **** -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

				<h4 class="modal-title" id="myModalLabel">Formulario de registración de migración
				<br>
				</h4>

			</div><!--./modal-header-->


			<!-- ***** MODAL BODY ****-->

			<div class="modal-body" id="modal-body" >
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='col-md-12 alert alert-success'>Datos de Escuela</div>                            
                            <div class='col-md-6'>Numero:<br><input class='form-control' type="text" id="numero" name="numero" value="" disabled></div>
                            <div class='col-md-6'>Cue:<br><input class='form-control' type="text" id="cue" name="cue" value="" disabled></div>                        
                            <div class='col-md-12'>Escuela:<br><input class='form-control' type="text" id="nombre" name="nombre"  value="" disabled></div>
                    </div>        
                    <hr>
                    <div class='col-md-12'>
                        <div class='col-md-12 alert alert-success'>Fecha y observaciones</div>                            
                        <div class='col-md-12'>Fecha:<br><input class='form-control' type="date" id="dateMigracion" name="dateMigracion"  value=""></div>
                        <div class='col-md-12'>Observaciones:<br><textarea class='form-control'  id="observaciones"  name="observaciones" rows="4" cols="50"></textarea></div>
                    </div>    
                </div>
			</div>
			<!-- **** FIN MODAL BODY ****-->
			<!-- **** INICIO MODAL FOOTER ****-->

			<div class="modal-footer" id="modal-footer">

				<div id="divButton">
					<!-- <button type="button" class="btn btn-default footerButton" data-dismiss="modal">Cerrar</button> -->
                    <button type="button" class="btn btn-primary" id="guardarMigracion">Guardar</button>
				</div>
				<div id="respuestasContenido"></div>
			</div>
			<!-- **** FIN MODAL FOOTER ****-->

			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


    <!-- //Modal de edicion y creacion de registardion de migracion -->


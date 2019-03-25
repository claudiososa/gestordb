
<script type="text/javascript" src="includes/mod_cen/escuelas/js/ajax.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/agregaMisEscuelasSupervisor.js"></script>


<?php
    include_once("includes/mod_cen/clases/escuela.php");
    include_once("includes/mod_cen/clases/departamentos.php");
    include_once("includes/mod_cen/clases/localidades.php");
    include_once("includes/mod_cen/clases/persona.php");
    include_once("includes/mod_cen/clases/referente.php");
    include_once("includes/mod_cen/clases/rti.php");
    include_once("includes/mod_cen/clases/informe.php");
    include_once("includes/mod_cen/clases/director.php");
    include_once("includes/mod_cen/clases/EscuelaReferentes.php");
    include_once("includes/mod_cen/clases/Autoridades.php");
    include_once("includes/mod_cen/clases/EscuelaTipoAutoridad.php");
    include_once("includes/mod_cen/clases/CompartePredio.php");


    echo '<div class="container wow flipInX">';
    echo'<div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/busqueda (3).png"></div><h4><b>Registrar escuela migrada</b></h4>';

    echo '<hr>';
    echo'</div>';
    echo'<br>';
    echo'<br>';
    echo'<br>';

include_once("includes/mod_cen/formularios/f_buscar_escuela_simple.php");

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
            echo "<td>$row->escuelaId</td>";
            echo "<td>$row->numero</td>";
            echo "<td>$row->cue</td>";
            echo "<td>$row->nombre</td>";
            echo "<td><button class='btn btn-warning'>Registrar</button></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php

}else{
	$escuela=new Escuela(NULL);
}
?>
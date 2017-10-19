<script type="text/javascript">
  var referenteId = " <?php echo trim($_SESSION['referenteId']) ?>";
</script>
<script type="text/javascript" src="includes/mod_cen/documentos/panelportada.js"></script>
<script src="includes/mod_cen/portada/js/portadaCoordinadorFacilitador.js"></script>
<?php
require_once("includes/mod_cen/clases/informe.php");
require_once("includes/mod_cen/clases/persona.php");
require_once("includes/mod_cen/clases/referente.php");



$informes= new informe();
//create object referenteId and filter of status active
$referenteId=$_SESSION['referenteId'];

$referente= new Referente($referenteId);
$resultado_ett_acargo = $referente->Cargo("Activo");

$referente_ett= new Referente(null,null,"Facilitador");
$buscar_ett=$referente_ett->Tipo("Facilitador","Activo");

// todos los informes creados por referente Conectar Igualdad
$arrayFacilitadores = array ('Facilitador','CoordinadorFacilitador');
$informeEquipoSupevisorSecundaria = $informes->buscar(20,null,$arrayFacilitadores);

//busqueda de informes de proiridad alta
$informe_alta= new Informe(null,null,null,"Alta");
$buscar_alta =$informe_alta->buscar(20,null,$arrayFacilitadores);
$total = mysqli_num_rows($buscar_alta);

//busqueda de informes de proiridad media
$informe_media= new Informe(null,null,null,"Media");
$buscar_media =$informe_media->buscar(20,null,$arrayFacilitadores);
$media = mysqli_num_rows($buscar_media);

//busqueda de informes de proiridad normal
$informe_normal= new Informe(null,null,null,"Normal");
$buscar_normal =$informe_normal->buscar(20,null,$arrayFacilitadores);
$normal = mysqli_num_rows($buscar_normal);


//echo "alta".$total;
//echo "media".$media;



// creación y busqueda de todos los informes


$b_informe = $informes->buscar(20);

////////////////////////////////////////////////

$mis_informes= new informe(null,null,$_SESSION["referenteId"]);

$b_mis_informe = $mis_informes->buscar(10);

echo '<div class="container">';

//echo '<div class="alert alert-info" role="alert">';
//echo '<h4> <span class="badge">1 </span>&nbsp;<a href="index.php?mod=slat&men=referentes&id=10">Atención!! Nuevo -> Buscador de RTI, por nombre, apellido, etc.</a>  </h4>';
//echo '</div>';

echo '<div class="row">';
  echo '<div class="col-md-6">';

 //informes de prioridad alta ///
 if(mysqli_num_rows($buscar_alta)>0){
  ?>
  <div class="panel panel-primary">
    <div class="panel-heading" id="panel1"><span class="panel-title clickable">
      <h4>Informes Prioridad Alta<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
    </div>
    <div class="panel-body">
      <?php

  echo "<table id='myTableAlta' class='table table-hover table-striped table-condensed tablesorter'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>Id</th>";
  echo "<th>Título</th>";
  echo "<th>Nº</th>";
  echo "<th>Creado por...</th>";
  echo "<th>Prioridad</th>";
  echo "</tr>";
  echo "</thead>";

  echo "<tbody>";
  while ($fila=mysqli_fetch_object($buscar_alta)){

    $escuela= new Escuela($fila->escuelaId);
    $buscar_escuela= $escuela->buscar();
    $dato_escuela= mysqli_fetch_object($buscar_escuela);

    $referente = new Referente($fila->referenteId);
    $b_referente = $referente->buscar();

    $dato_referente= mysqli_fetch_object($b_referente);

    $persona = new Persona($dato_referente->personaId);

    $b_persona = $persona->buscar();

    $dato_persona=mysqli_fetch_object($b_persona);



    echo "<tr>";
    ?>
    <td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
    <td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
    <?php
    echo "<td>".$dato_escuela->numero."</td>";
    echo "<td>".$dato_persona->apellido."  ".$dato_persona->nombre."</td>";
    echo "<td>".$fila->prioridad."</td>";
    echo "</td>";
  }
  echo "</tbody>";
  echo "</table>";
  ?>
 </div>
 </div>
 <?php
 }

 ///////////////////////////////

 //informes de prioridad media ///
 if(mysqli_num_rows($buscar_media)>0){
  ?>
  <div class="panel panel-primary">
    <div class="panel-heading" id="panel2"><span class="panel-title clickable">
      <h4>Informes prioridad Media<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
    </div>
    <div class="panel-body">
      <?php

  echo "<table id='myTableMedia' class='table table-hover table-striped table-condensed tablesorter'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>Id</th>";
  echo "<th>Título</th>";
  echo "<th>Nº</th>";
  echo "<th>Creado por...</th>";
  echo "<th>Prioridad</th>";
  echo "</tr>";
  echo "</thead>";

  echo "<tbody>";
  while ($fila=mysqli_fetch_object($buscar_media)){

    $escuela= new Escuela($fila->escuelaId);
    $buscar_escuela= $escuela->buscar();
    $dato_escuela= mysqli_fetch_object($buscar_escuela);

    $referente = new Referente($fila->referenteId);
    $b_referente = $referente->buscar();

    $dato_referente= mysqli_fetch_object($b_referente);

    $persona = new Persona($dato_referente->personaId);

    $b_persona = $persona->buscar();

    $dato_persona=mysqli_fetch_object($b_persona);



    echo "<tr>";
    ?>
    <td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
    <td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
    <?php
    echo "<td>".$dato_escuela->numero."</td>";
    echo "<td>".$dato_persona->apellido."  ".$dato_persona->nombre."</td>";
    echo "<td>".$fila->prioridad."</td>";
    echo "</td>";
  }
  echo "</tbody>";
  echo "</table>";
  ?>
 </div>
 </div>
 <?php
 }

 ///////////////////////////////



  if(mysqli_num_rows($buscar_normal)>0){
    ?>
    <div class="panel panel-primary">
      <div class="panel-heading" id="panel3"><span class="panel-title clickable">
        <h4>Informes prioridad Normal<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
      </div>
      <div class="panel-body">
        <?php

    echo "<table id='myTableNormal' class='table table-hover table-striped table-condensed tablesorter'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Título</th>";
    echo "<th>Nº</th>";
    echo "<th>Creado por...</th>";
    echo "<th>Prioridad</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";
    while ($fila=mysqli_fetch_object($buscar_normal)){

      $escuela= new Escuela($fila->escuelaId);
      $buscar_escuela= $escuela->buscar();
      $dato_escuela= mysqli_fetch_object($buscar_escuela);

      $referente = new Referente($fila->referenteId);
      $b_referente = $referente->buscar();

      $dato_referente= mysqli_fetch_object($b_referente);

      $persona = new Persona($dato_referente->personaId);

      $b_persona = $persona->buscar();

      $dato_persona=mysqli_fetch_object($b_persona);



      echo "<tr>";
      ?>
      <td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
      <td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
      <?php
      echo "<td>".$dato_escuela->numero."</td>";
      echo "<td>".$dato_persona->apellido."  ".$dato_persona->nombre."</td>";
      echo "<td>".$fila->prioridad."</td>";
      echo "</td>";
    }
    echo "</tbody>";
    echo "</table>";
    ?>
   </div>
   </div>
<?php
 }
if(mysqli_num_rows($resultado_ett_acargo)>0){
  ?>
<?php
}
echo "</div>";
echo "<div class='col-md-6'>";


if(mysqli_num_rows($b_informe)>0){
?>
<div class="panel panel-primary">
  <div class="panel-heading" id="panel4"><span class="panel-title clickable">
    <h4>Ultimos informes creados por Facilitadores<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
  </div>
  <div class="panel-body">
    <?php

echo "<table id='myTable1' class='table table-hover table-striped table-condensed tablesorter'>";
echo "<thead>";
echo "<tr>";
echo "<th>Id</th>";
echo "<th>Título</th>";
echo "<th>Nº</th>";
echo "<th>Creado por...</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

while ($fila=mysqli_fetch_object($informeEquipoSupevisorSecundaria)){

  $escuela= new Escuela($fila->escuelaId);
  $buscar_escuela= $escuela->buscar();
  $dato_escuela= mysqli_fetch_object($buscar_escuela);

  $referente = new Referente($fila->referenteId);
  $b_referente = $referente->buscar();

  $dato_referente= mysqli_fetch_object($b_referente);

  $persona = new Persona($dato_referente->personaId);

  $b_persona = $persona->buscar();

  $dato_persona=mysqli_fetch_object($b_persona);
  echo "<tr>";
  ?>
  <td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
  <td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
  <?php
  echo "<td>".$dato_escuela->numero."</td>";
  echo "<td>".$dato_persona->apellido."  ".$dato_persona->nombre."</td>";
  echo "</td>";
}
echo "</tbody>";
echo "</table>";
?>
</div>
</div>


<div class="panel panel-primary">
<div class="panel-heading" id="panel5"><span class="panel-title clickable">
  <h4>Informes de Facilitadores a Cargo<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
</div>
<div class="panel-body">
  <?php
$mes= date('m');
$año= date('Y');
  echo "<form class='form-inline'>";
  echo "<div class='form-group'>";

  echo "<label  for='year'>Año:</label>";

  echo "<select class='form-control' name='year' id='year'>";
  /*if ($año ){
   echo '<option value="'.$año.'" selected>'.$año.'</option>';

 }*/
  echo "<option value='2017' ";
  echo ($año==2017) ?  ' selected ':'';
  echo ">2017</option>";

  echo "<option value='2018' ";
  echo ($año==2018) ?  ' selected ':'';
  echo ">2018</option>";

  echo "</select>";

  echo "</div>";
  echo "<div class='form-group'>";

  echo "<label  for='month'>Mes:</label>";
  echo "<select class='form-control' name='month' id='month'>";

  $meses = Maestro::meses();

  foreach ($meses as $key => $value) {
    if ($mes==$key) {
      echo '<option selected value="'.$key.'">'.$value.'</option>';
    }else{
      echo '<option value="'.$key.'">'.$value.'</option>';
    }

  }

  echo "</select>";
  echo "</div>";
  echo"<button type='button' id='buttomSearchDate' class='btn btn-warning' name='button'>buscar</button>";
  //var_dump($meses);
  echo "</form>";



  echo "<table class='table table-hover table-striped table-condensed tablesorter'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>Apellido y Nombre</th>";
  echo "<th>Total</th>";
  echo "<th>Mes Actual</th>";
  echo "<th>Horario</th>";
  echo "</tr>";
  echo "</thead>";

  echo "<tbody id='bodyTablaCargo'>";

  while ($fila=mysqli_fetch_object($resultado_ett_acargo)){
    echo "<tr>";
    echo "<td><a href='index.php?mod=slat&men=referentes&id=2&personaId=".$fila->personaId."&referenteId=".$fila->referenteId."'>".$fila->apellido.", ".$fila->nombre."</a></td>";
    echo "<td>";
    $informe_ett= new informe(null,null,$fila->referenteId);
    $buscar_informe=$informe_ett->buscar();
    $cantidad=mysqli_num_rows($buscar_informe);

    $mesAc=date("m");
    $buscarMesActualInforme=$informe_ett->summary('mesAñoReferente',null,null,null,$mesAc,'2017',null,$fila->referenteId);
    $totalMes=mysqli_num_rows($buscarMesActualInforme);

    //echo $cantidad;
    echo '<a class="btn btn-success" href="?mod=slat&men=informe&id=6&referenteId='.$fila->referenteId.'">'.$cantidad.'</a>';
    echo "</td>";
    echo "<td>";
    echo '<a class="btn btn-success" href="?mod=slat&men=informe&date&id=6&year='.$año.'&month='.$mes.'&referenteId='.$fila->referenteId.'">'.$totalMes.'</a>';
    echo "</td>";
    echo "<td>";
    echo '<a class="btn btn-success" href="?mod=slat&men=referentes&id=12&referenteId='.$fila->referenteId.'">Ver Horario</a>';
    echo "</td>";
    echo "</tr>";
  }

  echo "</tbody>";
  echo "</table>";
}

   ?>
</div>
</div>
<?php


if(mysqli_num_rows($b_mis_informe)>0){
?>
<div class="panel panel-primary">
<div class="panel-heading" id="panel6"><span class="panel-title clickable">
  <h4>Mis Informes (últimos 10)<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
</div>
<div class="panel-body">
<?php

echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
echo "<thead>";
echo "<tr>";
echo "<th>Id</th>";
echo "<th>Título</th>";
echo "<th>Nº</th>";
echo "<th>Creado por...</th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
while ($fila=mysqli_fetch_object($b_mis_informe)){

$escuela= new Escuela($fila->escuelaId);
$buscar_escuela= $escuela->buscar();
$dato_escuela= mysqli_fetch_object($buscar_escuela);

$referente = new Referente($_SESSION["referenteId"]);
$b_referente = $referente->buscar();

$dato_referente= mysqli_fetch_object($b_referente);

$persona = new Persona($dato_referente->personaId);

$b_persona = $persona->buscar();

$dato_persona=mysqli_fetch_object($b_persona);



echo "<tr>";
?>
<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
<?php
echo "<td>".$dato_escuela->numero."</td>";
echo "<td>".$dato_persona->apellido."  ".$dato_persona->nombre."</td>";
echo "</td>";
}
echo "</tbody>";
echo "</table>";
?>
</div>
</div>
<?php
}
echo "</div>";
echo "</div>";
echo "<div class='col-md-12'>";



?>
<script type="text/javascript">
$(document).ready(function()
  {
    //$("#myTable").tablesorter();
    $("#myTable").tablesorter( {sortList: [[0,1]]} );

      $("#myTableAlta").tablesorter( {sortList: [[0,1]]} );
      $("#myTableMedia").tablesorter( {sortList: [[0,1]]} );
      $("#myTableNormal").tablesorter( {sortList: [[0,1]]} );

    //$("#myTable1").tablesorter();
    $("#myTable1").tablesorter( {sortList: [[0,1]]} );
    $("#informe_etj").tablesorter( {sortList: [[1,1]]} );

  }
);
</script>
<div class="row">


  <div class="panel panel-primary">
  	<div class="panel-heading" id="panel7"><span class="panel-title clickable">
  		<h4>Documentación<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4>
  	</span>
  	</div>
  	<div class="panel-body">

  				<?php
  require_once("includes/mod_cen/documentos/documento.php")
  ?>
  </div>
  </div>
</div>

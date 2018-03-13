
<link rel="stylesheet" href="includes/mod_cen/css/styleIconos.css">
<script type="text/javascript">
    let referenteId2 = '<?php echo $_SESSION['referenteId'];?>'
</script>

<script type="text/javascript" src="includes/mod_cen/escuelas/js/validarMisEscuelasSnp.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/agregaMisEscuelasSupervisor.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informes.js"></script>
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>



<?php
include_once 'includes/mod_cen/clases/EscuelaReferentes.php';
include_once 'includes/mod_cen/clases/escuela.php';
include_once 'includes/mod_cen/clases/Autoridades.php';
include_once 'includes/mod_cen/clases/informe.php';

include_once "includes/mod_cen/clases/persona.php" ;
include_once "includes/mod_cen/clases/referente.php" ;
include_once "includes/mod_cen/clases/leido.php" ;
include_once "includes/mod_cen/clases/respuesta.php" ;
include_once "includes/mod_cen/clases/rtixescuela.php";
include_once "includes/mod_cen/clases/rti.php";
?>

<!----------------------------------------------------------------------------->
<!--MIS ESCUELAS SUPER VISTA DESKTOP-->
<!----------------------------------------------------------------------------->


<div class="container">
  <div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/escuela (2).png"></div><h4><b>Mis Escuelas</b><img class="img-responsive img-circle"  onclick="history.back()" align="right" src="includes/mod_cen/portada/imgPortadas/back/flecha-mis-esc.png"></h4>
  <hr class='hrMisEscRed'>
<br>
</div>


<div class="row">
  <div class="container">
<div class="panel panel-primary col-md-4">
  <div class="panel-body">
    <div class="styleFont" ><u>Accesos rapidos a acciones generales</u></div>

    <br>

    <form class="form-horizontal" action="" method="POST" >
      <input type="hidden" name="tipoId" id="tipoId" value="" />
  		<div class="form-group">
  				<div><label class="">Seleccione Escuela</label></div>
  			</div>
  			<div class="form-group">
  				<div class="">
            <select class="form-control" name="escuelaId" id="escuelaId" >
              <option value="0">Seleccione...</option>
            <?php
            $escuelasCargo = new EscuelaReferentes(null,null,'4',$_SESSION['referenteId']);
            $buscarEscuelas = $escuelasCargo->buscar();
            $escuela = new Escuela();
            while ($row = mysqli_fetch_object($buscarEscuelas)) {
              $escuela->escuelaId=$row->escuelaId;
              $buscarEscuela = $escuela->buscar();
              $infoEscuela = mysqli_fetch_object($buscarEscuela);
              echo '<option value="'.$row->escuelaId.'">'.$infoEscuela->numero.' '.substr($infoEscuela->nombre,0,30).'</option>';
            }
          ?>
          </select>
  				</div>
  			</div>
  	</form>

    <form class="form-horizontal" action="" method="POST" >
      <div class="form-group">
          <div><label class="">Seleccione Escuela</label></div>
        </div>
        <div class="form-group">
          <div class="">
              <select class="form-control" name="" id="modulo">
                <option value="informe&id=1">Crear informe</option>
                <option value="informe&id=2">Ver informes</option>
                <optgroup label="____________________________"></optgroup>
                <option value="director">Director</option>
                <option value="snp">Supervisor de Nucleo</option>
                <option value="srp">Supervisor de Religion</option>
                <option value="">Cargar modificar autoridad</option>

              </select>
          </div>
        </div>

    </form>

    <div class="form-group">
      <div class="" id="padreIr">
        <input class="btn btn-primary" type="submit" value="ir" id="btn_ir">
      </div>
    </div>

  </div><!--</div panel-body-->
</div><!-- </div panel default -->
<div class="panel panel-primary col-md-7 col-md-offset-1 hidden-xs">
  <div class="panel-body">
    <div class="styleFont" align="text-center"><u>Ultimos 5 informes creados</u><a href="index.php?mod=slat&men=informe&id=6&referenteId=<?php echo $_SESSION['referenteId'] ?>"></a></div>
      <?php
        echo "<div class='table-responsive'>";
        echo "<table id='tablaPrincipal' class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th class='hidden'>Id</th>";
        echo "<th>Título Informe</th>";
        echo "<th>Nº Esc</th>";
        echo "<th>Leido</th>";
        echo "<th>Respuestas</th>";
        echo "<th>Prioridad</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";


  // listo los ultimos 5 informes realizado por el ett loguegado.

  $mis_informes= new informe(null,null,$_SESSION["referenteId"]);
  $b_mis_informe = $mis_informes->buscar(5);
  $leido = new Leido();
  $resp = new Respuesta();

  while ($fila=mysqli_fetch_object($b_mis_informe)){

    echo "<tr id= 'encabezado.$fila->informeId'>";
    ?>
    <td class='hidden'> <?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
    <td><?php  echo   '<a class="btn btn-default" role="button" id="list'.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>


    <?php // echo '<a id="list'.$fila->informeId.'" href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?>
    <?php
    echo "<td>".$fila->numero."</td>";

    $leido->informeId=$fila->informeId;
    $buscarLeido = $leido->buscar();
    $cantidadLeido=mysqli_num_rows($buscarLeido);

    echo "<td>".$cantidadLeido."</td>";

    $resp->informeId=$fila->informeId;
    $buscarResp = $resp->buscar();
    $cantidadResp = mysqli_num_rows($buscarResp);

    echo "<td>".$cantidadResp."</td>";
    echo "<td>".$fila->prioridad."</td>";
    echo "</tr>";

    }
    echo "</tbody>";
  echo "</table>";
echo "</div>";

  ?>
  </div>
</div>
</div>
</div>

<div class="row">

<div class="container">


<table class="table table-bordered hidden-xs">
  <thead>
    <tr class='danger' >
      <th>CUE</th>
      <th>N°</th>
      <th>Nombre</th>
      <th>Informes</th>
      <th>Autoridades</th>
      <th>RTI</th>
    </tr>
  </thead>

  <tbody>

    <?php
      //Seleccino todas las escuelas que tiene a cargo el referente loegado mediante el dato de personaId
      $escuelasCargo = new EscuelaReferentes(null,null,'4',$_SESSION['referenteId']);
      $buscarEscuelas = $escuelasCargo->buscar();

      $escuela = new Escuela();

      while ($row = mysqli_fetch_object($buscarEscuelas)) {

        $rtix= new rtixescuela($row->escuelaId);

        $buscar_rti=$rtix->buscar();

        $cantidadRti=mysqli_num_rows($buscar_rti);


        $informe = new informe(null,$row->escuelaId,$_SESSION['referenteId']);
        $buscarInforme= $informe->buscar();
        $cantidadInforme = mysqli_num_rows($buscarInforme);

        $autoridad = new Autoridades(null,$row->escuelaId);
        $buscarAutoridad = $autoridad->buscarAutoridad3('all');
        $cantidadAutoridades = mysqli_num_rows($buscarAutoridad);

        $escuela->escuelaId=$row->escuelaId;
        $buscarEscuela = $escuela->buscar();
        $infoEscuela = mysqli_fetch_object($buscarEscuela);

        //echo $infoEscuela->numero."<br>";
        echo '<tr id="fila'.$infoEscuela->escuelaId.'">';
        echo '<td>'.$infoEscuela->cue.'</td>';
        echo '<td>'.$infoEscuela->numero.'</td>';
        echo '<td>'.$infoEscuela->nombre.'</td>';
        echo '<td id="informes'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-warning" id="info'.$infoEscuela->escuelaId.'" name="button">'.$cantidadInforme.'</button></td>';
        echo '<td id="row'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-success" id="autoridad'.$infoEscuela->escuelaId.'" name="button">'.$cantidadAutoridades.' </button><span id="verAutoridad'.$infoEscuela->escuelaId.'" class="pull-right clickable"><i  class="glyphicon glyphicon-chevron-down"></i></span></td>';
        echo '<td id="tecnico'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-success" id="rti'.$infoEscuela->escuelaId.'" name="button">'.$cantidadRti.' </button><span id="verRti'.$infoEscuela->escuelaId.'" class="pull-right clickable"><i  class="glyphicon glyphicon-chevron-down"></i></span></td>';
        echo '</tr>';
        ?>


        <?php
      }
    ?>

  </tbody>
</table>

</div>

</div> <!-- </div container> -->



<!----------------------------------------------------------------------------->
<!--MIS ESCUELAS SUPER VISTA MOBILE-->
<!----------------------------------------------------------------------------->
<div class="container visible-xs">
<?php
  //Seleccino todas las escuelas que tiene a cargo el referente loegado mediante el dato de personaId
  $escuelasCargo = new EscuelaReferentes(null,null,'4',$_SESSION['referenteId']);
  $buscarEscuelas = $escuelasCargo->buscar();

  $escuela = new Escuela();

  while ($row = mysqli_fetch_object($buscarEscuelas)) {
    $informe = new informe(null,$row->escuelaId,$_SESSION['referenteId']);
    $buscarInforme= $informe->buscar();
    $cantidadInforme = mysqli_num_rows($buscarInforme);

    $autoridad = new Autoridades(null,$row->escuelaId);
    $buscarAutoridad = $autoridad->buscarAutoridad3('all');
    $cantidadAutoridades = mysqli_num_rows($buscarAutoridad);

    //$arrayPrincipal=array();

    $escuela->escuelaId=$row->escuelaId;
    $buscarEscuela = $escuela->buscar();
    $infoEscuela = mysqli_fetch_object($buscarEscuela);



    //echo $infoEscuela->numero."<br>";
    //echo '<div class="container visible-xs">';
    echo '<div class="panel panel-primary panelPrimarySuperP">';
    echo '<div class="panel-heading clickable" id="panel-heading">'.$infoEscuela->numero.' '.$infoEscuela->nombre.'</div>';
    echo '<div class="panel-body escuela">';
    echo '<div class="row">';
  //  echo '<br>';
    echo '<div class="col-md-12"><h4><b>Teléfono: </b></h4>'.$infoEscuela->telefono.'</div>';
    echo '</div>';
  //  echo '<div class="row">';
  //  echo '<div class="col-md-12"><b>Email:</b></div>';
  //  echo '</div>';
    //echo '<br>';
    echo '<hr class="hrSeparador">';
    echo '<h4><b>Mis Informes</b></h4>';
    echo '<div class="row">';
    echo '<div class="col-md-12">';
    echo '<button type="button" class="btn btn-danger"name="button" >Ver Informes '.$cantidadInforme.'</button>&nbsp&nbsp&nbsp&nbsp&nbsp';

    echo '<button type="button" class="btn btn-danger"name="button">Crear Nuevo</button>';
    echo '</div>';
  //  echo '<br>';
  //  echo '<div class="col-md-12">';
    //echo '<button type="button" class="btn btn-danger"name="button">Crear</button>';
  //  echo '</div>';
    echo '</div>';
    echo '<hr class="hrSeparador">';
    echo '<h4><b>Autoridades: ('.$cantidadAutoridades.')</b></h4>';

    if ($cantidadAutoridades > 0) {
      while ($rowAutoridades = mysqli_fetch_object($buscarAutoridad)) {
      echo '<div class="row" >';
      echo '<div class="col-xs-8"> <b>'.$rowAutoridades->cargoAutoridad. ':</b> '.$rowAutoridades->nombre. ' '.$rowAutoridades->apellido. '</div>';
      echo '<div class="col-xs-2"><img class="img-responsive" src="img/iconos/lapiz (4).png"></div>';
      echo '<div class="col-xs-2"><img class="img-responsive" src="img/iconos/mas.png" data-toggle="popover" tabindex="0" data-trigger="focus" title="'.$rowAutoridades->nombre. ' '.$rowAutoridades->apellido. '" data-placement="left" data-content=" Cel:'.$rowAutoridades->telefonoM.'<br>  Email: '.$rowAutoridades->email. '<br>  Dni: '.$rowAutoridades->dni. '<br>  Cuil: '.$rowAutoridades->cuil. '" ></div>';
        echo '</div>';
        echo '<br>';
        echo '<div class="row" id="rowContacto">';
      if ($rowAutoridades->telefonoM != '') {


        echo '<div class="col-xs-2 pull-right"><a target="_blank" href="https://api.whatsapp.com/send?phone=54'.$rowAutoridades->telefonoM.'" ><img class="img-responsive" src="img/iconos/whatsapp (1).png"></a></div>';
        echo '<div class="col-xs-2 pull-right"><a href="tel:'.$rowAutoridades->telefonoM.'" ><img class="img-responsive" src="img/iconos/llamada-saliente (1).png"></a>';
        echo '</div>';



      //  echo '<br>';

      //  echo '<div class="col-xs-2"></div>';

      }
      if ($rowAutoridades->email != '') {

        echo '<div class="col-xs-2 pull-right"><a href="mailto:'.$rowAutoridades->email. '"><img class="img-responsive" src="img/iconos/gmail.png"></a>';
        echo '</div>';

      }
echo '</div>';

      //${ echo'<a href="tel:'.$rowAutoridades->telefonoM.'">Llama</a>';}
    //  echo '<br>';
    //  echo '<br>';
      //echo '<br>';


      echo '<hr>';
      }
    }

    //echo '<div class="col-md-12">perez juan supervisor primaria</div>';

    echo '</div>';

    echo '</div>';


    echo '<div>';
    echo '<div>';


  }
  ?>

</div>


<!--modal boton autoridades vista desktop-->

<!--
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Autoridades escuela 5159</h4>
      </div>
      <div class="modal-body">
      Supervisor primaria diaz juan
      <br>
      director colque juan
      <br>supervisor religion marta diaz
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>-->

<!--fin modal vista desktop-->



  <script>
  $(document).ready(function(){

   $(".escuela").hide()

//dropdown accesos acciones generales
    $('.dropdown-submenu a.test').on("click", function(e){
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });

//paneles escuelas vista mobile
    $(document).on('click', '#panel-heading ' , 'span.clickable', function(){

        var $this = $(this);

    $this.closest('.panel').find('.panel-body').toggle();


    });

  });
  $(function () {
  $('[data-toggle="popover"]').popover({ html : true })
})
  </script>

<link rel="stylesheet" href="includes/mod_cen/css/styleIconosSuperPrim.css">
<link rel="stylesheet" href="includes/mod_cen/css/default.css">
<link rel="stylesheet" href="includes/mod_cen/css/default.date.css">

<script type="text/javascript">
    let referenteId2 = '<?php echo $_SESSION['referenteId'];?>'
    let tipoR = '<?php echo $_SESSION['tipo'];?>'
</script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/agregaMisEscuelasSupervisor.js?v=<?php echo(rand()); ?>"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/validarMisEscuelasSnp.js?v=<?php echo(rand()); ?>"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informeNuevo.js?v=<?php echo(rand()); ?>"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/ajax.js?v=<?php echo(rand()); ?>"></script>

<script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.date.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/legacy.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informes.js?v=<?php echo(rand()); ?>"></script>

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
  <div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/escuela (2).png"></div><h4><b>Mis Escuelas</b><img class="img-responsive img-circle" onclick="history.back()" align="right" src="includes/mod_cen/portada/imgPortadas/back/flecha-mis-esc.png"></h4>
  <hr class='hrMisEscRed'>
<br>
</div>

<div class="form-group">
  <div class="" id="padreIr">
  </div>
</div>
  <input type="hidden" name="tipoId" id="tipoId" value="" />
<div class="row">
  <div class="container">
<div class="panel panel-primary col-md-12">
  <div class="panel-body hidden-xs">
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
        echo "<th>Resp.</th>";
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
    $buscarLeido = $leido->buscar(null,null,$fila->referenteId);
    $cantidadLeido=mysqli_num_rows($buscarLeido);
    $lectores="";
    while ($rowLeido = mysqli_fetch_object($buscarLeido)) {
      $lectores.= $rowLeido->apellido.', '.$rowLeido->nombre.'<br>';
      //.'<br>'.$rowLeido->fechaHora;
    }

    if ($cantidadLeido>0) {
      echo '<td><a href="#" data-toggle="popover" data-trigger="focus" title="Leido por" data-content="'.$lectores.'">'.$cantidadLeido.'</a></td>';
    }else{
      echo '<td>'.$cantidadLeido.'</td>';
    }


    $resp->informeId=$fila->informeId;
    $buscarResp = $resp->buscar();
    $cantidadResp = mysqli_num_rows($buscarResp);
    $autores="";
    while ($rowResp = mysqli_fetch_object($buscarResp)) {
      $autores.= $rowResp->apellido.', '.$rowResp->nombre.'<br>';
      //.'<br>'.$rowLeido->fechaHora;
    }


    if ($cantidadLeido>0) {
      echo '<td><a href="#" data-toggle="popover" data-trigger="focus" title="Respondido por" data-content="'.$autores.'">'.$cantidadResp.'</a></td>';
    }else{
      echo "<td>".$cantidadResp."</td>";
    }



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
      $escuelasCargo = new EscuelaReferentes(null,null,'19',$_SESSION['referenteId']);
      $buscarEscuelas = $escuelasCargo->buscar();

      $escuela = new Escuela();

      while ($row = mysqli_fetch_object($buscarEscuelas)) {

        $rtix= new rtixescuela($row->escuelaId);

        $buscar_rti=$rtix->buscar();

        $cantidadRti=mysqli_num_rows($buscar_rti);


        $informe = new informe(null,$row->escuelaId);

        $arrayReferente= ['ETT','ETJ','Coordinador'];

        $buscarInforme= $informe->buscar(null,null,$arrayReferente);

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
        echo '<td id="row'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-success" id="autoridad'.$infoEscuela->escuelaId.'" name="button">'.$cantidadAutoridades.' </button><span id="verAutoridad'.$infoEscuela->escuelaId.'" class="pull-right clickable"></span></td>';
        if ($cantidadRti > 0 ) {
          echo '<td id="tecnico'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-success" id="rti'.$infoEscuela->escuelaId.'" name="button">'.$cantidadRti.' </button><span id="verRti'.$infoEscuela->escuelaId.'" class="pull-right clickable"></span></td>';
        }else{
          echo '<td id="tecnico'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-success" name="button">'.$cantidadRti.' </button><span id="verRti'.$infoEscuela->escuelaId.'" class="pull-right clickable"></span></td>';
        }



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
<!-- <div class="container visible-xs">
<?php
  //Seleccino todas las escuelas que tiene a cargo el referente loegado mediante el dato de personaId
  $escuelasCargo = new EscuelaReferentes(null,null,'19',$_SESSION['referenteId']);
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

    //$arrayPrincipal=array();

    $escuela->escuelaId=$row->escuelaId;
    $buscarEscuela = $escuela->buscar();
    $infoEscuela = mysqli_fetch_object($buscarEscuela);


    //
    // echo $infoEscuela->numero."<br>";
    // echo '<div class="container visible-xs">';
    echo '<div class="panel panel-primary">';
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
      echo '<div class="col-xs-2"><img id="celIdAuto" class="img-responsive" src="img/iconos/lapiz (4).png"></div>';
      echo '<div class="col-xs-2">
            <img class="img-responsive" src="img/iconos/mas.png" data-toggle="popover" tabindex="0" data-trigger="focus"
            title="'.$rowAutoridades->nombre. ' '.$rowAutoridades->apellido. '" data-placement="left" data-content=" Cel:'.$rowAutoridades->telefonoM.'<br>  Email: '.$rowAutoridades->email. '<br>  Dni: '.$rowAutoridades->dni. '<br>  Cuil: '.$rowAutoridades->cuil. '" >
          </div>';
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

</div> -->




  <script>
  $(document).ready(function(){

   //$(".escuela").hide()

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

<link rel="stylesheet" href="includes/mod_cen/css/styleIconosSuperPrim.css">
<link rel="stylesheet" href="includes/mod_cen/css/default.css">
<link rel="stylesheet" href="includes/mod_cen/css/default.date.css">

<script type="text/javascript">
    let referenteId2 = '<?php echo $_SESSION['referenteId'];?>'
    let tipoR = '<?php echo $_SESSION['tipo'];?>'
    let reports = 'ETT'
</script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/agregaMisEscuelasSupervisor.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/validarMisEscuelasSnp.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informeNuevo.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/predioNuevo.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/ajax.js"></script>

<script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.date.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/legacy.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informes.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/jsValidarPersona.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/jsValidarInforme.js"></script>

<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>



<?php
// var_dump($_SESSION['tipoNumero']);
// var_dump($_SESSION['tipo']);
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
include_once "includes/mod_cen/clases/CompartePredio.php";
include_once "includes/mod_cen/clases/UpdateData.php";
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
<div class="row hidden-xs">
  <div class="container">
<div class="panel panel-primary col-md-12">
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
    <tr class='primary' >
      <th>CUE</th>
      <th>N°</th>
      <th>Nombre</th>
      <th>Informes</th>
      <th>Autoridades</th>
      <th>RTI</th>
      <th>Predio</th>
    </tr>
  </thead>

  <tbody>

    <?php
      //Seleccino todas las escuelas que tiene a cargo el referente loegado mediante el dato de personaId
      $escuelasCargo = new EscuelaReferentes(null,null,$_SESSION['tipoNumero'],$_SESSION['referenteId']);
      $buscarEscuelas = $escuelasCargo->buscar();

      $escuela = new Escuela();

      $updateData = new UpdateData();

      while ($row = mysqli_fetch_object($buscarEscuelas)) {

        $rtix= new rtixescuela($row->escuelaId);

        $buscar_rti=$rtix->buscar();

        $cantidadRti=mysqli_num_rows($buscar_rti);


        $informe = new informe(null,$row->escuelaId);

        $arrayReferente= ['ETT','ETJ','Coordinador','COORCONECT'];

        $buscarInforme= $informe->buscar(null,null,$arrayReferente);

        $cantidadInforme = mysqli_num_rows($buscarInforme);

        $autoridad = new Autoridades(null,$row->escuelaId);
        $buscarAutoridad = $autoridad->buscarAutoridad3('all');
        $cantidadAutoridades = mysqli_num_rows($buscarAutoridad);



        $escuela->escuelaId=$row->escuelaId;
        $buscarEscuela = $escuela->buscar();
        $infoEscuela = mysqli_fetch_object($buscarEscuela);

        //Consulta sobre la cantidad de predio para la escuela actual
        $predio = new CompartePredio(null,$row->escuelaId);

        $cantidadPredio = $predio->buscarPredio('count');


        //echo $infoEscuela->numero."<br>";
        echo '<tr id="fila'.$infoEscuela->escuelaId.'">';
        echo '<td>'.$infoEscuela->cue.'</td>';
        echo '<td>'.$infoEscuela->numero.'</td>';

        $mensajeUpdate ="";
        $updateData->referenteId = $_SESSION['referenteId'];
        $updateData->table_name = 'escuelas';
        $buscarUpdate = $updateData->buscar();
        $resultadoUpdate = mysqli_num_rows($buscarUpdate);

        echo '<td class="alert alert-danger">
                <a href="index.php?mod=slat&men=escuelas&id=3&escuelaId='.$infoEscuela->escuelaId.'">'.$infoEscuela->nombre.'</a>
                <br>Alerta falta actualizar datos
              </td>';

        echo '<td id="informes'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-warning" id="info'.$infoEscuela->escuelaId.'" name="button">'.$cantidadInforme.'</button></td>';
        echo '<td id="row'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-success" id="autoridad'.$infoEscuela->escuelaId.'" name="button">'.$cantidadAutoridades.' </button><span id="verAutoridad'.$infoEscuela->escuelaId.'" class="pull-right clickable"></span></td>';
        if ($cantidadRti > 0 ) {
          echo '<td id="tecnico'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-success" id="rti'.$infoEscuela->escuelaId.'" name="button">'.$cantidadRti.' </button><span id="verRti'.$infoEscuela->escuelaId.'" class="pull-right clickable"></span></td>';
        }else{
          echo '<td id="tecnico'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-success" name="button">'.$cantidadRti.' </button><span id="verRti'.$infoEscuela->escuelaId.'" class="pull-right clickable"></span></td>';
        }
        echo '<td id="predios'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-warning" id="pre'.$infoEscuela->escuelaId.'" name="button">'.$cantidadPredio.'</button></td>';



        echo '</tr>';
        ?>


        <?php
      }
    ?>

  </tbody>
</table>

</div>

</div>
 </div ><!---row>

<!----------------------------------------------------------------------------->
<!--MIS ESCUELAS SUPER VISTA MOBILE-->
<!----------------------------------------------------------------------------->
<div class="container visible-xs">
<?php
  //Seleccino todas las escuelas que tiene a cargo el referente loegado mediante el dato de personaId
  //Seleccino todas las escuelas que tiene a cargo el referente loegado mediante el dato de personaId
  $escuelasCargo = new EscuelaReferentes(null,null,$_SESSION['tipoNumero'],$_SESSION['referenteId']);
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

    //Consulta sobre la cantidad de predio para la escuela actual
    $predio = new CompartePredio(null,$row->escuelaId);
    $cantidadPredio = $predio->buscarPredio('count');
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
    echo '<div class="row" >';

    echo '<div class="col-md-12" id="informeM'.$infoEscuela->escuelaId.'" >';
    echo '<button type="button" class="btn btn-danger"name="button" id="infoM'.$infoEscuela->escuelaId.'">Ver Informes '.$cantidadInforme.'</button>';
    //echo '&nbsp';
    //echo '</div>';
//echo '<br>';
echo '<br>';
    //echo '<div class="col-md-12" id="informeN'.$infoEscuela->escuelaId.'" >';
  //  echo '<button type="button"id="nuevoInforme'.$infoEscuela->escuelaId.'" class="btn btn-danger"name="button">Crear Informe</button>';
    echo '</div>';

    echo '</div>';
    echo '<hr class="hrSeparador">';
    echo '<h4><b>Autoridades: ('.$cantidadAutoridades.')</b></h4>';

    if ($cantidadAutoridades > 0) {
      while ($rowAutoridades = mysqli_fetch_object($buscarAutoridad)) {
      echo '<div class="row" id="'.$infoEscuela->escuelaId.'">';
      echo '<div class="col-xs-8"> <b>'.$rowAutoridades->cargoAutoridad. ':</b> '.$rowAutoridades->nombre. ' '.$rowAutoridades->apellido. '</div>';
            echo '<div class="col-xs-2" id="'.$infoEscuela->escuelaId.'"><img id="autorM'.$rowAutoridades->tipoId.'" class="img img-responsive" src="img/iconos/lapiz (4).png"></div>';
      echo '<div class="col-xs-2">
            <img class="img img-responsive" src="img/iconos/mas.png" data-toggle="popover" tabindex="0" data-trigger="focus"
            title="'.$rowAutoridades->nombre. ' '.$rowAutoridades->apellido. '" data-placement="left" data-content=" Cel:'.$rowAutoridades->telefonoM.'<br>  Email: '.$rowAutoridades->email. '<br>  Dni: '.$rowAutoridades->dni. '<br>  Cuil: '.$rowAutoridades->cuil. '" >
          </div>';
        echo '</div>';
        echo '<br>';
        echo '<div class="row" id="rowContacto">';
      if ($rowAutoridades->telefonoM != '') {


        echo '<div class="col-xs-2 pull-right"><a target="_blank" href="https://api.whatsapp.com/send?phone=54'.$rowAutoridades->telefonoM.'" ><img class="img img-responsive" src="img/iconos/whatsapp (1).png"></a></div>';
        echo '<div class="col-xs-2 pull-right"><a href="tel:'.$rowAutoridades->telefonoM.'" ><img class="img img-responsive" src="img/iconos/llamada-saliente (1).png"></a>';
        echo '</div>';



      //  echo '<br>';

      //  echo '<div class="col-xs-2"></div>';

      }
      if ($rowAutoridades->email != '') {

        echo '<div class="col-xs-2 pull-right"><a href="mailto:'.$rowAutoridades->email. '"><img class="img img-responsive" src="img/iconos/gmail.png"></a>';
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
    echo "<hr class='hrSeparador'>";
    echo '<h4 id="predioM'.$infoEscuela->escuelaId.'"><b id="preM'.$infoEscuela->escuelaId.'">Predios ('.$cantidadPredio.')</b></h4>';


    echo '</div>';

    echo '</div>';


  }
  ?>

</div>




  <script>
  $(document).ready(function(){

   $(".escuela").hide()
  // $(".img").css('display', 'true');

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

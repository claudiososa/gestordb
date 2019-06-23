<link rel="stylesheet" href="includes/mod_cen/css/styleIconosSuperPrim.css">
<link rel="stylesheet" href="includes/mod_cen/css/default.css">
<link rel="stylesheet" href="includes/mod_cen/css/default.date.css">

<script type="text/javascript">
    let referenteId2 = '<?php echo $_SESSION['referenteId'];?>'
    let tipoR = '<?php echo $_SESSION['tipo'];?>'
    let reports = 'ETT'
</script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/ett/conectividad.js"></script>
<!-- <script type="text/javascript" src="includes/mod_cen/escuelas/js/validarMisEscuelasSnp.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informeNuevo.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/predioNuevo.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/ajax.js"></script> -->

<!-- <script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.date.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/legacy.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informes.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/jsValidarPersona.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/jsValidarInforme.js"></script>

<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script> -->



<?php



// var_dump($_SESSION['tipoNumero']);
// var_dump($_SESSION['tipo']);
include_once 'includes/mod_cen/clases/EscuelaReferentes.php';
include_once 'includes/mod_cen/clases/escuela.php';
include_once 'includes/mod_cen/clases/Conectividad.class.php';

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

$guardado = 0;

if ($_POST) {
    $escuela = new Escuela($_POST['escuela_id']);
    
    $escuela->conectividad = $_POST['conectividad'];
    $escuela->pc_escritorio = $_POST['pc_escritorio'];
    $escuela->rti = $_POST['rti'];

    $buscar_escuela = $escuela->editar('conectividad');
    
    $conectividad = new Conectividad(null,$_POST['escuela_id']);
    

    if ($_POST['conectividad'] =='SI') {
      
      // verifica y elimina de la tabla el tipo de conectividad sino es un tipo seleccionado en el formulario
      for ($i=1; $i < 4; $i++) { 
        $eliminar = 0;
        foreach ($_POST['type_conectividad'] as $key => $value) {
          if ($i == $value) {
            $eliminar++;
          }
        } 
        
        if ($eliminar == 0) {
          $conectividad->conectividad_servicio_id = $i;        
          $conectividad->eliminar();
        }else{
          $eliminar = 0;
        }        
      }


        foreach ($_POST['type_conectividad'] as $key => $value) {

            
            $conectividad->conectividad_servicio_id = $value;
            
            if ($conectividad->buscar(null,'cantidad') == 0) {
              $conectividad->created_at = date("Y-m-d H:i:s");
              $conectividad->referente_id = $_SESSION['referenteId'];
              $conectividad->agregar();
              $conectividad->referente_id = NULL;
            }
            
        }
    }else if($_POST['conectividad'] =='NO'){
        $conectividad->eliminar();
    }

    $guardado = 1;
}

?>



<!----------------------------------------------------------------------------->
<!--MIS ESCUELAS SUPER VISTA DESKTOP-->
<!----------------------------------------------------------------------------->


<div class="container">
  <div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/escuela (2).png"></div><h4><b>Datos de Conectividad y RTI</b><img class="img-responsive img-circle" onclick="history.back()" align="right" src="includes/mod_cen/portada/imgPortadas/back/flecha-mis-esc.png"></h4>
  <hr class='hrMisEscRed'>
<br>
</div>

<div class="form-group">
  <div class="" id="padreIr">
  </div>
</div>
  <input type="hidden" name="tipoId" id="tipoId" value="" />
<div class="row hidden-xs">

<div class="row">

<div class="container">

<?php 
if ($guardado == 1) {
  echo "<div class='alert alert-danger alert-dismissable'>";
  echo "<strong>¡Excelente!</strong> Se guardaron los datos correctamente.<br>";
  $escuela = new Escuela($_POST['escuela_id']);
  $buscar = $escuela->buscar();
  $row = mysqli_fetch_object($buscar);
  echo "Para la Institución: ".$row->nombre;   
  echo "</div>"; 
}
?>



<!-- <table class="table table-bordered hidden-xs">
  <thead>
    <tr class='primary' >
      <th>CUE</th>
      <th>N°</th>
      <th>Nombre</th>      
    </tr>
  </thead>

  <tbody> -->

    <?php
      //Seleccino todas las escuelas que tiene a cargo el referente loegado mediante el dato de personaId
      $escuelasCargo = new EscuelaReferentes(null,null,$_SESSION['tipoNumero'],$_SESSION['referenteId']);
      $buscarEscuelas = $escuelasCargo->buscar();

      $escuela = new Escuela();

      $updateData = new UpdateData();

      while ($row = mysqli_fetch_object($buscarEscuelas)) {
        
        //if ($row->numero > 2005) {
            # code...
        
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

        $escuela->escuelaId = $row->escuelaId;

        $buscarEscuela = $escuela->buscar();

        $infoEscuela = mysqli_fetch_object($buscarEscuela);
       
        if( ($infoEscuela->numero > 2999 && $infoEscuela->numero < 3999) || ($infoEscuela->numero > 4999 && $infoEscuela->numero < 5999) ){

        ?>
        <div class="panel panel-default">
            <div style="background-color:#F7BE81" class="panel-heading" id="p_header<?php echo $infoEscuela->escuelaId ?>">
                <?php echo "$infoEscuela->numero - $infoEscuela->cue - $infoEscuela->nombre" ?>
            </div>
                <div class="panel-body" id="p_body<?php echo $infoEscuela->escuelaId ?>">
                    
                </div>
        </div>
        
        
        
        <?php
        }
        }
    //}
      
    ?>

  <!-- </tbody>
</table> -->

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

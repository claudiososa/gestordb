<!-- <link rel="stylesheet" href="includes/mod_cen/css/styleIconosSuperPrim.css">
<link rel="stylesheet" href="includes/mod_cen/css/default.css">
<link rel="stylesheet" href="includes/mod_cen/css/default.date.css"> -->

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
  <div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/escuela (2).png"></div>
    <h4><b>Datos de Conectividad y RTI</b><img class="img-responsive img-circle" onclick="history.back()" align="right" src="includes/mod_cen/portada/imgPortadas/back/flecha-mis-esc.png"></h4>
    <hr class='hrMisEscRed'>
    <br>
  </div>
  <div class="col-md-8 col-md-offset-2">


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
            <?php if ($infoEscuela->rti <> NULL) {?>
              <div style="background-color:#FAAC58"  class="panel-heading" id="p_header<?php echo $infoEscuela->escuelaId ?>">
                <?php echo "$infoEscuela->numero - $infoEscuela->cue - $infoEscuela->nombre" ?>
              </div>
            <?php }else{ ?>
              <div style="background-color:#BDBDBD" class="panel-heading" id="p_header<?php echo $infoEscuela->escuelaId ?>">
                <?php echo "$infoEscuela->numero - $infoEscuela->cue - $infoEscuela->nombre" ?>
            </div>
            <?php } ?>
            

            


                <div style="background-color:#D8D8D8" class="panel-body" id="p_body<?php echo $infoEscuela->escuelaId ?>">
                    
                </div>
        </div>
        
        
        
        <?php
        }
        }
    //}
      
    ?>

</div>

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

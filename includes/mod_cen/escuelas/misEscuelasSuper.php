<script type="text/javascript">
    let referenteId2 = '<?php echo $_SESSION['referenteId'];?>'
</script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/validarMisEscuelasSnp.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/agregaMisEscuelasSupervisor.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informes.js"></script>

<?php
include_once 'includes/mod_cen/clases/EscuelaReferentes.php';
include_once 'includes/mod_cen/clases/escuela.php';
include_once 'includes/mod_cen/clases/Autoridades.php';
include_once 'includes/mod_cen/clases/informe.php';
?>

<!----------------------------------------------------------------------------->
<!--MIS ESCUELAS SUPER VISTA DESKTOP-->
<!----------------------------------------------------------------------------->

<div class="container">

<h3>Mis escuelas</h3>
<div class="panel panel-default">
  <div class="panel-body">
    <div class="">Accesos rapidos a acciones generales</div>
    <br>

    <form class="form-horizontal" action="" method="POST" >
      <input type="hidden" name="tipoId" id="tipoId" value="" />
  		<div class="form-group">
  				<div><label class="col-md-3">Seleccione Escuela</label></div>
  			</div>
  			<div class="form-group">
  				<div class="col-md-3">
            <select class="form-control" name="escuelaId" id="escuelaId" >
              <option value="0">Seleccione...</option>
            <?php
            $escuelasCargo = new EscuelaReferentes(null,null,'4',$_SESSION['personaId']);
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
          <div><label class="col-md-3">Seleccione Escuela</label></div>
        </div>
        <div class="form-group">
          <div class="col-md-3">
              <select class="form-control" name="" id="modulo">
                <option value="informe&id=1">Crear informe</option>
                <option value="informe&id=2">Ver informes</option>
                <option value="">-------------</option>
                <option value="director">Director</option>
                <option value="snp">Supervisor de Nucleo</option>
                <option value="srp">Supervisor de Religion</option>
                <option value="">Cargar modificar autoridad</option>
              </select>
          </div>
        </div>

    </form>

    <div class="form-group">
      <div class="col-md-6" id="padreIr">
        <input class="btn btn-primary" type="submit" value="ir" id="btn_ir">
      </div>
    </div>

  </div><!--</div panel-body-->
</div><!-- </div panel default -->



<table class="table table-bordered hidden-xs">
  <thead>
    <tr class='danger' >
      <th>CUE</th>
      <th>N°</th>
      <th>Nombre</th>
      <th>Mis informes</th>
      <th>Autoridades</th>

    </tr>
  </thead>

  <tbody>

    <?php
      //Seleccino todas las escuelas que tiene a cargo el referente loegado mediante el dato de personaId
      $escuelasCargo = new EscuelaReferentes(null,null,'4',$_SESSION['personaId']);
      $buscarEscuelas = $escuelasCargo->buscar();

      $escuela = new Escuela();

      while ($row = mysqli_fetch_object($buscarEscuelas)) {
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
        echo '<td id="informes'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-danger" id="info'.$infoEscuela->escuelaId.'" name="button">'.$cantidadInforme.'</button></td>';
        echo '<td id="row'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-danger" id="autoridad'.$infoEscuela->escuelaId.'" name="button">'.$cantidadAutoridades.' </button><span id="verAutoridad'.$infoEscuela->escuelaId.'" class="pull-right clickable"><i  class="glyphicon glyphicon-chevron-down"></i></span></td>';
        echo '</tr>';
        ?>


        <?php
      }
    ?>

  </tbody>
</table>



</div> <!-- </div container> -->


<!----------------------------------------------------------------------------->
<!--MIS ESCUELAS SUPER VISTA MOBILE-->
<!----------------------------------------------------------------------------->


<div class="container visible-xs">

<div class="panel panel-danger">
  <div class="panel-heading clickable" id="panel-heading">Escuela N° 5159</div>
  <div class="panel-body escuela">
    <h4><b>Datos Institución</b></h4>
    <div class="row">
    <div class="col-md-12"><b>Dirección:&nbsp</b></div>
    </div>
    <div class="row">
    <div class="col-md-5"><b>Localidad:&nbsp</b></div>

    </div>
    <div class="row">

    <div class="col-md-12"><b>Nivel:</div>
    </div>

    <div class="row">
    <div class="col-md-12"><b>Teléfono:'</div>
    </div>
    <div class="row">
    <div class="col-md-12"><b>Email:'</div>
    </div>
    <br>
    <hr>
    <h4><b>Informes</b></h4>
    <div class="row">
    <div class="col-md-12"><button type="button" class="btn btn-danger"name="button">ver informes (8)</button></div>
    <br>
    <div class="col-md-12"><button type="button" class="btn btn-danger"name="button">Crear</button></div>
    </div>
    <hr>
    <h4><b>Autoridades</b></h4>
    <div class="row">
    <div class="col-md-12">perez juan supervisor cel: 1546431354</div>
    <div class="col-md-12">perez juan supervisor primaria</div>
    </div>
  </div><!--</div panel-body-->
</div><!--</div panel panel-default-->


</div> <!--</div container vista mobile-->



<!--modal boton autoridades vista desktop-->


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
</div>

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
  </script>

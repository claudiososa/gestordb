<!-- Carga para Mis escuelas de cada ett -->
<link rel="stylesheet" href="includes/mod_cen/css/styleIconosSuperPrim.css">
<link rel="stylesheet" href="includes/mod_cen/css/default.css">
<link rel="stylesheet" href="includes/mod_cen/css/default.date.css">
<link rel="stylesheet" href="includes/mod_cen/portada/css/portadaEtjMisEtt.css">


<script type="text/javascript" src="includes/mod_cen/portada/etj/js/etjEscuelas.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/validarMisEscuelasSnp.js"></script>
<script type="text/javascript" src="includes/mod_cen/portada/coordinador/js/informeNuevo.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/ajax.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.date.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/legacy.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informes.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/jsValidarPersona.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/jsValidarInforme.js"></script>
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<!-- ////////////////////// ///////////////////////////////////// -->
<script type="text/javascript" src="includes/mod_cen/documentos/panelportada.js"></script>
<script type="text/javascript">
    let referenteId2 = '<?php echo $_SESSION['referenteId'];?>'
    let tipoR = '<?php echo $_SESSION['tipo'];?>'
</script>
<link rel="stylesheet" href="includes/mod_cen/informes/css/stylesCalendar.css">
<link rel="stylesheet" href="includes/mod_cen/informes/css/stylesVisitaMensual.css"/>
<script type="text/javascript"src="includes/mod_cen/portada/js/calendarETJ.js"></script>
<style type="text/css">

.btn-default {
		color: #333;
		background-color: #E9ECEC;
		border-color: #ccc;
}
</style>
<script>
  $( function() {

	   $( "#accordionBuscar1,#accordionBuscar2,#accordionBuscar3,#accordionBuscar4,#accordionBuscar5").accordion({
      active: false,
      collapsible: true
     });

		 $( "#tabs" ).tabs({
       collapsible: true
     });
     $( "#tabsBuscar" ).tabs({
       collapsible: true
     });

  } );

  </script>
<script type="text/javascript" src="includes/mod_cen/portada/js/etjInforme.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/validarMisEscuelasSnp.js"></script>


<?php
require_once("includes/mod_cen/clases/informe.php");
require_once("includes/mod_cen/clases/persona.php");
require_once("includes/mod_cen/clases/referente.php");
require_once("includes/mod_cen/clases/leido.php");
require_once("includes/mod_cen/clases/escuela.php");
include_once 'includes/mod_cen/clases/Autoridades.php';
include_once "includes/mod_cen/clases/respuesta.php" ;
include_once "includes/mod_cen/clases/rtixescuela.php";
include_once "includes/mod_cen/clases/rti.php";
include_once "includes/mod_cen/clases/maestro.php";
include_once "includes/mod_cen/clases/TipoInforme.php";
include_once "includes/mod_cen/clases/TipoPermisos.php";


$escuela = new Escuela(null,null,null,null,null,null,'Sistema Virtual');

$buscar = $escuela->buscar();


/**
 * Obtener todas las categorias relacionadas a Planied, coordinacion
 */

$categoriasPermitidas = new TipoPermisos(null,null,'Coordinador');
$buscarPermitidas = $categoriasPermitidas->buscar();

 /**********************************************/

//create object referenteId and filter of status active
$referenteId=$_SESSION['referenteId'];

$referente= new Referente($referenteId);
$todoReferente= new Referente(null,null,'ETT',null,null,null,null,'Activo');
$ett1 = $todoReferente->buscar();//$referente->Cargo("Activo");
$ett2 = $todoReferente->buscar();//$referente->Cargo("Activo");
$resultado_ett_acargo = $todoReferente->buscar();
//$referente->Cargo("Activo");
$informes= new informe();

////////////////////////////
// Actualizacion de Servidores

$todoReferente->setTipo('AS');

$listaReferenteAs = $todoReferente->buscar();

///////////////////////////////////////////////


////////////////////////////////////////////////
// todos los informes creados por referente Conectar Igualdad
$arrayReferenteConectar = array ('ETT','ETJ','Coordinador');
$informeEquipoConectar = $informes->buscar(20,null,$arrayReferenteConectar);

//busqueda de informes de proiridad alta
$informe_alta= new Informe(null,null,null,"Alta");
$buscar_alta =$informe_alta->buscar(30,null,$arrayReferenteConectar);
$total = mysqli_num_rows($buscar_alta);

// creación y busqueda de todos los informes


$b_informe = $informes->buscar(20);

////////////////////////////////////////////////


$mis_informes= new informe(null,null,$_SESSION["referenteId"]);

$b_mis_informe = $mis_informes->buscar(10);

//echo '<div class="container">';
?>
<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-5 col-8 align-self-center">
        <h5 class=" m-b-0 m-t-0">Búsqueda de Escuelas</h5>

      </div>

    </div>

<div class="" id="padreIr">
</div>

<div class="hidden-xs  wow zoomIn">
  <div id="tabsBuscar">
    <ul>
      <li><a  href='#tabsBuscar-1'>Buscar</a></li>
      <li><a  href='#tabsBuscar-2'>Informe prioridad Alta</a></li>
      <li><a  href='#tabsBuscar-3'>Conectividad PNCE</a></li>
      <li><a  href='#tabsBuscar-4'>Informes 5240</a></li>
      <li><a  href='#tabsBuscar-5'>Informes 5212</a></li>
    </ul>
    <div id="tabsBuscar-1">
      <!-- <div id='accordionBuscar1'>
        <h3>Escuela</h3>
        <div>
          <p>buscar de escuelas</p>
          <?php
        //  include 'includes/mod_cen/portada/etj/etjBuscarEscuela.php';
           ?>
        </div>
      </div> -->
      <!-- <div id='accordionBuscar2'>
          <h3>RTI</h3>
          <div>
            <p>buscar rti</p>
          </div>
      </div> -->
      <div id='accordionBuscar3'>
          <h3>Actualizacion de Servidores</h3>
          <div>
           <?php              
              $escuelaAs = new EscuelaReferentes(null,null,'48');
              while ($fila = mysqli_fetch_object($listaReferenteAs) ) {                
                $escuelaAs->referenteId=$fila->referenteId;                
                $misEscuelas=mysqli_num_rows($escuelaAs->buscar());
                echo "<a id='as$fila->referenteId'>$fila->nombre $fila->apellido <b>($misEscuelas)</b><br><br></a>";
                echo "<div>";
                echo "<table  style='display:none;' id='divAs$fila->referenteId' border='1' ><tr><td>Numero</td><td>CUE</td><td>Nombre</td></tr></table>";
                echo "</div>";
                
                //echo "<div ></div>";
              }
            ?>
          </div>
      </div>
      <div id='accordionBuscar4'>
          <h3>Informe</h3>
          <div>
            <div id="cargando">
              <img class="img img-responsive cargando" style="display:none;margin:auto;" src="img/iconos/informes/ajax-loader.gif"><br>
              <b><p class="cargando"align="center"style="display:none;color:#068587;">Buscando Informes, por favor espere...</p></b>
            </div>

            <form class="form-inline" id="formBuscarInforme" action="" method="post">
              <input type="text" name="numero" id="numero" value="" placeholder="N° Esc." size="5" class="form-control"><br><br>
              <input type="text" name="titulo" id="titulo" value="" placeholder="Titulo Informe" class="form-control"><br><br>
              <select class="form-control" id="seleCategoria" name="categoria">
                <option value="0">Todas las Categorias...</option>
                <?php
                while ($rowCate = mysqli_fetch_object($buscarPermitidas) ) {
                  echo '<option value="'.$rowCate->tipoId.'">'.$rowCate->nombre.'</option>';
                }
                 ?>
              </select><br><br>
              <select class="form-control" id="seleSubCategoria" name="subCategoria" >
                <option value="0">Todas las subcategorias...</option>
              </select>
                  <img class="img img-responsive" id="carga" src="img/iconos/informes/cargar.gif" style="display:none;margin:auto;max-width:3%;"><br>
                <br><br>
              <button type="button" id="buscarInforme" class="btn btn-primary" name="button">Buscar</button>
            </form>
          </div>
      </div>
      <div id='accordionBuscar5'>
          <h3>Mediada por Tic</h3>
          <div>
          <?php
            while ($row = mysqli_fetch_object($buscar)) {
              echo 'Escuela Sede:'.$row->nombre.'<br>'.$row->cue.'<br>';
              $escuela->nivel = '';
              $escuela->aulaS = $row->escuelaId;

              $buscarAulas = $escuela->buscar();
              echo '<br>Aulas satelites<br><br>';
              while ($row = mysqli_fetch_object($buscarAulas)) {
                echo $row->nombre.'<br>'.$row->cue.'<br>';
                echo 'ULTIMOS 5 INFORMES<br>';
              }
              
            }

          ?>
            
          </div>

      </div>

    </div>
    <div id="tabsBuscar-2">
      <?php
      include 'includes/mod_cen/portada/etj/etjPrioridad.php';
       ?>
    </div>
    <div id="tabsBuscar-3">
      <?php
      include 'includes/mod_cen/portada/coordinador/coorConectividad.php';
       ?>
    </div>
    <div id="tabsBuscar-4">
      <?php
        include 'includes/mod_cen/portada/coordinador/coordinadorInformes5240.php';
       ?>
    </div>
    <div id="tabsBuscar-5">
      <?php
      include 'includes/mod_cen/portada/coordinador/coordinadorInformes5212.php';
       ?>
    </div>
    <!-- <div id="tabsBuscar-5"> -->
      <?php
      // include 'includes/mod_cen/portada/etj/etjDocumentos.php';
       ?>
    <!-- </div> -->
  </div>

  <div id="resultadoInforme">
    <table id='tableinformes'>
    <thead>
      <tr>
        <th>Fecha Visita</th>
        <th>Escuela</th>
        <th>Titulo</th>
        <!-- <th>Resp.</th>
        <th>Fecha</th>
        <th>Prioridad</th> -->
      </tr>
    </thead>
    <tbody>
    </tbody>
    </table>
  </div>
</div>
</div>


<!--vista mobile-->

<!-- <div class="row visible-xs wow zoomIn">
	<div class="col-xs-6"><a href="index.php?mod=slat&men=escuelas&id=18" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda.png"><h3 align="center">Búsqueda escuelas</h3></a>
	</div>

</div> -->


<br><br><br>
<?php
	echo '<div class="row">';
	?>
	<!-- <div class="col-md-12 hidden-xs">
			<p class="alert alert-success">Presentación Proyecto trabajo 2018</p>
			<iframe allowFullScreen frameborder="0" height="564" mozallowfullscreen src="https://player.vimeo.com/video/258948009" webkitAllowFullScreen width="640"></iframe>
			 <p><a href="https://vimeo.com/user72995653">Mensaje para el equipo</a></p>
		</div>
		<div class="col-md-12 visible-xs">
		 <p class="alert alert-success">Presentación Proyecto trabajo 2018</p>
		 <iframe allowFullScreen frameborder="0" height="240" mozallowfullscreen src="https://player.vimeo.com/video/258948009" webkitAllowFullScreen width="320"></iframe>
			<p><a href="https://vimeo.com/user72995653">Mensaje para el equipo</a></p>
	</div> -->


<!-- <script type="text/javascript" src="includes/mod_cen/portada/js/animatePortadas.js"></script> -->

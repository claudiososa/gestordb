<?php
    include_once('includes/mod_cen/clases/escuela.php');
		include_once('includes/mod_cen/clases/RelevamientoElectrico.php');
    if($_POST){
      //var_dump($_POST);
      $otrosactual=str_split($_POST['otrosactual']);

      if(isset($_POST['televisor'])) {
          $otros[0]="s";
        }else {
          $otros[0]="n";}

      if(isset($_POST['cañon'])) {
          $otros[1]="s";
        }else {
          $otros[1]="n";}

      if(isset($_POST['reproductor'])) {
          $otros[2]="s";
        }else {
          $otros[2]="n";}

      if(isset($_POST['impresora'])) {
          $otros[3]="s";
        }else {
          $otros[3]="n";}

      if(isset($_POST['otro'])) {
          $otros[4]="s";
        }else {
          $otros[4]="n";}

      //var_dump($otros);
      foreach ($otrosactual AS $clave=>$valor){
        $otrosactual[$clave]=$otros[$clave];
      }

      $otros= implode('',$otros);
      //echo '<br><br>Como funciona: '.$otros;

     if(isset($_GET['edit'])){
       $relevamiento = new RelevamientoElectrico($_POST['escuelaId'],$_POST['otroCue'],$_POST['internado'],$_POST['totalCargos'],
                                                 $_POST['matricula'],$_POST['energia'],$_POST['tipoInstalacion'],$_POST['comoFunciona'],
                                                 $_POST['cantidadAulas'],$_POST['cantidadPcInstaladas'],$_POST['heladera'],
                                                 $otros,$_POST['suficienteEnergia'],$_POST['calefon'],$_POST['necesitaCalefonSolar'],
                                                 $_POST['necesitaBombeoAgua'],$_POST['comentario']);
       $agregar = $relevamiento->editar();
     }else{
       $relevamiento = new RelevamientoElectrico($_POST['escuelaId'],$_POST['otroCue'],$_POST['internado'],$_POST['totalCargos'],
                                                 $_POST['matricula'],$_POST['energia'],$_POST['tipoInstalacion'],$_POST['comoFunciona'],
                                                 $_POST['cantidadAulas'],$_POST['cantidadPcInstaladas'],$_POST['heladera'],
                                                 $otros,$_POST['suficienteEnergia'],$_POST['calefon'],$_POST['necesitaCalefonSolar'],
                                                 $_POST['necesitaBombeoAgua'],$_POST['comentario']);
       $agregar = $relevamiento->agregar();
     }

      //echo '<br><br>'.$agregar;
    }

    /**
     * Crear un objetivo tipo Escuela con el id obtenido de url, aplicando metodo de busqueda
     * @var Escuela
     */
    $escuelaId=$_GET['escuelaId'];
		$escuela= new Escuela($escuelaId);
		$datos = $escuela->getContacto();

    /**
     * Crear un objeto tipo Relevamiento con el id obtenido de url, aplicando metodo de busqueda
     * @var Escuela
     */
     $escuelaId=$_GET['escuelaId'];
     $relevamiento= new RelevamientoElectrico($escuelaId);
     $buscarRelevamiento = $relevamiento->buscar();
     $datoRelevamiento = mysqli_fetch_object($buscarRelevamiento);
     //var_dump($datoRelevamiento);

    $nuevalocalidad = new Localidad($datos->getLocalidadId());
    $localidad = $nuevalocalidad->getLocalidad();
    $location=new Localidad();
    $resultado=$location->buscar();

		?>
		<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>Creando Relevamiento <?php echo ' para '.$datos->getNombre() ?></h4>
				</div>
				<div class="panel-body">
		<?php
		include_once("includes/mod_cen/formularios/f_relevamiento.php");
		?>
		</div>
	</div>
		</div>

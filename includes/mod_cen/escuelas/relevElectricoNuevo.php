<?php
    include_once('includes/mod_cen/clases/escuela.php');
		include_once('includes/mod_cen/clases/RelevamientoElectrico.php');
    if($_POST){
      var_dump($_POST);
      $otrosactual=str_split($_POST['otros']);


      if(isset($_POST['Televisor'])) {
          $otros[0]="Televisor";
        }else {
          $otros[0]="";}

      if(isset($_POST['Cañon'])) {
          $otros[1]="Cañon";
        }else {
          $otros[1]="";}

      if(isset($_POST['Reproductor Cd/DVD'])) {
          $otros[2]="Reproductor Cd/DVD";
        }else {
          $otros[2]="";}

      if(isset($_POST['Impresora'])) {
          $otros[3]="Impresora";
        }else {
          $otros[3]="";}

      if(isset($_POST['Otro'])) {
          $otros[4]="Otro";
        }else {
          $otros[4]="";}


      foreach ($otrosactual AS $clave=>$valor){
        $otrosactual[$clave]=$otros[$clave];
      }

      $otros= implode('',$otros);
      echo 'otros: '.$otros;
    }

    /**
     * Crear un objetivo tipo Escuela con el id obtenido de url, aplicando metodo de busqueda
     * @var Escuela
     */
    $escuelaId=$_GET['escuelaId'];
		$escuela= new Escuela($escuelaId);
		$datos = $escuela->getContacto();

    /**
     * Crear un objetivo tipo Relevamiento con el id obtenido de url, aplicando metodo de busqueda
     * @var Escuela
     */
     $escuelaId=$_GET['escuelaId'];
     $relevamiento= new RelevamientoElectrico($escuelaId);
     $buscarRelevamiento = $relevamiento->buscar();
     $datoRelevamiento = mysqli_fetch_object($buscarRelevamiento);
     var_dump($datoRelevamiento);

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

<?php
    include_once('includes/mod_cen/clases/escuela.php');
		include_once('includes/mod_cen/clases/AulaSatelite.php');

    if($_POST){
      echo "hola mundo";
     if(isset($_POST['aulaSateliteId'])){
       $relevamiento = new AulaSatelite ($_POST['aulaSateliteId'],$_POST['escuelaId'],$_POST['nombre'],$_POST['domicilio'],$_POST['telefono'],$_POST['localidadId']);
       $agregar = $relevamiento->editar('soloAula');
     }else{
       $relevamiento = new AulaSatelite (NULL,$_POST['escuelaId'],$_POST['nombre'],$_POST['domicilio'],$_POST['telefono'],$_POST['localidadId']);
       $agregar = $relevamiento->agregar('soloAula');
     }

      //echo '<br><br>'.$agregar;
      $variablephp = "?index.php?mod=slat&men=escuelas&id=19&escuelaId=".$_POST['escuelaId'];
      ?>

      <script type="text/javascript">
        var guardado = "<?php echo $agregar; ?>" ;
        if (guardado=='agregarcompleto') {
          alert ("Aula Satelite fue creada");
        }else if(guardado=='editarcompleto'){
          alert ("Aula Satelite fue modificada");
        }else{
          alert ("Erro al guardar");
        }
    		var variablejs = "<?php echo $variablephp; ?>" ;
    	   function redireccion(){window.location=variablejs;}
    	   setTimeout ("redireccion()", 0);
    	</script>
      <?php
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
     //$escuelaId=$_GET['escuelaId'];
     if(isset($_GET['aulaSateliteId'])){
       $relevamiento= new AulaSatelite($_GET['aulaSateliteId']);
       $datosAulaSatelite=$relevamiento->getContacto();
       //var_dump($datosAulaSatelite);
     }else{
       $datosAulaSatelite=false;
     }

     //var_dump($buscarRelevamiento);
     //if($datosAulaSatelite){
      // $datosAulaSatelite = mysqli_fetch_object($buscarRelevamiento);
       //var_dump($datosAulaSatelite);
     //}else{
       $relevamiento1= new AulaSatelite();
     //}

     //var_dump($datoRelevamiento);

    $nuevalocalidad = new Localidad($datos->getLocalidadId());
    $localidad = $nuevalocalidad->getLocalidad();
    $location=new Localidad();
    $resultado=$location->buscar();

		?>
		<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>Creando Aula Satelite para la Institución <?php echo ' para '.$datos->getNombre() ?></h4>
				</div>
				<div class="panel-body">
		<?php
		include_once("includes/mod_cen/formularios/f_aulasatelite.php");
		?>
		</div>
	</div>
		</div>

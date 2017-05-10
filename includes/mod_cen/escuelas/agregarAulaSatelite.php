<?php
    include_once('includes/mod_cen/clases/escuela.php');
		include_once('includes/mod_cen/clases/AulaSatelite.php');
    if($_POST){
     if(isset($_GET['edit'])){
       $relevamiento = new AulaSatelite ($_POST['escuelaId'],$_POST['numero'],$_POST['nombre'],$_POST['domicilio'],
                                                 $_POST['telefono']);
       $agregar = $relevamiento->editar();
     }else{
       $relevamiento = new AulaSatelite ($_POST['escuelaId'],$_POST['numero'],$_POST['nombre'],$_POST['domicilio'],
                                                 $_POST['telefono']);
       $agregar = $relevamiento->agregar();
     }

      //echo '<br><br>'.$agregar;
      $variablephp = "?index.php?mod=slat&men=escuelas&id=19";
      ?>

      <script type="text/javascript">
        var guardado = "<?php echo $agregar; ?>" ;
        if (guardado=='success') {
          alert ("Se relevamiento fue guardado");
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
     $escuelaId=$_GET['escuelaId'];
     $relevamiento= new AulaSatelite($escuelaId);
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

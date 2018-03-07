<script src="includes/mod_cen/js/s_ajax_informe.js"></script>
<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/TipoInforme.php");
include_once("includes/mod_cen/clases/TipoPermisos.php");
include_once("includes/mod_cen/clases/SubTipoInforme.php");
include_once("includes/mod_cen/clases/img.php");


$nuevo=0;
if(isset($_POST['save_report']))//Si presiona el boton enviar del formulario de informe nuevo ingresa aqui
{
//  sleep(10);
    if(!isset($_POST["edit_report"]))//sino esta editando un informe ingresa aqui
    {
      //creo objeto informe
      $fecha=date("Y-m-d H:i:s");
      $informe= new Informe(null,
                            $_GET["escuelaId"],
                            $_SESSION["referenteId"],
                            $_POST["prioridad"],
                            $_POST["tipo"],
                            $_POST["titulo"],
                            $_POST["contenido"],
                            NULL,
                            NULL,
                            $_POST["fechaVisita"],
                            $fecha,
                            Null,
                            $_POST["nuevotipo"],
                            $_POST["subtipo"]
                          );

        $guardar_informe=$informe->agregar(); // hasta aqui deberia haber guardado el informe nuevo


        foreach ($_FILES['input-img'] as $key) {
          $cantidadElmentos=count($_FILES['input-img']['name']);

          for ($i=0; $i < $cantidadElmentos ; $i++) {
            # code...
            $img1 = $_FILES['input-img']['tmp_name'][$i];
            $img1 = $_FILES['input-img']['name'][$i];

            $dir_subida = './img/informes/';

            if($_FILES['input-img']['type'][$i]=='image/jpeg'){
              $nombreArchivo='doc_'.$guardar_informe.'_'.$i.'.jpg';
              $nombreArchivoMediano='doc_'.$guardar_informe.'_'.$i.'m.jpg';
              $tipoArchivo='image/jpeg';
            } elseif($_FILES['input-img']['type'][$i]=='application/pdf') {
              $nombreArchivo='doc_'.$guardar_informe.'_'.$i.'.pdf';
              $tipoArchivo='application/pdf';
            }
            //$fichero_subido = $dir_subida . basename($_FILES['input-img']['name'][0]);
            $fichero_subido = $dir_subida . $nombreArchivo;
      //      echo $fichero_subido;


      //echo '<pre>';
            if (move_uploaded_file($_FILES['input-img']['tmp_name'][$i], $fichero_subido)) {
              if($_FILES['input-img']['type'][$i]=='image/jpeg'){
                $nuevoArchivo = $dir_subida.$nombreArchivoMediano;
                copy($fichero_subido,$nuevoArchivo);
              }
              $imagen = new Img(null,$guardar_informe,$nombreArchivo,$tipoArchivo);
              $agregarImg = $imagen->agregar();
          //    echo "El fichero es válido y se subió con éxito.\n";
            }	 else {
      // echo "¡Posible ataque de subida de ficheros!\n";
            }

          }
          break;
        }

        if($guardar_informe>0){

          include_once("includes/mod_cen/informes/email_script.php");
          }
    }else{
			$fecha_actual1= new DateTime(date("Y-m-d H:i:s"));
			$fecha_informe1 = new DateTime(date($_POST['f_carga']));
			$fechanueva = $fecha_actual1->diff($fecha_informe1);
      //var_dump($fechanueva->i);
			if($fechanueva->i < 10   && $fechanueva->d < 1 && $fechanueva->h <1){

    	$fecha=date("Y-m-d H:i:s");
    	$informe= new Informe($_POST["edit_report"],null,$_SESSION["referenteId"],$_POST["prioridad"],
			$_POST["tipo"],$_POST["titulo"],$_POST["contenido"],null,null,$_POST["fechaVisita"],null,$fecha);
    	$guardar_informe=$informe->editar();
        if($guardar_informe==1){
					  $variablephp = "index.php?mod=slat&men=informe&id=2&escuelaId=".$_POST["escuelaId"];

            ?>    <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>
            <?php
					}else{
						echo "no se puede guardar, error grave";
					}
				}else{
						?>
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Mensaje</h4>

								</div>
								<div class="modal-body">
									No puede guardar

									<?php
									echo $_POST['f_carga'],"<br>";
									echo $fechanueva->i ?>;
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

								</div>
							</div>
						</div>
						<?php
					}

    }

}else{

  $permisos = new TipoPermisos(NULL,
                               NULL,
                               $_SESSION["tipo"]);
  $buscarPermisos = $permisos->buscar();

  $escuela= new Escuela($_GET["escuelaId"]);
	$buscar_escuela=$escuela->buscar();
	$dato_escuela=mysqli_fetch_object($buscar_escuela);

	$informe = new Informe();
  $nuevo=1;
	include_once("includes/mod_cen/formularios/f_informe.php");

}

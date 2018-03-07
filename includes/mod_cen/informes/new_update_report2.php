<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
$nuevo=0;
if(isset($_POST['save_report']))
{

	//var_dump($_POST);
//  sleep(10);
    if(!isset($_POST["edit_report"])){
    //creo objeto informe

    $fecha=date("Y-m-d H:i:s");
    //$fechaVisita=$_POST[""]date("Y-m-d");
    $informe= new Informe(null,$_GET["escuelaId"],$_SESSION["referenteId"],$_POST["prioridad"],
		$_POST["tipo"],$_POST["titulo"],$_POST["contenido"],
		NULL,NULL,$_POST["fechaVisita"],$fecha,Null);
        $guardar_informe=$informe->agregar();

        if($guardar_informe==1){
          $dato_ref =  new Referente($_SESSION["referenteId"]);
          $buscar_dato_ref =  $dato_ref->buscar();
          $referente_actual = mysqli_fetch_object($buscar_dato_ref);

          if($referente_actual->tipo=="ETT" || $referente_actual->tipo=="ETJ"){

            if($_POST["prioridad"]=="Alta" && $referente_actual->tipo=="ETJ")
            {
              $enviar=1;
            }

            //Envio de email - notificación de informe
              $dato_referente =  new Referente($_SESSION["referenteId"]);
              $buscar_dato = $dato_referente->Persona($_SESSION["referenteId"]);
              $origen =  mysqli_fetch_object($buscar_dato);

              $creadopor=$origen->nombre." ".$origen->apellido;
              //quien envia el mensaje - (email)
	            $header = "From: " . $origen->email;

              $dato_referente =  new Referente($origen->etjcargo);
              $buscar_dato = $dato_referente->Persona($origen->etjcargo);
              $origen =  mysqli_fetch_object($buscar_dato);

              //para quien se envia el mensaje - (email)
              $para = $origen->email;
              if($_POST["prioridad"]=="Alta"){
                //$para=$para.",cristianjavierortin@gmail.com"
                $para=$para.",jfvpipo@gmail.com";
              }

	            $titulo = "Nuevo Informe".$_POST["titulo"];
	            $mensaje = "Tienes un nuevo informe para revisar.\n creado por".$creadopor;
		        	//$nombre = $_POST["nombre"];
            	//$email = $_POST["email"];
            	//$telefono = $_POST["telefono"];




            	//$msjCorreo = "Nombre: $nombre\n E-Mail: $email\n Telefono: $telefono\n Mensaje:\n $mensaje";
            	if (mail($para, $titulo, $mensaje, $header)) {
            		/*echo "<script language='javascript'>
            				alert('Mensaje enviado, muchas gracias.');
            				window.location.href = 'http://www.deportivaTUSITIOWEB.COM';
            				</script>";*/
            		$enviado=1;
            	} else {
            		echo "Falló el envio";
            	}

            }
            $variablephp = "index.php?mod=slat&men=informe&id=2&escuelaId=".$_POST["escuelaId"];
            ?>    <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>
            <?php
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
    //echo "llego post";
  //  echo $_GET["escuelaId"];
   // echo $_SESSION["referenteId"];

}else{
	//sino entre por post, entonces debe cargarse formulario de informe
	//echo "no llego post";
	// crea objeto escuela, de acuerdo al id de escuela provisto por GET
	$escuela= new Escuela($_GET["escuelaId"]);
	$buscar_escuela=$escuela->buscar();
	$dato_escuela=mysqli_fetch_object($buscar_escuela);
	$informe = new Informe();
    $nuevo=1;

	//$dato_informe = mysqli_fetch_object($informe);

	include_once("includes/mod_cen/formularios/f_informe.php");

}

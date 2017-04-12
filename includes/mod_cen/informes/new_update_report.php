<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/TipoInforme.php");
include_once("includes/mod_cen/clases/TipoPermisos.php");
include_once("includes/mod_cen/clases/SubTipoInforme.php");
include_once("includes/mod_cen/clases/img.php");


$nuevo=0;
if(isset($_POST['save_report']))
{
	//var_dump($_FILES);

//  sleep(10);
    if(!isset($_POST["edit_report"]))
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
                            $_POST["subtipo"]);
														/*array(1) { ["input-img"]=> array(5)
															             { ["name"]=> array(2){ [0]=> string(14) "000375853W.jpg" [1]=> string(14) "trujillo-2.jpg" }
														                 ["type"]=> array(2) { [0]=> string(10) "image/jpeg" [1]=> string(10) "image/jpeg" }
                                             ["tmp_name"]=> array(2) { [0]=> string(14) "/tmp/phpRzFX4u" [1]=> string(14) "/tmp/phpNFrbnK" }
																					   ["error"]=> array(2) { [0]=> int(0) [1]=> int(0) }
																					   ["size"]=> array(2) { [0]=> int(269079) [1]=> int(41088) }
																				} } si llego foto /tmp/phpRzFX4u
														si llego foto trujillo-2.jpg*/




        $guardar_informe=$informe->agregar(); // hasta aqui deberia haber guardado el informe nuevo


				foreach ($_FILES['input-img'] as $clave) {
				    // $array[3] se actualizará con cada valor de $array...
						foreach ($_FILES['input-img'][$clave] as $key => $value) {
							# code...
							echo 'nonbrePrimerArchivo1'.$_FILES['input-img'][$clave][$key].'<br>';
						}
				}
				var_dump($_FILES);

				if (isset($_FILES)){
						$img1 = $_FILES['input-img']['tmp_name'][0];
						echo "si llego foto "." ".$img1."<br>";

						$img1 = $_FILES['input-img']['name'][1];
						echo "si llego foto "." ".$img1."<br>";

						$dir_subida = './img/informes/';
						//$dir_subida = "/tmp/";
						$nombreArchivo='img_'.$guardar_informe.'.jpg';
						//$fichero_subido = $dir_subida . basename($_FILES['input-img']['name'][0]);
						$fichero_subido = $dir_subida . $nombreArchivo;
						echo $fichero_subido;


						echo '<pre>';
						if (move_uploaded_file($_FILES['input-img']['tmp_name'][0], $fichero_subido)) {
							$imagen = new Img(null,$guardar_informe,$nombreArchivo,'jpg');
							$agregarImg = $imagen->agregar();
							echo "El fichero es válido y se subió con éxito.\n";
						}	 else {
							echo "¡Posible ataque de subida de ficheros!\n";
						}
				}



        // en el siguiente codigo usamos el escuelaID para encontrar el referente de la escuela asociada al informe por crear
        $escuela= new Escuela($_GET["escuelaId"]);
        $buscar_escuela=$escuela->buscar();
        $dato_escuela=mysqli_fetch_object($buscar_escuela);
        $id_referente_escuela= $dato_escuela->referenteId; //hasta aqui obtengo el referentID

        // en el siguiente codigo usamos el referenteID obtenido en el paso anterior para obtener  su mail e usarlo mas adelante
        $dato_ref_esc =  new Referente($id_referente_escuela);
        $buscar_dato_ref_esc =  $dato_ref_esc->Persona($id_referente_escuela);
        $ref_esc = mysqli_fetch_object($buscar_dato_ref_esc);
        $ref_esc_mail= $ref_esc->email;   //  aqui obtenemos el mail del referente de la escuela



            // en el siguiente codigo averiguamos si el referente de la escuela es ett o etj de manera que no repitamos el mail a cristian si es etj


          $dato_ref_origen =  new Referente($id_referente_escuela);
          $buscar_dato_ref_origen =  $dato_ref_origen->buscar();
          $referente_origen = mysqli_fetch_object($buscar_dato_ref_origen);
          $cargo_origen=$referente_origen->tipo; // aqui obtenemos informacion para saber si es ett o etj


               //  en el siguiente codigo obtenemos  el mail del etj responsable del referente de la escuela


              $dato_ref_asociado =  new Referente($referente_origen->etjcargo);
              $buscar_dato_ref_asociado = $dato_ref_asociado->Persona($referente_origen->etjcargo);
              $mail_etj_asociado =  mysqli_fetch_object($buscar_dato_ref_asociado);
              $mail__etj_responsable=$mail_etj_asociado->email; //aqui obtenemos el mail del etj superior al referente de la escuela


        if($guardar_informe==1){



          $dato_ref =  new Referente($_SESSION["referenteId"]);
          $buscar_dato_ref =  $dato_ref->buscar();
          $referente_actual = mysqli_fetch_object($buscar_dato_ref);

          if($referente_actual->tipo=="ETT" || $referente_actual->tipo=="ETJ" || $referente_actual->tipo=="Coordinador" ){ // entra si es ett o etj o coordinador


            //Envio de email - notificación de informe
              $dato_referente =  new Referente($_SESSION["referenteId"]);
              $buscar_dato = $dato_referente->Persona($_SESSION["referenteId"]);
              $origen =  mysqli_fetch_object($buscar_dato);

              $creadopor=$origen->nombre." ".$origen->apellido;
              //quien envia el mensaje - (email)
              $mail_propio=$origen->email;

              $header = "From: ". $origen->email;
              //$header = "From: dbms.conectarigualdad@gmail.com";//. $origen->email;

              $dato_referente2 =  new Referente($origen->etjcargo);
              $buscar_dato2 = $dato_referente2->Persona($origen->etjcargo);
              $origen2 =  mysqli_fetch_object($buscar_dato2);

              //preguntar si quien entro es o no el coordinador en caso de que no sea, avanzar, sino ir mas abajo.

          if($referente_actual->tipo!="Coordinador"){


            if($_POST["prioridad"]=="Alta" && $referente_actual->tipo=="ETJ")
             {
              $enviar=1;
               $para="cristianjavierortin@gmail.com"; //mail de cristian ortin

              if($_SESSION["referenteId"] != $id_referente_escuela) //informes de escuelas de otro referente
                 {


                  // al mail de cristian  se le debe concatenar el mail del referente de la escuela y del etj si corresponde
                  $para=$para.",".$ref_esc_mail;

                       if ($cargo_origen=="ETT") // averiguo si el referente de la escuela es ett,
                          {
                            $para=$para.",".$mail__etj_responsable;  //agregamos el mail del ETJ
                          }


                 }


            }else{


                if($_POST["prioridad"]=="Alta" && $referente_actual->tipo=="ETT")
                        {

                            $para=$origen2->email.",cristianjavierortin@gmail.com"; // mando mail de mi etj  que lo tenemos en $origen2->mail y el mail de cristian.



                            if($_SESSION["referenteId"] != $id_referente_escuela)
                                    // si el informe creado es de una escuela ajena

                                   {

                                    $para=$ref_esc_mail.",cristianjavierortin@gmail.com"; //envio mail al referente de la escuela ajena y a cristian por que es prioridad alta

                                    if ($cargo_origen=="ETT") // averiguo si el referente de la escuela es ett para agregar el mail de su etj, por que si fuese etj estaria mandando 2 veces el mismo mail a cristian
                                        {
                                          $para=$para.",".$mail__etj_responsable;  //agregamos el mail del ETJ
                                        }

                                   }


                         }else{


                                if ($referente_actual->tipo=="ETT")

                                   {

                                    $para = $origen2->email; // va  mail a mi  etj



                                   if($_SESSION["referenteId"] != $id_referente_escuela) // pregunta si el informe creado es de otro referente
                                       {

                                        $para=$para.",".$ref_esc_mail;// mail del referente de la escuela y el mi etj

                                        if ($cargo_origen=="ETT")
                                        // averiguo si el referente de la escuela es ett para agregar el mail de su etj, por que si fuese etj estaria mandando un mail a cristian con prioridad normal y no corresponde
                                        {
                                          $para=$para.",".$mail__etj_responsable;  //agregamos el mail del ETJ
                                        }



                                       }


                                   }else{

                                          $para= $mail_propio; //bandera=1; // se autoenvia un  mail

                                             if($_SESSION["referenteId"] != $id_referente_escuela) // pregunta si el informe creado es de otro referente
                                               {

                                                $para=$ref_esc_mail;// envio mail al referente de la escuela.

                                                 if ($cargo_origen=="ETT")
                                        // averiguo si el referente de la escuela es ett para agregar el mail de su etj, por que si fuese etj estaria mandando un mail a cristian con prioridad normal y no corresponde.
                                                    {
                                                      $para=$para.",".$mail__etj_responsable;  //agregamos el mail del ETJ
                                                    }



                                               }



                                        }

                         }


              }  // aqui debe ingresar el coordinador

            }else{

                    //aqui armar los mail para los ett y etj

                     $para=$ref_esc_mail;

                    if ($cargo_origen=="ETT") // averiguo si el referente de la escuela es ett
                          {
                            $para=$para.",".$mail__etj_responsable;;  //agregamos el mail del ETJ superior
                          }


                  }

              //buscar el ultimo informe creado por el usuario logeado
              $ultimo= new Informe(null,null,$_SESSION["referenteId"]);
              $buscar_ultimo= $ultimo->buscar(1);
              $dato_ultimo = mysqli_fetch_object($buscar_ultimo);

              $linkinforme="index.php?mod=slat&men=informe&id=3&informeId=".$dato_ultimo->informeId;
              $mailobtenido=$para;
              //$para="jfvpipo@gmail.com";

	            $titulo = "   Nuevo Informe - Prioridad > ".$_POST["prioridad"]." - ".$_POST["titulo"];
	            $mensaje = "Este es un mensaje generado por DBMS Conectar Igualdad - 2017 - \n\nTienes un nuevo informe para revisar.\nPrioridad -> ".$_POST["prioridad"]."\nCreado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme;
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
                setTimeout ("redireccion()",14000);
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
                setTimeout ("redireccion()",14000);
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

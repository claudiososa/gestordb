<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/TipoInforme.php");
include_once("includes/mod_cen/clases/TipoPermisos.php");
include_once("includes/mod_cen/clases/SubTipoInforme.php");


// a partir de este codigo trabajamos en recabar datos del usuario que inicio sesion.
  $dato_ref =  new Referente($_SESSION["referenteId"]);
  $buscar_dato_ref =  $dato_ref->buscar();
  $referente_actual = mysqli_fetch_object($buscar_dato_ref);

  // entra si es ett o etj o coordinador de Conectar Igualdad
  if($referente_actual->tipo=="ETT" || $referente_actual->tipo=="ETJ" || $referente_actual->tipo=="Coordinador" ){
    // en el siguiente codigo usamos el escuelaID para encontrar el referente de la escuela asociada al informe por crear
	   $escuela= new Escuela($_GET["escuelaId"]);
	   $buscar_escuela=$escuela->buscar();
	   $dato_escuela=mysqli_fetch_object($buscar_escuela);
	   $id_referente_escuela= $dato_escuela->referenteId; //hasta aqui obtengo el referentID conectar igualdad

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
              $mail__etj_responsable=$mail_etj_asociado->email; //aqui obtenemos el mail del etj superior al referente de la escuela.


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

                                    $para=$origen2->email.",".$ref_esc_mail.",cristianjavierortin@gmail.com"; //envio mail al referente de la escuela ajena y a cristian por que es prioridad alta

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

              }

            }else{   // aqui debe ingresar el coordinador
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

            	if (mail($para, $titulo, $mensaje, $header)) {

            		$enviado=1;
            	} else {
            		echo "Falló el envio";
            	}








        }else{  // aqui entra si es ATT O COORDINADOR PMI


        	if($referente_actual->tipo=="ATT" ||  $referente_actual->tipo=="CoordinadorPmi" ){


              // en el siguiente codigo usamos el escuelaID para encontrar el referentePmi de la escuela asociada al informe por crear
              $escuela= new Escuela($_GET["escuelaId"]);
              $buscar_escuela=$escuela->buscar();
              $dato_escuela=mysqli_fetch_object($buscar_escuela);
              $id_referente_escuela= $dato_escuela->referenteIdPmi; //hasta aqui obtengo el referentID PMI

              //En el siguiente codigo usamos el referenteID obtenido en el paso anterior para obtener  su mail e usarlo mas adelante
              $dato_ref_esc =  new Referente($id_referente_escuela);
              $buscar_dato_ref_esc =  $dato_ref_esc->Persona($id_referente_escuela);
              $ref_esc = mysqli_fetch_object($buscar_dato_ref_esc);
              $ref_esc_mail= $ref_esc->email;   //  aqui obtenemos el mail del referentePmi de la escuela

              // En el siguiente codigo obtenemos datos del referentePMI que inicio sesion
              $dato_referente =  new Referente($_SESSION["referenteId"]);
              $buscar_dato = $dato_referente->Persona($_SESSION["referenteId"]);
              $origen =  mysqli_fetch_object($buscar_dato);

              $creadopor=$origen->nombre." ".$origen->apellido;
              //quien envia el mensaje - (email)
              $mail_propio=$origen->email;

              $header = "From: ". $origen->email; // datos de quien envia el mail

            if ($referente_actual->tipo=="ATT")
            { //mandamos mail a los coordinadores PMI

               $para="maricel.eg31@gmail.com,noemiemercado@gmail.com";

                      if($_SESSION["referenteId"] != $id_referente_escuela)
                      // pregunta si el informe creado es de otro referente
                                  {
                                        $para=$para.",".$ref_esc_mail;// mail del referentePmi de la escuela tambien
                                  }

            }else{  // entra por que es coordinador pmi y solo envia mail al att de la escuela en cuestion

                $para= $ref_esc_mail;

                 }

              //buscamos el ultimo informe creado por el usuario logeado
              $ultimo= new Informe(null,null,$_SESSION["referenteId"]);
              $buscar_ultimo= $ultimo->buscar(1);
              $dato_ultimo = mysqli_fetch_object($buscar_ultimo);

              $linkinforme="index.php?mod=slat&men=informe&id=3&informeId=".$dato_ultimo->informeId;
              $mailobtenido=$para;
              //$para="jfvpipo@gmail.com";

	            $titulo = "   Nuevo Informe - Prioridad > ".$_POST["prioridad"]." - ".$_POST["titulo"];
	            $mensaje = "Este es un mensaje generado por DBMS Conectar Igualdad - 2017 - \n\nTienes un nuevo informe para revisar.\nPrioridad -> ".$_POST["prioridad"]."\nCreado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme;

            	if (mail($para, $titulo, $mensaje, $header)) {

            		$enviado=1;
            	} else {
            		echo "Falló el envio";
            	}



        		 }// fin att o coordinador pmi

             if($referente_actual->tipo=="Supervisor-Secundaria"
                ||  $referente_actual->tipo=="Supervisor-General-Secundaria"
                ||  $referente_actual->tipo=="DirectorNivelSecundario"){


                 // en el siguiente codigo usamos el escuelaID para encontrar el Supervisor de la escuela asociada al informe por crear
                 $escuela= new Escuela($_GET["escuelaId"]);
                 $buscar_escuela=$escuela->buscar();
                 $dato_escuela=mysqli_fetch_object($buscar_escuela);
                 $id_referente_escuela= $dato_escuela->referenteIdSuperSec; //hasta aqui obtengo el referentID PMI

                 //En el siguiente codigo usamos el referenteID obtenido en el paso anterior para obtener  su mail e usarlo mas adelante
                 $dato_ref_esc =  new Referente($id_referente_escuela);
                 $buscar_dato_ref_esc =  $dato_ref_esc->Persona($id_referente_escuela);
                 $ref_esc = mysqli_fetch_object($buscar_dato_ref_esc);
                 $ref_esc_mail= $ref_esc->email;   //  aqui obtenemos el mail del supervisor de la escuela

                 // En el siguiente codigo obtenemos datos del Supervisor que inicio sesion
                 $dato_referente =  new Referente($_SESSION["referenteId"]);
                 $buscar_dato = $dato_referente->Persona($_SESSION["referenteId"]);
                 $origen =  mysqli_fetch_object($buscar_dato);

                 $creadopor=$origen->nombre." ".$origen->apellido;
                 //quien envia el mensaje - (email)
                 $mail_propio=$origen->email;

                 $header = "From: ". $origen->email; // datos de quien envia el mail

               if ($referente_actual->tipo=="Supervisor-Secundaria")
               { //mandamos mail a director de nivel y supervisora general

                  $para="martucamerlo@gmail.com,francomaria@gmail.com";

                         if($_SESSION["referenteId"] != $id_referente_escuela)
                         // pregunta si el informe creado es de otro referente
                                     {
                                           $para=$para.",".$ref_esc_mail;// mail del Supervisor de la escuela tambien
                                     }

               }else{  // entra por que es coordinador pmi y solo envia mail al att de la escuela en cuestion

                   $para= $ref_esc_mail;

                    }

                 //buscamos el ultimo informe creado por el usuario logeado
                 $ultimo= new Informe(null,null,$_SESSION["referenteId"]);
                 $buscar_ultimo= $ultimo->buscar(1);
                 $dato_ultimo = mysqli_fetch_object($buscar_ultimo);

                 $linkinforme="index.php?mod=slat&men=informe&id=3&informeId=".$dato_ultimo->informeId;
                 $mailobtenido=$para;
                 //$para="jfvpipo@gmail.com";

   	            $titulo = "   Nuevo Informe - Prioridad > ".$_POST["prioridad"]." - ".$_POST["titulo"];
   	            $mensaje = "Este es un mensaje generado por DBMS Conectar Igualdad - 2017 - \n\nTienes un nuevo informe para revisar.\nPrioridad -> ".$_POST["prioridad"]."\nCreado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme;

               	if (mail($para, $titulo, $mensaje, $header)) {

               		$enviado=1;
               	} else {
               		echo "Falló el envio";
               	}



              }// fin de supervisor, DirectorNivelSecundario y Supervisor-General-Secundaria




        }// fin del if-else principal

        $variablephp = "index.php?mod=slat&men=informe&id=2&escuelaId=".$_POST["escuelaId"];


       ?>    <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>

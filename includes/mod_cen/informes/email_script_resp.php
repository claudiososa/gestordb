
<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/respuesta.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");


			// ingresa cuando se agrego la respuesta


            $informeId= $_POST["informeId"];

             $variablephp = "index.php?mod=slat&men=informe&id=3&informeId=$informeId";
            ?>    <script type="text/javascript"> 
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>
           
            <?php


            // preparo el header con el referente que inicio sesion
/* 
            $referente= new Referente($_SESSION["referenteId"]);
            $buscar_ref = $referente->Persona($_SESSION["referenteId"]);
            $dato_ref = mysqli_fetch_object($buscar_ref);

            $mail_login=$dato_ref->email; // mail del referente que inicia sesion
            $header="From: ".$dato_ref->email; // armo la cabecera del mail con el mail del ref que inicio sesion
            $creadopor=$dato_ref->nombre." ".$dato_ref->apellido; // usamos creadopor para el mensaje del mail


            $dato_informe_resp = new Informe($informeId);
            $buscar_informe_resp = $dato_informe_resp->buscar();
            $informe_resp = mysqli_fetch_object($buscar_informe_resp);
            $titulo=" RE -".$informe_resp->titulo; // armo el titulo de los mail con el titulo del informe original
            $num_escuela=$informe_resp->escuelaId; // obtengo el escuelaId de la escuela a la cual se le creo el informe, lo usamos mas adelante

            $referente= new Referente($informe_resp->referenteId);
            $buscar_ref = $referente->Persona($informe_resp->referenteId);
            $dato_ref = mysqli_fetch_object($buscar_ref);

            $bandera=0; // usamos esta bandera para saber si hay almenos una respuesta que no sea de su creador
            $destinatario=" ";
            $creador_informe=$dato_ref->email; // guardo el mail del creador del informe muy importante, ya que no necesariamente respondera algun mensaje del informe



            if ($mail_login != $creador_informe)
              {
              $destinatario=$creador_informe; // guardo el mail del creador del informe en la variable $destinatario

             $bandera=1; // actualizo la bandera en 1 para saber que hay una respuesta que no es de su creador
              }




            $respuesta_resp=new Respuesta(null,$informeId);
            $buscar_respuesta= $respuesta_resp->buscar();


            while ($fila = mysqli_fetch_object($buscar_respuesta))
                {
                  $referente= new Referente($fila->referenteId);
                  $buscar_ref = $referente->Persona($fila->referenteId);
                  $dato_ref = mysqli_fetch_object($buscar_ref);
                  $email_ref=$dato_ref->email;
                  // en el siguiente codigo armamos la lista de destinatarios del email, cuidando de no repetir el mail a un mismo destinatario que haya respondido varias veces

                  $resultado = strpos($destinatario, $email_ref);

                         if(($resultado === FALSE) && ($email_ref != $mail_login))
                            {
                                // concateno a destinatarios  el mail del referente que encontro


                                $destinatario=$destinatario.",".$email_ref;


                                $bandera=1;

                            }

                 }


                   // en el siguiente codigo se  busca el mail del responsable de la escuela que tiene el informe en cuestion

                    $escuela= new Escuela($num_escuela);
                    $buscar_escuela=$escuela->buscar();
                    $dato_escuela=mysqli_fetch_object($buscar_escuela);
                    $id_referente_escuela= $dato_escuela->referenteId; //hasta aqui obtengo el referentID de la escuela

                    $dato_ref_esc =  new Referente($id_referente_escuela);
                    $buscar_dato_ref_esc =  $dato_ref_esc->buscar();
                    $ref_esc = mysqli_fetch_object($buscar_dato_ref_esc);
                    $ref_esc_per= $ref_esc->personaId;   //  aqui obtenemos el personaid

                    // en el siguiente codigo usamos personaID obtenido en el paso anterior para obtener  su mail e usarlo mas adelante

                    $persona= new Persona($ref_esc_per);
                    $buscar_persona=$persona->buscar();
                    $dato_persona=mysqli_fetch_object($buscar_persona);
                    $mail_responsable=$dato_persona->email;    //obtengo el mail del responsable de la escuela



                  $resultado2 = strpos($destinatario, $mail_responsable); // me fijo si aun no esta en la lista


                  if (($mail_responsable != $mail_login) && ($mail_responsable!= $creador_informe)&&( $resultado2 === FALSE ) )
                  {

                  $destinatario=$destinatario.",".$mail_responsable; // agrego el mail del responsable de la escuela

                        $bandera=1;

                  }


                   if ($bandera == 1) {   // pregunto si hay almenos una respuesta distinta de su creador



                 // en el siguiente codigo envio el mail a todos los que participaron en las respuestas, el creador del informe y el responsable de la escuela en cuestion


                  $linkinforme="index.php?mod=slat&men=informe&id=3&informeId=$informeId";

                   $mensaje = "Este es un mensaje generado por DBMS Conectar Igualdad - 2017 - \n\n Hay una nueva respuesta para revisar.\n \n Creado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme." \n";

                  $para=$destinatario;
                  //$para="jfvpipo@gmail.com";

                  if (mail($para, $titulo, $mensaje, $header))
                  {

                    $enviado_resp=1;
                  } else {
                            echo "Fall贸 el envio";
                         }
                  }

              $variablephp = "index.php?mod=slat&men=informe&id=3&informeId=$informeId";
            ?>    <script type="text/javascript"> 
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>
            <?php


*/

?>
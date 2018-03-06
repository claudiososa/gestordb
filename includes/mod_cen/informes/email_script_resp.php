
<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/respuesta.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/EscuelaReferentes.php");


    

      // ingresa cuando se agregó la respuesta

            $informeId = $_POST["informeId"]; // informeId del informe creado
            
      // a partir de este codigo trabajamos en recabar datos del usuario que inicio sesion.

          $dato_ref =  new Referente($_SESSION["referenteId"]);
          $buscar_dato_ref =  $dato_ref->buscar();
          $referente_actual = mysqli_fetch_object($buscar_dato_ref); // guardo el cargo del referente que se usara para una validacion mas adelante

          

            $resp_mail = new respuesta(); //creamos un objeto respuesta
            
            $resultad=$resp_mail->buscarMailRespuesta($informeId); // llamamos el metodo que devuelve los mail de las personas que participaron en las respuestas
            
             // busco el mail del referente que inicio sesion
            $referente= new Referente($_SESSION["referenteId"]);
            $buscar_ref = $referente->Persona($_SESSION["referenteId"]);
            $dato_ref = mysqli_fetch_object($buscar_ref);
            $mail_login=$dato_ref->email; // guardo el mail del referente que inicia sesion
            
            // armo la cabecera del mail con el mail del ref que inicio sesion
            $header="From: ".$dato_ref->email; 
            $creadopor=$dato_ref->nombre." ".$dato_ref->apellido; // usamos creadopor para el mensaje del mail

            $para="";


           while ($fila = mysqli_fetch_object($resultad)) // empezamos a concatenar los mail devuelto por el metodo buscarmailrespuesta()
               {
               
                if ($mail_login != $fila->email) { // evitamos que se concatene el mail del que inicio sesion
                  
                  $para=$para.",".$fila->email;

                }
               

              
                }
              
                // armo el tituo del mail
             
            $dato_informe_resp = new Informe($informeId);
            $buscar_informe_resp = $dato_informe_resp->buscar();
            $informe_resp = mysqli_fetch_object($buscar_informe_resp);
            $titulo=" RE -".$informe_resp->titulo; // armo el titulo de los mail con el titulo del informe original
            $num_escuela=$informe_resp->escuelaId; // obtengo el escuelaId de la escuela a la cual se le creo el informe, lo usamos mas adelante

            //busco el mail del creador del informe 
            $referente2= new Referente($informe_resp->referenteId);
            $buscar_ref2 = $referente2->Persona($informe_resp->referenteId);
            $dato_ref2 = mysqli_fetch_object($buscar_ref2);
            $creador_informe=$dato_ref2->email; // guardo el mail del creador del informe muy importante, ya que no necesariamente respondera algun mensaje del informe

            $resultado = strpos($para, $creador_informe);

                         if(($resultado === FALSE) && ($creador_informe != $mail_login))
                            {
                                // concateno a $para  el mail del creador del infome

                                $para=$para.",".$creador_informe;
                                
                            }

                 //  ingresa al if si es referente de conectar, con la idea de mandar mail al referente de la 
                // escuela, encaso que no hay sido el creador del informe y tambien para el caso en que no haya participado de las respuestas. Es necesario que este al tanto de una respuesta de su escuela creada por un referente de conectar igualdad.
              if($referente_actual->tipo=="ETT" || $referente_actual->tipo=="ETJ" || $referente_actual->tipo=="Coordinador" ){ // entra si es de conectar igualdad.

             // en el siguiente codigo se  busca el mail del responsable de la escuela que tiene el informe en cuestion ETT o ETJ

                    $escuela= new Escuela($num_escuela);
                    $buscar_escuela=$escuela->buscar();

                    $dato_escuela=mysqli_fetch_object($buscar_escuela);

                     $referenteEscuela = new EscuelaReferentes(null,$dato_escuela->escuelaId); //**** nueva entrada con el escuelaId para buscar
                     $buscarEscuelaReferente = $referenteEscuela->buscarReferente('19'); //**** buscamos los ett referentes de la escuela
                     $id_referente_escuela=$buscarEscuelaReferente->referenteId;   //***** obtenemos el referente ETT




                    // $id_referente_escuela= $dato_escuela->referenteId; //hasta aqui obtengo el referentID de la escuela  (** codigo reemplazado)
                           


                    $dato_ref_esc =  new Referente($id_referente_escuela);
                    $buscar_dato_ref_esc =  $dato_ref_esc->buscar();
                    $ref_esc = mysqli_fetch_object($buscar_dato_ref_esc);
                    $ref_esc_per= $ref_esc->personaId;   //  aqui obtenemos el personaid

                    // en el siguiente codigo usamos personaID obtenido en el paso anterior para obtener  su mail e usarlo mas adelante

                    $persona= new Persona($ref_esc_per);
                    $buscar_persona=$persona->buscar();
                    $dato_persona=mysqli_fetch_object($buscar_persona);
                    $mail_responsable=$dato_persona->email;    //obtengo el mail del responsable de la escuela



                  $resultado2 = strpos($para, $mail_responsable); // me fijo si aun no esta en la lista


                  if (($mail_responsable != $mail_login) && ($mail_responsable!= $creador_informe)&&( $resultado2 === FALSE ) )
                  {

                  $para=$para.",".$mail_responsable; // agrego el mail del responsable de la escuela

                        
                  }

              }
                  
              // en el siguiente codigo envio el mail a todos los que participaron en las respuestas, el creador del informe y el responsable de la escuela en cuestion si es que hay una intervencion de algun referente de conectar igualdad.


                  $linkinforme="index.php?mod=slat&men=informe&id=3&informeId=$informeId";

                   $mensaje = "Este es un mensaje generado por DBMS Conectar Igualdad - 2017 - \n\n Hay una nueva respuesta para revisar.\n \n Creado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme." \n ";

                  $destinatario=$para;
                  //$para=",jfvpipo@gmail.com";

                  if (mail($para, $titulo, $mensaje, $header))
                  {

                    $enviado_resp=1;
                    
                  } else {
                            echo "Falló el envio";
                            //echo $para;
                         }
              
              $variablephp = "index.php?mod=slat&men=informe&id=3&informeId=$informeId";

            ?>   

            
             <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
             </script>


              

           

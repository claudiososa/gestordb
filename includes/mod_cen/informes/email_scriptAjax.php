<?php

include_once("../../clases/informe.php");
include_once("../../clases/referente.php");
include_once("../../clases/escuela.php");
//include_once("includes/mod_cen/clases/TipoInforme.php");
//include_once("includes/mod_cen/clases/TipoPermisos.php");
//include_once("includes/mod_cen/clases/SubTipoInforme.php");
include_once("../../clases/EscuelaReferentes.php");
include_once("../../clases/maestro.php");




  
// a partir de este codigo trabajamos en recabar datos del usuario que inicio sesion.
 

  // Maestro::debbugPHP($_POST["referenteId"]);
  $dato_ref =  new Referente($_POST["referenteId"]); // EN CUENTA DE $_SESSION["referenteId"]
  $buscar_dato_ref =  $dato_ref->buscar();
  $referente_actual = mysqli_fetch_object($buscar_dato_ref);
 

  $_POST["prioridad"]= ucfirst($_POST["prioridad"]); // realizamos esta accion por que $_POST["prioridad"] venia con la primer letra en minuscula
  //$prioridad = ucfirst($prioridad);

 // Maestro::debbugPHP($_POST["prioridad"]);

  //
  // 
   
   switch ($referente_actual->tipo) {
     case 'ETT':
     case 'ETJ':
     case 'Coordinador':
       

  // entra si es ett o etj o coordinador de Conectar Igualdad
  // en el siguiente codigo usamos el escuelaID para encontrar el referente de la escuela asociada al informe por crear
  
     $escuela= new Escuela($_POST["escuelaId"]); // EN CUENTA DE $_GET["escuelaId"]
     $escuelaI=$_POST["escuelaId"];
     //Maestro::debbugPHP($escuelaI);
     $buscar_escuela=$escuela->buscar();
     // buscamos el referente de la escuela en la tabla escuelaReferentes.
     $referenteEscuela = new EscuelaReferentes(null,$escuelaI); //**** nueva entrada
     $buscarEscuelaReferente = $referenteEscuela->buscarReferente('19'); //**** buscamos los ett referentes de la escuela
     $id_referente_escuela=$buscarEscuelaReferente->referenteId;         //**** obtenemos el referenteId del ETT
     
       
     
      // fin de busqueda de referente en la tabla escuelaReferentes.
        
        // $dato_escuela=mysqli_fetch_object($buscar_escuela); // Codigo reemplazado por la busqueda en escuelaReferentes
         //$id_referente_escuela= $dato_escuela->referenteId; // Codigo reemplazado por la busqueda en escuelaReferentes(Obtengo el referentID conectar igualdad)

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
              $dato_referente =  new Referente($_POST["referenteId"]); // EN CUENTA DE $_SESSION["referenteId"]
              $buscar_dato = $dato_referente->Persona($_POST["referenteId"]); // EN CUENTA DE $_SESSION["referenteId"]
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
              //$cartel=$ref_esc->email." - ".$referente_origen->tipo." - ".$mail_etj_asociado->email."-".$origen->email."-".$origen2->email."-".$referente_actual->tipo." - ".$_POST["prioridad"];
              // Maestro::debbugPHP($cartel);


          if($referente_actual->tipo!="Coordinador")
      { // abre


            if($_POST["prioridad"]=="Alta" && $referente_actual->tipo=="ETJ"){ // abre
              $enviar=1;
               $para="cristianjavierortin@gmail.com"; //mail de cristian ortin
                                
              if($_POST["referenteId"] != $id_referente_escuela) //informes de escuelas de otro referente
                 {// abre Cambiado por  $_SESSION["referenteId"]

                  // al mail de cristian  se le debe concatenar el mail del referente de la escuela y del etj si corresponde
                  $para=$para.",".$ref_esc_mail;

                       if ($cargo_origen=="ETT") // averiguo si el referente de la escuela es ett,
                          {
                            $para=$para.",".$mail__etj_responsable;  //agregamos el mail del ETJ
                          }
                 } // cierra

            } // cierra
            else{

             // abre
                         

                if($_POST["prioridad"]=="Alta" && $referente_actual->tipo=="ETT")
                        { // abre
                           
                          
                           $para=$origen2->email.",cristianjavierortin@gmail.com"; // mando mail de mi etj  que lo tenemos en $origen2->mail y el mail de cristian.
                            if($_POST["referenteId"] != $id_referente_escuela) //Cambiado por  $_SESSION["referenteId"]
                                    // si el informe creado es de una escuela ajena
                                   { // abre

                                    $para=$origen2->email.",".$ref_esc_mail.",cristianjavierortin@gmail.com"; //envio mail al referente de la escuela ajena y a cristian por que es prioridad alta

                                    if ($cargo_origen=="ETT") // averiguo si el referente de la escuela es ett para agregar el mail de su etj, por que si fuese etj estaria mandando 2 veces el mismo mail a cristian
                                        {
                                          $para=$para.",".$mail__etj_responsable;  //agregamos el mail del ETJ
                                        }

                                   } // cierra
                             
                                   

                         } //cierra
                         else{ //abre

                                if ($referente_actual->tipo=="ETT")

                                   { // abre

                                    $para = $origen2->email; // va  mail a mi  etj

                                   if($_POST["referenteId"] != $id_referente_escuela) // pregunta si el informe creado es de otro referente
                                       { // abre // Cambiado por  $_SESSION["referenteId"]

                                        $para=$para.",".$ref_esc_mail;// mail del referente de la escuela y el mi etj

                                        if ($cargo_origen=="ETT")
                                        // averiguo si el referente de la escuela es ett para agregar el mail de su etj, por que si fuese etj estaria mandando un mail a cristian con prioridad normal y no corresponde
                                        {
                                          $para=$para.",".$mail__etj_responsable;  //agregamos el mail del ETJ
                                        }

                                       } // cierra

                             //cierra
                                   }else{ //  abre

                                          $para= $mail_propio; //bandera=1; // se autoenvia un  mail

                                             if($_POST["referenteId"] != $id_referente_escuela) // pregunta si el informe creado es de otro referente
                                               { // abre //  Cambiado por  $_SESSION["referenteId"]

                                                $para=$ref_esc_mail;// envio mail al referente de la escuela.

                                                 if ($cargo_origen=="ETT")
                                        // averiguo si el referente de la escuela es ett para agregar el mail de su etj, por que si fuese etj estaria mandando un mail a cristian con prioridad normal y no corresponde.
                                                    {
                                                      $para=$para.",".$mail__etj_responsable;  //agregamos el mail del ETJ
                                                    }
                                               } // cierra
                                       } // cierra

                         } // cierra

              } // cierra

       } // cierra
            else{   // aqui debe ingresar el coordinador
                   //aqui armar los mail para los ett y etj

                     $para=$ref_esc_mail;

                    if ($cargo_origen=="ETT") // averiguo si el referente de la escuela es ett
                          {
                            $para=$para.",".$mail__etj_responsable;;  //agregamos el mail del ETJ superior
                          }

                  }

              //buscar el ultimo informe creado por el usuario logeado
              $ultimo= new Informe(null,null,$_POST["referenteId"]); // Cambiado por  $_SESSION["referenteId"]
              $buscar_ultimo= $ultimo->buscar(1);
              $dato_ultimo = mysqli_fetch_object($buscar_ultimo);

              $linkinforme="index.php?mod=slat&men=informe&id=3&informeId=".$dato_ultimo->informeId;
              //$mailobtenido=$para;
              //$para="jfvpipo@gmail.com";

              $titulo = "   Nuevo Informe - Prioridad > ".$_POST["prioridad"]." - ".$_POST["titulo"];
              $mensaje = "Este es un mensaje generado por DBMS Conectar Igualdad - 2018 - \n\nTienes un nuevo informe para revisar.\nPrioridad -> ".$_POST["prioridad"]."\nCreado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme;

              if (mail($para, $titulo, $mensaje, $header)) {

                $enviado=1;
              } else {
                echo "Falló el envio ";
            
              }


       
       Maestro::debbugPHP($para);
             

      break; // CIERRA ETT ETJ Y COORDINADOR
     
     default:
       # code...
       break;
   }


       //fin php
   ?>  
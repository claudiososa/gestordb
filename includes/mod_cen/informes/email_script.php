<?php

include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/TipoInforme.php");
include_once("includes/mod_cen/clases/TipoPermisos.php");
include_once("includes/mod_cen/clases/SubTipoInforme.php");
include_once("includes/mod_cen/clases/EscuelaReferentes.php");
include_once("includes/mod_cen/clases/maestro.php");
  
// a partir de este codigo trabajamos en recabar datos del usuario que inicio sesion.
 
     $dato_ref =  new Referente($_SESSION["referenteId"]);
     $buscar_dato_ref =  $dato_ref->buscar();
     $referente_actual = mysqli_fetch_object($buscar_dato_ref);

     
     switch ($referente_actual->tipo) {
      
      case 'ETT':
      case 'ETJ':
      case 'Coordinador':

           // entra si es ett o etj o coordinador de Conectar Igualdad
            // en el siguiente codigo usamos el escuelaID para encontrar el referente de la escuela asociada al informe por crear
           $escuela= new Escuela($_GET["escuelaId"]);
           $buscar_escuela=$escuela->buscar();

                   // buscamos el referente de la escuela en la tabla escuelaReferentes  [puede ser ETT o ETJ o sin Referente].

           $referenteEscuela = new EscuelaReferentes(null,$_GET["escuelaId"]); 
           $buscarEscuelaReferente = $referenteEscuela->buscarReferente('19'); //**** buscamos el ETT referente de la escuela
           $id_referente_escuela=$buscarEscuelaReferente->referenteId; 
         
             if($id_referente_escuela == "")
             {    // aqui entra si la escuela no tiene ETT
          
              $buscarEscuelaReferente = $referenteEscuela->buscarReferente('20');   //**** buscamos ETJ referente de la escuela
              $id_referente_escuela=$buscarEscuelaReferente->referenteId;
                
                  if ($id_referente_escuela == "")
                   {  // aqui entra si no tiene ni ETT ni ETJ
                       $id_referente_escuela=0001;
                   }
             }
              
                       // fin de busqueda de referente en la tabla escuelaReferentes.
        
        
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

             if($referente_actual->tipo!="Coordinador") // entra si es ETT o ETJ
              {
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
               }else
                    {
                      if($_POST["prioridad"]=="Alta" && $referente_actual->tipo=="ETT")
                        {
                           $para=$origen2->email.",cristianjavierortin@gmail.com"; // mando mail de mi etj  que lo tenemos en $origen2->mail y el mail de cristian.
                            if($_SESSION["referenteId"] != $id_referente_escuela)
                                  {            // si el informe creado es de una escuela ajena
                                    $para=$origen2->email.",".$ref_esc_mail.",cristianjavierortin@gmail.com"; //envio mail al referente de la escuela ajena y a cristian por que es prioridad alta
                                    if ($cargo_origen=="ETT") // averiguo si el referente de la escuela es ett para agregar el mail de su etj, por que si fuese etj estaria mandando 2 veces el mismo mail a cristian
                                        {
                                          $para=$para.",".$mail__etj_responsable;  //agregamos el mail del ETJ
                                        }
                                   }
                         }else
                              {
                                if ($referente_actual->tipo=="ETT")
                                   {
                                       $para = $origen2->email; // va  mail a mi  etj
                                       if($_SESSION["referenteId"] != $id_referente_escuela) // pregunta si el informe creado es de otro referente
                                       {
                                          $para=$para.",".$ref_esc_mail;// mail del referente de la escuela y el mi etj
                                           if ($cargo_origen=="ETT") 
                                            {      
                                                       // averiguo si el referente de la escuela es ett para agregar el mail de su etj, por que si fuese etj estaria mandando un mail a cristian con prioridad normal y no corresponde
                                                      $para=$para.",".$mail__etj_responsable;  //agregamos el mail del ETJ
                                            }
                                       }
                                   }else
                                       {
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
               } // esta llave cierra  distinto de coordinador
              else{   // aqui debe ingresar el coordinador
                   //aqui armar los mail para los ett y etj

                         

                     $para=$ref_esc_mail;

                     if ($cargo_origen=="ETT") // averiguo si el referente de la escuela es ett
                          {
                            $para=$para.",".$mail__etj_responsable;  //agregamos el mail del ETJ superior
                          }

                  }

              
              //buscar el ultimo informe creado por el usuario logeado
              $ultimo= new Informe(null,null,$_SESSION["referenteId"]);
              $buscar_ultimo= $ultimo->buscar(1);
              $dato_ultimo = mysqli_fetch_object($buscar_ultimo);

              $linkinforme="index.php?mod=slat&men=informe&id=3&informeId=".$dato_ultimo->informeId;
             
              //********** inicio de ultima modificacion *******//
                
              
               

              switch ($dato_ultimo->nuevotipo) {
                
                case 18:
                        if ($dato_ultimo->prioridad == 'Alta'){  

                           // aqui verificar si el informe es de pnce y prioridad alta, y envia mail a luis castro
            
                          $para=$para.",luchocachi@gmail.com";

                          }
                  break;

                case 27:
                case 29:
                case 30:

                        switch ($dato_ultimo->escuelaId) {
                               case 225:
                               case 1383:
                               case 1384:
                               case 1385:
                               case 1387:
                               case 1388:
                               case 1390:
                               case 1391:
                               case 1392:
                               case 1393:
                               case 1394:
                               case 1395:
                               case 1397:
                               case 1398:
                                 
                                 // aqui entra si el informe es de categorias para unicef (inf. tecnico,pedagogico o historia de la escuela) y las escuelas 5212 y sus anexos
                                 
                                   if ($dato_ultimo->prioridad == 'Alta'){


                                    $para="martucamerlo@gmail.com,alfonbarraza@gmail.com,juliocorimayo@gmail.com, manucespedesrico@gmail.com";

                                  }else
                                  {

                                    $para="juliocorimayo@gmail.com,manucespedesrico@gmail.com";
                                  }
                                 break;
                               
                               default:
                                 
                                 break;
                             }

                  break;
                default:
                  
                  break;
              }

         //********* fin de ultima modificacion ******////



              $mailobtenido=$para;
              //$para="jfvpipo@gmail.com";

              $titulo = "   Nuevo Informe - Prioridad > ".$_POST["prioridad"]." - ".$_POST["titulo"];
              $mensaje = "Este es un mensaje generado por CONDOR-DBMS - 2019 - \n\nTienes un nuevo informe para revisar.\nPrioridad -> ".$_POST["prioridad"]."\nCreado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme;

              if (mail($para, $titulo, $mensaje, $header)) {

                $enviado=1;
              } else {
                        echo "Falló el envio ";
                       
                
                      }

              $variablephp = "index.php?mod=slat&men=informe&id=2&escuelaId=".$_POST["escuelaId"];

      break; // fin del case ETT,ETJ,COORDINADOR
   
    case 'ATT':
    case 'CoordinadorPmi':
          // aqui entra si es ATT O COORDINADOR PMI  //
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
              $mensaje = "Este es un mensaje generado por CONDOR-DBMS - 2019  - \n\nTienes un nuevo informe para revisar.\nPrioridad -> ".$_POST["prioridad"]."\nCreado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme;

              if (mail($para, $titulo, $mensaje, $header)) {

                $enviado=1;
              } else {
                echo "Falló el envio";
              }

              $variablephp = "index.php?mod=slat&men=informe&id=2&escuelaId=".$_POST["escuelaId"];
      
      break;
    
    case 'Supervisor-Secundaria':
    case 'Supervisor-General-Secundaria':
    case 'DirectorNivelSecundario':
      
          
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
               { //mandamos mail a director de nivel y supervisora general si es prioridad alta

                   if($_POST["prioridad"]=="Alta" || $_POST["prioridad"]=="Media") // modificacion 

                    {
                      $para="martucamerlo@gmail.com,francomaria@gmail.com";
                    }else{

                      $para="";
                    }


                         if($_SESSION["referenteId"] != $id_referente_escuela)
                         // pregunta si el informe creado es de otro referente
                                     {
                                           $para=$para.",".$ref_esc_mail;// mail del Supervisor de la escuela tambien
                                     }

               }else{  // entra por que es supervisor general o director de nivel y solo envia mail al supervisor de la escuela en cuestion

                   $para= $ref_esc_mail;

                    }

                 //buscamos el ultimo informe creado por el usuario logeado
                 $ultimo= new Informe(null,null,$_SESSION["referenteId"]);
                 $buscar_ultimo= $ultimo->buscar(1);
                 $dato_ultimo = mysqli_fetch_object($buscar_ultimo);

                 $linkinforme="index.php?mod=slat&men=informe&id=3&informeId=".$dato_ultimo->informeId;
                 $mailobtenido=$para;
                 //$para="jfvpipo@gmail.com";// prueba de mail a sup secundaria

                $titulo = "   Nuevo Informe - Prioridad > ".$_POST["prioridad"]." - ".$_POST["titulo"];
                $mensaje = "Este es un mensaje generado por CONDOR-DBMS - 2019  - \n\nTienes un nuevo informe para revisar.\nPrioridad -> ".$_POST["prioridad"]."\nCreado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme;

                if (mail($para, $titulo, $mensaje, $header)) {

                  $enviado=1;
                } else {
                  echo "Falló el envio";
                }

                $variablephp = "index.php?mod=slat&men=informe&id=2&escuelaId=".$_POST["escuelaId"];

      break;
    
    case 'Supervisor-Nivel-Superior':
    case 'SupervisorGeneralSuperior':
    case 'DirectorNivelSuperior':
      
          
                 // en el siguiente codigo usamos el escuelaID para encontrar el Supervisor de la escuela asociada al informe por crear
                 $escuela= new Escuela($_GET["escuelaId"]);
                 $buscar_escuela=$escuela->buscar();
                 $dato_escuela=mysqli_fetch_object($buscar_escuela);
                 $id_referente_escuela= $dato_escuela->referenteIdSuperSup; //hasta aqui obtengo el referentID del Supervisor asociado a la escuela.

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

               if ($referente_actual->tipo=="Supervisor-Nivel-Superior")
               { //mandamos mail a director de nivel superior y supervisora general si es prioridad alta o media

                   if($_POST["prioridad"]=="Alta" || $_POST["prioridad"]=="Media") // modificacion 

                    {
                      $para="epinikas@hotmail.com,patriciadelcarril@gmail.com";
                    }else{

                      $para="";
                    }


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
                 //$para="jfvpipo@gmail.com"; // prueba de mail a superior

                $titulo = "   Nuevo Informe - Prioridad > ".$_POST["prioridad"]." - ".$_POST["titulo"];
                $mensaje = "Este es un mensaje generado por CONDOR-DBMS - 2019  - \n\nTienes un nuevo informe para revisar.\nPrioridad -> ".$_POST["prioridad"]."\nCreado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme;

                if (mail($para, $titulo, $mensaje, $header)) {

                  $enviado=1;
                  //echo $para;
                  //sleep(20);
                } else {
                  
                  echo "Falló el envio";
                  
                  
                }

                $variablephp = "index.php?mod=slat&men=informe&id=2&escuelaId=".$_POST["escuelaId"];

      break;


    case 'CPPL':
    case 'ETTPL':
        
              // En el siguiente codigo obtenemos datos del Referente de Plan de Lectura que inicio sesion
                 $dato_referente =  new Referente($_SESSION["referenteId"]);
                 $buscar_dato = $dato_referente->Persona($_SESSION["referenteId"]);
                 $origen =  mysqli_fetch_object($buscar_dato);

                 $creadopor=$origen->nombre." ".$origen->apellido;
                 //quien envia el mensaje - (email)
                 $mail_propio=$origen->email;

                 $header = "From: ". $origen->email; // datos de quien envia el mail

               if ($referente_actual->tipo=="ETTPL")
               { //mandamos mail al coordinador de Plan de Lectura si es prioridad alta o media

                   if($_POST["prioridad"]=="Alta" || $_POST["prioridad"]=="Media" || $_POST["prioridad"]=="Normal") // modificacion 

                    {
                      $para="mauriciocoudert@gmail.com";
                    }else{

                      $para="";
                    }


                        

               }else{  // entra por que es coordinador del Plan de Lectura envia mail al att de la escuela en cuestion

                   $para=""; // no envia mail.

                    }

                 //buscamos el ultimo informe creado por el usuario logeado
                 $ultimo= new Informe(null,null,$_SESSION["referenteId"]);
                 $buscar_ultimo= $ultimo->buscar(1);
                 $dato_ultimo = mysqli_fetch_object($buscar_ultimo);

                 $linkinforme="index.php?mod=slat&men=informe&id=3&informeId=".$dato_ultimo->informeId;
                 $mailobtenido=$para;
                 //$para="jfvpipo@gmail.com"; // prueba de mail a superior

                $titulo = "   Nuevo Informe - Prioridad > ".$_POST["prioridad"]." - ".$_POST["titulo"];
                $mensaje = "Este es un mensaje generado por CONDOR-DBMS - 2019 - \n\nTienes un nuevo informe para revisar.\nPrioridad -> ".$_POST["prioridad"]."\nCreado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme;

                if (mail($para, $titulo, $mensaje, $header)) {

                  $enviado=1;
                  //echo $para;
                  //sleep(20);
                } else {
                  
                  echo "Falló el envio  ";
                  
                  
                }

           $variablephp = "index.php?mod=slat&men=informe&id=2&escuelaId=".$_POST["escuelaId"]."&tipo=lectura";
   
      break;  

     case 'CU':
     case 'CAS':

                   // En el siguiente codigo obtenemos datos del Referente de UNICEF  que inicio sesion
                 $dato_referente =  new Referente($_SESSION["referenteId"]);
                 $buscar_dato = $dato_referente->Persona($_SESSION["referenteId"]);
                 $origen =  mysqli_fetch_object($buscar_dato);

                 $creadopor=$origen->nombre." ".$origen->apellido;
                 //quien envia el mensaje - (email)
                 $mail_propio=$origen->email;

                 $header = "From: ". $origen->email; // datos de quien envia el mail

               if ($referente_actual->tipo=="CAS")
               { //mandamos mail al coordinador unicef si es prioridad alta o media

                   if($_POST["prioridad"]=="Alta" || $_POST["prioridad"]=="Media")  

                    {
                      $para="juliocorimayo@gmail.com,manucespedesrico@gmail.com";
                    }else{

                      $para="";
                    }


                        

               }else{  // entra por que es coordinador unicef envia mail a cristian, merlo, barraza y el otro coordinador

                   
                       if($_POST["prioridad"]=="Alta" || $_POST["prioridad"]=="Media")  

                        {
                       
                                if ($origen->email =="juliocorimayo@gmail.com") {
                                  $para="manucespedesrico@gmail.com";
                                }
                                else
                                {
                                  $para="juliocorimayo@gmail.com";  
                                }
                               
                                
                                if($_POST["prioridad"]=="Alta"){

                                      $para=$para.",cristianjavierortin@gmail.com,martucamerlo@gmail.com,alfonbarraza@gmail.com";
                       
                                }
                                else{

                                      $para=$para.",cristianjavierortin@gmail.com";
                                }

                            
                       }
                       else{

                           $para="";
                           }
              
                      }

                 //buscamos el ultimo informe creado por el usuario logeado
                 $ultimo= new Informe(null,null,$_SESSION["referenteId"]);
                 $buscar_ultimo= $ultimo->buscar(1);
                 $dato_ultimo = mysqli_fetch_object($buscar_ultimo);

                 $linkinforme="index.php?mod=slat&men=informe&id=3&informeId=".$dato_ultimo->informeId;
                 $mailobtenido=$para;
                 //$para="jfvpipo@gmail.com"; // prueba de mail a superior

                $titulo = "   Nuevo Informe - Prioridad > ".$_POST["prioridad"]." - ".$_POST["titulo"];
                $mensaje = "Este es un mensaje generado por CONDOR-DBMS - 2019 - \n\nTienes un nuevo informe para revisar.\nPrioridad -> ".$_POST["prioridad"]."\nCreado por ".$creadopor." \n\nEnlace al informe ->  http://ticsalta.com.ar/conectar/".$linkinforme;

                if (mail($para, $titulo, $mensaje, $header)) {

                  $enviado=1;
                  //echo $para;
                  //sleep(20);
                } else {
                  
                  echo "Falló el envio ";
                                   
                }

                $variablephp = "index.php?mod=slat&men=informe&id=2&escuelaId=".$_POST["escuelaId"];
            
       break; 
     default:
      # code...
      break;

   }  // fin del switch
             


?>

<script type="text/javascript">
  var variablejs = "<?php echo $variablephp; ?>" ;
  function redireccion(){window.location=variablejs;}
          setTimeout ("redireccion()",0);
 </script>
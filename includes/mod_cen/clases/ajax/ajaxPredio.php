<?php
  include_once('../CompartePredio.php');
  //include_once('../maestro.php');
  include_once('../escuela.php');
  include_once('../EscuelaReferentes.php');
  include_once('../referente.php');
  include_once('../localidades.php');

/**
 * pregunta por la escuela que se esta
 * seleccionando como escuela que comparte predio con la institucion actual
 */
  if (isset($_POST['agregarEscuelaId']))
   {

     $list=array();
     $predio = new CompartePredio(null,$_POST['agregarEscuelaId']);
     $buscarUnico = $predio->registroUnico();

     //busca el escuelaId de la escuela Seleccionada para agregar al predio
     $buscar = $predio->buscarPredio('count');

     if ($buscar == 0 AND $buscarUnico == 'no') {//sino encuentra  el escuelaId en tabla Predio,
       $predio->escuelaId = $_POST['escuelaId'];

       //busca el escuelaId de la escuela a cargo a donde quieres agregar la escuela Seleccionada
       $buscarUnico = $predio->registroUnico();

       $buscar = $predio->buscarPredio('count');

       if ($buscar == 0 AND $buscarUnico == 'no') {//sino encuentra  el escuelaId en tabla Predio,
         $ultimoPredio = $predio->ultimoPredio();
         $objUltimoPredio = mysqli_fetch_object($ultimoPredio);

         $datoPredio = $objUltimoPredio->predio + 1;

         $nuevoPredio = new CompartePredio(null,$_POST['escuelaId'],$datoPredio,'22');
         $nuevoId = $nuevoPredio->agregar();
         $nuevoPredio->escuelaId=$_POST['agregarEscuelaId'];
         $nuevoId = $nuevoPredio->agregar();
         //$nuevoPredio = $pred


         $nuevoPredio->id = $nuevoId;

         $buscarP = $nuevoPredio->buscarPredioId();

         $datoEscuela = mysqli_fetch_object($buscarP);


         $temporal=array(
            'predioId'=>$nuevoId,
            'numero'=>$datoEscuela->numero,
            'domicilio'=>substr($datoEscuela->domicilio,0,30),
            'nombre'=>$datoEscuela->nombre,
            'cue'=>$datoEscuela->cue
            );
       }else{
         $buscar = mysqli_fetch_object($predio->buscarPredio());

         $nuevoPredio = new CompartePredio(null,$_POST['agregarEscuelaId'],$buscar->predio,'22');

         $predioNuevo = $nuevoPredio->agregar();

         $nuevoPredio->id = $predioNuevo;

         $buscarP = $nuevoPredio->buscarPredioId();

         $datoEscuela = mysqli_fetch_object($buscarP);

         $temporal=array(
            'predioId'=>$predioNuevo,
            'domicilio'=>substr($datoEscuela->domicilio,0,30),
            'numero'=>$datoEscuela->numero,
            'nombre'=>substr($datoEscuela->nombre,0,30),
            'cue'=>$datoEscuela->cue
            );
       }

       // $datoPredio = mysqli_fetch_object($predio->buscarPredio());
       // $predioId = new CompartePredio(null,$_POST['agregarEscuelaId'],$datoPredio->predio,'22');
       // $predioId->agregar();
     }else{

       //Verifica si existe la escuela actual en la tabla compartirPredio

       $predio->escuelaId = $_POST['escuelaId'];

       $unicoActual = $predio->buscarPredio('count');

       if ($unicoActual > 0) {
         $predio->escuelaId = $_POST['agregarEscuelaId'];

         $buscar = $predio->buscarPredioUnico();
         $dato1 = mysqli_fetch_object($buscar);
         //Maestro::debbugPHP($dato1);

         $predio->escuelaId = $_POST['escuelaId'];
         $buscar = $predio->buscarPredio();
         $datoPredio = mysqli_fetch_object($buscar);
         $nuevoPredio = new CompartePredio($dato1->id,$_POST['agregarEscuelaId'],$datoPredio->predio,'22');
         $predioNuevo = $nuevoPredio->editar();


         $nuevoPredio->id = $predioNuevo;

         $buscarP = $nuevoPredio->buscarPredioId();
         $datoEscuela = mysqli_fetch_object($buscarP);
         //Maestro::debbugPHP($datoEscuela);
         $temporal=array(
            'predioId'=>$predioNuevo,
            'domicilio'=>substr($datoEscuela->domicilio,0,30),
            'numero'=>$datoEscuela->numero,
            'nombre'=>substr($datoEscuela->nombre,0,30),
            'cue'=>$datoEscuela->cue
            );
       }else{

         $ultimoPredio = $predio->ultimoPredio();
         $objUltimoPredio = mysqli_fetch_object($ultimoPredio);

         $crearPredio = $objUltimoPredio->predio + 1;

         $nuevoPredio = new CompartePredio(null,$_POST['escuelaId'],$crearPredio,'22');
         $predioNuevo = $nuevoPredio->agregar();

         $predio->escuelaId = $_POST['agregarEscuelaId'];

         $buscar = $predio->buscarPredioUnico();
         $dato1 = mysqli_fetch_object($buscar);
         //Maestro::debbugPHP($crearPredio);

         $nuevoPredio2 = new CompartePredio($dato1->id,$_POST['agregarEscuelaId'],$crearPredio,'22');
         $predioNuevo = $nuevoPredio2->editar();

         $nuevoPredio->id = $predioNuevo;

         $buscarP = $nuevoPredio->buscarPredioId();
         $datoEscuela = mysqli_fetch_object($buscarP);

         $temporal=array(
            'predioId'=>$predioNuevo,
            'domicilio'=>substr($datoEscuela->domicilio,0,30),
            'numero'=>$datoEscuela->numero,
            'nombre'=>substr($datoEscuela->nombre,0,30),
            'cue'=>$datoEscuela->cue
            );
       }



     }
      array_push($list,$temporal);

      $json = json_encode($list);

      echo $json;
   }



  if (isset($_POST['quitarPredioId']))
   {
     $list=array();
     $predio = new CompartePredio($_POST['quitarPredioId']);
     $quitar = $predio->eliminar();

     $temporal=array(
        'predioId'=>$_POST['quitarPredioId']
        );

      array_push($list,$temporal);

      $json = json_encode($list);

      echo $json;
   }

  if (isset($_POST['predio']))
   {
   	 $list=array();
     $predio = new CompartePredio(null,$_POST['escuelaId']);
     $buscarPredio = $predio->buscarPredio();

     $cantidadPredio = $predio->buscarPredio('count');
     //$cantidadPredio=mysqli_num_rows($buscarPredio);
     //$cantidadPredio = $cantidadPredio + 1;


     if ($cantidadPredio > 0) {
       //Maestro::debbugPHP($buscarPredio);
       while ($fila = mysqli_fetch_object($buscarPredio))
       {


        if ($fila->escuelaId <> $_POST['escuelaId']) {
          $temporal=array(
             'escuelaActual'=>$_POST['escuelaId'],
             'escuelaId'=>$fila->escuelaId,
             'cantidad'=>$cantidadPredio,
             'nombre' =>substr($fila->nombre,0,30).'...',
             'domicilio' =>substr($fila->domicilio,0,30).'...',
             'numero' =>$fila->numero,
             'cue' =>$fila->cue,
             'predioId'=>$fila->id
     		    );

            array_push($list,$temporal);

        }
     	}

    }else{
      $temporal=array(
         'escuelaActual'=>$_POST['escuelaId'],
         'cantidad'=>$cantidadPredio,
        );
        array_push($list,$temporal);

    }


     $json = json_encode($list);

     //Maestro::debbugPHP($json);

     echo $json;

   }


//***** para listar escuelas con predio compartido en el buscador de escuelas viejo

   if (isset($_POST['idEscuelaPredio']))
   {
     $list=array();
     $escuelaObj= new escuela($_POST['idEscuelaPredio']);
     $buscarEscuelas=$escuelaObj->buscar();
     $datosEscuela=mysqli_fetch_object($buscarEscuelas);
     //Inicio de busqueda de localidad //
          $locali=new Localidad($datosEscuela->localidadId,null);
          $busca_loc= $locali->buscar();
          $datosLocalidad=mysqli_fetch_object($busca_loc);
     //Fin de busqueda de localidad

      $perfil="ETT"; // usamos la varible perfil para indicar en el modal si es ett o etj

     $escuelasETT=new EscuelaReferentes(null,$_POST['idEscuelaPredio'],'19'); // buscamos las escuelas del ETT
     $buscar_referenteETT=$escuelasETT->buscar2();// devuelve todos los datos de las escuelas del ETT
     $datoBuscarETT=mysqli_fetch_object($buscar_referenteETT);

             
             if ($datoBuscarETT->referenteId == NULL){ 

                $escuelasETJ=new EscuelaReferentes(null,$_POST['idEscuelaPredio'],'20'); // buscamos la escuelas del ETJ
                $buscar_referenteETJ=$escuelasETJ->buscar2();// devuelve todos los datos de la escuelas del ETJ
                $datoBuscarETJ=mysqli_fetch_object($buscar_referenteETJ); 
                  if ($datoBuscarETJ->referenteId == NULL ){
                  $referente=new Referente('0001');

                  }else{
                  $referente=new Referente($datoBuscarETJ->referenteId);
                  $perfil="ETJ";
                }
                    // vamos a mostrar Sin, Asignar
                }else{

               $referente=new Referente($datoBuscarETT->referenteId);  // vamos a mostrar el ETT

            }
   $buscar_referente=$referente->buscar();
   $datoEttEtj=mysqli_fetch_object($buscar_referente);


   // buscar datos del etj a cargo de la escuela

   // fin buscar datos del etj a cargo de la escuela


     
          $temporal=array(
             
             'escuelaId'=>$datosEscuela->escuelaId,
             'nombre' =>$datosEscuela->nombre,
             'numero' =>$datosEscuela->numero,
             'cue' =>$datosEscuela->cue,
             'domicilio' =>$datosEscuela->domicilio,
             'localidad' =>$datosLocalidad->nombre,
             'perfil'=>$perfil,
             'nombreEtt'=>$datoEttEtj->nombre,
             'apellidoEtt'=>$datoEttEtj->apellido,
             'telefonoEtt'=>$datoEttEtj->telefonoM
            );

            array_push($list,$temporal);

  


     $json = json_encode($list);

     //Maestro::debbugPHP($json);

     echo $json;

   }


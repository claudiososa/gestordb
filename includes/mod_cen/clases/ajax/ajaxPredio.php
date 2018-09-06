<?php
  include_once('../CompartePredio.php');
  include_once('../maestro.php');

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


         Maestro::debbugPHP($predioNuevo);
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


     if ($cantidadPredio > 0) {
       //$datoPredio = mysqli_fetch_object($buscarPredio);
       //$predio2 = new CompartePredio(null,null,$datoPredio->predio);
       //$buscarPredio2 = $predio2->buscar();
       //$cantidadPredio2=mysqli_num_rows($buscarPredio2);

       while ($fila = mysqli_fetch_object($buscarPredio))
       {
        if ($fila->escuelaId<>$_POST['escuelaId']) {
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
     }
     $json = json_encode($list);

     echo $json;

   }

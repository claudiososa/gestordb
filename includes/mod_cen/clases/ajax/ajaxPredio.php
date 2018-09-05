<?php
  include_once('../CompartePredio.php');
  include_once('../maestro.php');


  if (isset($_POST['agregarEscuelaId']))
   {
     $list=array();
     $predio = new CompartePredio(null,$_POST['agregarEscuelaId']);
     //busca el escuelaId de la escuela Seleccionada para agregar al predio
     $buscar = $predio->buscarPredio('count');

     if ($buscar == 0) {//sino encuentra  el escuelaId en tabla Predio,
       $predio->escuelaId = $_POST['escuelaId'];
       //busca el escuelaId de la escuela a cargo a donde quieres agregar la escuela Seleccionada
       $buscar = $predio->buscarPredio('count');

       if ($buscar == 0) {//sino encuentra  el escuelaId en tabla Predio,
         $ultimoPredio = mysqli_fetch_object($predio->ultimoPredio());
         $datoPredio = $ultimoPredio->predio + 1;
         $nuevoPredio = new CompartePredio(null,$_POST['escuelaId'],$datoPredio,'22');
         $predioNuevo = $predioId->agregar();

         $nuevoPredio->id = $predioNuevo;


         $datoEscuela = mysqli_fetch_object($nuevoPredio->buscarPredioId());


         $temporal=array(
            'predioId'=>$predioNuevo,
            'numero'=>$datoEscuela->numero,
            'nombre'=>$datoEscuela->nombre,
            'cue'=>$datoEscuela->cue
            );
       }else{
         $buscar = mysqli_fetch_object($predio->buscarPredio());

         $nuevoPredio = new CompartePredio(null,$_POST['agregarEscuelaId'],$buscar->predio,'22');

         $predioNuevo = $nuevoPredio->agregar();

         $nuevoPredio->id = $predioNuevo;
         $datoEscuela = mysqli_fetch_object($nuevoPredio->buscarPredioId());


         $temporal=array(
            'predioId'=>$predioNuevo,
            'numero'=>$datoEscuela->numero,
            'nombre'=>$datoEscuela->nombre,
            'cue'=>$datoEscuela->cue
            );
       }

       // $datoPredio = mysqli_fetch_object($predio->buscarPredio());
       // $predioId = new CompartePredio(null,$_POST['agregarEscuelaId'],$datoPredio->predio,'22');
       // $predioId->agregar();
     }else{

     }
      array_push($list,$temporal);

      $json = json_encode($list);
      //Maestro::debbugPHP($json);
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
      Maestro::debbugPHP($json);
      echo $json;
   }

  if (isset($_POST['predio']))
   {
   	 $list=array();
     $predio = new CompartePredio(null,$_POST['escuelaId']);
     $buscarPredio = $predio->buscarPredio();
     $cantidadPredio = $predio->buscarPredio('count');
     //$cantidadPredio=mysqli_num_rows($buscarPredio);
     //Maestro::debbugPHP($cantidadPredio);

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
             'nombre' =>$fila->nombre,
             'numero' =>$fila->numero,
             'cue' =>$fila->cue,
             'predioId'=>$fila->id
     		    );

       		array_push($list,$temporal);
        }

     	}
     }
     $json = json_encode($list);
     //Maestro::debbugPHP($json);
     echo $json;

   }

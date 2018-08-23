<?php
  include_once('../CompartePredio.php');
  include_once('../maestro.php');

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
     		$temporal=array(
           'escuelaActual'=>$_POST['escuelaId'],
           'escuelaId'=>$fila->escuelaId,
           'cantidad'=>$cantidadPredio,
           'nombre' =>$fila->nombre,
           'numero' =>$fila->numero,
           'cue' =>$fila->cue
   		    );

     		array_push($list,$temporal);
     	}
     }

   }

   $json = json_encode($list);
   //Maestro::debbugPHP($json);
   echo $json;

  ?>

<?php
include_once("../escuela.php");
include_once("../referente.php");
include_once("../rtixescuela.php");
//include_once("../persona.php");
include_once("../rti.php");
include_once("../maestro.php");




  if (isset($_POST['rti']))
  {

    $referenteId=$_SESSION['referenteId'];
    //Maestro::debbugPHP($_POST);
    //$escuelaId = $_POST['escuelaId'];
    //Crear objeto escuela y buscar las escuelas que tiene a cargo el Referente
    $escuela= new Escuela('0069');
    $fila=$escuela->buscarUnico();
    //$fila=mysqli_fetch_object($escuela_acargo);
    Maestro::debbugPHP($fila);


    //while($fila=mysqli_fetch_object($escuela_acargo)){
      //echo $fila->escuelaId.$fila->nombre."<br><br>";
      //echo "_______________________<br>";
      $rtix= new rtixescuela($fila->escuelaId);

      $buscar_rti=$rtix->buscar();
      //var_dump($rtix);
      while($filarti=mysqli_fetch_object($buscar_rti)){
        $list=[];
        $rti=new Rti($filarti->rtiId);
        $buscar_dato=$rti->buscar();
        $cantidadRti='2';


        while($filadato=mysqli_fetch_object($buscar_dato)){
          $persona= new Persona($filadato->personaId);
          $buscar_persona=$persona->buscar();
          $dato=mysqli_fetch_object($buscar_persona);

          $temporal=array(
            'escuelaId'=>$fila->escuelaId,
            'numero'=>$fila->numero,
            'cue'=>$fila->cue,
      			'nombre'=>$dato->apellido.", ".$dato->nombre,
            'email'=>$dato->email,
            'cantidad'=>$cantidadRti,
            'telefonoM' =>$dato->telefonoM,
            'telefonoC' =>$dato->telefonoC,
            'turno' =>$filarti->turno
      		);

      		array_push($list,$temporal);

        }

      }



    $json = json_encode($list);
    //Maestro::debbugPHP($json);
    echo $json;

  }
  ?>

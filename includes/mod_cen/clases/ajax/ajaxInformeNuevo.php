<?php
  include_once('../img.php');
  include_once('../informe.php');
  include_once('../maestro.php');


  if (isset($_POST))
  {
    $fecha=date("Y-m-d H:i:s");
    $nuevaInforme =  new Informe($_POST['informeId'],$_POST['escuelaId'],$_POST['referenteId'],
                                    $_POST['prioridad'],"Acta de Visita",$_POST['titulo'],
                                    $_POST['contenido'],"0","0",$_POST['fecha'],$fecha,$fecha,$_POST['tipo'],$_POST['subTipo']);
    $guardar_informe=$nuevaInforme->agregar();


    foreach ($_FILES['input-img'] as $key) {

      $cantidadElmentos=count($_FILES['input-img']['name']);

      for ($i=0; $i < $cantidadElmentos ; $i++) {
        # code...
        $img1 = $_FILES['input-img']['tmp_name'][$i];
        $img1 = $_FILES['input-img']['name'][$i];
              $dir_subida = '../../../../img/informes/';

        if($_FILES['input-img']['type'][$i]=='image/jpeg'){
          $nombreArchivo='doc_'.$guardar_informe.'_'.$i.'.jpg';
          $nombreArchivoMediano='doc_'.$guardar_informe.'_'.$i.'m.jpg';
          $tipoArchivo='image/jpeg';
        } elseif($_FILES['input-img']['type'][$i]=='application/pdf') {
          $nombreArchivo='doc_'.$guardar_informe.'_'.$i.'.pdf';
          $tipoArchivo='application/pdf';
        } elseif($_FILES['input-img']['type'][$i]=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
          $nombreArchivo='doc_'.$guardar_informe.'_'.$i.'.xlsx';
          $tipoArchivo='application/excel';
        }
        $fichero_subido = $dir_subida . $nombreArchivo;

        if (move_uploaded_file($_FILES['input-img']['tmp_name'][$i], $fichero_subido)) {
          if($_FILES['input-img']['type'][$i]=='image/jpeg'){
            $nuevoArchivo = $dir_subida.$nombreArchivoMediano;
            copy($fichero_subido,$nuevoArchivo);
          }
          $imagen = new Img(null,$guardar_informe,$nombreArchivo,$tipoArchivo);
          $agregarImg = $imagen->agregar();
          echo "El fichero es válido y se subió con éxito.\n";
        }	 else {
   echo "¡Posible ataque de subida de ficheros!\n";
        }

      }
      break;
    }

   //Maestro::debbugPHP($guardar_informe);

   if($guardar_informe > 0){



          include_once("../../informes/email_scriptAjax.php");
          //Maestro::debbugPHP($guardar_informe);

         }

      // $list=array();
      // $temporal=array(
      //   'estado'=>'guardado'
      // );
      //
      // array_push($list,$temporal);
      // $json = json_encode($list);
      // //Maestro::debbugPHP($json);
      // echo $json;
  }

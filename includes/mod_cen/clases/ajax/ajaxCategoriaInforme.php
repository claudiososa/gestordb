<?php
  include_once('../TipoInforme.php');
  include_once('../TipoPermisos.php');
  include_once('../SubTipoInforme.php');
  include_once('../maestro.php');


//buscar datos de categorias disponibles para referente
//*****************************************************
  if (isset($_POST['tipoReferente'])) {
      $arrayPrincipal=array();
      $permiso =  new TipoPermisos(null,null,$_POST['tipoReferente']);
      $buscarCategorias = $permiso->buscar();

      while ($fila = mysqli_fetch_object($buscarCategorias)) {
        $item=array();
            $item=['tipoInformeId' => $fila->tipoId,
                   'nombre' => $fila->nombre
                 ];

        array_push($arrayPrincipal,$item);
      }
      $json = json_encode($arrayPrincipal);
      echo $json;
    }

    if (isset($_POST['idCategoria'])) {
        $arrayPrincipal=array();
        $subCategoria =  new SubTipoInforme(null,$_POST['idCategoria']);
        $buscarSubCategorias = $subCategoria->buscar();

        while ($fila = mysqli_fetch_object($buscarSubCategorias)) {
          $item=array();
              $item=['subTipoId' => $fila->subTipoId,
                     'nombre' => $fila->nombre
                   ];

          array_push($arrayPrincipal,$item);
        }
        $json = json_encode($arrayPrincipal);
        echo $json;
      }

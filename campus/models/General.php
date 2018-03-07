<?php
require_once "conexion.php";
class General extends Conexion {
  public function grafico($tipo,$dato,$canvasId){
    $graficoDibujado = '<script type="text/javascript">
    var ctx = document.getElementById("'.$canvasId.'").getContext("2d");';
    $valor=0;

    foreach($dato as $fila)
    {
      $graficoDibujado.='var '.preg_replace("[\s+]","", $fila[0]).$valor.'='.$fila[1].';';
      $valor++;
    }
    $graficoDibujado.='var myChart = new Chart(ctx, {
      type: "'.$tipo.'",
      data: {';
        $graficoDibujado.='
        labels: [';
        $valor=0;
        foreach($dato as $fila)
        {
          $graficoDibujado.='"'.$fila[0].'",';
          //echo 'alert ('.$fila[0].');';
          $valor++;
        }
        $graficoDibujado=trim($graficoDibujado, ',');
        $graficoDibujado.='],
        datasets: [{';
          if($tipo=="bar"){
            $graficoDibujado.='label: "Colegio Secundario 5159",';
          }
            $graficoDibujado.='
            backgroundColor: [
              "#2ecc71",
              "#3498db",
              "#95a5a6",
              "#9b59b6",
              "#f1c40f",
              "#e74c3c",
              "#34495e"
            ],';

          $graficoDibujado.='data: [';
          $valor=0;
          foreach($dato as $fila)
          {
            $graficoDibujado.=preg_replace("[\s+]","", $fila[0]).$valor.'='.$fila[1].',';
            $valor++;
          }
          $graficoDibujado=trim($graficoDibujado, ',');
          $graficoDibujado.=']
        }]
      },
      options:   {
      pieceLabel: {
        mode: "percentage",
      }
      }
    });
    </script>';
    return $graficoDibujado;
  }
  public static function camposet($campo,$tabla){

    $conexion = new Conexion();
    $stmt = $conexion->prepare("SHOW COLUMNS FROM $tabla LIKE '$campo'");
    $stmt->execute();

    $result = $stmt->fetchAll();
    $result=$result[0]["Type"];
    $result=substr($result, 5, strlen($result)-5);
    $result=substr($result, 0, strlen($result)-2);
    $result = explode("','",$result);
    return $result;
  }
}

 ?>

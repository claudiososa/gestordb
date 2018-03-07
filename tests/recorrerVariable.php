<?php $strOtros='';
for ($i=0; $i < 5; $i++) {
  echo $i;
  $valor = substr("ssnns",$i,1);
  echo $valor;
  if($valor=='s'){
    //var_dump($valor);
    if ($i==0) {
      $strOtros.='Televisor ';
    }elseif ($i==1) {
      $strOtros.='Cañon ';
    }elseif ($i==2) {
      $strOtros.='Reproductor CD/DVD ';
    }elseif ($i==3) {
      $strOtros.='Impresora ';
    }elseif ($i==4) {
      $strOtros.='Otros ';
    }
    switch ($i) {
      case 0:

        break;
      case 1:

          break;
      case 2:

            break;
      case 3:

          break;
      case 4:

              break;
      default:
        # code...
        break;
    }
  }
}
echo $strOtros;
 ?>

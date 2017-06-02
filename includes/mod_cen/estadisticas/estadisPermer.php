<script type="text/javascript" src="includes/mod_cen/estadisticas/Chart.min.js"></script>
<script type="text/javascript" src="includes/mod_cen/estadisticas/Chart.PieceLabel.js-master/build/Chart.PieceLabel.min.js"></script>
<!--
<script type="text/javascript" src="includes/mod_cen/estadisticas/jspdf.min.js"></script>-->
<link rel="stylesheet" type="text/css" >
<style type="text/css">
a {
    color: #ffffff;
    text-decoration: none;
}
a:hover, a:focus {
    color: #ffffff;
    text-decoration: underline;
}
scaffolding.less:52
a {
    color: #ffffff;
    text-decoration: none;
}
</style>

<?php
include_once 'includes/mod_cen/clases/RelevamientoElectrico.php';

$conectividad = new RelevamientoElectrico();
/**
 * Buscando instituciones con Conectividad a internet
 */
 $conexion = array(
 array("Si", 0),
 array("No", 0)
 );
$conectividad->conectividad='Si';
$conexion[0][1]= $conectividad->buscar('cantidad');
$conectividad->conectividad='No';
$conexion[1][1]= $conectividad->buscar('cantidad');
$conectividad->conectividad=NULL;
//***************************************************************

/**
 * Buscando instituciones con Albergue o internado
 */
 $internado = array(
 array("Si", 0),
                           array("No", 0)
 );
$conectividad->internado='Si';
$internado[0][1]= $conectividad->buscar('cantidad');
$conectividad->internado='No';
$internado[1][1]= $conectividad->buscar('cantidad');
$conectividad->internado=NULL;
//***************************************************************


/**
* Buscando instituciones con Energia Electrica
*/
$energia = array(
array("Si", 0),
array("No", 0)
);
$conectividad->energia='Si';
$energia[0][1]= $conectividad->buscar('cantidad');
$conectividad->energia='No';
$energia[1][1]= $conectividad->buscar('cantidad');
$conectividad->energia=NULL;

/**
* Buscando instituciones con Heladera
*/
$heladera= array(
                  array('Si',0),
                  array('No',0)
                );
$conectividad->heladera='Si';
$heladera[0][1]=$conectividad->buscar('cantidad');
$conectividad->heladera='No';
$heladera[1][1]=$conectividad->buscar('cantidad');
$conectividad->heladera=NULL;

/**
* Buscando instituciones con Suficiente Energia
*/
$suficienteEnergia= array(
                  array('Si',0),
                  array('No',0)
                );
$conectividad->suficienteEnergia='Si';
$suficienteEnergia[0][1]=$conectividad->buscar('cantidad');
$conectividad->suficienteEnergia='No';
$suficienteEnergia[1][1]=$conectividad->buscar('cantidad');
$conectividad->suficienteEnergia=NULL;


/**
* Buscando instituciones con Calefon
*/
$calefon= array(
                  array('No',0),
                  array('Si (es a Gas)',0),
                  array('Si (es con energía Solar)',0)
                );
$conectividad->calefon='No';
$calefon[0][1]=$conectividad->buscar('cantidad');
$conectividad->calefon='Si (es a Gas)';
$calefon[1][1]=$conectividad->buscar('cantidad');
$conectividad->calefon='Si (es con energía Solar)';
$calefon[2][1]=$conectividad->buscar('cantidad');
$conectividad->calefon=NULL;

/**
* Buscando otros artefactos
*/
//$conectividad->suficienteEnergia='Si';
$buscarOtros = $conectividad->buscar();
$cantInstituciones=mysqli_num_rows($buscarOtros);
$otrosA=['televisor'=>0,'canon'=>0,'reproductor'=>0,'impresora'=>0,'otro'=>0];
while ($fila=mysqli_fetch_object($buscarOtros)) {
  if(substr($fila->otros,0,1)=='s'){
    $otrosA['televisor']=$otrosA['televisor']+1;
  }
  if(substr($fila->otros,1,1)=='s'){
    $otrosA['canon']=$otrosA['canon']+1;
  }
  if(substr($fila->otros,2,1)=='s'){
    $otrosA['reproductor']=$otrosA['reproductor']+1;
  }
  if(substr($fila->otros,3,1)=='s'){
    $otrosA['impresora']=$otrosA['impresora']+1;
  }
  if(substr($fila->otros,4,1)=='s'){
    $otrosA['otro']=$otrosA['otro']+1;
  }

}

/**
* Buscando instituciones con Calefon Solar
*/
$necesitaCalefonSolar= array(
                  array('Si',0),
                  array('No',0)
                );
$conectividad->necesitaCalefonSolar='Si';
$necesitaCalefonSolar[0][1]=$conectividad->buscar('cantidad');
$conectividad->necesitaCalefonSolar='No';
$necesitaCalefonSolar[1][1]=$conectividad->buscar('cantidad');
$conectividad->necesitaCalefonSolar=NULL;

/*
$conectividad->necesitaCalefonSolar='Si';
$buscarSi = $conectividad->buscar();
$SolarSi=mysqli_num_rows($buscarSi);

$conectividad->necesitaCalefonSolar='No';
$buscarNo = $conectividad->buscar();
$SolarNo=mysqli_num_rows($buscarNo);
$conectividad->necesitaCalefonSolar=NULL;

/**
* Buscando instituciones con Bombeo de Agua
*/
$necesitaBombeoAgua= array(
                  array('Si',0),
                  array('No',0)
                );
$conectividad->necesitaBombeoAgua='Si';
$necesitaBombeoAgua[0][1]=$conectividad->buscar('cantidad');
$conectividad->necesitaBombeoAgua='No';
$necesitaBombeoAgua[1][1]=$conectividad->buscar('cantidad');
$conectividad->necesitaBombeoAgua=NULL;
/*
$conectividad->necesitaBombeoAgua='Si';
$buscarSi = $conectividad->buscar();
$bombeoSi=mysqli_num_rows($buscarSi);

$conectividad->necesitaBombeoAgua='No';
$buscarNo = $conectividad->buscar();
$bombeoNo=mysqli_num_rows($buscarNo);
$conectividad->necesitaBombeoAgua=NULL;

/**
* Buscando instituciones comoFunciona
*/
$comoFunciona= array(
                  array('Muy bien',0),
                  array('Bien',0),
                  array('Regular',0),
                  array('Mal',0)
                );
$conectividad->comoFunciona='Muy bien';
$comoFunciona[0][1]=$conectividad->buscar('cantidad');
$conectividad->comoFunciona='Bien';
$comoFunciona[1][1]=$conectividad->buscar('cantidad');
$conectividad->comoFunciona='Regular';
$comoFunciona[2][1]=$conectividad->buscar('cantidad');
$conectividad->comoFunciona='Mal';
$comoFunciona[3][1]=$conectividad->buscar('cantidad');
$conectividad->comoFunciona=NULL;


/**
* Buscando instituciones tipo de Instalacion
*/
$tipoInstalacion= array(
                  array('RE (Red Eléctrica)',0),
                  array('GE (Grupo Electrógeno)',0),
                  array('PS (Panel Solar)',0),
                  array('E (Eólico)',0),
                  array('GH (Generador Hidráulico)',0),
                  array('O (otro)',0)
                );
$conectividad->tipoInstalacion='RE (Red Eléctrica)';
$tipoInstalacion[0][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion='GE (Grupo Electrógeno)';
$tipoInstalacion[1][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion='PS (Panel Solar)';
$tipoInstalacion[2][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion='E (Eólico)';
$tipoInstalacion[3][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion='GH (Generador Hidráulico)';
$tipoInstalacion[4][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion='O (otro)';
$tipoInstalacion[5][1]=$conectividad->buscar('cantidad');
$conectividad->tipoInstalacion=NULL;



/**
* Buscando tipo de conexion
*/
//$conectividad->suficienteEnergia='Si';
$buscarTipoConec = $conectividad->buscar();
$cantInstituciones=mysqli_num_rows($buscarTipoConec);
$otrasE=['claro'=>0,'arnet'=>0,'fibertel'=>0,'empresaLocal'=>0,'satelital'=>0,'otro'=>0];
while ($fila=mysqli_fetch_object($buscarTipoConec)) {
  if(substr($fila->tipoConectividad,0,1)=='s'){
    $otrasE['claro']=$otrasE['claro']+1;
  }
  if(substr($fila->tipoConectividad,1,1)=='s'){
    $otrasE['arnet']=$otrasE['arnet']+1;
  }
  if(substr($fila->tipoConectividad,2,1)=='s'){
    $otrasE['fibertel']=$otrasE['fibertel']+1;
  }
  if(substr($fila->tipoConectividad,3,1)=='s'){
    $otrasE['empresaLocal']=$otrasE['empresaLocal']+1;
  }
  if(substr($fila->tipoConectividad,4,1)=='s'){
    $otrasE['satelital']=$otrasE['satelital']+1;
  }
  if(substr($fila->tipoConectividad,5,1)=='s'){
    $otrasE['otro']=$otrasE['otro']+1;
  }
  //echo substr($fila->tipoConectividad,0,1).'<br>';
  //echo substr($fila->otros,1,1).'<br>';
  //echo substr($fila->otros,2,1).'<br>';
  //echo substr($fila->otros,3,1).'<br>';
  //echo substr($fila->otros,4,1).'<br>';

}
//echo 'arnet'.$otrasE['arnet'].'<br>';
//echo 'Canon'.$otrosA['canon'].'<br>';
//echo 'Reproducto'.$otrosA['reproductor'].'<br>';
//echo 'Impresora'.$otrosA['impresora'].'<br>';
///echo 'Otros'.$otrosA['otro'].'<br>';
//echo '<br><br>'.$otros;

//$si=40;
//$no=60;
 ?>
<div class="container">



      <div class="btn btn-default" id="botonbarra" value="Graficos">Mostrar en graficos de barra
      </div>
      <div class="btn btn-default" id="botontorta" value="Graficos" style='display:none;'>Mostrar en graficos de torta
      </div>


 <div id="torta">

<br><br>
<div class="row"><!--fila energia-->
  <div class="panel panel-primary">
    <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse1"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
    <span class="panel-title clickable"><h3 class="panel-title">ESTADÍSTICAS ENERGÉTICAS:</h3></span></a></div>
    <div id="collapse1" class="panel-collapse collapse">
    <div class="panel-body">
      <!--fila1-->
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con Energia Eléctrica: </div>
<div class="panel-body"><!--contenido de grafica instituciones con energia electrica-->
  <canvas id="energiaEId" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$energia,'energiaEId');
  ?>
</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Tipo de Instalación Eléctrica:</div>
<div class="panel-body">
<canvas id="tipoInstalacionId" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$tipoInstalacion,'tipoInstalacionId');
  ?>

</div>
  </div>

</div>

</div>
<!--fila2-->
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">¿Como funciona la Instalación Electrica?:</div>
<div class="panel-body">
<canvas id="comoFuncionaId" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$comoFunciona,'comoFuncionaId');
  ?>

</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">La Institucion: ¿Tiene suficiente energia? </div>
<div class="panel-body">
<canvas id="myChart5" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$suficienteEnergia,'myChart5');
  ?>

</div>
  </div>

</div>

</div>
    </div>
</div>
  </div>


</div><!--cierre de fila energia-->



<!--fila artefactos-->
<div class="row">
  <div class="panel panel-primary">

    <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse2"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
    <span class="panel-title clickable"><h3 class="panel-title">ESTADISTICAS DE ARTEFACTOS ELECTRICOS E INSTALADOS:</h3></span></a></div>
    <div id="collapse2" class="panel-collapse collapse">

    <div class="panel-body">
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con heladeras:</div>
<div class="panel-body">
<canvas id="myChart4" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$heladera,'myChart4');
  ?>

  </div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con televisor:</div>
<div class="panel-body">
<canvas id="myChart7" width="600" height="300"></canvas>
<?php
  $televisor=array(
                    array('Si',0),
                    array('No',0)
                  );
  $televisor[0][1]= $otrosA['televisor'];
  $televisor[1][1]=$cantInstituciones-$otrosA['televisor'];
  echo $conectividad->grafico('pie',$televisor,'myChart7');
 ?>

</div>
  </div>

</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con cañon:</div>
<div class="panel-body">
<canvas id="canonId" width="600" height="300"></canvas>
<?php
$canon=array(
                  array('Si',0),
                  array('No',0)
                );
$canon[0][1]= $otrosA['canon'];
$canon[1][1]=$cantInstituciones-$otrosA['canon'];
echo $conectividad->grafico('pie',$canon,'canonId');
?>
</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con reproductor CD/DVD:</div>
<div class="panel-body">
<canvas id="reproductorId" width="600" height="300"></canvas>
<?php
$reproductor=array(
                  array('Si',0),
                  array('No',0)
                );
$reproductor[0][1]= $otrosA['reproductor'];
$reproductor[1][1]=$cantInstituciones-$otrosA['reproductor'];
echo $conectividad->grafico('pie',$reproductor,'reproductorId');
?>
</div>
  </div>

</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con impresora:</div>
<div class="panel-body">
<canvas id="impresoraId" width="600" height="300"></canvas>
<?php
  $impresora=array(
                    array('Si',0),
                    array('No',0)
                  );
  $impresora[0][1]= $otrosA['impresora'];
  $impresora[1][1]=$cantInstituciones-$otrosA['impresora'];
  echo $conectividad->grafico('pie',$impresora,'impresoraId');
 ?>
</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">instituciones con otros artefactos electricos:</div>
<div class="panel-body">
<canvas id="otrosId" width="600" height="300"></canvas>
<?php
  $otro=array(
                    array('Si',0),
                    array('No',0)
                  );
  $otro[0][1]= $otrosA['otro'];
  $otro[1][1]=$cantInstituciones-$otrosA['otro'];
  echo $conectividad->grafico('pie',$otro,'otrosId');
 ?>

</div>
  </div>

</div>

</div>


<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con calefón:</div>
<div class="panel-body">
<canvas id="calefonId" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$calefon,'calefonId');
  ?>

</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones que necesitan Calefón Solar:</div>
<div class="panel-body">
<canvas id="solarId" width="600" height="300"></canvas>
<?php
  echo $conectividad->grafico('pie',$necesitaCalefonSolar,'solarId');
 ?>
</div>
  </div>

</div>

</div>

<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones que necesitan Bombeo de Agua:</div>
<div class="panel-body">
<canvas id="bombeoId" width="600" height="300"></canvas>
<?php
  echo $conectividad->grafico('pie',$necesitaBombeoAgua,'bombeoId');
 ?>

</div>
  </div>

</div>



</div>
    </div>

  </div>

</div>


</div>


<!--fila conectividad-->

<div class="row">
  <div class="panel panel-primary">

      <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse3"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
      <span class="panel-title clickable"><h3 class="panel-title">ESTADISTICAS DE CONECTIVIDAD:</h3></span></a></div>
      <div id="collapse3" class="panel-collapse collapse">

    <div class="panel-body">
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con conexion a internet</div>
<div class="panel-body">
<canvas id="myChart" width="600" height="300"></canvas>
<?php
    echo $conectividad->grafico('pie',$conexion,'myChart');
 ?>

</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Empresa Claro:</div>
<div class="panel-body">
<canvas id="claroId" width="600" height="300"></canvas>
<?php
$claro=array(
                  array('Si',0),
                  array('No',0)
                );
$claro[0][1]= $otrasE['claro'];
$claro[1][1]=$cantInstituciones-$otrasE['claro'];
echo $conectividad->grafico('pie',$claro,'claroId');
?>

</div>
  </div>

</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Empresa Arnet:</div>
<div class="panel-body">
<canvas id="arnetId" width="600" height="300"></canvas>
<?php
$arnet=array(
                  array('Si',0),
                  array('No',0)
                );
$arnet[0][1]= $otrasE['arnet'];
$arnet[1][1]=$cantInstituciones-$otrasE['arnet'];
echo $conectividad->grafico('pie',$arnet,'arnetId');
?>
</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Empresa Fibertel:</div>
<div class="panel-body">
<canvas id="fibertelId" width="600" height="300"></canvas>
<?php
$fibertel=array(
                  array('Si',0),
                  array('No',0)
                );
$fibertel[0][1]= $otrasE['fibertel'];
$fibertel[1][1]=$cantInstituciones-$otrasE['fibertel'];
echo $conectividad->grafico('pie',$fibertel,'fibertelId');
?>
</div>
  </div>

</div>

</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Empresa Local de Conectividad:</div>
<div class="panel-body">
<canvas id="localId" width="600" height="300"></canvas>
<?php
$empresaLocal=array(
                  array('Si',0),
                  array('No',0)
                );
$empresaLocal[0][1]= $otrasE['empresaLocal'];
$empresaLocal[1][1]=$cantInstituciones-$otrasE['empresaLocal'];
echo $conectividad->grafico('pie',$empresaLocal,'localId');
?>

</div>
  </div>

</div>

<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Conexión Satelital:</div>
<div class="panel-body">
<canvas id="satelitalId" width="600" height="300"></canvas>
<?php
$satelital=array(
                  array('Si',0),
                  array('No',0)
                );
$satelital[0][1]= $otrasE['satelital'];
$satelital[1][1]=$cantInstituciones-$otrasE['satelital'];
echo $conectividad->grafico('pie',$satelital,'satelitalId');
?>
</div>
  </div>

</div>

</div>


<div class="row">
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Otra Empresa de Conectividad:</div>
<div class="panel-body">
<canvas id="otraEmpresaId" width="600" height="300"></canvas>
<?php
$otro=array(
                  array('Si',0),
                  array('No',0)
                );
$otro[0][1]= $otrasE['otro'];
$otro[1][1]=$cantInstituciones-$otrasE['otro'];
echo $conectividad->grafico('pie',$otro,'otraEmpresaId');
?>
</div>
  </div>

</div>



</div>
  </div>
  </div>
    </div>



<div class="row">

    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse4"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
        <span class="panel-title clickable"><h3 class="panel-title">ESCUELAS CON INTERNADO O ALBERGUE:</h3></span></a></div>
        <div id="collapse4" class="panel-collapse collapse">

        <div class="panel-body">
      <canvas id="myChart2" width="600" height="150"></canvas>
      <?php
      echo $conectividad->grafico('pie',$internado,'myChart2');
      ?>

        </div>
      </div>

    </div>


</div>


</div>
  </div>
  </div>
  <!--graficos barra-->


   <div id="barra" style='display:none'>

  <br><br>
  <div class="row"><!--fila energia-->
    <div class="panel panel-primary">
      <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse1b"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
      <span class="panel-title clickable"><h3 class="panel-title">ESTADÍSTICAS ENERGÉTICAS:</h3></span></a></div>
      <div id="collapse1b" class="panel-collapse collapse">
      <div class="panel-body">
        <!--fila1-->
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con Energia Eléctrica: </div>
  <div class="panel-body"><!--contenido de grafica instituciones con energia electrica-->
    <canvas id="energiaEIdb" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$energia,'energiaEIdb');
    ?>
  </div>
    </div>

  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Tipo de Instalación Eléctrica:</div>
  <div class="panel-body">
  <canvas id="tipoInstalacionIdb" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$tipoInstalacion,'tipoInstalacionIdb');
    ?>

  </div>
    </div>

  </div>

  </div>
  <!--fila2-->
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">¿Como funciona la Instalación Electrica?:</div>
  <div class="panel-body">
  <canvas id="comoFuncionaIdb" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$comoFunciona,'comoFuncionaIdb');
    ?>

  </div>
    </div>

  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">La Institucion: ¿Tiene suficiente energia? </div>
  <div class="panel-body">
  <canvas id="myChart5b" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$suficienteEnergia,'myChart5b');
    ?>

  </div>
    </div>

  </div>

  </div>
      </div>
  </div>
    </div>


  </div><!--cierre de fila energia-->



  <!--fila artefactos-->
  <div class="row">
    <div class="panel panel-primary">

      <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse2b"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
      <span class="panel-title clickable"><h3 class="panel-title">ESTADISTICAS DE ARTEFACTOS ELECTRICOS E INSTALADOS:</h3></span></a></div>
      <div id="collapse2b" class="panel-collapse collapse">

      <div class="panel-body">
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con heladeras:</div>
  <div class="panel-body">
  <canvas id="myChart4b" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$heladera,'myChart4b');
    ?>

    </div>
    </div>

  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con televisor:</div>
  <div class="panel-body">
  <canvas id="myChart7b" width="600" height="300"></canvas>
  <?php
    $televisor=array(
                      array('Si',0),
                      array('No',0)
                    );
    $televisor[0][1]= $otrosA['televisor'];
    $televisor[1][1]=$cantInstituciones-$otrosA['televisor'];
    echo $conectividad->grafico('bar',$televisor,'myChart7b');
   ?>

  </div>
    </div>

  </div>

  </div>
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con cañon:</div>
  <div class="panel-body">
  <canvas id="canonIdb" width="600" height="300"></canvas>
  <?php
  $canon=array(
                    array('Si',0),
                    array('No',0)
                  );
  $canon[0][1]= $otrosA['canon'];
  $canon[1][1]=$cantInstituciones-$otrosA['canon'];
  echo $conectividad->grafico('bar',$canon,'canonIdb');
  ?>
  </div>
    </div>

  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con reproductor CD/DVD:</div>
  <div class="panel-body">
  <canvas id="reproductorIdb" width="600" height="300"></canvas>
  <?php
  $reproductor=array(
                    array('Si',0),
                    array('No',0)
                  );
  $reproductor[0][1]= $otrosA['reproductor'];
  $reproductor[1][1]=$cantInstituciones-$otrosA['reproductor'];
  echo $conectividad->grafico('bar',$reproductor,'reproductorIdb');
  ?>
  </div>
    </div>

  </div>

  </div>
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con impresora:</div>
  <div class="panel-body">
  <canvas id="impresoraIdb" width="600" height="300"></canvas>
  <?php
    $impresora=array(
                      array('Si',0),
                      array('No',0)
                    );
    $impresora[0][1]= $otrosA['impresora'];
    $impresora[1][1]=$cantInstituciones-$otrosA['impresora'];
    echo $conectividad->grafico('bar',$impresora,'impresoraIdb');
   ?>
  </div>
    </div>

  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">instituciones con otros artefactos electricos:</div>
  <div class="panel-body">
  <canvas id="otrosIdb" width="600" height="300"></canvas>
  <?php
    $otro=array(
                      array('Si',0),
                      array('No',0)
                    );
    $otro[0][1]= $otrosA['otro'];
    $otro[1][1]=$cantInstituciones-$otrosA['otro'];
    echo $conectividad->grafico('bar',$otro,'otrosIdb');
   ?>

  </div>
    </div>

  </div>

  </div>


  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con calefón:</div>
  <div class="panel-body">
  <canvas id="calefonIdb" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$calefon,'calefonIdb');
    ?>

  </div>
    </div>

  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones que necesitan Calefón Solar:</div>
  <div class="panel-body">
  <canvas id="solarIdb" width="600" height="300"></canvas>
  <?php
    echo $conectividad->grafico('bar',$necesitaCalefonSolar,'solarIdb');
   ?>
  </div>
    </div>

  </div>

  </div>

  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones que necesitan Bombeo de Agua:</div>
  <div class="panel-body">
  <canvas id="bombeoIdb" width="600" height="300"></canvas>
  <?php
    echo $conectividad->grafico('bar',$necesitaBombeoAgua,'bombeoIdb');
   ?>

  </div>
    </div>

  </div>



  </div>
      </div>

    </div>

  </div>


  </div>


  <!--fila conectividad-->

  <div class="row">
    <div class="panel panel-primary">

        <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse3b"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
        <span class="panel-title clickable"><h3 class="panel-title">ESTADISTICAS DE CONECTIVIDAD:</h3></span></a></div>
        <div id="collapse3b" class="panel-collapse collapse">

      <div class="panel-body">
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Instituciones con conexion a internet</div>
  <div class="panel-body">
  <canvas id="myChartb" width="600" height="300"></canvas>
  <?php
      echo $conectividad->grafico('bar',$conexion,'myChartb');
   ?>

  </div>
    </div>

  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Empresa Claro:</div>
  <div class="panel-body">
  <canvas id="claroIdb" width="600" height="300"></canvas>
  <?php
  $claro=array(
                    array('Si',0),
                    array('No',0)
                  );
  $claro[0][1]= $otrasE['claro'];
  $claro[1][1]=$cantInstituciones-$otrasE['claro'];
  echo $conectividad->grafico('bar',$claro,'claroIdb');
  ?>

  </div>
    </div>

  </div>

  </div>
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Empresa Arnet:</div>
  <div class="panel-body">
  <canvas id="arnetIdb" width="600" height="300"></canvas>
  <?php
  $arnet=array(
                    array('Si',0),
                    array('No',0)
                  );
  $arnet[0][1]= $otrasE['arnet'];
  $arnet[1][1]=$cantInstituciones-$otrasE['arnet'];
  echo $conectividad->grafico('bar',$arnet,'arnetIdb');
  ?>
  </div>
    </div>

  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Empresa Fibertel:</div>
  <div class="panel-body">
  <canvas id="fibertelIdb" width="600" height="300"></canvas>
  <?php
  $fibertel=array(
                    array('Si',0),
                    array('No',0)
                  );
  $fibertel[0][1]= $otrasE['fibertel'];
  $fibertel[1][1]=$cantInstituciones-$otrasE['fibertel'];
  echo $conectividad->grafico('pie',$fibertel,'fibertelIdb');
  ?>
  </div>
    </div>

  </div>

  </div>
  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Empresa Local de Conectividad:</div>
  <div class="panel-body">
  <canvas id="localIdb" width="600" height="300"></canvas>
  <?php
  $empresaLocal=array(
                    array('Si',0),
                    array('No',0)
                  );
  $empresaLocal[0][1]= $otrasE['empresaLocal'];
  $empresaLocal[1][1]=$cantInstituciones-$otrasE['empresaLocal'];
  echo $conectividad->grafico('bar',$empresaLocal,'localIdb');
  ?>

  </div>
    </div>

  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Conexión Satelital:</div>
  <div class="panel-body">
  <canvas id="satelitalIdb" width="600" height="300"></canvas>
  <?php
  $satelital=array(
                    array('Si',0),
                    array('No',0)
                  );
  $satelital[0][1]= $otrasE['satelital'];
  $satelital[1][1]=$cantInstituciones-$otrasE['satelital'];
  echo $conectividad->grafico('bar',$satelital,'satelitalIdb');
  ?>
  </div>
    </div>

  </div>

  </div>


  <div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Otra Empresa de Conectividad:</div>
  <div class="panel-body">
  <canvas id="otraEmpresaIdb" width="600" height="300"></canvas>
  <?php
  $otro=array(
                    array('Si',0),
                    array('No',0)
                  );
  $otro[0][1]= $otrasE['otro'];
  $otro[1][1]=$cantInstituciones-$otrasE['otro'];
  echo $conectividad->grafico('bar',$otro,'otraEmpresaIdb');
  ?>
  </div>
    </div>

  </div>



  </div>
    </div>
    </div>
      </div>



  <div class="row">

      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading" align="center"><a data-toggle="collapse" href="#collapse4b"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
          <span class="panel-title clickable"><h3 class="panel-title">ESCUELAS CON INTERNADO O ALBERGUE:</h3></span></a></div>
          <div id="collapse4b" class="panel-collapse collapse">

          <div class="panel-body">
        <canvas id="myChart2b" width="600" height="150"></canvas>
        <?php
        echo $conectividad->grafico('bar',$internado,'myChart2b');
        ?>

          </div>
        </div>

      </div>


  </div>


  </div>
    </div>
    <!-- codigo ejemplo de estadisticas barra-->
    <div class="container">
      <canvas id="myChartbarra" width="400" height="150"></canvas>
      <script>
      var ctx = document.getElementById("myChartbarra");
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
              datasets: [{
                  label: '# of Votes',
                  data: [12, 19, 3, 5, 2, 3],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255,99,132,1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
      </script>
    </div>
  <!--fin de codigo ejemplo-->

    </div>

</div>
<script type="text/javascript" src="includes/mod_cen/estadisticas/botongrafico.js"></script>

<!--<script type="text/javascript" src="includes/mod_cen/estadisticas/scriptestadistica.js"></script>
<script type="text/javascript" src="includes/mod_cen/estadisticas/estadisticabarra.js">
</script>-->

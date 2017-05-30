
<script type="text/javascript" src="includes/mod_cen/estadisticas/Chart.min.js"></script>
<script type="text/javascript" src="includes/mod_cen/estadisticas/Chart.PieceLabel.js-master/build/Chart.PieceLabel.min.js"></script>
<?php
include_once 'includes/mod_cen/clases/RelevamientoElectrico.php';

/**
 * Buscando instituciones con Conectividad a internet
 */
$conectividad = new RelevamientoElectrico();
$conectividad->conectividad='Si';
$buscarSi = $conectividad->buscar();
$si=mysqli_num_rows($buscarSi);

$conectividad->conectividad='No';
$buscarNo = $conectividad->buscar();
$no=mysqli_num_rows($buscarNo);
$conectividad->conectividad=NULL;
//***************************************************************

/**
 * Buscando instituciones con Albergue o internado
 */

$conectividad->internado='Si';
$buscarSi = $conectividad->buscar();
$InternadoSi=mysqli_num_rows($buscarSi);

$conectividad->internado='No';
$buscarNo = $conectividad->buscar();
$InternadoNo=mysqli_num_rows($buscarNo);
$conectividad->internado=NULL;
//***************************************************************


/**
* Buscando instituciones con Energia Electrica
*/

$conectividad->energia='Si';
$buscarSi = $conectividad->buscar();
$EnergiaSi=mysqli_num_rows($buscarSi);

$conectividad->energia='No';
$buscarNo = $conectividad->buscar();
$EnergiaNo=mysqli_num_rows($buscarNo);
$conectividad->energia=NULL;

/**
* Buscando instituciones con Heladera
*/

$conectividad->heladera='Si';
$buscarSi = $conectividad->buscar();
$HeladeraSi=mysqli_num_rows($buscarSi);

$conectividad->heladera='No';
$buscarNo = $conectividad->buscar();
$HeladeraNo=mysqli_num_rows($buscarNo);
$conectividad->heladera=NULL;

/**
* Buscando instituciones con Suficiente Energia
*/
$conectividad->suficienteEnergia='Si';
$buscarSi = $conectividad->buscar();
$suficienteEnergiaSi=mysqli_num_rows($buscarSi);

$conectividad->suficienteEnergia='No';
$buscarNo = $conectividad->buscar();
$suficienteEnergiaNo=mysqli_num_rows($buscarNo);
$conectividad->suficienteEnergia=NULL;

/**
* Buscando instituciones con Calefon
*/
$conectividad->calefon='No';
$buscarNo = $conectividad->buscar();
$calefonNo=mysqli_num_rows($buscarNo);

$conectividad->calefon='Si (es a Gas)';
$buscarSiGas = $conectividad->buscar();
$calefonSiGas=mysqli_num_rows($buscarSiGas);

$conectividad->calefon='Si (es con energía Solar)';
$buscarSiSolar = $conectividad->buscar();
$calefonSiSolar=mysqli_num_rows($buscarSiSolar);


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
  //echo substr($fila->otros,0,1).'<br>';
  //echo substr($fila->otros,1,1).'<br>';
  //echo substr($fila->otros,2,1).'<br>';
  //echo substr($fila->otros,3,1).'<br>';
  //echo substr($fila->otros,4,1).'<br>';

}
//echo 'Televisor'.$otrosA['televisor'].'<br>';
//echo 'Canon'.$otrosA['canon'].'<br>';
//echo 'Reproducto'.$otrosA['reproductor'].'<br>';
//echo 'Impresora'.$otrosA['impresora'].'<br>';
///echo 'Otros'.$otrosA['otro'].'<br>';
//echo '<br><br>'.$otros;



//$si=40;
//$no=60;
 ?>


      <div class="btn btn-default" id="botonbarra" value="Graficos">Mostrar en graficos de barra
      </div>
      <div class="btn btn-default" id="botontorta" value="Graficos" style='display:none;'>Mostrar en graficos de torta
      </div>


 <div id="torta">

<br><br>
      <div class="row">
          <div class="col-md-6">
            <div class="panel panel-primary">
              <div class="panel-heading">Escuelas con Conexion a Internet:</div>
              <div class="panel-body">
            <canvas id="myChart" width="600" height="300"></canvas>

            <script type="text/javascript">
            var ctx = document.getElementById("myChart").getContext('2d');
            var si=<?php echo $si ?>;
            var no=<?php echo $no ?>;
            var myChart = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: ["SI", "NO"],
                datasets: [{
                  backgroundColor: [
                    "#2ecc71",
                    "#3498db",
                    "#95a5a6",
                    "#9b59b6",
                    "#f1c40f",
                    "#e74c3c",
                    "#34495e"
                  ],
                  data: [si, no]
                }]


              },
              options:   {
              pieceLabel: {
                mode: 'percentage',
              }
              }
            });
            </script>

              </div>
            </div>

          </div>
<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Conexion Internet</div>
    <div class="panel-body">
  <canvas id="myChart1" width="600" height="300"></canvas>
    </div>
  </div>

</div>
  </div>



<div class="row">

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Escuelas con Albergue o Internado:</div>
      <div class="panel-body">
    <canvas id="myChart2" width="600" height="300"></canvas>

    <script type="text/javascript">
    var ctx = document.getElementById("myChart2").getContext('2d');
    var si=<?php echo $InternadoSi ?>;
    var no=<?php echo $InternadoNo ?>;
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["SI", "NO"],
        datasets: [{
          backgroundColor: [
            "#2ecc71",
            "#3498db",
            "#95a5a6",
            "#9b59b6",
            "#f1c40f",
            "#e74c3c",
            "#34495e"
          ],
          data: [si, no]
        }]


      },
      options:   {
      pieceLabel: {
        mode: 'percentage',
      }
      }
    });
    </script>

      </div>
    </div>

  </div>


<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Escuelas con Energía Eléctrica:</div>
    <div class="panel-body">
  <canvas id="myChart3" width="600" height="300"></canvas>

  <script type="text/javascript">
  var ctx = document.getElementById("myChart3").getContext('2d');
  var si=<?php echo $EnergiaSi ?>;
  var no=<?php echo $EnergiaNo ?>;
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["SI", "NO"],
      datasets: [{
        backgroundColor: [
          "#2ecc71",
          "#3498db",
          "#95a5a6",
          "#9b59b6",
          "#f1c40f",
          "#e74c3c",
          "#34495e"
        ],
        data: [si, no]
      }]


    },
    options:   {
    pieceLabel: {
      mode: 'percentage',
    }
    }
  });
  </script>

    </div>
  </div>

</div>

</div>
<div class="row">

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Escuelas con Heladera:</div>
      <div class="panel-body">
    <canvas id="myChart4" width="600" height="300"></canvas>

    <script type="text/javascript">
    var ctx = document.getElementById("myChart4").getContext('2d');
    var si=<?php echo $HeladeraSi ?>;
    var no=<?php echo $HeladeraNo ?>;
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["SI", "NO"],
        datasets: [{
          backgroundColor: [
            "#2ecc71",
            "#3498db",
            "#95a5a6",
            "#9b59b6",
            "#f1c40f",
            "#e74c3c",
            "#34495e"
          ],
          data: [si, no]
        }]


      },
      options:   {
      pieceLabel: {
        mode: 'percentage',
      }
      }
    });
    </script>

      </div>
    </div>

  </div>


<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">La institucion: ¿Tiene Suficiente Energía?</div>
    <div class="panel-body">
  <canvas id="myChart5" width="600" height="300"></canvas>

  <script type="text/javascript">
  var ctx = document.getElementById("myChart5").getContext('2d');
  var si=<?php echo $suficienteEnergiaSi ?>;
  var no=<?php echo $suficienteEnergiaNo ?>;
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["SI", "NO"],
      datasets: [{
        backgroundColor: [
          "#2ecc71",
          "#3498db",
          "#95a5a6",
          "#9b59b6",
          "#f1c40f",
          "#e74c3c",
          "#34495e"
        ],
        data: [si, no]
      }]


    },
    options:   {
    pieceLabel: {
      mode: 'percentage',
    }
    }
  });
  </script>

    </div>
  </div>

</div>

</div>
<div class="row">

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">La institucion: ¿Cuenta con calefón?</div>
      <div class="panel-body">
    <canvas id="myChart6" width="600" height="300"></canvas>

    <script type="text/javascript">
    var ctx = document.getElementById("myChart6").getContext('2d');
    var no=<?php echo $calefonNo ?>;
    var siGas=<?php echo $calefonSiGas ?>;
    var siSolar=<?php echo $calefonSiSolar ?>;
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["NO", "Si a Gas", "Si con Energia Solar"],
        datasets: [{
          backgroundColor: [
            "#2ecc71",
            "#3498db",
            "#95a5a6",
            "#9b59b6",
            "#f1c40f",
            "#e74c3c",
            "#34495e"
          ],
          data: [no, siGas, siSolar],
        }]


      },
      options:   {
      pieceLabel: {
        mode: 'percentage',
      }
      }
    });
    </script>

      </div>
    </div>

  </div>


<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Escuelas con Televisor:</div>
    <div class="panel-body">
  <canvas id="myChart7" width="600" height="300"></canvas>

  <script type="text/javascript">
  var ctx = document.getElementById("myChart7").getContext('2d');
  var si=<?php echo $otrosA['televisor'] ?>;
  var no=<?php echo $cantInstituciones-$otrosA['televisor'] ?>;
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["SI", "NO"],
      datasets: [{
        backgroundColor: [
          "#2ecc71",
          "#3498db",
          "#95a5a6",
          "#9b59b6",
          "#f1c40f",
          "#e74c3c",
          "#34495e"
        ],
        data: [si, no]
      }]


    },
    options:   {
    pieceLabel: {
      mode: 'percentage',
    }
    }
  });
  </script>

    </div>
  </div>

</div>

</div>
<div class="row">

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Escuelas con Albergue o Internado:</div>
      <div class="panel-body">
    <canvas id="myChart2" width="600" height="300"></canvas>

    <script type="text/javascript">
    var ctx = document.getElementById("myChart2").getContext('2d');
    var si=<?php echo $InternadoSi ?>;
    var no=<?php echo $InternadoNo ?>;
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["SI", "NO"],
        datasets: [{
          backgroundColor: [
            "#2ecc71",
            "#3498db",
            "#95a5a6",
            "#9b59b6",
            "#f1c40f",
            "#e74c3c",
            "#34495e"
          ],
          data: [si, no]
        }]


      },
      options:   {
      pieceLabel: {
        mode: 'percentage',
      }
      }
    });
    </script>

      </div>
    </div>

  </div>


<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Escuelas con Energía Eléctrica:</div>
    <div class="panel-body">
  <canvas id="myChart3" width="600" height="300"></canvas>

  <script type="text/javascript">
  var ctx = document.getElementById("myChart3").getContext('2d');
  var si=<?php echo $EnergiaSi ?>;
  var no=<?php echo $EnergiaNo ?>;
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["SI", "NO"],
      datasets: [{
        backgroundColor: [
          "#2ecc71",
          "#3498db",
          "#95a5a6",
          "#9b59b6",
          "#f1c40f",
          "#e74c3c",
          "#34495e"
        ],
        data: [si, no]
      }]


    },
    options:   {
    pieceLabel: {
      mode: 'percentage',
    }
    }
  });
  </script>

    </div>
  </div>

</div>

</div>
</div>

<div id="barra" style='display:none;'>

<br><br>
  <div class="row">
      <div class="col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">Instituciones con albergues:</div>
          <div class="panel-body">
        <canvas id="barra1"></canvas>
<br><br>
          </div>
        </div>

      </div>
<div class="col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">Conexion Internet</div>
<div class="panel-body">
<canvas id="barra2" width="600" height="300"></canvas>
</div>
</div>

</div>
</div>



<div class="row">

<div class="col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">Instituciones con heladeras</div>
<div class="panel-body">
<canvas id="barra3" width="600" height="300"></canvas>
</div>
</div>

</div>


<div class="col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">Instituciones con calefon</div>
<div class="panel-body">
<canvas id="barra4" width="600" height="300"></canvas>
</div>

</div>
</div>

</div>
</div>
</div>
<script type="text/javascript" src="includes/mod_cen/estadisticas/botongrafico.js"></script>
<!--<script type="text/javascript" src="includes/mod_cen/estadisticas/scriptestadistica.js"></script>-->
<script type="text/javascript" src="includes/mod_cen/estadisticas/estadisticabarra.js">
</script>

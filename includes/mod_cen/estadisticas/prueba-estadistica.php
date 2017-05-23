
<script type="text/javascript" src="includes/mod_cen/estadisticas/Chart.min.js"></script>
<script type="text/javascript" src="includes/mod_cen/estadisticas/Chart.PieceLabel.js-master/build/Chart.PieceLabel.min.js"></script>
<?php
include_once 'includes/mod_cen/clases/RelevamientoElectrico.php';
$conectividad = new RelevamientoElectrico();
$conectividad->conectividad='Si';
$buscarSi = $conectividad->buscar();
$si=mysqli_num_rows($buscarSi);


$conectividad->conectividad='No';

$buscarNo = $conectividad->buscar();
$no=mysqli_num_rows($buscarNo);

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
              <div class="panel-heading">Instituciones con albergues:</div>
              <div class="panel-body">
            <canvas id="myChart" width="600" height="300"></canvas>

            <script type="text/javascript">
            var ctx = document.getElementById("myChart").getContext('2d');
            var si=<?php echo $si ?>;
            var no=<?php echo $no ?>;
            var myChart = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: ["si", "no"],
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
    <div class="panel-heading">Instituciones con heladeras</div>
    <div class="panel-body">
  <canvas id="myChart2" width="600" height="300"></canvas>
    </div>
  </div>

</div>


<div class="col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Instituciones con calefon</div>
    <div class="panel-body">
    <canvas id="myChart3" width="600" height="300"></canvas>
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
<script type="text/javascript" src="includes/mod_cen/estadisticas/scriptestadistica.js"></script>
<script type="text/javascript" src="includes/mod_cen/estadisticas/estadisticabarra.js">
</script>

<?php
   include_once("includes/mod_cen/clases/RelevamientoElectrico.php");
   include_once("includes/mod_cen/clases/referente.php");
   include_once("includes/mod_cen/clases/escuela.php");
  $objReleva = new RelevamientoElectrico();
  $buscar = $objReleva->buscar('todos');
  $cantidad=mysqli_num_rows($buscar);

  ?>
  <div class="container">
    <?php echo '<p class="alert alert-success">Cantidad de Instituciones : '.$cantidad.'</p>'; ?>

  <div class="table-responsive">
  <table id="Relevamiento Escuelas Sedes" class='table table-striped table-bordered  table-condensed'>
    <thead>
      <tr>
        <th>Provincia</th>
        <th>Localidad</th>
        <th>Cue</th>
        <th>N colegio</th>
        <th>Nombre</th>
        <th>Domicilio</th>
        <th>Telefono</th>
        <th>Otro Cue</th>
        <th>Internado</th>
        <th>Cargos</th>
        <th>Matricula</th>
        <th>Coordinador provincial EDUC.AR</th>
        <th>Referente Colegio</th>
        <th>Telefono Referente</th>
        <th>Email Referente</th>
        <th>Tiene Energia</th>
        <th>Tipo de Instalacion</th>
        <th>Como funciona</th>
        <th>Cantidad Aulas</th>
        <th>Cantidad Pc Instalada</th>
        <th>Tiene Heladera</th>
        <th>Otro artefactos</th>
        <th>Suficiente Energia</th>
        <th>Tiene calefon</th>
        <th>Necesita calefon solar</th>
        <th>Necesita Bombeo de Agua</th>
        <th>Conectividad</th>
        <th>Tipo de Conectividad</th>
        <th>Comentario</th>
      </tr>
    </thead>
    <tbody>

  <?php

  while ($row  = mysqli_fetch_object($buscar)) {
    $objReferente = new Referente($row->referenteId);
    $buscarReferente = $objReferente->buscar();
    $datoReferente = mysqli_fetch_object($buscarReferente);

    $cantidad++;
    //var_dump($row);
    echo '<tr>';
    //echo '<td>'.$cantidad.'</td>';
    echo '<td>Salta</td>';
    echo '<td>'.$row->localidad.'</td>';
    echo '<td>'.$row->cue.'</td>';
    echo '<td>'.$row->numero.'</td>';

    $esNumero = substr(trim($row->nombre),strlen(trim($row->nombre))-1,1);
    if(ctype_digit($esNumero)){
      $nombre = $row->nombre.' Salta';
    }else if(!ctype_alpha($esNumero)){
      $nombre = $row->nombre.' Salta';
    }else{
      $nombre = $row->nombre;
    }
    echo '<td>'.$nombre.'</td>';
    $esNumero = substr(trim($row->domicilio),strlen(trim($row->domicilio))-1,1);
    if(ctype_digit($esNumero)){
      $domicilio = $row->domicilio.' Salta';
    }else if(!ctype_alpha($esNumero)){
      $domicilio = $row->domicilio.' Salta';
    }else{
      $domicilio = $row->domicilio;
    }
    echo '<td>'.$domicilio.'</td>';
    echo '<td>'.$row->telefono.'</td>';
    echo '<td>'.$row->otroCue.'</td>';
    echo '<td>'.$row->internado.'</td>';
    echo '<td>'.$row->totalCargos.'</td>';
    echo '<td>'.$row->matricula.'</td>';
    echo '<td>Cristian Javier Ortin</td>';
    echo '<td>'.$datoReferente->apellido.','.$datoReferente->nombre.'</td>';
    echo '<td>'.$datoReferente->telefonoC.' - '.$datoReferente->telefonoM.'</td>';
    echo '<td>'.$datoReferente->email.'</td>';
    echo '<td>'.$row->energia.'</td>';
    echo '<td>'.$row->tipoInstalacion.'</td>';
    echo '<td>'.$row->comoFunciona.'</td>';
    echo '<td>'.$row->cantidadAulas.'</td>';
    echo '<td>'.$row->cantidadPcInstaladas.'</td>';
    echo '<td>'.$row->heladera.'</td>';
    $strOtros='';
    if ($row->otros<>'') {
      # code...

    for ($i=0; $i < 5; $i++) {


      //echo $valor;
      if(substr($row->otros,$i,1)=='s'){

        switch ($i) {
          case 0:
            $strOtros.='Televisor ';
            break;
          case 1:
            $strOtros.='Cañon ';
              break;
          case 2:
              $strOtros.='Reproductor CD/DVD ';
                break;
          case 3:
                $strOtros.='Impresora ';
              break;
          case 4:
                $strOtros.='Otros ';
                  break;
          default:
            # code...
            break;
        }
      }
    }
    }
    //var_dump($arrayOtros);

    echo '<td>'.$strOtros.'</td>';
    echo '<td>'.$row->suficienteEnergia.'</td>';
    echo '<td>'.$row->calefon.'</td>';
    echo '<td>'.$row->necesitaCalefonSolar.'</td>';
    echo '<td>'.$row->necesitaBombeoAgua.'</td>';
    echo '<td>'.$row->conectividad.'</td>';
    $strOtros='';
    if ($row->tipoConectividad<>'') {
      # code...

    for ($i=0; $i < 6; $i++) {


      //echo $valor;
      if(substr($row->tipoConectividad,$i,1)=='s'){

        switch ($i) {
          case 0:
            $strOtros.='Claro ';
            break;
          case 1:
            $strOtros.='Arnet ';
              break;
          case 2:
              $strOtros.='Fibertel ';
                break;
          case 3:
                $strOtros.='Empresa Local ';
              break;
          case 4:
                $strOtros.='Satelital ';
                  break;
          case 5:
                $strOtros.='Otro ';
                    break;
          default:
            # code...
            break;
        }
      }
    }
    }
    echo '<td>'.$strOtros.'</td>';
    echo '<td>'.$row->comentario.'</td>';
    echo '</tr>';
  }
?>
</tbody>
</table>
</div>
</div>

<script type="text/javascript">
  new TableExport(document.getElementsByTagName("table"), {
                               // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
    formats: ['xls'],             // (String[]), filetype(s) for the export, (default: ['xls', 'csv', 'txt'])
    bootstrap: true,
	});


</script>

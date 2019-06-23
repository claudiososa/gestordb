<?php 
include_once('includes/mod_cen/clases/escuela.php');
include_once('includes/mod_cen/clases/Conectividad.class.php');

$escuelas = new Escuela();
$resultado = $escuelas->buscar_conectividad();

?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="alert alert-info">Listado de Escuelas Conectividad </div>            
        <table class="table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Número</th>
                    <th>CUE</th>
                    <th>Nombre</th>
                    <th>Pc Escritorio</th>
                    <th>Cant. RTI</th>
                    <th>Conectividad</th>
                    <th>PNCE</th>
                    <th>Salta Conectada</th>
                    <th>Particular</th>
                    <th>Referente</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cant = 0;
                $conectividad = new Conectividad();

             

                while ($row = mysqli_fetch_object($resultado)) {
                    $tipo_conect = [
                        'pnce' => 'FALTA REGISTRAR',
                        'salta_conectada' => 'FALTA REGISTRAR',
                        'particular' => 'FALTA REGISTRAR'
                    ];
                    
                    $conectividad->escuela_id = $row->escuelaId;

                    $tipo_conectividad =$conectividad->buscar();

                    if ($row->conectividad =='NO') {
                        $tipo_conect['pnce'] = 'NO';                           
                        $tipo_conect['salta_conectada'] = 'NO';                           
                        $tipo_conect['particular'] = 'NO';                           
                    } else if($row->conectividad=='SI') {
                        $tipo_conect['pnce'] = 'NO';                           
                        $tipo_conect['salta_conectada'] = 'NO';                           
                        $tipo_conect['particular'] = 'NO';                           

                        while ($tipo = mysqli_fetch_object($tipo_conectividad)) {

                            switch ($tipo->conectividad_servicio_id) {
                                case 1:
                                    $tipo_conect['pnce'] = 'SI';
                                    break;
                                case 2:
                                    $tipo_conect['salta_conectada'] = 'SI';
                                    break;
                                case 3:
                                    $tipo_conect['particular'] = 'SI';
                                    break;
                                default:
                                    # code...
                                    break;
                            }                           
                        }
                    }
                    

               

                    if( ($row->numero > 2999 && $row->numero < 3999) || ($row->numero > 4999 && $row->numero < 5999) ){
                        $cant++;
                        if ($row->conectividad =='SI') {
                            # code...
                        }

                        echo "<tr>
                                <td>$cant</td>
                                <td>$row->numero</td>
                                <td>$row->cue</td>
                                <td>$row->nombre_escuela</td>
                                <td>$row->pc_escritorio</td>
                                <td>$row->rti</td>
                                <td>$row->conectividad</td>
                                <td>".$tipo_conect['pnce']."</td>
                                <td>".$tipo_conect['salta_conectada']."</td>                                
                                <td>".$tipo_conect['particular']."</td>                    
                                <td>$row->apellido, $row->nombre</td>
                            </tr>";
                    }
                }
                ?>
                
            </tbody>
        </table>
        


        </div>
    </div>
</div>
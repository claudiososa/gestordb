<?php
  include_once('../../../clases/MigracionServidores.class.php');    
  include_once('../../../clases/maestro.php');
  
//agregar nueva registracion de migracion
//en el caso que exista solo se edita los datos, fechas, observaciones y referente
//*****************************************************
  if (isset($_POST['ajaxMisMigraciones'])) {

    $migra = new MigracionServidores(null,null,null,$_POST['referenteId']);
        $buscarMigra = $migra->buscar();        
        $html = "<thead>
                    <tr>
                        <td>Id</td>
                        <td>Numero</td>
                        <td>Cue</td>
                        <td>Nombre</td>
                        <td>Accion</td>
                    </tr>
                </thead>
                <tbody>";   
        while ($row = mysqli_fetch_object($buscarMigra)) {
            $html .= "<tr>
                        <td class='id'>$row->escuelaId</td>
                        <td class='numero'>$row->numero</td>
                        <td class='cue'>$row->cue</td>
                        <td class='nombre'>$row->nombre</td>
                        <td><button id='editar$row->escuelaId' data-toggle='modal' data-target='#modalRegistrar' class='btn btn-warning'>Editar</button></td>
                    </tr>";
        }
        $html .= "</tbody>";
       
    echo $html;
     
  }    


<script src="includes/mod_cen/admin/js/carrera_abm.js"></script>
<?php   
    include_once ('includes/mod_cen/clases/Carreras.class.php');        
?>
<div class="page-wrapper"> 
<div class='container-fluid'>
    <div class='row page-titles'>
        <div class='col-md-5 col-8 align-self-center'>
            <h5 class='m-b-0 m-t-0 text-secondary'>Administrar Carreras</h5>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4'>  
            <form action="" method="post">
                <div class="form-group">
                    <br>
                    <h4><span class="alert alert-info" id="titulo">Agregar carrera</span></h4><br>
                    <input type="hidden" value="" id="id">
                    <input class='form-control' type="text" name='nombre' id='nombre' autofocus><br><br>
                    <input class='form-control' type="button" id="botonAccion" value="Crear">
                </div>
            </form>
        </div>
        <div class='col-md-8'>
            <div class='row'>
                <div class='col-md-12'>
                    <br>
                    <h4><span class="alert alert-info">Lista de carreras existentes</span></h4><br><br>    
                </div>
            </div>
            <div class='row' id='listadoProgramas'>
                <?php
                    $carrera = new Carreras();
                    $buscarCarreras = $carrera->buscar();
                    
                    while ($row = mysqli_fetch_object($buscarCarreras)) {
                        echo "<div class='col-md-12' id='rowPrograma$row->id'><p class='alert alert-dark'> 
                        <button class='btn btn-success' id='editar$row->id'>Editar</button>  $row->nombre </p></div>";
                    }
                    echo '</div>';
                ?>
            </div>
        </div>
    </div>
</div> <!-- fin container     -->
</div>
    



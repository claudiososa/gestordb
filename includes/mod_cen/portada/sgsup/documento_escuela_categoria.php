<script src="includes/mod_cen/admin/js/programa_abm.js"></script>
<?php   
    include_once ('includes/mod_cen/clases/Programa.php' );        
?>
<div class='container'>
    <div class='row'>
        <div class='col-md-4'>  
            <form action="" method="post">
                <div class="form-group">
                    <br>
                    <h4><span class="alert alert-info" id="titulo">Categorias de Documentos</span></h4><br>
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
                    <h4><span class="alert alert-info">Lista de programas existentes</span></h4><br><br>    
                </div>
            </div>
            <div class='row' id='listadoProgramas'>
                <?php
                    $programa = new Programa();
                    $buscarProgramas = $programa->buscar();
                    
                    while ($row = mysqli_fetch_object($buscarProgramas)) {
                        echo "<div class='col-md-12' id='rowPrograma$row->id'><p class='alert alert-dark'> 
                        <button class='btn btn-success' id='editar$row->id'>Editar</button>  $row->nombre </p></div>";
                    }
                    echo '</div>';
                ?>
            </div>
        </div>
    </div>
</div> <!-- fin container     -->

    



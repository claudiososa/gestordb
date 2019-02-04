<script src="includes/mod_cen/admin/js/programa_escuela.js"></script>
<?php   
    include_once ('includes/mod_cen/clases/Programa_escuela.php' );        
    include_once ('includes/mod_cen/clases/Programa.php' );
    
    $programa = new Programa();
    $buscarPrograma = $programa->buscar();

?>
<div class='container'>
    <div class='row'>
        <div class='col-md-3'>  
            <hr/>
            <h5><p class="alert alert-info" id="titulo">Seleccionar Programa</p></h5>                                      
            <form action="" method="post" onsubmit="funcionSubmit(event)">
               
                    
                    <select class="form-control" name="programa" id="programa">
                        <?php
                        while ($row = mysqli_fetch_object($buscarPrograma)) {
                            echo "<option value='$row->id'>$row->nombre</option>";
                        }
                        ?>                    
                    </select>
                    <br><br>
                    <h5><p class="alert alert-info" id="titulo">Buscador Escuela</p></h5><br>                    
                    <div class="form-group">
                    <input class='form-control' type="text" name='numero' placeholder='número' id='numero' autofocus><br><br>
                    <!-- <input class='form-control' type="text" name='cue' placeholder='cue' id='cue'><br><br> -->
                    <input class='form-control' type="button" id="botonAccion" value="Buscar">
                </div>
            </form>
        </div>                    
          
        <div class='col-md-6'>
            
                <hr/>
                <h5><p class="alert alert-info">Escuela encontradas</p></h5>  
                
                <div class='row' id='escuelasEncontradas'>
                    
                </div>
            
        </div>

        <div class='col-md-3'>    
                <hr/>
                <h5><p class="alert alert-info">últimas agregadas</p></h5> 
                <div class='row' id='ultimasAgregadas'>
                    <?php
                        $programa_escuela = new Programa_escuela();
                        $buscarProgramas = $programa_escuela->buscar('5');
                        
                        while ($row = mysqli_fetch_object($buscarProgramas)) {
                            echo "<div class='col-md-12' id='rowAgregada$row->id'>
                                    <p class='alert alert-dark'>$row->numero - $row->cue - .".substr($row->nombre,0,25)."</p>
                                 </div>";
                        }                        
                    ?>                
                </div>            
        </div>  
    </div>
</div> <!-- fin container     -->

    



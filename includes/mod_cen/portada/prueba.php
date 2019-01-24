
<script src="includes/mod_cen/portada/autoridad/js/autoridad.js"></script>
<div class="container">
    <select class="form-control" name="departamento" id="departamento">
    <option value="0">Seleccione departamento</option>
    <option value="todos">Toda la provincia</option>
    <?php
        include_once("includes/mod_cen/clases/departamentos.php");    
        $departamento = new Departamentos();         
        $lista = $departamento->lista('ASC');
        
        while ($row = mysqli_fetch_object($lista))
        {
            echo "<option value='$row->departamentoId'>$row->descripcion</option>";
        }    

    ?>
    </select>

    <div id="localidad" style="display:none">            
        <select name="localidad" id="localidad">
            <option value="0">Seleccione localidad</option>
            <option value="todos">Todas las localidades</option>
        </select>
    </div>    

    <div class="card">
        <div class="card-body" id="cardDepartamento">
            Departamento...
        </div>
    </div>    
</div>


<div class="container">
  <div class="panel panel-default col-md-4">
    <div class="panel-body">
      <h4>Busqueda de Informes</h4>
      <form>
        <div class="row">


      <div class="form-group">
        <label for="">Buscar por contenido</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingrese titulo, contenido , palabra clave etc">
      </div>

      </div>

      <div class="row" >

        <label for="">Buscar por Linea</label>
        <select class="form-control" id ="linea" name="linea">

           <option value="0">Seleccione...</option>

           <option value="7">PLANIED</option>
           <option value="1">SUPER primaria</option>
           <option value="3">SUPER sec</option>
        </select>

      </div>

<br>
      <div class="row" id= "rowCat">

        <label for="">Buscar por Categoria</label>
        <select class="form-control">

           <option value='0'>Seleccione</option>
           <?php
             /*$selected="";
             while($fila=mysqli_fetch_object($buscarCat)){

               echo "<option ".$selected.">".$fila->nombre."</option>";
               $selected="";
             }*/
           ?>
        </select>

      </div>

<br>
      <div class="row" id="subCat">

        <label for="">Buscar por Subcategoria</label>
        <select class="form-control">
          <option value='0'>Seleccione</option>
          <?php
          /*  $selected="";
            while($fila=mysqli_fetch_object($buscarSubCat)){

              echo "<option ".$selected.">".$fila->nombre."</option>";
              $selected="";
            }*/
          ?>
        </select>

      </div>

    </form>

    </div>
  </div>



  <div class="panel panel-default col-md-8">
    <div class="panel-body">
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

  </div>

</div>

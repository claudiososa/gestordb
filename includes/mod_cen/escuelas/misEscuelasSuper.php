
<!----------------------------------------------------------------------------->
<!--MIS ESCUELAS SUPER VISTA DESKTOP-->
<!----------------------------------------------------------------------------->

<div class="container">

<h3>Mis escuelas</h3>
<div class="panel panel-default">
  <div class="panel-body">
    <div class="">Accesos rapidos a acciones generales</div>
    <br>
    <div class="btn-group" role="group" aria-label="...">
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Seleccione Escuela
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="#">5159 palmeritas</a></li>
          <li><a href="#">5080</a></li>
          <li><a href="#">5080</a></li>
          <li><a href="#">5080</a></li>
        </ul>
      </div>

      <div class="btn-group" role="group">
      <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Acción
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#">Crear informe</a></li>
            <li><a href="#">Ver informes</a></li>


            <li class="dropdown-submenu">
              <a class="test" tabindex="-1" href="#">Cargar/modificar autoridad</a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#">Super 1</a></li>
                <li><a tabindex="-1" href="#">Super 2</a></li>

              </ul>
            </li>

          </ul>

        </div>

        </div>
        <div class="btn-group" role="group">
          <button type="button" class="btn btn-default ">
            ir
          </button>

        </div>
      </div> <!-- </div btn-group-->


  </div><!--</div panel-body-->
</div><!-- </div panel default -->



<table class="table table-bordered hidden-xs">
  <thead>
    <tr class='danger' >
      <th>CUE</th>
      <th>N°</th>
      <th>Nombre</th>
      <th>Mis informes</th>
      <th>Ver todas Autoridades</th>

    </tr>
  </thead>

  <tbody>
    <td>66025230</td>
    <td>5159</td>
    <td>palmeritas</td>
    <td><button type="button" class="btn btn-danger" name="button">3</button></td>
    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" name="button">5</button></td>
  </tbody>
</table>



</div> <!-- </div container> -->


<!----------------------------------------------------------------------------->
<!--MIS ESCUELAS SUPER VISTA MOBILE-->
<!----------------------------------------------------------------------------->


<div class="container visible-xs">

<div class="panel panel-danger">
  <div class="panel-heading clickable" id="panel-heading">Escuela N° 5159</div>
  <div class="panel-body escuela">
    <h4><b>Datos Institución</b></h4>
    <div class="row">
    <div class="col-md-12"><b>Dirección:&nbsp</b></div>
    </div>
    <div class="row">
    <div class="col-md-5"><b>Localidad:&nbsp</b></div>

    </div>
    <div class="row">

    <div class="col-md-12"><b>Nivel:</div>
    </div>

    <div class="row">
    <div class="col-md-12"><b>Teléfono:'</div>
    </div>
    <div class="row">
    <div class="col-md-12"><b>Email:'</div>
    </div>
    <br>
    <hr>
    <h4><b>Informes</b></h4>
    <div class="row">
    <div class="col-md-12"><button type="button" class="btn btn-danger"name="button">ver informes (8)</button></div>
    <br>
    <div class="col-md-12"><button type="button" class="btn btn-danger"name="button">Crear</button></div>
    </div>
    <hr>
    <h4><b>Autoridades</b></h4>
    <div class="row">
    <div class="col-md-12">perez juan supervisor cel: 1546431354</div>
    <div class="col-md-12">perez juan supervisor primaria</div>
    </div>
  </div><!--</div panel-body-->
</div><!--</div panel panel-default-->


</div> <!--</div container vista mobile-->



<!--modal boton autoridades vista desktop-->


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Autoridades escuela 5159</h4>
      </div>
      <div class="modal-body">
      Supervisor primaria diaz juan
      <br>
      director colque juan
      <br>supervisor religion marta diaz
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--fin modal vista desktop-->



  <script>
  $(document).ready(function(){

   $(".escuela").hide()

//dropdown accesos acciones generales
    $('.dropdown-submenu a.test').on("click", function(e){
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });

//paneles escuelas vista mobile
    $(document).on('click', '#panel-heading ' , 'span.clickable', function(){

        var $this = $(this);

    $this.closest('.panel').find('.panel-body').toggle();


    });

  });
  </script>

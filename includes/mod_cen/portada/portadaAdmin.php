<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-5 col-8 align-self-center">
        <h5 class=" m-b-0 m-t-0">Búsqueda de Escuelas</h5>

      </div>

    </div>


    <!-- contenido de buscador -->
    <div class="row">
      <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
          <div class="card-body">
            <div class="filtro pb-3 pt-3 pl-2 pr-2">
              <h6>Buscá escuela por N°, nombre o CUE</h6>

            </div>

            <form class="form-inline">
              <div class="input-group mt-2">
                <input type="search" class="form-control form-control-lg mr-sm-2 search" placeholder="Número" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary peach btn-lg" type="submit"><span class="oi oi-magnifying-glass searchIcon"></span> </button>
                </div>
              </div>

            </form>
            <form class="form-inline">
              <div class="input-group mt-2">
                <input type="search" class="form-control form-control-lg mr-sm-2 search" placeholder="CUE" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary peach btn-lg" type="submit">
                  <!-- <img onmouseout="this.src='new/img/lupa.png';"onmouseover="this.src='new/img/lupa1.png';"src="new/img/lupa.png">  -->
                  <span class="oi oi-magnifying-glass searchIcon"></span>
                </button>
                </div>
              </div>

            </form>
            <form class="form-inline">
              <div class="input-group mt-2">
                <input type="search" class="form-control form-control-lg mr-sm-2 search" placeholder="Nombre" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary peach btn-lg" type="submit"><span class="oi oi-magnifying-glass searchIcon"></span></button>
                </div>
              </div>

            </form>

            <!-- busqueda avanzada -->
            <div class="filtro pb-3 pt-3 pl-2 pr-2 mt-2">
              <h6>Buscá escuelas por departamentos</h6>

            </div>
            <form class="form-inline">
              <div class="form-group mt-2">
              <select name="departamento" id="departamento" class="custom-select custom-select-lg">
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
              </div>
            </form>
            <form class="form-inline">
              <!-- <div class="form-group mt-2"> -->
                <div class="form-group mt-2" id="divLocalidad" style="display:none">
                  <select class="custom-select custom-select-lg" name="localidad" id="localidad">
                      <!-- <option value="0">Seleccione localidad</option> -->
                      <option value="todos">Todas las localidades</option>
                  </select>
                </div>
           </form>
            <form class="form-inline">
              <div class="form-group mt-2" id="divNivel" style="display:none">
                <select class="custom-select custom-select-lg" name="nivel" id="nivel">
                    <!-- <option value="0">Seleccione localidad</option> -->
                    <option value="todos">Todas los Niveles</option>
                </select>
              </div>
            </form>



          </div>


        </div>
      </div>


      <!-- contenido -->
      <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
          <div class="card-body">
            <!-- resultados de busqueda -->

              <div class="accordion" id="escuelaListado">

              </div>

            <!-- resultados de busqueda -->

          </div>

        </div>
      </div>

    </div>

  </div>
</div>
<br><br>
<script src="includes/mod_cen/portada/autoridad/js/autoridadListaEscuelas.js"></script>
<script src="includes/mod_cen/portada/autoridad/js/autoridad.js"></script>


    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalCenterTitle">Autoridades Esc. xxxx</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- body modal -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#director" role="tab" aria-controls="director" aria-selected="true">Director/a</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#vice" role="tab" aria-controls="vice" aria-selected="false">Vicedirector/a</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#super" role="tab" aria-controls="super" aria-selected="false">Supervisor/a</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="director" role="tabpanel" aria-labelledby="home-tab">
              <div class="card">
                <div class="card-body">
                  <span class="oi oi-person modalIcon"> Nombre y apellido</span>
                  <br>
                  <span class="oi oi-phone modalIcon">3875565</span>
                </div>
              </div>

            </div>
            <div class="tab-pane fade" id="vice" role="tabpanel" aria-labelledby="profile-tab">
              <div class="card">
                <div class="card-body">
                  <span class="oi oi-person modalIcon"> Nombre y apellido</span>
                  <br>
                  <span class="oi oi-phone modalIcon">387992565</span>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="super" role="tabpanel" aria-labelledby="contact-tab">
              <div class="card">
                <div class="card-body">
                  <span class="oi oi-person modalIcon"> Nombre y apellido</span>
                  <br>
                  <span class="oi oi-phone modalIcon"> 38754991</span>
                </div>
              </div>
            </div>
          </div>


        <!-- body modal -->
      </div>

    </div>
  </div>
</div>
<!-- fin modal -->



<!--
 <img src="includes/mod_cen/portada/imgPortadas/navegador.png">
 <h2 align="center">¡Bienvenido Admin!.</h2>
 <h2 align="center">=)</h2> -->

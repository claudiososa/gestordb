<!-- <style type="text/css">

img{
display:block;
margin:auto;
}

</style>
-->
<br><br>



<div class="container">
  <div class="row">
    <div class="col-md-4">


            <div class="filtro pb-3 pt-3 pl-3">
              Búsqueda de Escuela

            </div>

            <form class="form-inline">

              <div class="form-group mt-2">
                <input class="form-control form-control-lg mr-sm-2 search" type="search" placeholder="Ingrese número" aria-label="Search">

              </div>
              <button class="btn btn-outline-primary peach btn-lg" type="submit"><img onmouseout="this.src='new/img/lupa.png';"onmouseover="this.src='new/img/lupa1.png';"src="new/img/lupa.png"> </button>

            </form>
            <form class="form-inline">
              <div class="form-group mt-2">
                <input class="form-control form-control-lg mr-sm-2 search" type="search" placeholder="Ingrese nombre" aria-label="Search">

              </div>
              <button class="btn btn-outline-primary peach btn-lg" type="submit"><img onmouseout="this.src='new/img/lupa.png';"onmouseover="this.src='new/img/lupa1.png';"src="new/img/lupa.png"> </button>

            </form>
            <form class="form-inline">
              <div class="form-group mt-2">
                <input class="form-control form-control-lg mr-sm-2 search" type="search" placeholder="Ingrese cue" aria-label="Search">

              </div>
              <button class="btn btn-outline-primary peach btn-lg" type="submit"><img onmouseout="this.src='new/img/lupa.png';"onmouseover="this.src='new/img/lupa1.png';"src="new/img/lupa.png"> </button>

            </form>
            <!-- busqueda avanzada -->
            <div class="filtro pb-3 pt-3 pl-3 mt-2">
              Filtra Resultados

            </div>
            <form class="form-inline">
              <div class="form-group mt-2">
                <select class="custom-select custom-select-lg">
                 <option selected>Seleccione Departamento</option>
                 <option value="1">Salta</option>
                 <option value="2">Cafayate</option>
                 <option value="3">Anta</option>
               </select>
              </div>


            </form>
            <form class="form-inline">
              <div class="form-group mt-2">
                <select class="custom-select custom-select-lg">
                 <option selected>Seleccione Localidad</option>
                 <option value="1">Salta</option>
                 <option value="2">Cafayate</option>
                 <option value="3">Anta</option>
               </select>
              </div>


            </form>
            <form class="form-inline">
              <div class="form-group mt-2">
                <select class="custom-select custom-select-lg">
                 <option selected>Seleccione Nivel</option>
                 <option value="1">Salta</option>
                 <option value="2">Cafayate</option>
                 <option value="3">Anta</option>
               </select>
              </div>


            </form>







    </div>

    <!-- fin de filtros -->

    <!-- resultados de busqueda -->
    <div class="col-md-8">

      <!-- Reemplazar id,data-target,aria-controls por ej. escuelaId -->
      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header cardHeaderStyle" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link  dropdown-toggle btnLink" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                E.E.T 3149
              </button>
              <!-- cambiar imagenes-horribleeeeeeeeesss! -->
              <span class=" imgInfo oi oi-people"data-toggle="modal" data-target="#exampleModalCenter" alt="informacion"></span>
              <span class=" imgInfo oi oi-map-marker"></span>
              <!-- <img class="imgInfo" src="new/img/info.png" > -->
              <!-- <img class="imgInfo" src="new/img/map.png" alt="ubicacion"> -->

            </h2>
          </div>

          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              <!-- body programas -->
              <div class="row">
  <div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Conectar</a>
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Pmi</a>
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">info de conectar</div>
      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">info de pmi</div>
      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
    </div>
  </div>
</div>
              <!-- body programas -->
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header cardHeaderStyle" id="headingTwo">
            <h2 class="mb-0">
              <button class="btn btn-link  dropdown-toggle btnLink" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Collapsible Group Item #2
              </button>
              <span class=" imgInfo oi oi-people"data-toggle="modal" data-target="#exampleModalCenter" alt="informacion"></span>
              <span class=" imgInfo oi oi-map-marker"></span>
            </h2>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
            </div>
          </div>
        </div>

</div>
      <!-- <div class="card">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Cras justo odio<button type="button" class="btn btn-outline-danger btn-md">Datos contacto </button>
            <br>  <button type="button" class="btn btn-outline-info btn-md">Aprender conectados</button>
            <button type="button" class="btn btn-outline-info btn-md">  PMI  </button>
            <button type="button" class="btn btn-outline-info btn-md">Todas</button>
            <button type="button" class="btn btn-outline-info btn-md">xxxxx</button>
            <button type="button" class="btn btn-outline-info btn-md">pmi</button>
            <button type="button" class="btn btn-outline-info btn-md">Todfdsfsdfsdfas</button>
            <button type="button" class="btn btn-outline-info btn-md">xxxdsfsddxx</button>
            <button type="button" class="btn btn-outline-info btn-md">pmi</button>
            <button type="button" class="btn btn-outline-info btn-md">Todadsffffffs</button>
            <button type="button" class="btn btn-outline-info btn-md">xxxxxsdafrsdsdfsdfsdf</button> </li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Vestibulum at eros</li>
        </ul>

      </div> -->

    </div>
    <!-- resultados de busqueda -->


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
                  <span class="oi oi-person"> Nombre y apellido</span>
                  <br>
                  <span class="oi oi-phone">3875565</span>
                </div>
              </div>

            </div>
            <div class="tab-pane fade" id="vice" role="tabpanel" aria-labelledby="profile-tab">
              <div class="card">
                <div class="card-body">
                  <span class="oi oi-person"> Nombre y apellido</span>
                  <br>
                  <span class="oi oi-phone">387992565</span>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="super" role="tabpanel" aria-labelledby="contact-tab">
              <div class="card">
                <div class="card-body">
                  <span class="oi oi-person"> Nombre y apellido</span>
                  <br>
                  <span class="oi oi-phone"> 38754991</span>
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

  </div>

<!--
 <img src="includes/mod_cen/portada/imgPortadas/navegador.png">
 <h2 align="center">¡Bienvenido Admin!.</h2>
 <h2 align="center">=)</h2> -->


</div>

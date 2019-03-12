<header>

  <nav class="navbar fixed-top flex-md-nowrap p-0 shadow">

    <button class="navbar-toggler menuBtn" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="oi oi-menu"></span>
    </button>
    <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <div class="navbar-header">
              <a class="navbar-brand" href="">
                  <!-- Logo icon --><b>

                      <!-- Logo icon -->
                      <img src="new/img/letra4.png" width="80px" height="50px" alt="">
                  </b>
                  <!--End Logo icon -->
               </a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div class="navbar">

            <!-- ============================================================== -->
                  <!-- User profile and search -->
                  <!-- ============================================================== -->
                  <ul class="navbar-nav my-lg-0">
                      <!-- ============================================================== -->
                      <!-- Profile -->
                      <!-- ============================================================== -->
                      <li class="nav-item">

                        <?php
                         include_once('includes/mod_cen/clases/persona.php');

                        if (isset($_SESSION["nombre"])) {
                          $personaId= $_SESSION["personaId"];
                          $persona= new Persona($personaId);
                          $persona = $persona->getContacto();
                        //  var_dump($persona);
                      }

                        $nomArchivoFoto="./img/perfil/";
                        if ($persona->getFotoPerfil() == "") {
                        $nomArchivoFoto.= "0000.jpg";
                        }else {
                        $nomArchivoFoto.= $persona->getFotoPerfil();
                        }

                        echo  "<img src='$nomArchivoFoto'  alt='perfil'  class=' img-responsive rounded-circle' style= 'width: 35px; height: 35px;' > ";
                        ?>


                          <!-- <a class="nav-link" href="index.php?men=user&id=1"><span class="oi oi-power-standby"></span><span class="textOffMenu" >Cerrar Sesión</span></a> -->
                      </li>
                  </ul>
            </div>



            <!-- ============================================================== -->
            <!-- SIDEBAR -->
            <!-- ============================================================== -->

  <!-- <a class="navbar-brand condor col-sm-3 col-md-2 mr-0" href="#">
   <img src="new/img/text4281.png" width="80px" height="50px" alt="">
  </a> -->

  <!-- <ul class="navbar-nav px-3">
  <li class="nav-item text-nowrap">

    <a class="nav-link"href="index.php?men=user&id=1"><span class="oi oi-power-standby"></span><span class="textOffMenu" >Cerrar Sesión</span>
    </a>
  </li>

  </ul> -->

  </nav>

</header>


<aside class="left-sidebar collapsing" id="navbarToggleExternalContent">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul>
                  <li class="nav-item">
                    <a  class="nav-link"href="index.php">
                      <span class="oi oi-home"></span>
                      Inicio <span class="sr-only">(current)</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php">
                      <span class="oi oi-magnifying-glass"></span>
                      Buscar
                    </a>
                  </li>

                  <div class="dropdown-divider"></div>
                  <li class="nav-item">
                    <a class="nav-link menuAside" href="#"  data-toggle="collapse"  data-target="#sidebarName" aria-controls="sidebarName" aria-expanded="false" aria-label="sidebarName"> Asignación Escuelas
                    <span class="oi oi-chevron-bottom bottomIconAside"></span>
                    </a>
                    <div class="collapse" id="sidebarName">
                      <ul class="nav nav-sm flex-column">



                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=admin&id=25&tipo=46" class="nav-link">Actualización Servidores</a>
                        </li>
                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=admin&id=6" class="nav-link">Referentes Conectar</a>
                        </li>
                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=admin&id=8" class="nav-link">Referentes PMI</a>
                        </li>
                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=admin&id=15&tipo=4" class="nav-link">Sup. Nucleo Primaria</a>
                        </li>
                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=admin&id=16&tipo=5" class="nav-link">Sup. Especial Primaria</a>
                        </li>
                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=admin&id=17&tipo=6" class="nav-link">Sup. Inicial</a>
                        </li>
                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=admin&id=17&tipo=6" class="nav-link">Supervisor Inicial</a>
                        </li>
                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=admin&id=18&tipo=7" class="nav-link">Sup. Hospitalaria</a>
                        </li>
                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=admin&id=19&tipo=12" class="nav-link">Sup. Religión</a>
                        </li>

                      </ul>

                    </div>
                  </li>
                  <div class="dropdown-divider"></div>

                  <li class="nav-item">
                    <a class="nav-link menuAside" href="#"  data-toggle="collapse"  data-target="#sidebarNameDoc" aria-controls="sidebarNameDoc" aria-expanded="false" aria-label="sidebarNameDoc"> <span class="oi oi-folder"></span>Documentos
                    <span class="oi oi-chevron-bottom bottomIconAside"></span>
                    </a>
                    <div class="collapse" id="sidebarNameDoc">
                      <ul class="nav nav-sm flex-column">



                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=doc&id=8" class="nav-link">Ver Documentos</a></li>
                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=informe&id=26" class="nav-link">Subir Documento</a>
                        </li>
                        <li class="nav-item">

                          <a href="index.php?mod=slat&men=informe&id=27" class="nav-link">Listar Documentos</a>
                        </li>


                      </ul>

                    </div>
                  </li>
                  <div class="dropdown-divider"></div>

                  <li class="nav-item">
                    <a class="nav-link menuAside" href="#"  data-toggle="collapse"  data-target="#sidebarNameCar" aria-controls="sidebarNameDoc" aria-expanded="false" aria-label="sidebarNameDoc"> <span class="oi oi-folder"></span>Carreras
                    <span class="oi oi-chevron-bottom bottomIconAside"></span>
                    </a>
                    <div class="collapse" id="sidebarNameCar">
                      <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                          <a href="index.php?mod=slat&men=abm&id=3" class="nav-link">Crear/Modif.</a>
                        </li>                        
                      </ul>
                    </div>
                  </li>
                  <li class="dropdown-divider"></li>

                  <li class="nav-item">
                    <a class="nav-link" href="index.php?mod=slat&men=admin&id=3">
                      <span class="oi oi-people"></span>
                      Login como...
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="index.php">
                      <span class="oi oi-magnifying-glass"></span>
                      Buscar
                    </a>
                  </li> -->



                </ul>

            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
        <!-- Bottom points-->
        <div class="sidebar-footer">
          <?php echo "<a href='index.php?mod=slat&men=personas&id=3&personaId=".$_SESSION['personaId']."' class='link' data-toggle='tooltip' title='Settings'>";?><span class="oi oi-cog"></span></a>
          <?php echo "<a href='index.php?mod=slat&men=personas&id=6&personaId=".$_SESSION['personaId']."' class='link' data-toggle='tooltip' title='pass'>";?><span class="oi oi-lock-locked"></span></a>

          <!-- <a href="index.php?men=mensajes&id=2" class="link" data-toggle="tooltip" title="Email"><span class="oi oi-envelope-closed"></span></a> -->
          <a href="index.php?men=user&id=1" class="link" data-toggle="tooltip" title="Logout"><span class="oi oi-power-standby"></span></a>
        </div>
        <!-- End Bottom points-->


    </aside>


<script type="text/javascript">
// ==============================================================
// Slimscrollbars
// ==============================================================
$('.scroll-sidebar').slimScroll({
    position: 'left',
    size: "5px",
    height: '100%',
    color: '#dcdcdc'
});

</script>
<script type="text/javascript">

let media= window.matchMedia('screen and (max-width:1023px)')

media.addListener(menu)


function menu(event){
  if (event.matches) {
    console.log('responsive');
    $('#navbarToggleExternalContent').removeClass('collapsing').addClass('collapse')


  }else{
    $('#navbarToggleExternalContent').removeClass('collapse').addClass('collapsing')
  }

}
menu(media);
</script>

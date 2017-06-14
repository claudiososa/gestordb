<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">DBMS 2017</a>
    </div>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php?mod=slat&men=admin&id=9">Asignar Escuelas para Supervisor</a></li>


        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Buscar <span class="caret"></span></a>
          <ul class="dropdown-menu">
                <li><a href="index.php?mod=slat&men=referentes&id=1">Referentes</a></li>
                <li ><a href="index.php?mod=slat&men=escuelas&id=1">Escuelas</a></li>
                <li ><a href="index.php?mod=slat&men=referentes&id=10">RTI</a></li>
          </ul>
        </li>
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Documentos<span class="caret"></span></a>
        <ul class="dropdown-menu">
                <li class=""><a href="index.php?mod=slat&men=doc&id=1">Ver Documentación<span class="sr-only">(current)</span></a></li>              
                <li class=""><a href="index.php?mod=slat&men=informe&id=17">Subir Documento Nuevo<span class="sr-only">(current)</span></a></li>
                <li ><a href="index.php?mod=slat&men=informe&id=20">Listar Documentos</a></li>
        </ul>
      </li>


          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi Perfil <span class="caret"></span></a>
          <ul class="dropdown-menu">
                  <li><?php echo "<a href='index.php?mod=slat&men=personas&id=3&personaId=".$_SESSION['personaId']."'>";?>Actualizar</a></li>
                  <li><?php echo "<a href='index.php?mod=slat&men=personas&id=6&personaId=".$_SESSION['personaId']."'>";?>Cambiar Contraseña</a></li>
          </ul>
        </li>

        </li>
        <li><a href="index.php?men=user&id=1">Cerrar Sesión</a></li>
  <li><a href="">Hola,<?php echo $_SESSION["nombre"]?></a></li>
      </ul>


    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

    <div class="row">
<div class="col-md-5">
  <a class="navbar-brand" href="index.php">DBMS 2017</a>
</div>




    <!-- Collect the nav links, forms, and other content for toggling -->

<div class="col-md-pull-7 pull-right">


      <ul class="nav navbar-nav">

        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["nombre"]?>&nbsp&nbsp<span class="glyphicon glyphicon glyphicon-user"></span><span class="caret"></span></a>
        <ul class="dropdown-menu">

          <li class="dropdown-submenu">
          <a href="#">Mi Perfil <span class="caret"></span></a>
          <ul class="dropdown-menu">

                  <li><?php echo "<a href='index.php?mod=slat&men=personas&id=3&personaId=".$_SESSION['personaId']."'>";?>Actualizar</a></li>
                  <li><?php echo "<a href='index.php?mod=slat&men=personas&id=6&personaId=".$_SESSION['personaId']."'>";?>Cambiar Contraseña</a></li>
          </ul>
        </li>


        <li class="disabled"><a href="index.php?men=user&id=1">Mis mensajes</a></li>
        <li><a href="index.php?men=user&id=1">Cerrar Sesión</a></li>
        </ul>
      </li>


      </ul>
</div>
</div>
    <!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

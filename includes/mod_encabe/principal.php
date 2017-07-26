<div class="container-fluid">
  <!-- Brand and toggle get grouped for better mobile display -->


      <img src="img/iconos/logodbms.png" alt="DBMS Conectar">

    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php
          if(strpos($_SESSION["nombre"],' ')==0){
          echo ucwords(strtolower($_SESSION["nombre"]));
        }else{
          echo ucwords(substr(strtolower($_SESSION["nombre"]),0,strpos($_SESSION["nombre"],' ')));
        }

          ?>&nbsp&nbsp<span class="glyphicon glyphicon glyphicon-user"></span><span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li class="disabled"><a href="index.php?men=user&id=1">Mis mensajes</a></li>
              <li class="divider"></li>
              <li><?php echo "<a href='index.php?mod=slat&men=personas&id=3&personaId=".$_SESSION['personaId']."'>";?>Actualizar Perfil</a></li>
              <li><?php echo "<a href='index.php?mod=slat&men=personas&id=6&personaId=".$_SESSION['personaId']."'>";?>Cambiar Contraseña</a></li>
              <li class="divider"></li>
              <li><a href="index.php?men=user&id=1">Cerrar Sesión</a></li>
        </ul>
        </li>
        </ul>
    

  </div><!-- /.container-fluid -->

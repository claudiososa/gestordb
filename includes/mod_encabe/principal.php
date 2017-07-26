<div class="container-fluid">
  <!-- Brand and toggle get grouped for better mobile display -->
<div class="row">
<div class="col-xs-6">
  <img src="img/iconos/logodbms.png" alt="DBMS Conectar">

</div>

<div class=" pull-right">



    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><?php
          if(strpos($_SESSION["nombre"],' ')==0){
          echo ucwords(strtolower($_SESSION["nombre"]));
        }else{
          echo ucwords(substr(strtolower($_SESSION["nombre"]),0,strpos($_SESSION["nombre"],' ')));
        }

          ?>&nbsp&nbsp<span class="glyphicon glyphicon glyphicon-user"></span><span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li class="disabled"><a href="index.php?men=mensajes&id=2"> &nbsp&nbspMis mensajes<span class="glyphicon glyphicon glyphicon-envelope pull-left"></span></a></li>
              <li class="divider"></li>
              <li><?php echo "<a href='index.php?mod=slat&men=personas&id=3&personaId=".$_SESSION['personaId']."'>";?><span class="glyphicon glyphicon glyphicon-pencil pull-left"></span>&nbsp&nbsp Actualizar Perfil</a></li>
              <li><?php echo "<a href='index.php?mod=slat&men=personas&id=6&personaId=".$_SESSION['personaId']."'>";?><span class="glyphicon glyphicon glyphicon-lock pull-left"></span>&nbsp&nbspCambiar Contraseña</a></li>
              <li class="divider"></li>
              <li><a href="index.php?men=user&id=1">&nbsp&nbspCerrar Sesión <span class="glyphicon glyphicon glyphicon-off pull-left"></span></a></li>
        </ul>
        </li>
        </ul>
</div>
</div>
  </div><!-- /.container-fluid -->

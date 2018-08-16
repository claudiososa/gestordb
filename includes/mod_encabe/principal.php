<?php
include_once('includes/mod_cen/clases/persona.php');
  ?>
<div class="container-fluid">
  <!-- Brand and toggle get grouped for better mobile display -->
<div class="row">
  <?php
  if (isset($_SESSION["nombre"])) {
    $personaId= $_SESSION["personaId"];
    $persona= new Persona($personaId);
    $persona = $persona->getContacto();
    ?>

<div class="nav navbar-header col-xs-5" style="margin-top:15px;margin-bottom:10px">
  <img class="img-responsive"src="img/iconos/logodbms.png" alt="DBMS Conectar" >

</div>

  <div class=" pull-right" style="margin-top:10px;margin-bottom:10px">
      <ul class="nav navbar-nav navbar-right">
          <li class="dropdown" style="margin-right:14px">
            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style='color:#068587;'><?php
            // if(strpos($_SESSION["nombre"],' ')==0)
            // {
            //   echo $persona->getFotoPerfil();
            //   echo ucwords(strtolower($_SESSION["nombre"]));
            // }else{
            //   echo ucwords(substr(strtolower($_SESSION["nombre"]),0,strpos($_SESSION["nombre"],' ')));
            //   echo $persona->getFotoPerfil();
            // }

          $nomArchivoFoto="./img/perfil/";
          if ($persona->getFotoPerfil() == "") {
              $nomArchivoFoto.= "0000.jpg";
          }else {
              $nomArchivoFoto.= $persona->getFotoPerfil();
          }

          echo  "<img src='$nomArchivoFoto'  alt='perfil'  class=' img-responsive img-circle' style= 'width: 35px; height: 35px;' > ";
            ?>
            <!-- <span class="caret"></span> -->
          </a>
            <ul class="dropdown-menu">
              <?php
           if(strpos($_SESSION["nombre"],' ')==0){

          //      echo $persona->getFotoPerfil();
             //echo ucwords(strtolower($_SESSION["nombre"]));
        //   }else{

            // echo ucwords(substr(strtolower($_SESSION["nombre"]),0,strpos($_SESSION["nombre"],' ')));
          //   echo $persona->getFotoPerfil();

           }
          ?>

                <li><a href="index.php?men=mensajes&id=2"><span class="glyphicon glyphicon glyphicon-envelope pull-left" style="color:#068587"></span>&nbsp&nbspMis mensajes</a></li>
                <li class="divider"></li>
                <li><?php echo "<a href='index.php?mod=slat&men=personas&id=3&personaId=".$_SESSION['personaId']."'>";?><span class="glyphicon glyphicon glyphicon-pencil pull-left" style="color:#068587"></span>&nbsp&nbsp Actualizar Perfil</a></li>
                <li><?php echo "<a href='index.php?mod=slat&men=personas&id=6&personaId=".$_SESSION['personaId']."'>";?><span class="glyphicon glyphicon glyphicon-lock pull-left" style="color:#068587"></span>&nbsp&nbspCambiar Contraseña</a></li>
                <li class="divider"></li>
                <li><a href="index.php?men=user&id=1"><span class="glyphicon glyphicon glyphicon-off pull-left" style="color:#068587"></span>&nbsp&nbspCerrar Sesión </a></li>
          </ul>
          </li>
          </ul>
  </div>
  <?php
}else{
  ?>
  <div class="col-md-12" align="center" style="margin-top:15px;margin-bottom:5px">
    <img src="img/iconos/logodbms.png" alt="DBMS Conectar" >

  </div>
  <?php
}
 ?>

</div>
  </div><!-- /.container-fluid -->

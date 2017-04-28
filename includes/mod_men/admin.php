<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar">cas</span>
        <span class="icon-bar">das</span>
        <span class="icon-bar">dfdf</span>
      </button>
      <a class="navbar-brand" href="index.php">DBMS 2017</a>
    </div>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php?men=rtis&id=1">RTI <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tareas<span class="caret"></span></a>
        <ul class="dropdown-menu">
              <li><a href="index.php?mod=slat&men=admin&id=6">Asignar Escuelas Conectar</a></li>
              <li><a href="index.php?mod=slat&men=admin&id=8">Asignar Escuelas PMI</a></li>
        </ul>
      </li>

		<li><a href="index.php?mod=slat&men=escuelas&id=9">Informe Escuelas</a></li>
		<li><a href="index.php?mod=slat&men=escuelas&id=12">ADM</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Buscar <span class="caret"></span></a>
          <ul class="dropdown-menu">
                <li><a href="index.php?mod=slat&men=referentes&id=1">Referentes</a></li>
                <li ><a href="index.php?mod=slat&men=admin&id=4">Escuelas</a></li>
          </ul>
          </li>

          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categorias<span class="caret"></span></a>
          <ul class="dropdown-menu">
                <li><a href="index.php?mod=slat&men=informe&id=10">Nueva Categoría</a></li>
                <li ><a href="index.php?mod=slat&men=informe&id=11">Buscar Editar Categoría</a></li>
                <li ><a href="index.php?mod=slat&men=informe&id=12">Nueva Sub-Categoría</a></li>
                <li ><a href="index.php?mod=slat&men=informe&id=13">Listar Sub-Categoría</a></li>
                <li ><a href="index.php?mod=slat&men=informe&id=16">Nueva Categoría Documentos</a></li>
          </ul>
        </li>


         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">NUEVO<span class="caret"></span></a>
          <ul class="dropdown-menu">
                <li ><a href="index.php?mod=slat&men=personas&id=8&escuelaId=111">Alta Vice-Director</a></li>
                 <li ><a href="index.php?mod=slat&men=personas&id=9">Editar Vice-Director</a></li>

          </ul>
        </li>



		  <li><a href="index.php?mod=slat&men=admin&id=3">Login como..</a></li>


          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi Perfil <span class="caret"></span></a>
          <ul class="dropdown-menu">
                  <li><?php echo "<a href='index.php?mod=slat&men=personas&id=3&personaId=".$_SESSION['personaId']."'>";?>Actualizar</a></li>
                  <li><?php echo "<a href='index.php?mod=slat&men=personas&id=6&personaId=".$_SESSION['personaId']."'>";?>Cambiar Contraseña</a></li>
          </ul>
        </li>

        </li>
        <li><a href="index.php?men=user&id=1">Cerrar Sesión</a></li>

      </ul>


    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

<?php /*
<ul class="nav">
	<li><a href="index.php">Inicio</a></li>
	<li><a href="index.php?men=referentes&id=1">Referentes</a></li>
	<li><a href="index.php?men=rtis&id=1">RTI</a></li>
	<li><a href="index.php?mod=slat&men=admin&id=4">Escuelas</a></li>
	<li><a href="index.php?mod=slat&men=admin&id=6">Asignar Escuelas</a></li>
	<li><a href="index.php?mod=slat&men=escuelas&id=9">Informe Escuelas</a></li>
	<li><a href="index.php?mod=slat&men=escuelas&id=12">ADM</a></li>
	<li><a href="">Encuentros</a>
        <ul>
           <li><a href="index.php?mod=slat&men=encuentros&id=3">Todos Encuentros</a></li>
         </ul>
   </li>
	<li><a href="index.php?mod=slat&men=admin&id=3">Login como..</a></li>
	<li><a href="index.php?men=user&id=1">Cerrar Sesión</a></li>
</ul>*/
?>

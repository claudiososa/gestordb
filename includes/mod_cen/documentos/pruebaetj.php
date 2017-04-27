<script type="text/javascript">
$(document).ready(function() {
if  {
  $(".panel-collapse").on("hide.bs.collapse", function () {
      $(".panel-heading-collapse-clickable").find('i').removeClass("glyphicon glyphicon-triangle-top").addClass("glyphicon-chevron-down");
  });

}
else {
  $(".panel-collapse").on("show.bs.collapse", function () {
      $(".panel-heading-collapse-clickable").find('i').removeClass("glyphicon-chevron-down").addClass("glyphicon glyphicon-triangle-top");
  });
}
});

</script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion2" href="#filterPanel2">Collapsible Group 1</a>
            <span class="pull-right panel-collapse-clickable" data-toggle="collapse" data-parent="#accordion2" href="#filterPanel2">
                <i class="glyphicon glyphicon-chevron-down"></i>
            </span>
        </h4>
    </div>
    <div id="filterPanel2" class="panel-collapse panel-collapse collapse">
        <div class="panel-body">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion1" href="#filterPanel1">Collapsible Group 1</a>
            <span class="pull-right panel-collapse-clickable" data-toggle="collapse" data-parent="#accordion2" href="#filterPanel1">
                <i class="glyphicon glyphicon-chevron-down"></i>
            </span>
        </h4>
    </div>
    <div id="filterPanel1" class="panel-collapse panel-collapse collapse">
      <div class="panel-body">
        <center><button type="button" class="btn btn-default btn-lg">
          <a href="documentacion/ett/servidores/Tutorial-reparacion-inicio-servidor-debian.pdf" download="Tutorial-reparacion-inicio-servidor-debian.pdf"><span class="pull-right glyphicon glyphicon glyphicon-download-alt"></span>Descargar&nbsp;</a></button></center><br>Tutorial .PDF de reparación del sistema de archivos (File System) para solucionar el error de Inicio de un Servidor Escolar GNU/DEBIAN.
      </div>

    </div>
</div>

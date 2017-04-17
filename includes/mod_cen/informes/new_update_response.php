<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/respuesta.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
$nuevo=0;

if(isset($_POST['save_report']))
{

	//var_dump($_POST);
//  sleep(10);
    if(!isset($_POST["edit_report"])){
    //creo objeto informe
    // en esta seccion de codigo se crea y guarda la respuesta

    $fecha=date("Y-m-d H:i:s");
    //$fechaVisita=$_POST[""]date("Y-m-d");
	    $respuesta= new Respuesta(null,$_POST["informeId"],$_SESSION["referenteId"],$_POST["contenido"],
		$_POST["fechaVisita"],$fecha,null);
        $guardar_respuesta=$respuesta->agregar();

        if($guardar_respuesta==1){          // entra si se agrego la respuesta
			  

            include_once("includes/mod_cen/informes/email_script_resp.php");
        }
    }else{
    	$fecha=date("Y-m-d H:i:s");
    	$respuesta= new Respuesta($_POST["contenido"],$_POST["fechaVisita"],$fecha);
    	$guardar_respuesta=$respuesta->editar();
        if($guardar_respuesta==1){
					  $informeId= $_POST["informeId"];
					$variablephp = "index.php?mod=slat&men=informe&id=3&informeId='$informeId'";
            ?>    <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()", 0);
                    </script>
            <?php
        }
    }
    //echo "llego post";
  //  echo $_GET["escuelaId"];
   // echo $_SESSION["referenteId"];

}else{
	//sino entre por post, entonces debe cargarse formulario de informe
	//echo "no llego post";
	// crea objeto escuela, de acuerdo al id de escuela provisto por GET

	$dato_informe = new Informe($_GET["informeId"]);
	$buscar_informe = $dato_informe->buscar();
	$informe = mysqli_fetch_object($buscar_informe);

	$escuela= new Escuela($informe->escuelaId);
	$buscar_escuela=$escuela->buscar();
	$dato_escuela=mysqli_fetch_object($buscar_escuela);

	$respuesta = new Respuesta();
    $nuevo=1;

	//$dato_informe = mysqli_fetch_object($informe);

	include_once("includes/mod_cen/formularios/f_respuesta.php");

}

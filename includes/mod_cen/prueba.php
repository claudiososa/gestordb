 <?php
include_once("includes/mod_cen/clases/conexion.php");
$nuevaConexion=new Conexion();
$conexion=$nuevaConexion->getConexion(); 

$resultado = mysqli_query("SHOW columns FROM encuentros");

if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        print_r($fila);
    }
}
?>
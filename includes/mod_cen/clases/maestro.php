<?php 
class Maestro{
public function estructura($campo,$tabla){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="SHOW COLUMNS FROM $tabla LIKE '$campo'";
		$query=$conexion->query($sentencia);
		$result = mysqli_fetch_assoc($query);
  		$result=$result['Type'];
  		$result=substr($result, 5, strlen($result)-5);
  		$result=substr($result, 0, strlen($result)-2);
  		$result = explode("','",$result);
		return $result;	
	}
	
	public function existeCampo($valor,$campo,$tabla)
	{
		$nuevaConexion= new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="SELECT ".$campo." FROM ".$tabla." WHERE ".$campo."=".$valor;
		$cantidad=mysqli_num_rows($conexion->query($sentencia));
		if($cantidad>0) {
			return 1;
		}else {
			return 0;
		}
	}
}

?>
<?php  
include_once('persona.php');
class Supervisor extends Persona
{
	public static function existeSupervisor($escuelaId)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="SELECT escuelas.supervisor_id,escuelaId,personaId,personas.apellido,personas.nombre FROM escuelas left join personas on escuelas.supervisor_id=personas.personaId where escuelaId=".$escuelaId;

		return $conexion->query($sentencia);
		
	}
}
if(isset($_POST['opcion']))//llamadas ayax
	
{
	
	switch($_POST['opcion'])
	{
		case 'buscarpordni':
			$supervisor = new persona(null,null,null,$_POST['dni']);
			$persona=$supervisor->buscar();
			$fila = mysqli_fetch_object($persona);
			if($fila){
				$data=$fila;
				echo json_encode($data);//envio como objeto json
			}
			else
			{
				echo 0;
			}
			break;
			
	}
}


?>

<?php
include_once("conexionPdo.php");
include_once("conexion.php");
include_once("referente.php");
include_once("persona.php");

class Login
{
	private $username;
	private $password;
	private $conexion;

function __construct($username=null, $password=null, $conexion=null)
{
	$this->username=$username;
	$this->password=$password;
	$this->conexion=$conexion;
}

public function iniciarSesion()
{

	$stmt = ConexionPdo::getConexion()->prepare("SELECT * FROM usuarios WHERE username=:user_name && password=:password");

    $stmt->bindParam(":user_name",$this->username,PDO::PARAM_INT);
    $stmt->bindParam(":password",md5($this->password),PDO::PARAM_STR);

		if($stmt->execute()){
			$elemento = $stmt->fetchobject();
			//var_dump($elemento);
			//$elemento=mysqli_fetch_object($resultado);
			$nuevaConexion=new Conexion();
			$conexion=$nuevaConexion->getConexion();
			//inici2amos session
			session_start();
			//cargamos valores session
			$_SESSION["username"]=$elemento->username;
			$_SESSION["referenteId"]=$elemento->referenteId;
			//$_SESSION["username"]=$elemento['username'];
			//$_SESSION["referenteId"]=$elemento['referenteId'];
			//var_dump($_SESSION["referenteId"]);
			$referente= new Referente($elemento->referenteId);
			$referente = $referente->getContacto();
			$_SESSION["tipo"]=$referente->getTipo();
			$persona="SELECT referentes.referenteId,personas.nombre,personas.apellido,personas.personaId FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE referenteId=".$elemento->referenteId."";
			$result=$conexion->query($persona);
			$dato=mysqli_fetch_object($result);
			$_SESSION["nombre"]=$dato->nombre;
			$_SESSION["personaId"]=$dato->personaId;
		}else{
        echo "error";
		}



				//$stmt->close();

}


public function passActual()
	{
		$nuevaConexion= new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$consulta="SELECT * FROM usuarios WHERE username='".$this->username."'";
		$hacer_consulta=$conexion->query($consulta);
		$actual=mysqli_fetch_object($hacer_consulta);
		$this->password=$actual->password;
		return $this;
	}

public function cambioPass() {
	$nuevaconexion=new Conexion();
	$conexion=$nuevaconexion->getConexion();
	$pmd5=md5($this->password);
	$sentencia="UPDATE usuarios SET password='$pmd5' WHERE username='$this->username'" ;
	if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
}

public function getUsername()
{
	return $this->username;
}

public function getPassword()
{
	return $this->password;
}
public function getConexion()
{
	return $this->conexion;
}
}

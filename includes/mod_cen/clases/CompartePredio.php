<?php
include_once('conexionv2.php');

class CompartePredio
{
	private $id;
 	private $escuelaId;
 	private $predio;
	private $referenteId;

function __construct($id=NULL,$escuelaId=NULL,$predio=NULL,$referenteId=NULL)
	{
		$this->id= $id;
 		$this->escuelaId = $escuelaId;
 		$this->predio =$predio;
		$this->referenteId = $referenteId;
 	}


	public function agregar(){
		$bd=Conexion2::getInstance();
		$sentencia = "INSERT INTO escuelaPredio (id,escuelaId,predio,referenteId)
									VALUES (NULL,'".$this->escuelaId."','".$this->predio."','".$this->referenteId."')";
		if ($bd->ejecutar($sentencia)) {
			return $ultimoPredio=$bd->lastID();
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function editar(){
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE escuelaPredio SET escuelaId=$this->escuelaId,predio=$this->predio,referenteId=$this->referenteId
									WHERE id=$this->id";
		if ($bd->ejecutar($sentencia)) {
			return $ultimoPredio=$bd->lastID();
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}


		public function buscarPredio($count=NULL)
		{
			// INNER JOIN escuelas
			// ON escuelaPredio.escuelaId = escuelas.escuelaId
			$bd=conexion2::getInstance();
		  $sentencia="SELECT * FROM escuelaPredio WHERE escuelaId=$this->escuelaId";

			$sentencia.="  ORDER BY id DESC";
			// if(isset($limit)){
			// 	$sentencia.=" LIMIT ".$limit;
			// }
			//echo $sentencia;
			$cantidad = mysqli_num_rows($bd->ejecutar($sentencia));# code...

			if ($cantidad > 0) {
					$dato = mysqli_fetch_object($bd->ejecutar($sentencia));
					//$bd=conexion2::getInstance();
				  $sentencia2="SELECT * FROM escuelaPredio
											 INNER JOIN escuelas
											 ON escuelas.escuelaId = escuelaPredio.escuelaId
											 WHERE predio = $dato->predio";

					if (mysqli_num_rows($bd->ejecutar($sentencia2))>1)
						{
							$cantidad = mysqli_num_rows($bd->ejecutar($sentencia2));
						}
				}
				if(isset($count)){
					return $cantidad;
				}else{
					return $bd->ejecutar($sentencia2);
				}


		}

	public function buscar($limit=NULL,$count=NULL)
	{
		// INNER JOIN escuelas
		// ON escuelaPredio.escuelaId = escuelas.escuelaId
		$bd=conexion2::getInstance();
	  $sentencia="SELECT * FROM escuelaPredio";

		if($this->id!=NULL || $this->escuelaId!=NULL || $this->predio!=NULL || $this->referenteId)
		{
			$sentencia.=" WHERE ";


		if($this->id!=NULL)
		{
			$sentencia.=" id = $this->id && ";
		}

		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId = $this->escuelaId  && ";
		}

		if($this->predio!=NULL)
		{
			$sentencia.=" predio = $this->predio && ";
		}

		if($this->referenteId!=NULL)
		{
			$sentencia.=" referenteId = $this->referenteId && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY id DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia;
		if (isset($count)) {
			return mysqli_num_rows($bd->ejecutar($sentencia));# code...
		}else{
			return $bd->ejecutar($sentencia);
		}


	}

	public function __get($var)
	{
		return $this->$var;

	}


	public function __set($var,$valor)
	{
		$this->$var=$valor;
	}

}

<?php

include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/maestro.php");

class CategoriaDoc
{
	private $categoriaDocId;
 	private $nombreCategoria;
 	private $descripcionCategoria;
	


function __construct($categoriaDocId=NULL,$nombreCategoria=NULL,$descripcionCategoria=NULL)
	{
		$this->categoriaDocId= $categoriaDocId;
 		$this->nombreCategoria = $nombreCategoria;
 		$this->descripcionCategoria =$descripcionCategoria;
		
 	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO categoria_doc(categoriaDocId,nombreCategoria,descripcionCategoria)
		VALUES (NULL,'". $this->nombreCategoria."','". $this->descripcionCategoria."');";
           
		if ($conexion->query($sentencia)) {
			$orden="SELECT MAX(categoriaDocId) AS id FROM categoria_doc";

			$datoFila = mysqli_fetch_object($conexion->query($orden));
			return $datoFila->id;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	public function editar()
	{
	
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="UPDATE categoria_doc SET nombreCategoria = '$this->nombreCategoria',descripcionCategoria = '$this->descripcionCategoria'
		 WHERE categoriaDocId = '$this->categoriaDocId'";

			
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}


	public function buscar($limit=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	    $sentencia="SELECT * FROM categoria_doc";

		if($this->categoriaDocId!=NULL || $this->nombreCategoria!=NULL || $this->descripcionCategoria!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->categoriaDocId!=NULL)
		{
			$sentencia.=" categoriaDocId = $this->categoriaDocId && ";
		}

		if($this->nombre!=NULL)
		{
			$sentencia.=" nombreCategoria LIKE '%$this->nombreCategoria%'  && ";
		}

		if($this->descripcion!=NULL)
		{
			$sentencia.=" descripcionCategoria=$this->descripcionCategoria && ";
		}

		
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY categoriaDocId ASC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia;
		return $conexion->query($sentencia);

	}


// metodo buscar categoria para menu ett

	public function buscarCatPermiso($cargo)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	    
	    $sentencia="SELECT  categoria_doc.nombreCategoria,categoria_doc.categoriaDocId
								 FROM categoria_doc
								JOIN permiso_categoria_doc
									ON (permiso_categoria_doc.categoriaDocId = categoria_doc.categoriaDocId )
								
							    WHERE ";


		if($cargo!=NULL)
			{
				$sentencia.=" permiso_categoria_doc.tipoReferente = '".$cargo."'";
				
			}


		

		$sentencia.="  ORDER BY nombreCategoria ASC";
		//echo $sentencia;
		
		return $conexion->query($sentencia);

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

<?php   
include_once('includes/mod_cen/clases/conexion.php');

class Eje
{
	private $eje_nroId;
 	private $eje_desc;
 	private $eje_pert;
 	private $eje_cant;
 	 	 
function __construct($eje_nroId=NULL,$eje_desc=NULL,$eje_pert=NULL,$eje_cant=NULL)
	{
		$this->eje_nroId = $eje_nroId;
		$this->eje_desc = $eje_desc;
		$this->eje_pert = $eje_pert;
		$this->eje_cant =$eje_cant;
		
	}
	
public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM ejes";
		if($this->eje_nroId!=NULL || $this->eje_desc!=NULL || $this->eje_pert!=NULL || $this->eje_cant!=NULL )
		{
			$sentencia.=" WHERE ";
		
		
		if($this->eje_nroId!=NULL)
		{
			$sentencia.=" eje_nroId = $this->eje_nroId && ";
		}
		
		if($this->eje_desc!=NULL)
		{
			$sentencia.=" eje_desc='$this->eje_desc' && ";
		}
				
		if($this->eje_pert!=NULL)
		{
			$sentencia.=" eje_pert='$this->eje_pert' && ";
		}
		
		if($this->eje_cant!=NULL)
		{
			$sentencia.=" eje_cant = $this->eje_cant && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);	
		
		}
		
		$sentencia.="  ORDER BY eje_nroId";	
	
		return $conexion->query($sentencia);
			
	}	
    
}
	
	
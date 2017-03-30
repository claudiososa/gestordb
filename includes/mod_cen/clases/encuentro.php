<?php   
include_once('includes/mod_cen/clases/conexion.php');

class Encuentro
{
	private $enc_nroId;
 	private $ref_nroId;
 	private $enc_tipcapac;
 	private $enc_nroenc;
 	private $enc_fch;
 	private $enc_sede;
 	private $enc_nroesc;
 	private $enc_catering;
	private $enc_obs; 	
 	private $enc_esta;
 	private $enc_hsd;
 	private $enc_hsh;
 	private $enc_cantdoc;
 	private $enc_cantrti;
 	private $enc_cantsup;
 	private $enc_cantpmi;
 	private $enc_cantdire;
 	private $enc_canteqfor;
 	private $enc_cantetj;
 		
 	 
function __construct($enc_nroId=NULL,$ref_nroId=NULL,$enc_tipcapac=NULL,$enc_nroenc=NULL,$enc_fch=NULL,$enc_sede=NULL,$enc_nroesc=NULL,$enc_catering=NULL,$enc_obs=NULL,$enc_esta=NULL,$enc_hsd=NULL,$enc_hsh=NULL,$enc_cantdoc=NULL,$enc_cantrti=NULL,$enc_cantsup=NULL,$enc_cantpmi=NULL,$enc_cantdire=NULL,$enc_canteqfor=NULL,$enc_cantetj=NULL)
	{
		$this->enc_nroId = $enc_nroId;
 		$this->ref_nroId = $ref_nroId;
 		$this->enc_tipcapac =$enc_tipcapac;
 		$this->enc_nroenc =$enc_nroenc;
 		$this->enc_fch =$enc_fch;
 		$this->enc_sede =$enc_sede;
 		$this->enc_nroesc =$enc_nroesc;
 		$this->enc_catering =$enc_catering;
		$this->enc_obs = $enc_obs; 	
 		$this->enc_esta = $enc_esta;
 		$this->enc_hsd = $enc_hsd;
 		$this->enc_hsh = $enc_hsh;
 		$this->enc_cantdoc =$enc_cantdoc;
 		$this->enc_cantrti = $enc_cantrti;
 		$this->enc_cantsup =$enc_cantsup;
 		$this->enc_cantpmi =$enc_cantpmi;
 		$this->enc_cantdire = $enc_cantdire;
 		$this->enc_canteqfor = $enc_canteqfor;
 		$this->enc_cantetj = $enc_cantetj;
		
	}
	
	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	
		$sentencia="INSERT INTO encuentros (enc_nroid,ref_nroId,enc_tipcapac,enc_nroenc,enc_fch,enc_sede,enc_nroesc,enc_catering,enc_obs,enc_esta,enc_hsd,enc_hsh,enc_cantdoc,enc_cantrti,enc_cantsup,enc_cantpmi,enc_cantdire,enc_canteqfor,enc_cantetj)
		VALUES (NULL,'". $this->ref_nroId."','". $this->enc_tipcapac."','". $this->enc_nroenc."','".$this->enc_fch."','". $this->enc_sede."','". $this->enc_nroesc."','". $this->enc_catering."','". $this->enc_obs."','". $this->enc_esta."','". $this->enc_hsd."','". $this->enc_hsh."','". $this->enc_cantdoc."','". $this->enc_cantrti."','". $this->enc_cantsup."','". $this->enc_cantpmi."','". $this->enc_cantdire."','". $this->enc_canteqfor."','". $this->enc_cantetj."');";
	
		
		if ($conexion->query($sentencia)) {
			
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	public function editar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
				$sentencia="UPDATE encuentros SET ref_nroId = '$this->ref_nroId', enc_tipcapac = '$this->enc_tipcapac', enc_nroenc = '$this->enc_nroenc',enc_fch = '$this->enc_fch', enc_sede = '$this->enc_sede', enc_nroesc = '$this->enc_nroesc', enc_catering = '$this->enc_catering', enc_obs = '$this->enc_obs', enc_esta = '$this->enc_esta' ,enc_hsd = '$this->enc_hsd', enc_hsh = '$this->enc_hsh', enc_cantdoc = '$this->enc_cantdoc', enc_cantrti = '$this->enc_cantrti', enc_cantsup = '$this->enc_cantsup', enc_cantpmi = '$this->enc_cantpmi', enc_cantdire = '$this->enc_cantdire', enc_canteqfor = '$this->enc_canteqfor', enc_cantetj = '$this->enc_cantetj' WHERE enc_nroId = '$this->enc_nroId'";		
		//echo $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	public function getDatos()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM encuentros WHERE ref_nroId=".$this->ref_nroId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado); 
		$this->enc_nroId = $elemento->enc_nroId;
 		$this->ref_nroId = $elemento->ref_nroId;
 		$this->enc_tipcapac =$elemento->enc_tipcapac;
 		$this->enc_nroenc =$elemento->enc_nroenc;
 		$this->enc_fch =$elemento->enc_fch;
 		$this->enc_sede =$elemento->enc_sede;
 		$this->enc_nroesc =$elemento->enc_nroesc;
 		$this->enc_catering =$elemento->enc_catering;
		$this->enc_obs = $elemento->enc_obs; 	
 		$this->enc_esta = $elemento->enc_esta;
 		$this->enc_hsd = $elemento->enc_hsd;
 		$this->enc_hsh = $elemento->enc_hsh;
 		$this->enc_cantdoc =$elemento->enc_cantdoc;
 		$this->enc_cantrti = $elemento->enc_cantrti;
 		$this->enc_cantsup =$elemento->enc_cantsup;
 		$this->enc_cantpmi =$elemento->enc_cantpmi;
 		$this->enc_cantdire = $elemento->enc_cantdire;
 		$this->enc_canteqfor = $elemento->enc_canteqfor;
 		$this->enc_cantetj = $elemento->enc_cantetj;
	
		return $this;
			
    }
	
	   
	public function estructura($campo){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="SHOW COLUMNS FROM encuentros LIKE '$campo'";
		$query=$conexion->query($sentencia);
		$result = mysqli_fetch_assoc($query);
  		$result=$result['Type'];
  		$result=substr($result, 5, strlen($result)-5);
  		$result=substr($result, 0, strlen($result)-2);
  		$result = explode("','",$result);
		return $result;	
	}
		
	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM encuentros";
		if($this->enc_nroId!=NULL || $this->ref_nroId!=NULL || $this->enc_nroenc!=NULL || $this->enc_tipcapac!=NULL || $this->enc_esta!=NULL || $this->enc_nroesc!=NULL)
		{
			$sentencia.=" WHERE ";  
		
		
		if($this->enc_nroId!=NULL)
		{
			$sentencia.=" enc_nroId = $this->enc_nroId && ";
		}
		
		if($this->ref_nroId!=NULL)
		{
			$sentencia.=" ref_nroId = $this->ref_nroId && ";
		}
		
		if($this->enc_nroenc!=NULL)
		{
			$sentencia.=" enc_nroenc=$this->enc_nroenc && ";
		}
		
		if($this->enc_tipcapac!=NULL)
		{
			$sentencia.=" enc_tipcapac='$this->enc_tipcapac' && ";
		}
		
		if($this->enc_esta!=NULL)
		{
			$sentencia.=" enc_esta='$this->enc_esta' && ";
		}
		
		if($this->enc_nroesc!=NULL)
		{
			$sentencia.=" enc_nroesc=$this->enc_nroesc && ";
		}
					
		
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);	
		
		}
		
		$sentencia.="  ORDER BY enc_nroid";	
		//echo $sentencia;	
		return $conexion->query($sentencia);
			
	}
    
}
	
	
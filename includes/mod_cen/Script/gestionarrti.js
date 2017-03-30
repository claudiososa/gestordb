function validacion()
{
	var $dni = $('#txtdni').val();
	var $cuil= $('#txtcuit').val();	
	if( $dni == null || $dni.length == 0 || /^\s+$/.test($dni) || isNaN($dni) || $dni<=0 ) 		{
		alert('[ATENCIÓN] El campo NRO DOCUMENTO debe ser un número positivo mayor que cero.');
		$('#txtdni').focus();
		return false;
	}
		if( $cuil == null || $cuil.length == 0 || /^\s+$/.test($cuil) || isNaN($cuil) || $cuil<=0 ) 		{
		alert('[ATENCIÓN] El campo CUIL debe ser un número positivo mayor que cero.');
		$('#txtcuit').focus();
		return false;
	}
	if($('#txtapellido').val()==""){
		alert('[ATENCIÓN] El campo APELLIDO es obligatorio');
		$('#txtapellido').focus();
		return false;
	}
	if($('#txtnombre').val()==""){
		alert('[ATENCIÓN] El campo NOMBRE es obligatorio');
		$('#txtnombre').focus();
		return false;
	}
	if($('#txtdomicilio').val()==""){
		alert('[ATENCIÓN] El campo DOMICILIO es obligatorio');
		$('#txtdomicilio').focus();
		return false;
	}
	return true;
}
$(function() {
$( "#dialog-form" ).dialog({//ventana de dialogo
	autoOpen: false,
	title:'Detalle RTI',
	width: 1200,
	modal: true,
	show: { effect: "blind"},
	hide: { effect: "blind"},
	buttons: {
		"Registar": function() {
			$txtidesacuela=$('#txtidesacuela').val();
			$idrti=$('#idrti').val();
			$txtidpersona=$('#txtidpersona').val();
			$txtdni=$('#txtdni').val();
			$txtdomicilio=$('#txtdomicilio').val();
			$txtcuit=$('#txtcuit').val();
			$txttelefono1=$('#txttelefono1').val();
			$txttelefono2=$('#txttelefono2').val();
			$txtemail1=$('#txtemail1').val();
			$txtemail2=$('#txtemail2').val();
			$txtfacebook=$('#txtfacebook').val();
			$txttwitter=$('#txttwitter').val();
			$txtcp=$('#txtcp').val();
			$txtapellido=$('#txtapellido').val();
			$txtnombre=$('#txtnombre').val();
			$txtidpersona=$('#txtidpersona').val();
			$cbestado=$('#cbestado').val();
			$cblocalidad=$('#cblocalidad').val();
			$cbturno=$('#cbturno').val();
			if($idrti>0){//si estoy editando un RTI
				if(validacion()){
					$.post( "includes/mod_cen/clases/rti.php",{opcion:'modificarrti',idrti:$idrti,txtdni:$txtdni,txtdomicilio:$txtdomicilio,txtcuit:$txtcuit,txttelefono1:$txttelefono1,txttelefono2:$txttelefono2,txtemail1:$txtemail1,txtemail2:$txtemail2,txtfacebook:$txtfacebook,txttwitter:$txttwitter,txtcp:$txtcp,txtapellido:$txtapellido,txtnombre:$txtnombre,txtidpersona:$txtidpersona,cbestado:$cbestado,cblocalidad:$cblocalidad,cbturno:$cbturno,txtidesacuela:$txtidesacuela}, function(data) 
						
							{
							if(data!=0){//Si existe se modifico el rti
								alert("El Referente fué modificado con éxito");
								$url='index.php?mod=slat&men=referentes&id=8&escuelaId='+$txtidesacuela;
								window.location=$url;
								
							}
							else
							{
								alert('[ALERTA] No se pudo modificar el RTI. Vuelva a intentarlo más tarde.' );
								$( this ).dialog( "close" );
							}
						
					
					});
					}
				}
			else//Estoy cargando un nuevo RTI
			{
				if(validacion()){
					$.post( "includes/mod_cen/clases/rti.php",{opcion:'registrarrti',idrti:$idrti,txtdni:$txtdni,txtdomicilio:$txtdomicilio,txtcuit:$txtcuit,txttelefono1:$txttelefono1,txttelefono2:$txttelefono2,txtemail1:$txtemail1,txtemail2:$txtemail2,txtfacebook:$txtfacebook,txttwitter:$txttwitter,txtcp:$txtcp,txtapellido:$txtapellido,txtnombre:$txtnombre,txtidpersona:$txtidpersona,cbestado:$cbestado,cblocalidad:$cblocalidad,cbturno:$cbturno,txtidesacuela:$txtidesacuela}, function(data) 
						
							{
							if(data!=0){//Si existe se modifico el rti
								alert("El Referente fué registrado con éxito");
								$url='index.php?mod=slat&men=referentes&id=8&escuelaId='+$txtidesacuela;
								window.location=$url;
								
							}
							else
							{
								alert('[ALERTA] No se pudo registrar el RTI. Vuelva a intentarlo más tarde.' );
								$( this ).dialog( "close" );
							}
						
					
					});
				}
			}
	
					
		},
		"Eliminar": function() {
			confirmar=confirm("[ATENCIÓN] ¿Está Seguro de Eliminar el RTI para esta Institución?");  
				if(confirmar){
					$idrti=$('#idrti').val();
					$txtidesacuela=$('#txtidesacuela').val();
					$.post( "includes/mod_cen/clases/rti.php",{opcion:'eliminarrti',idrti:$idrti,txtidesacuela:$txtidesacuela}, function(data){					
						if(data!=0){
							alert("El Referente fué eliminado con éxito");
							$url='index.php?mod=slat&men=referentes&id=8&escuelaId='+$txtidesacuela;
							window.location=$url;
						}
						else
						{
							alert('[ATENCIÓN] El RTI no pudo ser eliminado. Intentelo más tarde.');
						}
					});
				}
		},
		Cancelar: function() {
		$( this ).dialog( "close" );
		}
		}
	});
$('#txtdni').blur(function(evento){
	
		
		var $dni=$('#txtdni').val();
		if($dni.trim()!=""){//si se cargo algo en el campo nro de documento busca la persona y si existe la carga
			$.post( "includes/mod_cen/clases/supervisor.php",{opcion:'buscarpordni',dni:$dni}, function(data) 			{					if(data!=0){//Si existe una persona con el dni ingresado
						var $resultado= JSON.parse(data);
						$autoridad=$resultado['apellido']+', '+$resultado['nombre'];
						$('#txtdomicilio').val($resultado['direccion']);
						$('#txtcuit').val($resultado['cuil']);
						$('#txttelefono1').val($resultado['telefonoC']);
						$('#txttelefono2').val($resultado['telefonoM']);
						$('#txtemail1').val($resultado['email']);
						$('#txtemail2').val($resultado['email2']);
						$('#txtfacebook').val($resultado['facebook']);
						$('#txttwitter').val($resultado['twitter']);
						$('#txtcp').val($resultado['cpostal']);
						$('#txtapellido').val($resultado['apellido']);
						$('#txtnombre').val($resultado['nombre']);
						$('#txtidpersona').val($resultado['personaId']);
						var selectRol = $("select#cblocalidad");
						selectRol.val($resultado['localidadId']).attr('selected', 'selected');
					}
					else
					{
						alert('No existe ninguna persona registrada con el Nro. de Documento: '+$('#txtdni').val()+'.Por favor cargue los datos correspondientes' );
						$(".hades").val("");
						$('#txtidpersona').val('');
						//$('#txtdni').focus();
						$('#txtapellido').focus();
					}
				
			
			});
			//.done(function() {
//			alert( "second success" );
//			})
//			.fail(function() {
//			alert( "error" );
//			})
//			.always(function() {
//			alert( "finished" );
//			});
		}
   		 
});
	
$('.editarrti').click(function(evento){
	$valorboton=parseInt($(this).attr('id'));//tomo el valor del boton de presionado respecto a la clase editarrti
	$('#cbestado option').attr('selected', false);
	if(!$valorboton){//si hago clic en el boton Editar
		$('#form1')[0].reset();
		$('#idrti').val(0);//reseteo el idrti a 0
		var selectRol = $("select#cbestado");
		selectRol.val('EN EJERCICIO').attr('selected', 'selected');
		$( "#dialog-form" ).dialog( "open" );//Abro ventana de dialogo
		exit();
	}
	if($valorboton){//si hago clic en el boton Editar
		$idrti=$(this).attr('id');//Nro de id de persona del RTI 
		$('#idrti').val($(this).attr('id'));
		$.post( "includes/mod_cen/clases/rti.php",{opcion:'buscarporid',idrti:$idrti}, function(data) 				{		
						if(data!=0){//Si existe una persona con el dni ingresado
							var $resultado= JSON.parse(data);
							$('#txtdni').val($resultado['dni']);
							$('#txtdomicilio').val($resultado['direccion']);
							$('#txtcuit').val($resultado['cuil']);
							$('#txttelefono1').val($resultado['telefonoC']);
							$('#txttelefono2').val($resultado['telefonoM']);
							$('#txtemail1').val($resultado['email']);
							$('#txtemail2').val($resultado['email2']);
							$('#txtfacebook').val($resultado['facebook']);
							$('#txttwitter').val($resultado['twitter']);
							$('#txtcp').val($resultado['cpostal']);
							$('#txtapellido').val($resultado['apellido']);
							$('#txtnombre').val($resultado['nombre']);
							$('#txtidpersona').val($resultado['personaId']);
							var selectRol = $("select#cbestado");
							selectRol.val($resultado['estado']).attr('selected', 'selected');
							var selectRol = $("select#cblocalidad");
							selectRol.val($resultado['localidadId']).attr('selected', 'selected');
							//$('#cbestado option').attr('selected', false);
							//$('#cbestado').find($estado).attr('selected',true);
							var selectRol = $("select#cbturno");
							selectRol.val($resultado['turno']).attr('selected', 'selected');
							
							$('#txttipodecargo').focus();
						}
						else
						{
							alert('No existe ninguna persona registrada con el Nro. de Documento: '+$('#txtdni').val()+'.Por favor cargue los datos correspondientes' );
							$(".hades").val("");
							$('#txtidpersona').val('');
							//$('#txtdni').focus();
							$('#txtapellido').focus();
						}
					
				
				});
				$( "#dialog-form" ).dialog( "open" );//Abro ventana de dialogo
		exit();
	}	

	
	
	
});
});

function validacion()
{
	var $dni = $('#txtdni').val();
	var $cuil= $('#txtcuit').val();
	if( $dni == null || $dni.length == 0 || /^\s+$/.test($dni) || isNaN($dni) || $dni<0 ) 		{
		alert('[ATENCIÓN] El campo NRO DOCUMENTO debe ser un número positivo o cero.');
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
	if($('#txttipodecargo').val()==""){
		alert('[ATENCIÓN] El campo CARGO es obligatorio');
		$('#txttipodecargo').focus();
		return false;
	}
	if($('#txtdomicilio').val()==""){
		alert('[ATENCIÓN] El campo DOMICILIO es obligatorio');
		$('#txtdomicilio').focus();
		return false;
	}
	$('#form1').submit();

}
$(document).ready(function(){
   	$("#txtdni").keypress(function(e){
			if (e.which == '13') {
				$("#txtdni").blur();
			}
	});
	$("#cmdlimpiar").click(function(){
		 $('#form1')[0].reset();
		 $('#txtdni').focus();
	});
	$("#cmdregistrar").click(function(){
		 validacion();
	});
    $("#txtdni").blur(function(){
		var $dni=$('#txtdni').val();
		if($dni.trim()!=""){//si se cargo algo en el campo nro de documento busca la persona y si existe la carga
			$.post( "includes/mod_cen/clases/rti.php",{opcion:'buscarpordni',dni:$dni}, function(data) 			{
					if(data!=0){//Si existe una persona con el dni ingresado
						var $resultado= JSON.parse(data);
						//alert($resultado['personaId']);
						$autoridad=$resultado['apellido']+', '+$resultado['nombre'];
						$('#autoridad').html($autoridad);
						//$(".hades").attr("disabled","disabled");
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
						$idlocalidad="option[value="+$resultado['localidadId']+"]";
						//$idtipoautoridad="option[value="+$resultado['tipoautoridad_id']+"]";
						//alert($idtipoautoridad);
						$('#cblocalidad').find($idlocalidad).attr('selected',true);
						//$('#cbtipoautoridad').find($idtipoautoridad).attr('selected',true);
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
			/*.done(function() {
			alert( "second success" );
			})
			.fail(function() {
			alert( "error" );
			})
			.always(function() {
			alert( "finished" );
			});*/
		}
   		 });

});

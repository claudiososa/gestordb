$('#cmdregistrar').attr("value","Modificar");
var $dni=$('#txtdni').val();

if($dni.trim()!=""){

	$.post( "includes/mod_cen/clases/rti.php",{opcion:'buscarpordni',dni:$dni}, function(data) 			{


			if(data!=0){
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
				//$idtipoautoridad="option[value="+$('#idautoridad').val()+"]";
				//alert($idtipoautoridad);
				$('#cblocalidad').find($idlocalidad).attr('selected',true);
				//$('#cbtipoautoridad').find($idtipoautoridad).attr('selected',true);
				$('#txtapellido').focus();
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
$('#txtidpersona').val($resultado['personaId']);
//$('#txtdni').attr("enabled","enabled");

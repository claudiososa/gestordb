	<?php
		include_once('includes/mod_cen/clases/escuela.php');
		include_once('includes/mod_cen/clases/EscuelaReferentes.php');
		include_once('includes/mod_cen/clases/FacilEscuelas.php');
		if (!empty($_GET['id']) AND isset($_SESSION["tipo"]))
		{
		$id=$_GET['id'];
		$men=$_GET['men'];
		switch ($men){
			case "personas":
				switch ($id) {
					case 1:
						include("includes/mod_cen/persona_ver.php");
						break;
					case 2:
						include("includes/mod_cen/personas/persona_vermas.php");
						break;
					case 3:
						if($_GET["personaId"]==$_SESSION["personaId"] OR $_SESSION["tipo"=="admin"]) {
							include("includes/mod_cen/personas/persona_editar.php");
						}else {
							include("includes/mod_cen/denegado.php");
						}

						break;
					case 4:
						include("includes/mod_cen/persona_editado.php");
						break;
					case 5:
						include("includes/mod_cen/persona_eliminar.php");
						break;
					case 6:
						if($_GET["personaId"]==$_SESSION["personaId"]) {
							include("includes/mod_cen/usuarios/cambio_pass.php");
						}else {
							include("includes/mod_cen/denegado.php");
						}
						break;
					case 7:
							include("includes/mod_cen/personas/persona_ver_director.php");
							break;
					case 8:
							include("includes/mod_cen/personas/vicedirector_nuevo.php");
							break;

					case 9:
							include("includes/mod_cen/personas/listado_vicedirector.php");
							break;

					case 10:
							include("includes/mod_cen/personas/vicedirector_editar.php");
							break;
					case 11:
							include("includes/mod_cen/personas/vicedirector_borrar.php");
							break;

				}
				break;
				case "mensajes":
					switch ($id) {
						case 1:
							include("includes/mod_cen/mensajes/nuevoMensaje.php");
							break;
						case 2:
							include("includes/mod_cen/mensajes/misMensajes.php");
							break;
						case 3:
							include("includes/mod_cen/mensajes/leerMensaje.php");
							break;
						case 4:
						include("includes/mod_cen/mensajes/responderMensaje.php");

							break;

					}
					break;
			case "referentes":
				switch ($id) {
					case 1:
						include("includes/mod_cen/referentes/referente_ver.php");
						break;
					case 2:
						include("includes/mod_cen/referentes/referente_vermas.php");
						break;
					case 3:
						include("includes/mod_cen/admin/referente_editar_admin.php");
						break;
					case 4:
						include("includes/mod_cen/admin/referente_editado.php");
						break;
					case 5:
						include("includes/mod_cen/referente_eliminar.php");
						break;
					case 6:
						include("includes/mod_cen/referente_cambiaretj.php");
						break;
					case 7:
						include("includes/mod_cen/referente_seleccionar.php");
						break;
					case 8:
						include("includes/mod_cen/rti/rti_escuela.php");
						break;
					case 9:
						include("includes/mod_cen/rti/rti_escuela_ver.php");
						break;
					case 10:
							include("includes/mod_cen/referentes/rti_ver.php");
							break;
					case 11:
								include("includes/mod_cen/facilitador/verxEscuelas.php");
								break;
					case 12:
								include("includes/mod_cen/facilitador/verHorarioFacilitadores.php");
								break;
					case 13:
								include("includes/mod_cen/referentes/referente_verEF.php");
						break;


				}
				break;
			case "escuelas":
				switch ($id) {
					case 1:
						include("includes/mod_cen/escuelas/escuela_ver_ett.php");
						break;
					case 2:
						include("includes/mod_cen/escuelas/escuela_vermas.php");
						break;
					case 3:
							if(isset($_GET["escuelaId"])) {

								if ($_SESSION["tipo"]<>'Facilitador'){


								switch ($_SESSION["tipo"]) {
									case 'ETT':
												$referente = new EscuelaReferentes(null,$_GET["escuelaId"],'19',$_SESSION['referenteId']);
												break;
									case 'ETJ':
												$escuela=new Escuela($_GET["escuelaId"],$_SESSION['referenteId']);
															break;
									case 'ATT':
												$escuela= new Escuela($_GET["escuelaId"],null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,$_SESSION['referenteId']);
												break;
									case 'Supervisor-Secundaria':
															$escuela= new Escuela($_GET["escuelaId"],null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,$_SESSION['referenteId']);
															break;
									case 'SupervisorAdultos':
															$escuela= new Escuela($_GET["escuelaId"],null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,$_SESSION['referenteId']);
															break;

									default:
										# code...
										break;
								}

								//$b_escuela= $escuela->buscarRef($_SESSION["tipo"]);
								$buscarReferente= $referente->buscar();
								$dato_escuela=mysqli_num_rows($buscarReferente);

							}else{
								$escuela = new FacilEscuelas(null,null,$_SESSION["referenteId"]);
								$b_escuela = $escuela->buscar();
								$dato_escuela=mysqli_num_rows($b_escuela);

							}

								if($dato_escuela>0 || $_SESSION['tipo']=='admin') {
							  		include("includes/mod_cen/escuelas/escuela_editar.php");
								}else {
									include("includes/mod_cen/denegado.php");
								}
							}

						break;
					case 4:
						include("includes/mod_cen/escuelas/escuela_editado.php");
						break;
					case 5:
						include("includes/mod_cen/escuela_eliminar.php");
						break;
					case 6:
						include("includes/mod_cen/escuela_ett.php");
						break;
					case 7:
						if(isset($_GET["escuelaId"])) {
							$escuela=new Escuela($_GET["escuelaId"],$_SESSION['referenteId']);
							$b_escuela= $escuela->buscarRef();
							$dato_escuela=mysqli_num_rows($b_escuela);
							if($dato_escuela>0 || $_SESSION['tipo']=='admin') {
							   include("includes/mod_cen/escuela_adm.php");
							}else {
								include("includes/mod_cen/denegado.php");
							}
						}else {
							include("includes/mod_cen/escuela_adm.php");
							}
						/*if($_GET["personaId"]==$_SESSION["personaId"]) {
							include("includes/mod_cen/usuarios/cambio_pass.php");
						}else {
							include("includes/mod_cen/denegado.php");
						}	*/
						break;
						case 8:
						include("includes/mod_cen/escuela_piso.php");
						break;
						case 9:
							include("includes/mod_cen/admin/escuela_ver_admin.php");
						break;
						case 10:
							include("includes/mod_cen/escuela_vermas_admin.php");
						break;
						case 11:
							include("includes/mod_cen/escuela_adm_ver.php");
						break;
						case 12:
							include("includes/mod_cen/escuela_adm_etj.php");
						break;
						case 13:
							include("includes/mod_cen/cargarAutoridad.Cuerpo.php");//sin autoridad
							break;
						case 14:
							include("includes/mod_cen/director_vermas.php");
							break;//editar autoridad
						case 15:
							include("includes/mod_cen/cargarSupervisor.Cuerpo.php");////Detalle-Carga Supervisor
							break;
						case 16:
								include("includes/mod_cen/rti_ver_escuela.php");
								break;
						case 17:
									include("includes/mod_cen/rti/rti_escuela.php");
									break;
						case 18:
									include("includes/mod_cen/escuelas/escuela_ver_etj.php");
										break;
						case 19:
									include("includes/mod_cen/escuelas/buscarRelevamiento.php");
								  break;
						case 20:
									include("includes/mod_cen/escuelas/relevElectricoNuevo.php");
								  break;
						case 21:
									include("includes/mod_cen/escuelas/agregarAulaSatelite.php");
								  break;
						case 22:
									include("includes/mod_cen/escuelas/relevamientoAulaSatelite.php");
									break;
						case 23:
									include("includes/mod_cen/escuelas/escuelaDatosBasicos.php");
									break;

						case 24:
									include("includes/mod_cen/escuelas/agregarEscuelas.php");
								  break;
						case 25:

									include("includes/mod_cen/escuelas/escuela_ver_EF.php");
								  break;
						case 26:

									include("includes/mod_cen/escuelas/nuevoTipoAutoridades.php");
								  break;

						case 27:

									include("includes/mod_cen/escuelas/listarTipoAutoridades.php");
								  break;
					    case 28:

									include("includes/mod_cen/escuelas/updateTipoAutoridades.php");
								  break;

						 case 29:

									include("includes/mod_cen/escuelas/nuevaAutoridad.php");
								  break;
						 case 30:

									include("includes/mod_cen/escuelas/listarAutoridades.php");
								  break;
						 case 31:
								 	include("includes/mod_cen/escuelas/misEscuelasSuper.php");
								 	break;
						case 32:
								 	include("includes/mod_cen/escuelas/escuela_ver_PL.php");
								 	break;
						case 33:
								 	include("includes/mod_cen/escuelas/escuelaVerSuperPrimaria.php");
								 	break;



				}
				break;
			 case "encuentros":
				  switch ($id) {
					case 1:
					    include("includes/mod_cen/nuevo_encuentro.php");
						break;
					case 2:
						include("includes/mod_cen/ver_encuentros.php");
						break;
					case 3:
						include("includes/mod_cen/encuentros_ver_todos.php");
						break;
					case 4:
						include("includes/mod_cen/editar_encuentro.php");
						break;
					case 5:
						include("includes/mod_cen/editado_encuentro.php");
						break;
					case 6:
						include("includes/mod_cen/encuentro_detalle.php");
						break;
				}
				break;
			case "rtis":
				switch ($id) {
					case 1:
						include("includes/mod_cen/rti_ver.php");
						break;
					case 2:
						include("includes/mod_cen/rti_vermas.php");
						break;
					case 3:
						if($_SESSION["tipo"]=="admin")
						 {
							include("includes/mod_cen/rti_editar.php");
						 }else {
						 	include("includes/mod_cen/persona_editar.php");
							}
						break;

					case 4:
						include("includes/mod_cen/rti_editado.php");
						break;
					case 5:
						include("includes/mod_cen/rti_eliminar.php");
						break;
					case 6:
						include("includes/mod_cen/rti_editarescuela.php");
						break;
					case 7:
						include("includes/mod_cen/rti_crear.php");
						break;
					case 8:
						include("includes/mod_cen/rti_creado.php");
						break;
					case 9:
						include("includes/mod_cen/rti_seleccionar.php");
						break;
					case 10:
						include("includes/mod_cen/rti_agregar.php");
						break;
					case 11:
						include("includes/mod_cen/rti_agregado.php");
						break;
					case 12:
							include("includes/mod_cen/rti/editarRti.php");
							break;
					case 13:
									include("includes/mod_cen/rti/eliminarRti.php");
									break;
				 case 14:
								include("includes/mod_cen/rti/nuevoRti.php");
								break;
				}
				break;
			case "user":
				switch ($id) {
				case 1:
						include("includes/mod_cen/cerrar.php");
						break;
				case 2:
						include("includes/mod_cen/referentes/referente_ett.php");
						break;
				case 3:
						include("includes/mod_cen/escuelas/misEscuelasEtt.php");
						break;
				case 4:
						include("includes/mod_cen/rti/rti_ett.php");
						break;
				case 5:
						include("includes/mod_cen/escuelas/escuela_ett_etj.php");
						break;
				case 6:
							include("includes/mod_cen/rti/rti_ett_etj.php");
							break;
				case 7:
							include("includes/mod_cen/referentes/referente_ett_todos.php");
							break;
				case 8:
							include("includes/mod_cen/referentes/referente_etj_todos.php");
							break;
				case 9:
							include("includes/mod_cen/referentes/referente_att_todos.php");
							break;
			  case 10:
							if($_SESSION['tipo']=='admin' || $_SESSION['tipo']=='DirectorNivelSecundario') {
					 				include("includes/mod_cen/referentes/referenteSupervisores.php");
							}else {
									include("includes/mod_cen/denegado.php");
							}
							break;
				case 11:
							include("includes/mod_cen/escuelas/escuelaSuperSec.php");
							break;
				case 12:
							include("includes/mod_cen/escuelas/escuelasSupervisorSec.php");
							break;
				case 13:
							include("includes/mod_cen/escuelas/escuelasSupervisorSuperior.php");
							break;
				case 14:
										if($_SESSION['tipo']=='admin' || $_SESSION['tipo']=='DirectorNivelSuperior') {
								 				include("includes/mod_cen/referentes/referenteSupervisores.php");
										}else {
												include("includes/mod_cen/denegado.php");
										}
										break;




				break;
				case 15:
				include("includes/mod_cen/referentes/referente_ett.php");
				break;
				case 16:
				include("includes/mod_cen/escuelas/escuelasSupervisorAdultos.php");
				break;
				case 17:
				include("includes/mod_cen/escuelas/escuela_facilitador.php");
				break;
				case 18:
						include("includes/mod_cen/referentes/referente_facilitador.php");
						break;
				case 19:
								include("includes/mod_cen/escuelas/escuela_facilitador_coordinador.php");
								break;
				case 20:
								include("includes/mod_cen/escuelas/escuelaDatosDirectivo.php");
								break;
				case 21:
								include("includes/mod_cen/escuelas/escuelaHorario.php");
								break;
				case 22:
								include("includes/mod_cen/escuelas/misEscuelasSuper.php");
								break;
				case 23:
								include("includes/mod_cen/referentes/referente_cu_todos.php");
								break;
				case 24:
								include("includes/mod_cen/escuelas/misEscuelasCAS.php");
								break;
}


				case "doc":
					switch ($id) {
					case 1:
							include("includes/mod_cen/documentos/documento.php");
							break;
					case 2:
						  include("includes/mod_cen/documentos/etj.php");
							break;
					case 3:
								  include("includes/mod_cen/documentos/att.php");
									break;
					case 4:
									include("includes/mod_cen/documentos/coordinador-pmi.php");
									break;
					case 5:
									include("includes/mod_cen/documentos/coordinador-conectar.php");
									break;
					case 6:
													include("includes/mod_cen/documentos/coordinadorfacilitador.php");
													break;
					case 7:
					         include("includes/mod_cen/documentos/documentoPortadas.php");
					break;
					}
					break;
					case "estadistica":
						switch ($id) {
						case 1:
								include("includes/mod_cen/estadisticas/estadisPermer.php");
								break;
						case 2:
								include("includes/mod_cen/estadisticas/estadisticaDispositivo1.php");
								break;
						}
						break;
//				 nueva entrada para prof de educacion fisica

						case "edFisica":
						switch ($id) {
						case 1:
								include("includes/mod_cen/escuelas/escuelaEdFisica.php");
								//include("includes/mod_cen/edFisica/nuevoProfe.php");
								break;

						}
						break;

						case "videoTutorial":
						switch ($id) {
						case 1:
								include("includes/mod_cen/videoTutorial/videoTutorial.php");
								//include("includes/mod_cen/edFisica/nuevoProfe.php");
								break;

						}
						break;




				case "informe":
					switch ($id) {
						case 1:
							include("includes/mod_cen/informes/new_update_report.php");
							break;
						case 2:
							include("includes/mod_cen/informes/list_view_report.php");
							break;
						case 3:
							include("includes/mod_cen/informes/view_report.php");
							break;
						case 4:
							include("includes/mod_cen/informes/list_view_report_ett.php");
							break;
						case 5:
							include("includes/mod_cen/escuela_ett_etj.php");
							break;
						case 6:
							include("includes/mod_cen/informes/list_my_report.php");
							break;
						case 7:
							include("includes/mod_cen/informes/new_update_response.php");
							break;
						case 8:
							include("includes/mod_cen/informes/summary_report.php");
							break;
					 	case 9:
							include("includes/mod_cen/informes/calendarByMonth.php");
							break;
					 	case 10:
							include("includes/mod_cen/informes/nuevoTipoInforme.php");
							 break;
					 	case 11:
					 		include("includes/mod_cen/informes/buscarEditarTipoInforme.php");
					 		break;

					 	 case 12:
					        include("includes/mod_cen/informes/nuevoSubTipoInforme.php");
					 		break;

					 	 case 13:
					    	include("includes/mod_cen/informes/listarSubtipo.php");
					 		break;

					     case 14:
					        include("includes/mod_cen/informes/update_subtipo_informe.php");
					 		break;
					     case 15:
					        include("includes/mod_cen/informes/delete_subtipo_informe.php");
					 		break;
					 	case 16:
					    	include("includes/mod_cen/informes/nuevaCategoriaDoc.php");
					 		break;
					 	case 17:
					    	include("includes/mod_cen/documentos/nuevo_documento.php");
					 		break;
					 	case 18:
					    	include("includes/mod_cen/informes/listarCategoriaDoc.php");
					 		break;
					 	case 19:
					    	include("includes/mod_cen/informes/modificarCategoriaDoc.php");
					 		break;
					 	case 20:
					    	include("includes/mod_cen/documentos/listarDocumentos.php");
					 		break;
					 	case 21:
					    	include("includes/mod_cen/documentos/modificarDocumento.php");
					 		break;
						case 22:
								include("includes/mod_cen/informes/list_my_report_escuela.php");
								break;
						case 23:
										include("includes/mod_cen/informes/permer.php");
										break;
						case 24:
									 include("includes/mod_cen/informes/permerAulas.php");
									 break;
						case 25:
									 include("includes/mod_cen/informes/buscarInformesAutoridad.php");
	 								 break;

					}
					break;

			case "admin":
				switch ($id) {
				case 1:
						include("includes/mod_cen/admin/escuela_crear.php");
						break;
				case 2:
						include("includes/mod_cen/referente_ett.php");
						break;
				case 3:
							if($_SESSION['tipo']=='Coordinador'
								|| $_SESSION['tipo']=='admin'
							  || $_SESSION['tipo']=='SupervisorGeneralSuperior'
						    || $_SESSION['tipo']=='DirectorNivelSuperior'
					      || $_SESSION['tipo']=='Supervisor-General-Secundaria'
								|| $_SESSION['tipo']=='DirectorNivelSecundario'
								|| $_SESSION['tipo']=='CoordinadorPmi'
								|| $_SESSION['tipo']=='ETJ')
							{
							   include("includes/mod_cen/admin/loginc.php");
							}else {
								include("includes/mod_cen/denegado.php");
							}
						break;
				case 4:
						include("includes/mod_cen/admin/escuela_ver_admin.php");
						break;
				case 5:
						include("includes/mod_cen/admin/escuela_ver_admin_ett.php");
						break;
				case 6:
						if($_SESSION['tipo']=='Coordinador' || $_SESSION['tipo']=='admin' || $_SESSION['tipo']=='ETJ') {
							include("includes/mod_cen/admin/escuela_asignar_admin.php");
						}else {
							include("includes/mod_cen/denegado.php");
						}
						break;
				case 7:
							if($_SESSION['tipo']=='Coordinador' || $_SESSION['tipo']=='admin') {
								include("includes/mod_cen/admin/escuela_editar_admin.php");
							}else {
								include("includes/mod_cen/denegado.php");
							}
							break;

				case 8:
									//if($_SESSION['tipo']=='CoordinadorPMI' || $_SESSION['tipo']=='admin') {
										include("includes/mod_cen/admin/escuelaAsignarPmi.php");
								//	}else {
								//		include("includes/mod_cen/denegado.php");
								//	}
									break;

				case 9:
								//if($_SESSION['tipo']=='CoordinadorPMI' || $_SESSION['tipo']=='admin') {
								include("includes/mod_cen/admin/escuelaAsignarSuperSec.php");
								//	}else {
							//		include("includes/mod_cen/denegado.php");
								//	}
								break;
					case 10:
								//if($_SESSION['tipo']=='CoordinadorPMI' || $_SESSION['tipo']=='admin') {
									include("includes/mod_cen/admin/escuelaAsignarSuperSuperior.php");
									//	}else {
								//		include("includes/mod_cen/denegado.php");
									//	}
								break;
						case 11:
											if($_SESSION['tipo']=='DirectorNivelSecundario' || $_SESSION['tipo']=='admin') {
											   include("includes/mod_cen/admin/loginc.php");
											}else {
												include("includes/mod_cen/denegado.php");
											}
										break;
							case 12:
															//if($_SESSION['tipo']=='CoordinadorPMI' || $_SESSION['tipo']=='admin') {
																include("includes/mod_cen/admin/escuelasAsignarAdultos.php");
														//	}else {
														//		include("includes/mod_cen/denegado.php");
														//	}
															break;
								case 13:
															//if($_SESSION['tipo']=='CoordinadorPMI' || $_SESSION['tipo']=='admin') {
															include("includes/mod_cen/admin/escuelaAsignarFacilitador.php");
															//	}else {
												    	//		include("includes/mod_cen/denegado.php");
															//	}
															break;
								 case 14:
														//if($_SESSION['tipo']=='CoordinadorPMI' || $_SESSION['tipo']=='admin') {
														include("includes/mod_cen/admin/detalleFacilitadores.php");
														//	}else {
											    	//		include("includes/mod_cen/denegado.php");
														//	}
														break;
									case 15:
														if($_SESSION['tipo']=='DNP' || $_SESSION['tipo']=='SGP' || $_SESSION['tipo']=='admin') {
																include("includes/mod_cen/admin/escuelaAsignarSNP.php");

														}else {
																include("includes/mod_cen/denegado.php");
														}
														break;
									case 16:
														if($_SESSION['tipo']=='DNP' || $_SESSION['tipo']=='SGP' || $_SESSION['tipo']=='admin') {
																include("includes/mod_cen/admin/escuelaAsignarSEP.php");

														}else {
																include("includes/mod_cen/denegado.php");
														}
														break;


									case 17:
														if($_SESSION['tipo']=='DNP' || $_SESSION['tipo']=='SGP' || $_SESSION['tipo']=='admin') {
																include("includes/mod_cen/admin/escuelaAsignarSI.php");

														}else {
																include("includes/mod_cen/denegado.php");
														}
														break;
									case 18:
														if($_SESSION['tipo']=='DNP' || $_SESSION['tipo']=='SGP' || $_SESSION['tipo']=='admin') {
																include("includes/mod_cen/admin/escuelaAsignarSH.php");

														}else {
																include("includes/mod_cen/denegado.php");
														}

														break;
									case 19:
														if($_SESSION['tipo']=='DNP' || $_SESSION['tipo']=='SGP' || $_SESSION['tipo']=='admin') {
																include("includes/mod_cen/admin/escuelaAsignarSR.php");

														}else {
																include("includes/mod_cen/denegado.php");
														}
														break;
									case 20:
														if($_SESSION['tipo']=='DNP' || $_SESSION['tipo']=='SGP' || $_SESSION['tipo']=='admin') {
																include("includes/mod_cen/admin/escuelaAsignarSP.php");

														}else {
																include("includes/mod_cen/denegado.php");
														}
														break;
									case 21:
														if($_SESSION['tipo']=='Coordinador' || $_SESSION['tipo']=='admin' || $_SESSION['tipo']=='ETJ') {
																include("includes/mod_cen/admin/escuela_asignar_admin_Ett.php");
														}else {
																include("includes/mod_cen/denegado.php");
														}
														break;
									case 22:
														if($_SESSION['tipo']=='Coordinador' || $_SESSION['tipo']=='admin' || $_SESSION['tipo']=='ETJ') {
																include("includes/mod_cen/admin/escuela_asignar_admin_Etj.php");
														}else {
																include("includes/mod_cen/denegado.php");
														}
														break;
									case 23:
																include("includes/mod_cen/admin/escuelaNuevo_ver_admin.php");
																break;
									case 24:
													if($_SESSION['tipo']=='Coordinador' || $_SESSION['tipo']=='admin' || $_SESSION['tipo']=='ETJ') {
															include("includes/mod_cen/admin/escuela_asignar_admin_Cas.php");
													}else {
															include("includes/mod_cen/denegado.php");
													}
													break;


				}

			//   default:
			 //      include("pagina_por_defecto.php");
			// estado default .. nos determina el estado
			// "si no es ninguna opcion de las anteriores".
		}
		}
			else {
			include("includes/mod_cen/login_f.php");
			//echo "modulo principal de contenidos";
			}
	?>

<?php 

class ControladorUsuarios 
{
	static public function ctrIngresoUsuario()  
	{
		if(isset($_POST["ingUsuario"]))
		{
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])) 
			{
				$tabla = "usuarios";
				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::mdlIngresoUsuario($tabla,$item,$valor);

				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["paswword"] == $_POST["ingPassword"])
				{
					if($respuesta["estado"] != 0)
					{
						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["perfil"] = $respuesta["perfil"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["foto"] = $respuesta["foto"];

						echo '<script>

							window.location = "inicio";

						</script>';
					}
					else
					{
						echo '<script>

							swal({

									title: "¡Usuario no activado!",
									type: "error",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								})

						</script>';
					}
				}
				else
				{
					echo '<script>

						swal({

								title: "¡Error al ingresar!",
								text: "Por favo intentelo de nuevo",
								type: "error",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							})

					</script>';
				}
			}
		}
	}

	static public function ctrMostrarUsuarios($item,$valor)
	{
		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlIngresoUsuario($tabla,$item,$valor);

		return $respuesta;
	}

	static public function ctrCrearUsuario()
	{
		if(isset($_POST["nuevoNombre"]))
		{
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]))
			{
				$ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"]))
				{
					list($ancho,$alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

					mkdir($directorio,0755);

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg")
					{
						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino,$ruta);
					}

					if($_FILES["nuevaFoto"]["type"] == "image/png")
					{
						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino,$ruta);
					}
				}

				$tabla = "usuarios";
				$datos = array("nombre"=>$_POST["nuevoUsuario"] ,
				   			   "usuario"=>$_POST["nuevoNombre"] ,
				   			   "paswword"=>$_POST["nuevoPassword"] ,
				   			   "perfil"=>$_POST["nuevoPerfil"] ,
				   			   "foto"=>$ruta);

				$respuesta = ModeloUsuarios::mdlCrearUsuario($tabla,$datos);

				if($respuesta == "ok")
				{
					echo '<script>

						swal({

								title: "¡Usuario creado!",
								type: "success",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(respuesta){

									if(respuesta.value)
									{
										window.location = "usuarios";
									}

								});

					</script>';
				}
			}
			else
			{
				echo '<script>

					swal({

							title: "¡Error al crear usuario!",
							text: "La contraseña y el usuario no pueden contener espacios ni simbolos",
							type: "error",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(respuesta){

								if(respuesta.value)
								{
									window.location = "usuarios";
								}

							});

				</script>';
			}
		}
	}

	static public function ctrEditarUsuario()
	{
		if(isset($_POST["editarNombre"]))
		{
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"]))
			{
				$respuesta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"]))
				{
					list($ancho,$alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					if(!empty($_POST["fotoActual"]))
					{
						unlink($_POST["fotoActual"]);
					}
					else
					{
						mkdir($directorio,0755);
					}

					if($_FILES["editarFoto"]["type"] == "image/jpeg")
					{
						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino,$ruta);
					}

					if($_FILES["editarFoto"]["type"] == "image/png")
					{
						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino,$ruta);
					}
				}

				$tabla = "usuarios";
				$datos = array("nombre"=>$_POST["editarNombre"] ,
				 			   "usuario"=>$_POST["editarUsuario"] ,
				 			   "paswword"=>$_POST["editarPassword"] ,
				 			   "perfil"=>$_POST["editarPerfil"] ,
				 			   "foto"=>$ruta);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla,$datos);

				if($respuesta == "ok")
				{
					echo '<script>

						swal({

								title: "¡Usuario actualizado!",
								type: "success",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(respuesta){

									if(respuesta.value)
									{
										window.location = "usuarios";
									}

								});

					</script>';
				}

			}
			else
			{
				echo '<script>

					swal({

							title: "¡Error al actualizar!",
							text: "La contraseña no puede contener espacios ni simbolos",
							type: "error",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(respuesta){

								if(respuesta.value)
								{
									window.location = "usuarios";
								}

							});

				</script>';
			}
		}
	}
}
<?php

if (isset($_POST)) {

	require_once 'include/conexion.php';
	if(isset($_SESSION)){
		session_start();
	}

	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
	$apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
	$email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

	//Array de errores
	$errores = array();

	//Validar los datos para almacenarlos
	//Validar campo nombre
	if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
		$nombre_validado = true;
	}else{
		$nombre_validado = false;
		$errores['nombre'] = "El nombre es incorrecto";
	}

	//Validar apellidos
	if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
		$apellidos_validado = true;
	}else{
		$apellidos_validado = false;
		$errores['apellidos'] = "El apellido es incorrecto";
	}

	//Validar email
	if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$email_validado = true;
	}else{
		$email_validado = false;
		$errores['email'] = "El email es incorrecto";
	}

	//Ingresar cuando no haya errores
	$guardar_usuario = false;
	if(count($errores) == 0){
		$guardar_usuario = true;
		$usuario = $_SESSION['usuario'];
		//Comprobar si el email no existe
		$sql = "SELECT id, email FROM usuarios WHERE email='$email';";
		$isset_email = mysqli_query($db, $sql);
		$isset_user = mysqli_fetch_assoc($isset_email);


		if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
			//Actualizaren la base de datos
			$sql = "UPDATE usuarios SET ".
					"nombre = '$nombre', ".
					"apellidos = '$apellidos', ".
					"email = '$email' ".
					"where id =".$usuario['id'];
			$guardar = mysqli_query($db, $sql);
			if ($guardar) {
				$_SESSION['usuario']['nombre'] = $nombre;
				$_SESSION['usuario']['apellidos'] = $apellidos;
				$_SESSION['usuario']['email'] = $email;
				$_SESSION['completado'] = "Tus datos se han actualizado con éxito";
			}else{
				$_SESSION['errores']['general'] ="Fallo al alctualizar al usuario";
			}
		}else{
			$_SESSION['errores']['general'] ="El usuario ya existe";
		}
	}else{
		$_SESSION['errores'] = $errores;
	}
}
	header('location: misdatos.php');
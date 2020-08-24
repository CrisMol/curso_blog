<?php
if (isset($_POST)) {

	require_once 'include/conexion.php';
	if(isset($_SESSION)){
		session_start();
	}

	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
	$apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
	$password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
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

	//Validar password
	if (!empty($password)) {
		$password_validado = true;
	}else{
		$password_validado = false;
		$errores['password'] = "El password es incorrecto";
	}

	//Ingresar cuando no haya errores
	$guardar_usuario = false;
	if(count($errores) == 0){
		$guardar_usuario = true;
		//Cifrar la contraeña
		$password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);//cifrar 4 veces
		//Insertar en la base de datos
		$sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
		$guardar = mysqli_query($db, $sql);
		if ($guardar) {
			$_SESSION['completado'] = "el registro se ha completado";
		}else{
			$_SESSION['errores']['general'] ="Fallo al guardar al usuario";
		}
	}else{
		$_SESSION['errores'] = $errores;
	}
}
	header('location: index.php');
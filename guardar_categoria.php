<?php
if (isset($_POST)) {
	//Conexión a la base de datos
	require_once 'include/conexion.php';

	$nombre_categoria = isset($_POST['nombre_categoria']) ? mysqli_real_escape_string($db, $_POST['nombre_categoria']) : false;

	//Array de errores
	$errores = array();

	//Validar los datos para almacenarlos
	//Validar campo nombre
	if (!empty($nombre_categoria) && !is_numeric($nombre_categoria) && !preg_match("/[0-9]/", $nombre_categoria)) {
		$nombre_categoria_validado = true;
	}else{
		$nombre_categoria_validado = false;
		$errores['nombre_categoria'] = "El nombre de la categoria es incorrecto";
	}

	if (count($errores) == 0) {
		$sql = "INSERT INTO categorias VALUES (null, '$nombre_categoria');";
		$guardar = mysqli_query($db, $sql);
	}
}

header("Location: index.php");
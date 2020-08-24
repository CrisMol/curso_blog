<?php

if(isset($_POST)){

	require_once 'include/conexion.php';

	$titulo = isset($_POST['titulo_entrada']) ? mysqli_real_escape_string($db, $_POST['titulo_entrada']) : false;
	$descripcion = isset($_POST['descripcion_entrada']) ? mysqli_real_escape_string($db, $_POST['descripcion_entrada']) : false;
	$categoria = isset($_POST['categoria_entrada']) ? (int) $_POST['categoria_entrada'] : false;
	$usuario = $_SESSION['usuario']['id'];

	//validacion
	$errores = array();

	if (empty($titulo)) {
		$errores['titulo'] = 'El titulo no es valido';
	}

	if (empty($descripcion)) {
		$errores['descripcion'] = 'La descripcion no es valido';
	}

	if (empty($categoria) && !is_numeric($categoria)) {
		$errores['categoria'] = 'La categoria no es valido';
	}


	if (count($errores) == 0) {
		if (isset($_GET['editar'])) {
			$entrada_id = $_GET['editar'];
			$usuario_id = $_SESSION['usuario']['id'];
			$sql = "UPDATE entradas SET titulo = '$titulo', descripcion = '$descripcion', categoria_id = $categoria ".
					"where id = $entrada_id AND usuario_id = $usuario_id";
		}else{
			//guardar en la base
			$sql = "INSERT INTO entradas VALUES(null,$usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
		}
		$guardar = mysqli_query($db, $sql);
		header("Location: index.php");
	}else{
		$_SESSION['errores_entradas'] = $errores;
		if(isset($_GET['editar'])){
			header("Location: editar_entrada.php?id=".$_GET['editar']);
		}else{
			header("Location: crear_entradas.php");
		}
	}
}
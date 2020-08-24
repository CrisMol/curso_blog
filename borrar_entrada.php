<?php

require_once 'include/conexion.php';

if (isset($_SESSION['usuario']) && isset($_GET['id'])) {
	$usuario_id = $_SESSION['usuario']['id'];
	$entrada_id = $_GET['id'];
	$sql = "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";

	$borrar = mysqli_query($db, $sql);
}

header("Location: index.php");
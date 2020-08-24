<?php
	require_once 'conexion.php';
	require_once 'include/helpers.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Blog de videojuegos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div id="contenedor">
	<!--cabecera-->
	<header id="cabecera">
		<div class="logo">
			<a href="#">Blog de Videojuegos</a>
		</div>
		<!--menu-->
		<nav id="menu">
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<?php 
					$categorias = conseguir_categorias($db);
					if(!empty($categorias)):
						while($categoria = mysqli_fetch_assoc($categorias)) 
				:?>
					<li><a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a></li>
				<?php 
						endwhile;
					endif; 
				?>
				<li><a href="index.php">Sobre Mi</a></li>
				<li><a href="index.php">Contacto</a></li>
			</ul>
		</nav>
		<div class="">
			
		</div>
	</header>
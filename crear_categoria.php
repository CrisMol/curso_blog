<?php

require_once 'include/redireccion.php';
require_once 'include/cabecera.php';
require_once 'include/lateral.php';

?>

<div id="principal">
	<h1>Crear una nueva Categoría</h1>
	<p>Añade nuevas categorías al blog para que los usuarios puedan usarlas al crear sus entradas</p>
	<br>
	<form action="guardar_categoria.php" method="POST">
		<label for="nombre_categoria">Nombre de la Categoría</label>
		<input type="text" name="nombre_categoria" value="">
		<input type="submit" name="submit" value="Guardar">
	</form>
</div>

<?php require_once 'include/footer.php';?>
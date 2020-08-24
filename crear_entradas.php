<?php

require_once 'include/redireccion.php';
require_once 'include/cabecera.php';
require_once 'include/lateral.php';
require_once 'include/helpers.php';

?>

<div id="principal">
	<h1>Crear una nueva Entrada</h1>
	<p>Añade nuevas entradas al blog para que los usuarios puedan disfrutar del contenido</p>
	<br>
	<form action="guardar_entrada.php" method="POST">
		<label for="titulo_entrada">Titulo de la Entrada</label>
		<input type="text" name="titulo_entrada" value="">

		<?php echo isset($_SESSION['errores_entradas']) ? mostrar_error($_SESSION['errores_entradas'], 'titulo') : ''; ?>

		<label for="descripcion_entrada">Descripción de la Entrada</label>
		<textarea id="textarea" name="descripcion_entrada"></textarea>

		<?php echo isset($_SESSION['errores_entradas']) ? mostrar_error($_SESSION['errores_entradas'], 'descripcion') : ''; ?>

		<label for="categoria">Categoría</label>
		<select name="categoria_entrada">
			<?php 
				$categorias = conseguir_categorias($db);
				if (!empty($categorias)) :
					while($categoria = mysqli_fetch_assoc($categorias))
			: ?>
					<option value="<?=$categoria['id']?>">
						<?=$categoria['nombre']?>
					</option>
			<?php 
					endwhile;
				endif;
			?>
		</select>

		<?php echo isset($_SESSION['errores_entradas']) ? mostrar_error($_SESSION['errores_entradas'], 'categoria') : ''; ?>

		<input type="submit" name="submit" value="Guardar">
	</form>
	<?php borrar_error();?>
</div>

<?php require_once 'include/footer.php';?>
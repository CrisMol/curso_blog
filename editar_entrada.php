<?php require_once 'include/redireccion.php'; ?>
<?php require_once 'include/helpers.php'; ?>
<?php require_once 'include/conexion.php'; ?>
<?php
	$entrada_actual = conseguir_entrada($db, $_GET['id']);
	if (!isset($entrada_actual['id'])) {
		header("Location: index.php");
	}
?>

<?php require_once 'include/cabecera.php'; ?>
<?php require_once 'include/lateral.php'; ?>

<div id="principal">
	<h1>Editar Entrada</h1>
	<p>Tu entrada <?=$entrada_actual['titulo']?></p>
	<br>
	<form action="guardar_entrada.php?editar=<?=$entrada_actual['id']?>" method="POST">
		<label for="titulo_entrada">Titulo de la Entrada</label>
		<input type="text" name="titulo_entrada" value="<?=$entrada_actual['titulo']?>">

		<?php echo isset($_SESSION['errores_entradas']) ? mostrar_error($_SESSION['errores_entradas'], 'titulo') : ''; ?>

		<label for="descripcion_entrada">Descripción de la Entrada</label>
		<textarea id="textarea" name="descripcion_entrada"><?=$entrada_actual['descripcion']?></textarea>

		<?php echo isset($_SESSION['errores_entradas']) ? mostrar_error($_SESSION['errores_entradas'], 'descripcion') : ''; ?>

		<label for="categoria">Categoría</label>
		<select name="categoria_entrada">
			<?php 
				$categorias = conseguir_categorias($db);
				if (!empty($categorias)) :
					while($categoria = mysqli_fetch_assoc($categorias))
			: ?>
					<option value="<?=$categoria['id']?>"<?=($categoria['id']) == $entrada_actual['categoria_id'] ? 'selected=selected' : ''?>>
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

<?php require_once 'include/footer.php' ?>
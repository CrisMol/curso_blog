<?php require_once 'include/helpers.php'; ?>
<?php require_once 'include/conexion.php'; ?>
<?php
	$categoria_actual = conseguir_categoria($db, $_GET['id']);
	if (!isset($categoria_actual['id'])) {
		header("Location: index.php");
	}
?>

<?php require_once 'include/cabecera.php'; ?>
<?php require_once 'include/lateral.php'; ?>
	<!--caja principal-->
	<div id="principal">
		<h1>Entradas de <?=$categoria_actual['nombre']?></h1>

		<!--Conseguir entradas-->
		<?php 
			$entradas =conseguir_entradas($db, null, $_GET['id']);
			if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
				while ($entrada = mysqli_fetch_assoc($entradas)) :
		?>
			<article class="entrada">
				<a href="entrada.php?id=<?=$entrada['id']?>">
				<h2><?=$entrada['titulo']?></h2>
				<span class="fecha"><?=$entrada['categoria'].' ! '.$entrada['fecha']?></span>
				<p>
					<?=substr($entrada['descripcion'], 0, 180)."..."?>
				</p>
				</a>
			</article>
		<?php
				endwhile;
			else:
		?>
		<div class="alerta">No hay entradas en esta categoría</div>
		<?php endif; ?>
		<a href="entradas.php" class="boton boton-azul">Ver todas las entradas</a>
	</div>
	<?php require_once 'include/footer.php' ?>
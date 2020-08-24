<?php
	if (!isset($_POST['busqueda'])) {
		header("Location: index.php");
	}
?>

<?php require_once 'include/cabecera.php'; ?>
<?php require_once 'include/lateral.php'; ?>
	<!--caja principal-->
	<div id="principal">
		<h1>Busqueda de: <?=$_POST['busqueda']?></h1>

		<!--Conseguir entradas-->
		<?php 
			$entradas = conseguir_entradas($db, null, null, $_POST['busqueda']);

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
<?php require_once 'include/cabecera.php'; ?>
<?php require_once 'include/lateral.php'; ?>
	<!--caja principal-->
	<div id="principal">
		<h1>Ultimas entradas</h1>

		<!--Conseguir entradas-->
		<?php 
			$entradas =conseguir_entradas($db, TRUE);
			if(!empty($entradas)):
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
			endif;
		?>
		<a href="entradas.php" class="boton boton-azul">Ver todas las entradas</a>
	</div>
	<?php require_once 'include/footer.php' ?>
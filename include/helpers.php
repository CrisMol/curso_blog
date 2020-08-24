<?php
	function mostrar_error($errores, $campo){
		$alerta = "";
		if (isset($errores[$campo]) && !empty($campo)) {
			$alerta = "<div class='alerta alerta-error'>".$errores[$campo]."</div>";
		}
		return $alerta;
	}

	//Borrar la sesión

	function borrar_error(){
		$borrado = false;
		if(isset($_SESSION['errores'])){
			$_SESSION['errores'] = null;
			$borrado = true;
		}

		if(isset($_SESSION['errores_entradas'])){
			$_SESSION['errores_entradas'] = null;
			$borrado = true;
		}

		if(isset($_SESSION['completado'])){
			$_SESSION['completado'] = null;
			$borrado = true;
		}

		return $borrado;
	}

	//Conseguir las categorías
	function conseguir_categorias($conexion){
		$sql = "SELECT *FROM categorias ORDER BY id ASC;";
		$categorias = mysqli_query($conexion, $sql);

		$result = array();
		if ($categorias && mysqli_num_rows($categorias) >=1) {
			$result = $categorias;
		}

		return $result;
	}
	//Conseguir las ultimas entradas
	function conseguir_entradas($conexion, $limit = null, $categoria = null, $busqueda = null){
		$sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
				"INNER JOIN categorias c ON e.categoria_id = c.id ";

		if (!empty($categoria)) {
			$sql .= "WHERE e.categoria_id = $categoria ";
		}

		if (!empty($busqueda)) {
			$sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
		}

		$sql .= "ORDER BY e.id DESC ";

		if ($limit) {
			$sql .= "LIMIT 4";
		}

		$entradas = mysqli_query($conexion, $sql);

		$result = array();
		if ($entradas && mysqli_num_rows($entradas) >= 1) {
			$result = $entradas;
		}
		return $entradas;
	}

	//Conseguir una categoria
	function conseguir_categoria($conexion, $id){
		$sql = "SELECT *FROM categorias where id = $id;";
		$categorias = mysqli_query($conexion, $sql);

		$result = array();
		if ($categorias && mysqli_num_rows($categorias) >=1) {
			$result = mysqli_fetch_assoc($categorias);
		}

		return $result;
	}
	//Conseguir una entrada
	function conseguir_entrada($conexion, $id){
		$sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ' ,u.apellidos) AS 'usuario' FROM entradas e".
				" INNER JOIN categorias c ON e.categoria_id = c.id ".
				" INNER JOIN usuarios u ON e.usuario_id = u.id ".
				"WHERE e.id = $id";
		$entrada = mysqli_query($conexion, $sql);

		$resultado = array();
		if ($entrada && mysqli_num_rows($entrada) >= 1) {
			$resultado = mysqli_fetch_assoc($entrada);
		}

		return $resultado;
	}
?>
<?php
	require("conecta.php");
	$contador = $_POST["contador"];
	if ($contador > 0) {
		for ($i=0; $i < $contador; $i++) { 
			$idvenda = $_POST["idcompra_".$i];
			$produto = $_POST["produto_".$i];
			$preco = $_POST["preco_".$i];
			$mysqli->query("INSERT INTO vendas VALUES('$idvenda','$produto','$preco')");
		}
		$mysqli->query("DELETE FROM compras");
	}
	header("Location: index.php");
?>
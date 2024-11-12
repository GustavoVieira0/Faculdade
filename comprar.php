<?php
	$idpro = $_POST["idpro"];
	$quantidade = $_POST["quantidade"];
	require("conecta.php");
	$produto = $mysqli->query("SELECT * FROM produtos WHERE idpro='$idpro'");
	if ($produto->num_rows > 0) {
		$dados = $produto->fetch_assoc();
		$mysqli->query("INSERT INTO compras (produto, preco, quantidade) VALUES ('$dados[produto]', '$dados[preco]', '$quantidade')");
	}
	echo $mysqli->error;
	header("Location: index.php");
?>

<?php
	$produto = $_POST["produto"];
	$preco = $_POST["preco"];
	$categoria = $_POST["categoria"];
	$marca = $_POST["marca"];
	$descricao = $_POST["descricao"];
	$quantidade = $_POST["quantidade"];

	require("conecta.php");
	$mysqli->query("INSERT INTO produtos (produto, preco, categoria, marca, descricao, quantidade) VALUES ('$produto', '$preco', '$categoria', '$marca', '$descricao', '$quantidade')");
	echo $mysqli->error;

	header("Location: index.php");
?>

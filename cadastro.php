<?php
	$produto = $_POST["produto"];
	$preco = $_POST["preco"];

	require("conecta.php");
	$mysqli->query("INSERT INTO produtos (produto,preco) VALUES ('$produto','$preco')");
	echo $mysqli->error;

	header("Location: index.php");
?>
<?php
	require("conecta.php");
	$contador = $_POST["contador"];
	$cliente_nome = $_POST["cliente_nome"];
	$cliente_telefone = $_POST["cliente_telefone"];
	$cliente_endereco = $_POST["cliente_endereco"];

	if ($contador > 0) {
		// Salvar informações do cliente
		$mysqli->query("INSERT INTO clientes (nome, telefone, endereco) VALUES ('$cliente_nome', '$cliente_telefone', '$cliente_endereco')");
		$id_cliente = $mysqli->insert_id;  // ID do cliente recém-cadastrado

		// Salvar informações dos produtos no pedido
		for ($i=0; $i < $contador; $i++) { 
			$idvenda = $_POST["idcompra_".$i];
			$produto = $_POST["produto_".$i];
			$preco = $_POST["preco_".$i];
			$quantidade = $_POST["quantidade_".$i];
			$mysqli->query("INSERT INTO vendas (id_cliente, produto, preco, quantidade) VALUES ('$id_cliente', '$produto', '$preco', '$quantidade')");
		}
		$mysqli->query("DELETE FROM compras");
	}
	header("Location: index.php");
?>
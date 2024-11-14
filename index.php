<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8"/>
</head>
<body>
	<h2>Cadastrar Produtos</h2>
	<form action="cadastro.php" method="POST">
		<ul>
			<li>Nome: <input type="text" name="produto" size="20" maxlength="50"></li>
			<li>Valor: R$ <input type="number" name="preco" step="0.01"></li>
			<li>Categoria: <input type="text" name="categoria" size="20" maxlength="50"></li>
			<li>Marca: <input type="text" name="marca" size="20" maxlength="50"></li>
			<li>Descrição: <textarea name="descricao" rows="3" cols="30"></textarea></li>
			<li>Quantidade: <input type="number" name="quantidade" min="1"></li>
		</ul>
		<button type="submit">Adicionar</button>
	</form>

	<h2>Pesquisar Produtos</h2>
	<form action="index.php" method="GET">
		<input type="text" name="pesquisa" placeholder="Nome ou Categoria">
		<button type="submit">Pesquisar</button>
	</form>

	<br/><br/>

	<table border="1">
		<tr align="center">
			<td colspan="5">PRODUTOS</td>
		</tr>
		<tr align="center">
			<td>Id</td>
			<td>Produto</td>
			<td>Preço</td>
			<td>Categoria</td>
			<td>COMPRAR</td>
		</tr>
		<?php 
			require("conecta.php");
			$termoPesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
			$mostrar = $mysqli->query("SELECT * FROM produtos WHERE produto LIKE '%$termoPesquisa%' OR categoria LIKE '%$termoPesquisa%'");
			if ($mostrar->num_rows > 0) {
				while ($row = $mostrar->fetch_assoc()) {
					echo "
						<form action='comprar.php' method='POST'>
							<tr align='center'>
								<td>".$row['idpro']."</td>
								<td>".$row['produto']."</td>
								<td>".$row['preco']."</td>
								<td>".$row['categoria']."</td>
								<td>
									<input type='number' name='quantidade' min='1' value='1'>
									<button type='submit'>Adicionar ao carrinho</button>
								</td>
							</tr>
							<input type='hidden' name='idpro' value='".$row['idpro']."'>
						</form>
					";
				}
			} else {
				echo "<tr align='center'><td colspan='5'>Nenhum Produto Registrado</td></tr>";
			}
		?>
	</table>

	<br/><br/>

	<table border="1">
		<tr align="center">
			<td colspan="5">CARRINHO DE COMPRASa</td>
		</tr>
		<tr align="center">
			<td>Id</td>
			<td>Produto</td>
			<td>Preço</td>
			<td>Quantidade</td>
			<td>REMOVER</td>
		</tr>
		<?php 
			$total = 0;
			require("conecta.php");
			$compra = $mysqli->query("SELECT * FROM compras");
			if ($compra->num_rows > 0) {
				while ($row = $compra->fetch_assoc()) {
					echo "
						<form action='remover_compras.php' method='POST'>
							<tr align='center'>
								<td>".$row['idcompra']."</td>
								<td>".$row['produto']."</td>
								<td>".$row['preco']."</td>
								<td>".$row['quantidade']."</td>
								<td><button type='submit'>Remover</button></td>
							</tr>
							<input type='hidden' name='idcompra' value='".$row['idcompra']."'>
						</form>
					";
					$total += $row['preco'] * $row['quantidade'];
				}
				echo "<tr align='center'><td colspan='5'>Total a pagar: R$".$total."</td></tr>";
			} else {
				echo "<tr align='center'><td colspan='5'>Nenhum Produto</td></tr>";
			}
		?>
	</table>

	<br/><br/>

	<form action="vender.php" method="POST">
		<?php
			$compra = $mysqli->query("SELECT * FROM compras");
			$contador = 0;
			while ($row = $compra->fetch_assoc()) {
				echo "
					<input type='hidden' name='idcompra_".$contador."' value='".$row['idcompra']."'>
					<input type='hidden' name='produto_".$contador."' value='".$row['produto']."'>
					<input type='hidden' name='preco_".$contador."' value='".$row['preco']."'>
					<input type='hidden' name='quantidade_".$contador."' value='".$row['quantidade']."'>
				";
				$contador++;
			}
			echo "<input type='hidden' name='contador' value='".$contador."'>";
		?>
		<br/>
		<button type="submit">Confirmar</button>
	</form>
</body>
</html>

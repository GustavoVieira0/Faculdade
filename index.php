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
			</ul>
			<button type="submit">Adicionar</button>
		</form>

		<br/><br/>

		<table border="1">
			<tr align="center">
				<td colspan="4">PRODUTOS</td>
			</tr>
			<tr align="center">
				<td>Id</td>
				<td>Produto</td>
				<td>Preço</td>
				<td>COMPRAR</td>
			</tr>
			<?php 
				require("conecta.php");
				$mostrar = $mysqli->query("SELECT * FROM produtos");
				if ($mostrar->num_rows > 0) {
					while ($row = $mostrar->fetch_assoc()) {
						echo "
							<form action='comprar.php' method='POST'>
								<tr align='center'>
									<td>".$row['idpro']."</td>
									<td>".$row['produto']."</td>
									<td>".$row['preco']."</td>
									<td><button type='submit'>Adicionar ao carrinho</button></td>
								</tr>
								<input type='hidden' name='idpro' value='".$row['idpro']."'>
							</form>
						";
					}
				} else {
					echo "<tr align='center'><td colspan='4'>Nenhum Produto Registrado</td></tr>";
				}
			?>
		</table>

		<br/><br/>

		<table border="1">
			<tr align="center">
				<td colspan="4">CARRINHO DE COMPRAS</td>
			</tr>
			<tr align="center">
				<td>Id</td>
				<td>Produto</td>
				<td>Preço</td>
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
									<td><button type='submit'>Remover</button></td>
								</tr>
								<input type='hidden' name='idcompra' value='".$row['idcompra']."'>
							</form>
						";
						$total += $row['preco'];
					}
					echo "<tr align='center'><td colspan='4'>Total a pagar: R$".$total."</td></tr>";
				} else {
					echo "<tr align='center'><td colspan='4'>Nenhum Produto</td></tr>";
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
<?php
    $idpro = $_POST["idpro"];
    require("conecta.php");
    $produto = $mysqli->query("SELECT * FROM produtos WHERE idpro='$idpro'");
    if ($produto->num_rows > 0) {
        $dados = $produto->fetch_assoc();
        $mysqli->query("INSERT INTO compras (produto,preco) VALUES ('$dados[produto]','$dados[preco]')");
    }
    echo $mysqli->error;
    header("Location: index.php");
?>
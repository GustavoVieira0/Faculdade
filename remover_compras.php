<?php
    $idcompra = $_POST["idcompra"];
    require("conecta.php");
    $produto = $mysqli->query("SELECT * FROM compras WHERE idcompra='$idcompra'");
    if ($produto->num_rows > 0) {
        $mysqli->query("DELETE FROM compras WHERE idcompra='$idcompra'");
    }
    echo $mysqli->error;
    header("Location: index.php");
?>
<?php

include("../general/valida.php");
include("../general/conexao.php");

$id_filme = $_POST['id_filme'];

$sql = "delete from filmes where id_filme = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id_filme);
    $stmt->execute();
    $resultado = $stmt->get_result();
    header("Location:cadFilme.php");
} else {
    echo "Erro ao Apagar!";
}
<?php

include("../general/valida.php");
include("../general/conexao.php");

$id_filme = $_POST['id_filme'];
$nome_filme = $_POST['nome_filme'];
$id_genero = $_POST['id_genero'];

if ($nome_filme == '') {
    die("Nome de filme inválido!");
}

$sql = "update filmes set nome_filme = ?, id_genero = ? where id_filme = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sii", $nome_filme, $id_genero, $id_filme);
    $stmt->execute();
    $resultado = $stmt->get_result();
    header("Location: cadFilme.php");
} else {
    echo "Erro ao Alterar!";
}
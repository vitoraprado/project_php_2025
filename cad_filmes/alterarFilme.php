<?php

include("../general/valida.php");
include("../general/conexao.php");

$id_filme = $_POST['id_filme'];
$nome_filme = $_POST['nome_filme'];
$id_genero = $_POST['id_genero'];
$ano = $_POST['ano'];

if ($nome_filme == '') {
    die("Nome de filme inválido!");
}

$sql = "update filmes set nome_filme = ?, id_genero = ?, ano = ? where id_filme = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("siii", $nome_filme, $id_genero, $ano, $id_filme);
    $stmt->execute();
    $resultado = $stmt->get_result();
    header("Location: cadFilme.php");
} else {
    echo "Erro ao Alterar!";
}
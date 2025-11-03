<?php

include("../general/valida.php");
include("../general/conexao.php");

$nome_filme = $_POST['nome_filme'];
$id_genero = $_POST['id_genero'];

if ($nome_filme == '') {
    die("Nome do filme inválido!");
}

$sql = "select count(1) as existe from filmes where nome_filme = ? ";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $nome_filme);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        if (isset($row) and $row['existe'] > 0) {
            die('Já exsite um filme com esse nome!');
        }
    }
}

$sql = "insert into filmes (nome_filme, id_genero) values(?,?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("si", $nome_filme, $id_genero);
    $stmt->execute();
    $resultado = $stmt->get_result();
    header("Location: cadFilme.php");
} else {
    echo "Erro ao Inserir!";
}
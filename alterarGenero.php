<?php

include("valida.php");
include("conexao.php");

$id_genero = $_POST['id_genero'];
$genero = $_POST['genero'];

if ($genero == '') {
    die("Nome de gênero inválido!");
}

$sql = "select count(1) as existe from generos where genero = ? ";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id_genero);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        if (isset($row) and $row['existe'] > 0) {
            die('Já exsite um gênero cadastrado com este nome!');
        }
    }
}

$sql = "update generos set genero = ? where id_genero = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("si", $genero, $id_genero);
    $stmt->execute();
    $resultado = $stmt->get_result();
    header("Location:cadFilmeGen.php");
} else {
    echo "Erro ao Alterar!";
}
<?php

include("valida.php");
include("conexao.php");

$genero = $_POST['genero'];

if ($genero == '') {
    die("Nome do gênero inválido!");
}

$sql = "select count(1) as existe from generos where genero = ? ";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $genero);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        if (isset($row) and $row['existe'] > 0) {
            die('Já exsite um gênero com esse nome!');
        }
    }
}

$sql = "insert into generos (genero) values(?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $genero);
    $stmt->execute();
    $resultado = $stmt->get_result();
    header("Location:cadFilmeGen.php");
} else {
    echo "Erro ao Inserir!";
}
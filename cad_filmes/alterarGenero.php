<?php

include("../general/valida.php");
include("../general/conexao.php");

$id_genero = $_POST['id_genero'];
$genero = $_POST['genero'];

if (trim($genero) == '') {
    header("Location:cadFilme.php");
}

$sql = "update generos set genero = ? where id_genero = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("si", $genero, $id_genero);
    $stmt->execute();
    $resultado = $stmt->get_result();
    header("Location: cadFilme.php");
} else {
    echo "Erro ao Alterar!";
}
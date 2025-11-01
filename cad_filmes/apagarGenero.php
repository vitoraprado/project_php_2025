<?php

include("valida.php");
include("conexao.php");

$id_genero = $_POST['id_genero'];

$sql = "delete from generos where id_genero = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id_genero);
    $stmt->execute();
    $resultado = $stmt->get_result();
    header("Location:cadFilmeGen.php");
} else {
    echo "Erro ao Apagar!";
}
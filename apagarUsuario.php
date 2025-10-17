<?php

include("valida.php");
include("conexao.php");

$cpf = $_POST['cpf'];

$sql = "delete from usuarios where cpf=?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $resultado = $stmt->get_result();
    header("Location:cadUsuario.php");
} else {
    echo "Erro ao Apagar!";
}
<?php

include("../general/valida.php");
include("../general/conexao.php");

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];

// --- Validação de CPF ---
function validarCPF($cpf)
{
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se tem 11 dígitos
    if (strlen($cpf) != 11)
        return false;

    // Rejeita CPFs com todos os dígitos iguais (ex: 111.111.111-11)
    if (preg_match('/^(\d)\1{10}$/', $cpf))
        return false;

    // Calcula os dígitos verificadores
    for ($t = 9; $t < 11; $t++) {
        $soma = 0;
        for ($i = 0; $i < $t; $i++) {
            $soma += $cpf[$i] * (($t + 1) - $i);
        }
        $digito = ((10 * $soma) % 11) % 10;
        if ($cpf[$t] != $digito)
            return false;
    }
    return true;
}

// --- Validação de Senha ---
function validarSenha($senha)
{
    // Requisitos: Mínimo 6 caracteres, 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial
    $regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{6,}$/';
    return preg_match($regex, $senha);
}

if ($nome == '') {
    die("Nome inválido!");
}
if(!validarCPF($cpf)) {
    die("CPF inválido!");
}
if(!validarSenha($senha)) {
    die("Senha não atende os requisitos!");
}

$sql = "select count(1) as existe from usuarios where cpf = ? ";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        if (isset($row) and $row['existe'] > 0) {
            die('Já exsite um usuário cadastrado com este CPF!');
        }
    }
}

$sql = "insert into usuarios (cpf,nome,senha) values(?,?,?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sss", $cpf, $nome, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();
    header("Location: cadUsuario.php");
} else {
    echo "Erro ao Inserir!";
}
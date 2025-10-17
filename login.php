<?php
include("conexao.php");

$senha = $_POST["senha"];
$cpf = $_POST["cpf"];

$sql = "select nome,senha from usuarios where cpf = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        if (isset($row) and $row["senha"] == $senha) {
            session_start();
            $_SESSION['senha'] = $senha;
            $_SESSION['cpf'] = $cpf;
            $_SESSION['nome'] = $row['nome'];
            header("Location: principal.php");
            die();
        } else {
            $msg = "Senha incorreta!";
        }
    } else {
        $msg = "Erro ao buscar no banco!";
    }
} else {
    $msg = "Erro na SQL!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagem</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #d89bff;
            font-family: Arial, sans-serif;
        }

        .box {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #botao_voltar {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #652292ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #botao_voltar:hover {
            background-color: #8b2ec7;
        }
    </style>
</head>

<body>

    <body>
        <div class="box">
            <h1><b><?php echo $msg; ?></b></h1>
            <a href="index.php"><button id="botao_voltar" style="justify-content: right;">VOLTAR AO LOGIN</button></a>
        </div>
    </body>

</html>
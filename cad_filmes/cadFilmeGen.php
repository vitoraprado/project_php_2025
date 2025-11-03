<?php
include("../general/valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Gêneros</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #c4bddeff;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }

        #header {
            min-height: 100px;
            width: 100%;
            background-color: #9281cf;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 30px;
            border-radius: 25px 25px 0px 0px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .menu {
            width: 20%;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            border-radius: 0px 0px 0px 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
            padding: 10px;
        }

        #menu-topo {
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 15px;
        }

        #menu-baixo {
            margin-top: auto;
            align-items: center;
            display: flex;
            justify-content: center;
        }

        #principal {
            background-color: #ddd;
            width: 80%;
            min-height: 400px;
            border-radius: 0px 0px 25px 0px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
            padding: 10px;
            justify-content: center;
        }

        .botao {
            background: #624aba;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
        }

        .botao:hover {
            background: #4e3a97;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        table,
        td,
        th {
            border: 1px solid #9281cf;
            border-collapse: collapse;
            padding: 10px;
        }

        #conteudo {
            display: flex;
            align-items: stretch;
        }
    </style>
    <script>
        // --- Função principal do onsubmit ---
        function validarFormulario(form) {
            const genero = form.genero.value.trim();

            if (genero === '') {
                alert('O campo GÊNERO não pode estar vazio.');
                form.nome.focus();
                return false;
            }

            // Tudo certo → permite envio
            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <div id="header">
            <p style="text-transform: uppercase; padding: 10px;"><b><?php echo "Olá " . $_SESSION['nome'] . "!"; ?></b>
            </p>
        </div>
        <div id="conteudo">
            <div class="menu">
                <div id="menu-topo">
                    <a href="../general/principal.php"><button class="botao">MENU</button></a>
                    <a href="../cad_usuarios/cadUsuario.php"><button class="botao">CADASTRO USUÁRIOS</button></a>
                    <a href="../cad_filmes/cadFilmeGen.php"><button class="botao">CADASTRO DE GÊNEROS DE FILMES</button></a>
                    <a href="../cad_filmes/cadFilmeGen.php"><button class="botao">CADASTRO DE FILMES</button></a>
                </div>
                <div id="menu-baixo">
                    <a href="logout.php"><button class="botao" style="background-color: #de3c3cff;">SAIR</button></a>
                </div>
            </div>
            <div id="principal">
                <h1 style="display: flex; justify-content: center;">CADASTRO DE GÊNEROS DE FILMES</h1>
                <br>
                <div style="display: flex; justify-content: center;">
                    <form method="post" action="inserirGenero.php" onsubmit="return validarFormulario(this)">
                        GÊNERO: <input type="text" name="genero" style="display: flex; justify-content: center;"><br>
                        <input type="submit" value="CADASTRAR" class="botao" style="background-color: #30178aff;">
                    </form>
                </div>
                <br>
                <hr>
                <?php
                include("../general/conexao.php");
                $sql = "select id_genero, genero from generos";
                if (!$resultado = $conn->query($sql)) {
                    die("Erro na SQL!");
                }
                ?>
                <table style="display: flex; justify-content: center;">
                    <tr>
                        <th>CÓDIGO</th>
                        <th>GÊNERO</th>
                        <th colspan="2"></th>
                    </tr>
                    <?php while ($row = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                            <form method="post" action="alterarGenero.php" onsubmit="return validarFormulario(this)">
                                <input type="hidden" name="id_genero" value="<?= $row['id_genero']; ?>">
                                <td><?= $row['id_genero']; ?></td>
                                <td><input type="text" name="genero" value="<?= $row['genero']; ?>"></td>
                                <td><input type="submit" value="ALTERAR" class="botao" style="background-color: #30178aff;">
                                </td>
                            </form>
                            <form method="post" action="apagarGenero.php">
                                <input type="hidden" name="id_genero" value="<?= $row['id_genero']; ?>">
                                <td><input type="submit" value="EXCLUIR" class="botao" style="background-color: #b62f6eff;">
                                </td>
                            </form>
                            <?php
                    } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
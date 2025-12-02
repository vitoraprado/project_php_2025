<?php
include("../general/valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Filmes</title>
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
            width: 15%;
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
            width: 85%;
            min-height: 400px;
            border-radius: 0px 0px 25px 0px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
            padding: 10px;
        }

        .icone-menu {
            /* Defina o tamanho do seu ícone (ex: 20 pixels) */
            width: 20px;
            height: 20px;
        }

        .botao {
            background: #624aba;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        a {
            text-decoration: none;
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

        dialog {
            border: none;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 300px;
        }

        .welcome-message {
            font-weight: 400;
            font-size: 2.2rem;
            text-transform: uppercase;
            padding: 15px 10px;
            margin: 0;
            text-align: center;
            width: 100%;
        }
    </style>
    <script>
        // --- Função principal do onsubmit ---
        function validarFormulario(form) {
            const nome_filme = form.nome_filme.value.trim();
            const id_genero = form.id_genero.value;
            const ano = form.ano.value;

            let data = new Date();
            let ano_atual = data.getFullYear();

            if (nome_filme === '') {
                alert('O campo NOME não pode estar vazio!');
                form.nome_filme.focus();
                return false;
            }

            if (id_genero === '') {
                alert('O campo GÊNERO não pode estar vazio!');
                form.id_genero.focus();
                return false;
            }

            if (ano > ano_atual || ano < 1900) {
                alert('Ano inválido!');
                return false;
            }

            return true;
        }

        function validarGenero(form) {
            const genero = form.genero.value.trim();

            if (genero == '') {
                alert('Preencha o nome do gênero!');
                form.genero.focus();
                return false;
            }
            
            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <div id="header">
            <p class="welcome-message"><b><?php echo "Olá " . $_SESSION['nome'] . "!"; ?></b></p>
        </div>
        <div id="conteudo">
            <div class="menu">
                <div id="menu-topo">
                    <a href="../general/principal.php">
                        <button class="botao">
                            <img src="../general/icon_home.svg" alt="Ícone Home" class="icone-menu">
                            HOME
                        </button>
                    </a>
                    <a href="../cad_usuarios/cadUsuario.php">
                        <button class="botao">
                            <img src="../general/icon_user.svg" alt="Ícone Usuário" class="icone-menu">
                            USUÁRIOS
                        </button>
                    </a>
                    <a href="../cad_filmes/cadFilme.php">
                        <button class="botao">
                            <img src="../general/icon_film.svg" alt="Ícone Filme" class="icone-menu">
                            FILMES
                        </button>
                    </a>
                </div>
                <div id="menu-baixo">
                    <a href="../general/logout.php">
                        <button class="botao" style="background-color: #de3c3cff;">
                            <img src="../general/icon_sair.svg" alt="Ícone Sair" class="icone-menu">
                            SAIR
                        </button>
                    </a>
                </div>
            </div>
            <div id="principal">
                <h1 style="color: #624aba;text-align: center;">CADASTRO DE FILMES</h1>
                <div style="display: flex; gap: 30px;">
                    <div style="flex: 1;">
                        <form method="post" action="inserirFilme.php" onsubmit="return validarFormulario(this)">
                            NOME:<br>
                            <input type="text" name="nome_filme" style="width: 80%"><br><br>

                            GÊNERO:<br>
                            <select name="id_genero" style="width: 60%;">
                                <option value=""></option>
                                <?php
                                include "../general/conexao.php";
                                $sql = "select id_genero, genero from generos";
                                $resultado = $conn->query($sql);
                                while ($row = $resultado->fetch_assoc()) {
                                    echo "<option value='{$row['id_genero']}'>{$row['genero']}</option>";
                                }
                                ?>
                            </select><br><br>

                            ANO:<br>
                            <input type="number" name="ano" min="1900" step="1" placeholder="YYYY"><br><br>

                            <input type="submit" value="CADASTRAR" class="botao"
                                style="background-color: #30178aff;"><br><br>
                        </form>

                        <button class="botao" style="background: #62379aff;" enabled
                            onclick="document.getElementById('cadastroGen').showModal()">ADICIONAR GÊNERO</button>
                        <br>
                        <button class="botao" style="background: #62379aff;" enabled
                            onclick="document.getElementById('edicaoGen').showModal()">GERENCIAR GÊNEROS</button>
                    </div>

                    <div style="flex: 2;">
                        <table style="width: 100%;">
                            <tr>
                                <th>CÓDIGO</th>
                                <th>NOME DO FILME</th>
                                <th>GÊNERO</th>
                                <th>ANO</th>
                                <th>AÇÕES</th>
                            </tr>
                            <?php
                            $sql = "select f.id_filme as id_filme
                                        ,  f.nome_filme as nome_filme
                                        ,  f.id_genero as id_genero
                                        ,  g.genero as genero
                                        ,  f.ano as ano
                                    from filmes f 
                                    left join generos g on f.id_genero = g.id_genero";
                            $resultado = $conn->query($sql);
                            while ($row = $resultado->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $row['id_filme']; ?></td>

                                    <form method="post" action="alterarFilme.php" onsubmit="return validarFormulario(this)">
                                        <input type="hidden" name="id_filme" value="<?= $row['id_filme']; ?>">
                                        <td><input type="text" name="nome_filme" value="<?= $row['nome_filme']; ?>"></td>
                                        <td>
                                            <select name="id_genero">
                                                <?php
                                                $sql_generos = "SELECT id_genero, genero FROM generos";
                                                $res_generos = $conn->query($sql_generos);
                                                while ($genero = $res_generos->fetch_assoc()) {
                                                    $selected = ($genero['id_genero'] == $row['id_genero']) ? 'selected' : '';
                                                    echo "<option value='{$genero['id_genero']}' {$selected}>{$genero['genero']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="ano" min="1900" step="1" value="<?= $row['ano'] ?>">
                                        </td>

                                        <td style="display: flex; gap: 5px;">
                                            <input type="submit" value="ALTERAR" class="botao"
                                                style="background-color: #30178aff;">
                                    </form>

                                    <form method="post" action="apagarFilme.php" style="display:inline;"
                                        onsubmit="return confirm('Tem certeza que deseja EXCLUIR o filme <?= addslashes($row['nome_filme']); ?>?');">
                                        <input type="hidden" name="id_filme" value="<?= $row['id_filme']; ?>">
                                        <input type="submit" value="EXCLUIR" class="botao"
                                            style="background-color: #b62f6eff;">
                                    </form>

                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Diálogo de cadastro de gêneros -->
    <dialog id="cadastroGen">
        <form style="align-items: center;" method="post" action="inserirGenero.php"
            onsubmit="return validarGenero(this)">
            <h2 style="text-align: center;">CADASTRO DE GÊNEROS</h2>
            GÊNERO:<br><input type="text" name="genero" required>

            <menu>
                <button class="botao" style="float: left;" type="submit">CADASTRAR</button>
            </menu>
        </form>
        <button class="botao" style="float: right; background-color: #b62f6eff;"
            onclick="document.getElementById('cadastroGen').close()">CANCELAR</button>
    </dialog>

    <!-- Diálogo de edição / exclusão de gêneros -->
    <dialog id="edicaoGen" style="width: 35vw;">
        <table style="width: 100%;">
            <tr>
                <th>CÓDIGO</th>
                <th>GÊNERO</th>
            </tr>
            <?php
            $sql = "select g.id_genero as id_genero
                        ,  g.genero as genero
                                    from generos g";
            $resultado = $conn->query($sql);
            while ($row = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['id_genero']; ?></td>

                    <form method="post" action="alterarGenero.php" onsubmit="return validarGenero(this)">
                        <input type="hidden" name="id_genero" value="<?= $row['id_genero']; ?>">
                        <td><input type="text" name="genero" value="<?= $row['genero']; ?>"></td>

                        <td style="display: flex; gap: 5px;">
                            <input type="submit" value="ALTERAR" class="botao" style="background-color: #30178aff;">
                    </form>

                    <form method="post" action="apagarGenero.php" style="display:inline;"
                        onsubmit="return confirm('Tem certeza que deseja EXCLUIR o gênero <?= addslashes($row['genero']); ?>?');">
                        <input type="hidden" name="id_genero" value="<?= $row['id_genero']; ?>">
                        <input type="submit" value="EXCLUIR" class="botao" style="background-color: #b62f6eff;">
                    </form>

                    </td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <button class="botao" style="background-color: #b62f6eff;"
            onclick="document.getElementById('edicaoGen').close()">CANCELAR</button>
    </dialog>
</body>

</html>
<?php
include("../general/valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Usuários</title>
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
    // --- Validação de CPF ---
    function validarCPF(cpf) {
      cpf = cpf.replace(/[^\d]+/g, '');
      if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

      let soma = 0;
      for (let i = 0; i < 9; i++) soma += parseInt(cpf.charAt(i)) * (10 - i);
      let resto = (soma * 10) % 11;
      if (resto === 10 || resto === 11) resto = 0;
      if (resto !== parseInt(cpf.charAt(9))) return false;

      soma = 0;
      for (let i = 0; i < 10; i++) soma += parseInt(cpf.charAt(i)) * (11 - i);
      resto = (soma * 10) % 11;
      if (resto === 10 || resto === 11) resto = 0;

      return resto === parseInt(cpf.charAt(10));
    }

    // --- Validação de senha ---
    function validarSenha(senha) {
      // Mínimo 6 caracteres, 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;
      return regex.test(senha);
    }

    // --- Função principal do onsubmit ---
    function validarFormulario(form) {
      const nome = form.nome.value.trim();
      const cpf = form.cpf.value;
      const senha = form.senha.value;

      if (nome === '') {
        alert('O campo NOME não pode estar vazio.');
        form.nome.focus();
        return false;
      }

      if (!validarCPF(cpf)) {
        alert('CPF inválido!');
        form.cpf.focus();
        return false;
      }

      if (!validarSenha(senha)) {
        alert('A senha deve ter pelo menos 6 caracteres, incluindo 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial.');
        form.senha.focus();
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
      <p style="text-transform: uppercase; padding: 10px;"><b><?php echo "Olá " . $_SESSION['nome'] . "!"; ?></b></p>
    </div>
    <div id="conteudo">
      <div class="menu">
        <div id="menu-topo">
          <a href="../general/principal.php"><button class="botao">MENU</button></a>
          <a href="../cad_usuarios/cadUsuario.php"><button class="botao">USUÁRIOS</button></a>
          <a href="../cad_filmes/cadFilme.php"><button class="botao">FILMES</button></a>
        </div>
        <div id="menu-baixo">
          <a href="../general/logout.php"><button class="botao" style="background-color: #de3c3cff;">SAIR</button></a>
        </div>
      </div>
      <div id="principal">
        <h1 style="display: flex; justify-content: center;">CADASTRO DE USUÁRIOS</h1>
        <br>
        <div style="display: flex; justify-content: center;">
          <form method="post" action="inserirUsuario.php" onsubmit="return validarFormulario(this)">
            CPF: <input type="text" name="cpf" style="display: flex; justify-content: center;"><br>
            NOME: <input type="text" name="nome" style="display: flex; justify-content: center;"><br>
            SENHA: <input type="text" name="senha" style="display: flex; justify-content: center;"><br>
            <input type="submit" value="CADASTRAR" class="botao" style="background-color: #30178aff;">
          </form>
          <hr>
          <?php
          include("../general/conexao.php");
          $sql = "select nome,cpf,senha from usuarios";
          if (!$resultado = $conn->query($sql)) {
            die("Erro na SQL!");
          }
          ?>
          <table>
            <tr>
              <th>CPF</th>
              <th>NOME</th>
              <th>SENHA</th>
            </tr>
            <?php while ($row = $resultado->fetch_assoc()) {
              ?>
              <tr>
                <form method="post" action="alterarUsuario.php" onsubmit="return validarFormulario(this)">
                  <input type="hidden" name="cpfAnterior" value="<?= $row['cpf']; ?>">
                  <td><input type="text" name="cpf" value="<?= $row['cpf']; ?>"></td>
                  <td><input type="text" name="nome" value="<?= $row['nome']; ?>"></td>
                  <td><input type="text" name="senha" value="<?= $row['senha']; ?>"></td>
                  <td><input type="submit" value="ALTERAR" class="botao" style="background-color: #30178aff;"></td>
                </form>
                <form method="post" action="apagarUsuario.php">
                  <input type="hidden" name="cpf" value="<?= $row['cpf']; ?>">
                  <td><input type="submit" value="EXCLUIR" class="botao" style="background-color: #b62f6eff;"></td>
                </form>
                <?php
            } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
      background-image: url('bg_login.png');
      background-size: 100% 100%;
    }

    .login-box {
      background-color: #fff;
      padding: 30px;
      border-radius: 25px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .login_titulo {
      border: 1px solid #624aba;
      color: #624aba;
      padding: 5px;
      border-radius: 25px;
      text-align: center;
    }

    input {
      margin: 5px 0;
      padding: 8px;
      width: 200px;
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
  </style>
  <script>
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

    function validarSenha(senha) {
      // mínimo 6 caracteres, 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;
      return regex.test(senha);
    }

    // Função chamada no onsubmit
    function validarLogin() {
      const cpf = document.getElementById('cpf').value;
      const senha = document.getElementById('senha').value;

      if (!validarCPF(cpf)) {
        alert('CPF inválido!');
        return false; // bloqueia envio
      }

      if (!validarSenha(senha)) {
        alert('Senha inválida!');
        return false; // bloqueia envio
      }

      // Tudo certo, permite envio
      return true;
    }
  </script>
</head>

<body>
  <div class="login-box">
    <div class="login_titulo">
      <h1>LOGIN</h1>
    </div>
    <br>
    <form action="login.php" method="POST" onsubmit="return validarLogin()">
      CPF:<br>
      <input type="text" name="cpf" id="cpf" maxlength="14" placeholder="000.000.000-00"><br>
      SENHA:<br>
      <input type="password" name="senha" id="senha"><br><br>
      <button type="submit" class="botao">LOGAR</button>
    </form>
  </div>
</body>

</html>
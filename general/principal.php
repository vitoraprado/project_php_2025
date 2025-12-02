<?php
include("../general/valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal</title>
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
      display: flex;
      flex-direction: column;
      justify-content: center;
      /* Centraliza verticalmente */
      align-items: center;
      /* Centraliza horizontalmente */
      text-align: center;
      /* Centraliza o texto em si */
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

    #conteudo {
      display: flex;
      align-items: stretch;
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
        <h1 style="color: #624aba; margin-bottom: 10px; font-size: 2.5rem;">
          PROJETO - 12/2025 - HTML / CSS / PHP / JS
        </h1>
        <p style="font-size: 1.5rem; max-width: 70%; line-height: 1.6; color: #333;">
          <b>DISCIPLINA:</b> Tecnologias para a Internet II<br>
          <b>ALUNO:</b> Vítor Almeida Prado<br>
          <b>R.A:</b> 5165441
        </p>
      </div>
    </div>
  </div>
</body>

</html>
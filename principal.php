<?php
include("valida.php");
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

    #conteudo {
      display: flex;
      align-items: stretch;
    }
  </style>
</head>

<body>
  <div class="container">
    <div id="header">
      <p style="text-transform: uppercase; padding: 10px;"><b><?php echo "Olá " . $_SESSION['nome'] . "!"; ?></b></p>
    </div>
    <div id="conteudo">
      <div class="menu">
        <div id="menu-topo">
          <a href="principal.php"><button class="botao">MENU</button></a>
          <a href="cadUsuario.php"><button class="botao">CADASTRO USUÁRIOS</button></a>
          <a href="cadFilmeGen.php"><button class="botao">CADASTRO DE GÊNEROS DE FILMES</button></a>
        </div>
        <div id="menu-baixo">
          <a href="logout.php"><button class="botao" style="background-color: #de3c3cff;">SAIR</button></a>
        </div>
      </div>
      <div id="principal">
        <h1 style="display: flex; justify-content: center;">CONTEÚDO PRINCIPAL</h1>
      </div>
    </div>
  </div>
</body>

</html>
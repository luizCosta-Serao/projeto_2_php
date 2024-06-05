<?php

  $pdo = new PDO('mysql:host=localhost;dbname=projeto_2','root','');
  $sobre = $pdo->prepare("SELECT * FROM `sobre`");
  $sobre->execute();
  $sobre = $sobre->fetch()['sobre'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <title>Painel de Controle</title>
</head>
<body>
  <header class="painel-header">
    <nav class="painel-menu">
      <ul>
        <li><a class="active" href="#editarSobre">Editar Sobre</a></li>
        <li><a href="#cadastrarEquipe">Cadastrar Equipe</a></li>
        <li><a href="#listarEquipe">Lista Equipe</a></li>
      </ul>
      <a class="loggout" href="">Sair</a>
    </nav>
  </header>
  
  <section class="last-login">
    <h2>Painel de Controle</h2>
    <p>Seu último login foi em 02/06/2024</p>
  </section>

  <section class="breadcrumb">
    <ul>
      <li><a href="">Home</a></li>
    </ul>
  </section>

  <section class="main">
    <div class="main-menu">
      <ul>
        <li><a class="active" href="#editarSobre">Sobre</a></li>
        <li><a href="#cadastrarEquipe">Cadastrar Equipe</a></li>
        <li><a href="#listarEquipe">Lista Equipe</a></li>
      </ul> 
    </div>


    <div class="main-content">
      <div class="active" id="editarSobre">
        <?php
          if (isset($_POST['acao-sobre'])) {
            $sobre = $_POST['sobre'];
            $pdo->exec("DELETE FROM `sobre`");
            $sql = $pdo->prepare("INSERT INTO `sobre` VALUES (null,?)");
            $sql->execute(array($sobre));
            echo '<div>O código HTML Sobre foi editado com sucesso</div>';
            $sobre = $pdo->prepare("SELECT * FROM `sobre`");
            $sobre->execute();
            $sobre = $sobre->fetch()['sobre'];
          } else if (isset($_POST['acao-equipe'])) {
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];

            $sql = $pdo->prepare("INSERT INTO `equipe` VALUES (null,?,?)");
            $sql->execute(array($nome,$descricao));
            echo '<div>O código HTML Equipe foi editado com sucesso</div>';
          }

        ?>
        <h3>Sobre</h3>
        <form action="" method="post">
          <label for="sobre">Código HTML:</label>
          <textarea name="sobre" id="sobre"><?php echo $sobre; ?></textarea>

          <input type="hidden" name="editar-sobre" value="">
          <button type="submit" name="acao-sobre">Submit</button>
        </form>
      </div>
      
      <div id="cadastrarEquipe">
        <h3>Cadastrar Equipe</h3>
        <form action="" method="post">
          <label for="nome">Nome do Membro:</label>
          <input type="text" name="nome" id="nome">

          <label for="descricao">Descrição do Membro:</label>
          <textarea name="descricao" id="descricao"></textarea>

          <input type="hidden" name="cadastrar_equipe">
          <button type="Submit" name="acao-equipe" value="Submit">Submit</button>
        </form>
      </div>

      <div id="listarEquipe">
        <h3>Membros da Equipe</h3>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome do Membro</th>
              <th>Deletar</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $selecionarMembros = $pdo->prepare("SELECT * FROM `equipe`");
              $selecionarMembros->execute();
              $membros = $selecionarMembros->fetchAll();
              foreach ($membros as $key => $value) {
            ?>
              <tr>
                <td><?php echo $value['id']; ?></td>
                <td><?php echo $value['nome'] ?></td>
                <td class="deletar-membro" id_membro="<?php echo $value['id'] ?>">Excluir</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <script src="./js/jquery-3.7.1.min.js"></script>
  <script src="./js/index.js"></script>
</body>
</html>
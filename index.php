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
  <title>Document</title>
</head>
<body>
  <header class="header">
    <div class="logo">
      <a title="Logo" href="/">Programming</a>
    </div>
    <nav class="menu">
      <ul>
        <li><a title="Home" href="/">Home</a></li>
        <li><a title="Sobre" href="#sobre">Sobre</a></li>
        <li><a title="Contato" href="#contact">Contato</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <div class="bg-effect"></div>
    <div class="hero-content">
      <h1>Programming</h1>
      <p>Empresa voltada para desenvolvimento web e marketing digital</p>
      <a href="">Saiba Mais!</a>
    </div>
  </section>

  <section class="signup-lead">
    <h2>Entre na nossa lista!</h2>
    <form action="">
      <input type="text" name="name">
      <input type="submit" name="action" value="Enviar">
    </form>
  </section>

  <section class="testimonial">
    <h2>Depoimento</h2>
    <blockquote>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae asperiores quis reiciendis nesciunt dicta! Ipsam minus voluptates dolor ut recusandae dolorem autem reprehenderit quasi cupiditate ducimus. Aliquam id ipsa facere."</blockquote>
  </section>

  <section class="differences">
    <h2>Diferenciais</h2>
    <ul class="list-differences">
      <?php echo $sobre; ?>
    </ul>
  </section>

  <section class="team">
    <h2>Equipe</h2>
    <ul class="list-team">
      <?php
        $selectMembros = $pdo->prepare("SELECT * FROM `equipe`");
        $selectMembros->execute();
        $membros = $selectMembros->fetchAll();
        for ($i=0; $i < count($membros); $i++) {
      ?>
      <li>
        <span></span>
        <h3><?php echo $membros[$i]['nome'] ?></h3>
        <p><?php echo $membros[$i]['descricao'] ?></p>
      </li>
      <?php } ?>
    </ul>
  </section>

  <section class="contact-plans">
    <form class="contact" action="">
      <label for="name">Nome</label>
      <input type="text" id="name" name="name">

      <label for="email">Email</label>
      <input type="email" id="email" name="email">

      <label for="message">Mensagem</label>
      <textarea name="message" id="message"></textarea>

      <button type="submit">Cadastrar</button>
    </form>
    <table class="plans">
      <thead>
        <tr>
          <th>Plano Diário</th>
          <th>Plano Semanal</th>
          <th>Plano Anual</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>R$199,00</td>
          <td>R$299,00</td>
          <td>R$399,00</td>
        </tr>
        <tr>
          <td>R$199,00</td>
          <td>R$299,00</td>
          <td>R$399,00</td>
        </tr>
        <tr>
          <td>R$199,00</td>
          <td>R$299,00</td>
          <td>R$399,00</td>
        </tr>
      </tbody>
    </table>
  </section>
  
  <footer class="footer">
    <p>Todos os direitos reservados.</p>
  </footer>

  <script src="./js/jquery-3.7.1.min.js"></script>
</body>
</html>
<?php require_once '../../_scripts/utilidades/connection.php' ?>
<?php require_once 'session.php' ?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../_css/estilo.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/c8bf600d07.js" crossorigin="anonymous"></script>

    <title>Consultar</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav class="navbar navbar-dark bg-light mb-3">
          <div class="container">
            <a href="inicio.php">
              <button class="btn btn-outline-white">
                <i class="fas fa-arrow-left text-dark"></i>
              </button>
            </a>
          </div>
        </nav>

        <div class="container">
          <?php
            $query = "
              SELECT S.nome, I.* FROM integração I INNER JOIN matriculas M
              ON I.codigo_matricula = M.codigo INNER JOIN solicitações S
              ON S.codigo = M.codigo_solicitação WHERE I.codigo = $_GET[codigo]
            ";
            $execsql = mysqli_query($linkmy, $query);
            $result = mysqli_fetch_array($execsql);
          ?>
          <p><strong>Nome do aluno: </strong><?= $result['nome'] ?></p>
          <p><strong>Data do registro: </strong><?= date_format(new DateTime($result['data_registro']), "d/m/Y"); ?></p>
          <p><strong>Comeu? </strong><?= $result['comida'] ?></p>
          <p><strong>Bebeu? </strong><?= $result['bebida'] ?></p>
          <p><strong>Dormiu? </strong><?= $result['sono'] ?></p>
          <p><strong>Participou das atividades na sala? </strong><?= $result['participação_sala'] ?></p>
          <p><strong>Participou das atividades ao ar livre? </strong><?= $result['participação_livre'] ?></p>
          <p><strong>Brincou com outros alunos? </strong><?= $result['relacionamento'] ?></p>
          <p><strong>Ocorrências: </strong><?= $result['outros'] ?></p>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
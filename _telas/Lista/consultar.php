<?php require_once '../../_scripts/utilidades/connection.php' ?>

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
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="inicio.php">Início</a></li>
              <li class="breadcrumb-item active" aria-current="page">Consultar</li>
            </ol>
          </nav>

          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-borderless">
                  <?php
                    $cmdsql = "SELECT * FROM solicitações WHERE codigo = $_GET[codigo]";
                    $execsql = mysqli_query($linkmy, $cmdsql);
                    $result = mysqli_fetch_array($execsql);
                    if($result['status'] == 1) { ?>
                      <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">Turma</th>
                          <th scope="col">Escola</th>
                          <th scope="col">Status</th>
                        </tr>
                        <tbody>
                          <td><?= $result['nome'] ?></td>
                          <td>
                            <?php
                              $cmdsql = "SELECT * FROM turmas WHERE codigo = $result[codigo_turma]";
                              $execsql = mysqli_query($linkmy, $cmdsql);
                              $row = mysqli_fetch_array($execsql);
                              echo $row['num_turma'];
                            ?>
                          </td>
                          <td>
                            <?php
                              $cmdsql = "SELECT * FROM escolas WHERE codigo = $result[codigo_escola]";
                              $execsql = mysqli_query($linkmy, $cmdsql);
                              $row = mysqli_fetch_array($execsql);
                              echo $row['nome'];
                            ?>
                          </td>
                          <td><?php if($result['status'] == 1) { echo "Matriculado"; } ?></td>
                        </tbody>
                      </thead>
                    <?php } else { ?>
                      <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">Posição</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <td>
                          <?php
                            $cmdsql = "SELECT * FROM solicitações WHERE codigo = $_GET[codigo]";
                            $execsql = mysqli_query($linkmy, $cmdsql);
                            $registro = mysqli_fetch_array($execsql);
                            echo $registro['nome'];
                          ?>
                        </td>
                        <td>
                          <?php
                            $cmdsql = "
                              SELECT COUNT(*) FROM solicitações WHERE codigo <= $_GET[codigo] AND codigo_turma = $registro[codigo_turma] AND STATUS = 0
                            ";
                            $execsql = mysqli_query($linkmy, $cmdsql);
                            $row = mysqli_fetch_array($execsql);
                            echo $row['COUNT(*)'];
                          ?>
                        </td>
                        <td>
                          <?php if($registro['status'] == 0) { echo "Aguardando"; } ?>
                        </td>
                      </tbody>
                    <?php } ?>
                </table>
              </div>
            </div>
          </div>
          <?php
            if($result['status'] == 1) { ?>
              <div class="my-3 text-center">
                <a href="../acompanhamento/index.php?>">Clique aqui para acompanhar rotina do aluno</a>
              </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
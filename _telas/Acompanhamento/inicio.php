<?php require_once '../../_scripts/utilidades/connection.php' ?>
<?php require_once 'session.php' ?>
<?php $codigo_solicitação = $_SESSION['codigo_solicitação']; ?>

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

    <title>Início</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
          <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="logout.php">Sair</a>
              </div>
            </div>
          </div>
        </nav>

        <div class="container">

          <div class="my-4 text-center">
            <?php
              $cmd = "
                SELECT COUNT(*) FROM integração I INNER JOIN matriculas M
                ON I.codigo_matricula = M.codigo INNER JOIN solicitações S
                ON M.codigo_solicitação = S.codigo WHERE S.codigo = $codigo_solicitação
                ORDER BY I.data_registro DESC
              ";
              $query = mysqli_query($linkmy, $cmd);
              $result = mysqli_fetch_array($query);
            ?>
            <a href="relatório.php?codigo_solicitação=<?= $codigo_solicitação ?>">Ver relatório detalhado</a>
          </div>

          <div class="card text-center">
            <div class="card-header">
              <?php
                $cmdsql = "SELECT * FROM solicitações WHERE codigo = $codigo_solicitação";
                $execsql = mysqli_query($linkmy, $cmdsql);
                $registro = mysqli_fetch_array($execsql);
                echo $registro['nome'];
              ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Data</th>
                      <th scope="col">Consultar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $cmdsql = "
                        SELECT I.codigo, I.data_registro FROM integração I INNER JOIN matriculas M
                        ON I.codigo_matricula = M.codigo INNER JOIN solicitações S
                        ON M.codigo_solicitação = S.codigo WHERE S.codigo = $codigo_solicitação
                        ORDER BY I.data_registro DESC
                      ";
                      $execsql = mysqli_query($linkmy, $cmdsql);
                      while($row = mysqli_fetch_array($execsql)) { ?>
                        <tr>
                          <td><?= date_format(new DateTime($row[1]), "d/m/Y"); ?></td>
                          <td>
                            <a href="consultar.php?codigo=<?= $row[0] ?>">
                              <button class="btn btn-outline-warning">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                              </button>
                            </a>
                          </td>
                        </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
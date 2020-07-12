<?php require_once '../../_scripts/utilidades/connection.php' ?>
<?php require_once '../../_scripts/utilidades/session_professor.php' ?>
<?php $_SESSION['codigo_matricula'] = $_GET['codigo_matricula']; ?>

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

    <title>Registros</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav class="navbar navbar-dark bg-light mb-3">
          <div class="container">
            <a href="alunos.php?codigo_turma=<?= $_SESSION['codigo_turma'] ?>">
              <button class="btn btn-outline-white">
                <i class="fas fa-arrow-left text-dark"></i>
              </button>
            </a>
          </div>
        </nav>

        <div class="container">
          <div class="card">
            <div class="card-header text-left">
              <?php
                $cmdsql = "
                  SELECT * FROM solicitações S INNER JOIN matriculas M on M.codigo_solicitação = S.codigo 
                  WHERE M.codigo = $_GET[codigo_matricula]
                ";
                $execsql = mysqli_query($linkmy, $cmdsql);
                $result = mysqli_fetch_array($execsql);
                echo $result['nome'];
              ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Data do registro</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $cmdsql = "SELECT * FROM integração WHERE codigo_matricula = $_GET[codigo_matricula] ORDER BY data_registro DESC";
                      $execsql = mysqli_query($linkmy, $cmdsql);
                      while($result = mysqli_fetch_array($execsql)) { ?>
                        <tr>
                          <td><?= date_format(new DateTime($result['data_registro']), "d/m/Y"); ?></td>
                          <td>
                            <a href="alterar.php?codigo_integração=<?= $result['codigo'] ?>">
                              <button class="btn btn-outline-success">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                              </button>
                            </a>
                          </td>
                          <td>
                            <a href="consultar.php?codigo_integração=<?= $result['codigo'] ?>">
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
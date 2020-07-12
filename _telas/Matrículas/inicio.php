<?php require_once '../../_scripts/utilidades/connection.php' ?>
<?php require_once '../../_scripts/utilidades/session.php' ?>

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

    <title>Matrículas</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav class="navbar navbar-dark bg-light mb-3">
          <div class="container">
            <a href="seleção.php">
              <button class="btn btn-outline-white">
                <i class="fas fa-arrow-left text-dark"></i>
              </button>
            </a>
          </div>
        </nav>

        <div class="container">
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Observação: </strong>você sempre deve matricular a solicitação que está em primeiro lugar
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="card">
            <div class="card-header">
              Solicitações
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Turma</th>
                      <th scope="col">Vagas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $cmdsql = "SELECT * FROM solicitações WHERE codigo_escola = $_GET[codigo_escola] AND status = 0 ORDER BY codigo";
                      $execsql = mysqli_query($linkmy, $cmdsql);
                      while($registro = mysqli_fetch_array($execsql)) { ?>
                        <tr>
                          <td><?php echo $registro['nome']; ?></td>
                          <td>
                            <?php
                              $cmdsql1 = "SELECT * FROM turmas WHERE codigo = $registro[codigo_turma]";
                              $execsql1 = mysqli_query($linkmy, $cmdsql1);
                              $result1 = mysqli_fetch_array($execsql1);
                              echo $result1['num_turma'];
                            ?>
                          </td>
                          <td>
                            <?php
                              $cmdsql2 = "SELECT COUNT('matriculados') FROM matriculas WHERE codigo_turma = $registro[codigo_turma]";
                              $execsql2 = mysqli_query($linkmy, $cmdsql2);
                              $result2 = mysqli_fetch_array($execsql2);
                              $matriculados = $result2[0];
                              //echo $result1['qtd_maxima'] - $matriculados . ' de ' . $result1['qtd_maxima'];
                              $vagas = $result1['qtd_maxima'] - $matriculados;
                              echo $vagas;
                            ?>
                          </td>
                          <td>
                            <?php
                              if($vagas > 0) { ?>
                                <a href="../../_scripts/matrículas/matricular.php?codigo=<?= $registro['codigo'] ?>">
                                  <button class="btn btn-outline-success">
                                    Matricular
                                  </button>
                                </a>
                            <?php } ?>
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
<?php require_once '../../_scripts/utilidades/connection.php' ?>
<?php require_once '../../_scripts/utilidades/session_professor.php' ?>
<?php date_default_timezone_set('America/Sao_Paulo') ?>

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

    <title>Alunos</title>
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
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="inicio.php">Início</a></li>
              <li class="breadcrumb-item"><a href="seleção.php">Turmas</a></li>
              <?php
                $cmdsql = "
                  SELECT * FROM turmas as T INNER JOIN escolas as E
                  ON T.codigo_escola = E.codigo WHERE T.codigo = $_GET[codigo_turma]
                ";
                $execsql = mysqli_query($linkmy, $cmdsql);
                $result = mysqli_fetch_array($execsql);
              ?>
              <li class="breadcrumb-item active" aria-current="page">Alunos (<?= $result['num_turma'] . ' - ' . $result['nome'] ?>)</li>
            </ol>
          </nav>
          <div class="card">
            <div class="card-header text-left">
              Meus Alunos
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $_SESSION['codigo_turma'] = $_GET['codigo_turma'];
                      $cmdsql = "
                        SELECT S.codigo, S.nome, M.codigo as 'cod_matricula' FROM solicitações AS S INNER JOIN matriculas AS M
                        ON M.codigo_solicitação = S.codigo INNER JOIN turmas AS T
                        ON M.codigo_turma = T.codigo INNER JOIN professores AS P
                        ON T.codigo_professor = P.codigo WHERE P.codigo = $_SESSION[codigo_professor]
                        AND T.codigo = $_GET[codigo_turma];
                      "; 
                      $execsql = mysqli_query($linkmy, $cmdsql);
                      while($registro = mysqli_fetch_array($execsql)) { ?>
                        <tr>
                          <td><?= $registro['nome']; ?></td>
                          <td>
                            <?php
                              $data = date('Y-m-d');
                              $cmd1 = "SELECT COUNT(*) FROM integração WHERE codigo_matricula = $registro[2] AND data_registro = '$data'";
                              $execsql1 = mysqli_query($linkmy, $cmd1);
                              $reg = mysqli_fetch_array($execsql1);
                              if($reg[0] == 0) { ?>
                                <a href="adicionar.php?codigo_matricula=<?= $registro[2] ?>">
                                  <button class="btn btn-outline-success">
                                    <i class="fas fa-plus" aria-hidden="true"></i>
                                  </button>
                                </a>
                            <?php } ?>
                          </td>
                          <td>
                            <a href="lista_de_registros.php?codigo_matricula=<?= $registro[2] ?>">
                              <button class="btn btn-outline-primary">
                                <i class="fas fa-paste" aria-hidden="true"></i>
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
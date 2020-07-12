<?php require_once '../../_scripts/utilidades/connection.php' ?>
<?php require_once '../../_scripts/utilidades/session_professor.php' ?>

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

    <title>Turmas</title>
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
              <li class="breadcrumb-item active" aria-current="page">Turmas</li>
            </ol>
          </nav>
          <form method="GET" action="alunos.php">
            <div class="form-group row">
              <label class="col-lg-2 col-form-label">Selecione sua turma:</label>
                <div class="col-lg-8">
                  <select name="codigo_turma" class="form-control mb-2" required>
                    <?php
                      $cmsql = "
                        SELECT T.*, E.nome FROM turmas AS T INNER JOIN escolas AS E
                        ON T.codigo_escola = E.codigo WHERE T.codigo_professor = $_SESSION[codigo_professor]
                        ORDER BY E.nome
                      ";
                      $execsql = mysqli_query($linkmy, $cmsql);
                      while($registro = mysqli_fetch_array($execsql)) { ?>
                        <option value="<?= $registro['codigo'] ?>"><?= $registro['num_turma'] . ' - ' . $registro['nome'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-lg-2">
                  <button type="submit" class="btn btn-success">Continuar</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
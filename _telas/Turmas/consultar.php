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

    <title>Consultar</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav class="navbar navbar-dark bg-light mb-3">
          <div class="container">
            <a href="inicio.php?codigo_escola=<?= $_SESSION['codigo_escola'] ?>">
              <button class="btn btn-outline-white">
                <i class="fas fa-arrow-left text-dark"></i>
              </button>
            </a>
          </div>
        </nav>

        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <?php
                $cmdsql = "SELECT * FROM escolas WHERE codigo = $_SESSION[codigo_escola]";
                $execsql = mysqli_query($linkmy, $cmdsql);
                $result = mysqli_fetch_array($execsql);
              ?>
              <li class="breadcrumb-item"><a href="../funcionarios/home.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="inicio.php?codigo_escola=<?= $_SESSION['codigo_escola'] ?>"><?= $result['nome'] ?></a></li>
              <li class="breadcrumb-item active" aria-current="page">Consultar</li>
            </ol>
          </nav>
          <?php
            $codigo = $_GET['codigo'];
            $cmdsql = "SELECT * FROM turmas WHERE codigo = $codigo";
            $execsql = mysqli_query($linkmy, $cmdsql);
            $registro = mysqli_fetch_array($execsql);
          ?>
          <div class="form-row">
              <div class="form-group col-md-8">
                <?php
                  $cmdsql = "SELECT * FROM escolas WHERE codigo = $registro[codigo_escola]";
                  $execsql = mysqli_query($linkmy, $cmdsql);
                  $row = mysqli_fetch_array($execsql);
                ?>
                <label>Nome da escola <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="codigo_escola" value="<?php echo $row['nome'] ?>" disabled>
              </div>
              <div class="form-group col-md-4">
                <label>Tipo de turma <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="tipo_turma" value="<?php echo $registro['tipo_turma'] ?>" disabled>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label>Número da turma <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="num_turma" value="<?php echo $registro['num_turma'] ?>" disabled>
              </div>
              <div class="form-group col-md-2">
                <label>Total de vagas <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="qtd_maxima" value="<?php echo $registro['qtd_maxima'] ?>" disabled>
              </div>
              <div class="form-group col-md-4">
                <label>Período <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="qtd_maxima" value="<?php echo $registro['periodo'] ?>" disabled>

              </div>
              <div class="form-group col-md-4">
                <?php
                  $cmdsql = "SELECT * FROM professores WHERE codigo = $registro[codigo_professor]";
                  $execsql = mysqli_query($linkmy, $cmdsql);
                  $row = mysqli_fetch_array($execsql);
                ?>
                <label>Nome do professor <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="codigo_professor" value="<?php echo $row['nome'] ?>" disabled>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Status <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="status" value="<?php if($registro['status'] == 0) { echo "Inativo"; } else { echo "Ativo"; } ?>" disabled>
              </div>
              <div class="form-group col-md-4">
                <label>Data de registro <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="data_registro" value="<?php echo $registro['nome'] ?>" disabled>
              </div>
              <div class="form-group col-md-4">
                <?php
                  $cmdsql = "SELECT * FROM funcionarios WHERE codigo = $registro[codigo_funcionario]";
                  $execsql = mysqli_query($linkmy, $cmdsql);
                  $row = mysqli_fetch_array($execsql);
                ?>
                <label>Responsável pelo cadastro <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="codigo_funcionario" value="<?php echo $row['nome'] ?>" disabled>
              </div>
            </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
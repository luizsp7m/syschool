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

    <title>Relatórios</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav class="navbar navbar-dark bg-light mb-3">
          <div class="container">
            <a href="../funcionarios/home.php">
              <button class="btn btn-outline-white">
                <i class="fas fa-arrow-left text-dark"></i>
              </button>
            </a>
          </div>
        </nav>

        <div class="container">
          <form>
            <div class="form-group">
              <label>Nome da escola</label>
              <select name="escola" id="escola" class="form-control">
                <option id="selecionado" value="0" selected>Selecione uma escola</option>
                <?php
                  $cmdsql = "SELECT * FROM escolas";
                  $execsql = mysqli_query($linkmy, $cmdsql);
                  while($registro = mysqli_fetch_array($execsql)) { ?>
                    <option value="<?= $registro['codigo']; ?>"><?= $registro['nome']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Nome da turma</label>
              <select id="turmas" name="turma" class="form-control"></select>
            </div>
            <button type="button" class="btn btn-primary" id="buscar">Buscar</button>
          </form>

          <div id="relatorio" class="my-3"></div>   
          <button type="button" onclick='window.print()' id="imprimir" class="btn btn-outline-primary">
            <i class="fas fa-print"></i>
          </button>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(document).ready(() => {
        $('#buscar').prop("disabled", true);
        $('#turmas').prop("disabled", true);
        $('#imprimir').prop("disabled", true);

        $('#escola').change(() => {
          $('#selecionado').remove();
          $('#turmas').load('turmas.php?escola=' + $('#escola').val());
          $('#buscar').prop("disabled", false);
          $('#turmas').prop("disabled", false);
        });

        $('#buscar').click(() => {
          $('#relatorio').load('relatorio.php?escola='+$('#escola').val()+'&turma='+$('#turmas').val());
          $('#imprimir').prop("disabled", false);
        });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
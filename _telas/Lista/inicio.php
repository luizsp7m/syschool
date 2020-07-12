<?php require_once '../../_scripts/utilidades/connection.php' ?>
<?php session_start(); ?>

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

    <title>Lista de Espera</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav class="navbar navbar-dark bg-light mb-3">
          <div class="container">
            <a href="inicio.php">
              <button class="btn btn-outline-white">
                <i class="fas fa-list-ol text-dark"></i>
              </button>
            </a>
          </div>
        </nav>

        <div class="container text-center">
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong id="mensagem"></strong> Insira o código de sua solicitação para consulta-la.
          </div>
          <form class="form-inline justify-content-center" action="../../_scripts/lista/consultar.php" method="POST">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Código da solicitação</span>
              </div>
              <input type="text" name="codigo" class="form-control" required>
              <input type="submit" class="form-control btn btn-outline-primary" value="Continuar">
            </div>
          </form>
          <?php if(isset($_SESSION['cadastrado']) && $_SESSION['cadastrado'] == false) { ?>
              <div class="form-group text-center mt-2">
                <span class="text-danger">ERRO: Solicitação não encontrada</span>
              </div>
            <?php }
              unset($_SESSION['cadastrado']);
            ?>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      let agora = new Date();
      let hora = agora.getHours();
      if(hora >= 6 && hora < 12) {
        document.getElementById("mensagem").innerHTML = "Bom dia!";
      } else if(hora >= 12 && hora < 18) {
        document.getElementById("mensagem").innerHTML = "Boa tarde!";
      } else {
        document.getElementById("mensagem").innerHTML = "Boa noite!";
      }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
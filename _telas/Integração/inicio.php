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

    <title>Início</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Sidebar -->
      <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading"><b>Syschool</b></div>
        <div class="list-group list-group-flush">
          <a href="seleção.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-map mr-2"></i>Turmas</a>
          <a href="../../_scripts/utilidades/logout.php" class="list-group-item list-group-item-action bg-light" id="sair"><i class="fas fa-sign-out-alt mr-2"></i></i>Sair</a>
        </div>
      </div>

      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav class="navbar navbar-light bg-light mb-3">
          <button class="btn btn-outline-light" id="menu-toggle">
            <span class="navbar-toggler-icon"></span>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link mr-5">
                <?php
                  $cmdsql = "SELECT * FROM professores where codigo = $_SESSION[codigo_professor]";
                  $execsql = mysqli_query($linkmy, $cmdsql);
                  $registro = mysqli_fetch_array($execsql);
                ?>
                <span class="text-muted"><?= $registro['nome'] ?></span>
              </a>
            </li>
          </ul>
        </nav>

        <div class="container-fluid" id="conteudo">
          
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <script>
      $(document).ready(() => {
        $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
        });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
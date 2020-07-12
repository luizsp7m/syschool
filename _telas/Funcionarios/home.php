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

    <title>Início</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Sidebar -->
      <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading"><b>Syschool</b></div>
        <div class="list-group list-group-flush">
          <a href="inicio.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-users mr-2"></i>Funcionários</a>
          <a href="../professores/inicio.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-chalkboard-teacher mr-2"></i>Professores</a>
          <a href="../escolas/inicio.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-school mr-2"></i>Escolas</a>
          <a href="../turmas/seleção.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-map mr-2"></i>Turmas</a>
          <a href="../solicitações/seleção.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-file-alt mr-2"></i>Solicitações</a>
          <a href="../matrículas/seleção.php" class="list-group-item list-group-item-action bg-light"><i class="far fa-address-card mr-2"></i>Matrículas</a>
          <a href="../relatórios/inicio.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-chart-pie mr-2"></i></i>Relatórios</a>
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
                  $cmdsql = "SELECT * FROM funcionarios where codigo = $_SESSION[codigo_funcionario]";
                  $execsql = mysqli_query($linkmy, $cmdsql);
                  $registro = mysqli_fetch_array($execsql);
                ?>
                <span class="text-muted"><?= $registro['nome'] ?></span>
              </a>
            </li>
          </ul>
        </nav>

        <div class="container-fluid" id="conteudo">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
              <div class="card text-center border-0">
                <div class="card-body" style="background-color: #0097e6; border: none; border-radius: 0; color: white;">
                  <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 my-auto">
                      <span>Funcionários</span>
                      <?php
                        $cmdsql = "SELECT COUNT(codigo) AS quantidade FROM funcionarios WHERE status = 1";
                        $execsql = mysqli_query($linkmy, $cmdsql);
                        $registro = mysqli_fetch_array($execsql);
                      ?>
                      <h5><?php echo $registro['quantidade']; ?></h5>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <i class="fas fa-users fa-5x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
              <div class="card text-center border-0">
                <div class="card-body" style="background-color: #44bd32; border: none; border-radius: 0; color: white;">
                  <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 my-auto">
                      <span>Professores</span>
                      <?php
                        $cmdsql = "SELECT COUNT(codigo) AS quantidade FROM professores WHERE status = 1";
                        $execsql = mysqli_query($linkmy, $cmdsql);
                        $registro = mysqli_fetch_array($execsql);
                      ?>
                      <h5><?php echo $registro['quantidade']; ?></h5>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <i class="fas fa-chalkboard-teacher fa-5x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
              <div class="card text-center border-0">
                <div class="card-body" style="background-color: #fbc531; border: none; border-radius: 0; color: white;">
                  <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 my-auto">
                      <span>Escolas</span>
                      <?php
                        $cmdsql = "SELECT COUNT(codigo) AS quantidade FROM escolas WHERE status = 1";
                        $execsql = mysqli_query($linkmy, $cmdsql);
                        $registro = mysqli_fetch_array($execsql);
                      ?>
                      <h5><?php echo $registro['quantidade']; ?></h5>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <i class="fas fa-school fa-5x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
              <div class="card text-center border-0">
                <div class="card-body" style="background-color: #b71540; border: none; border-radius: 0; color: white;">
                  <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 my-auto">
                      <span>Turmas</span>
                      <?php
                        $cmdsql = "SELECT COUNT(codigo) AS quantidade FROM turmas WHERE status = 1";
                        $execsql = mysqli_query($linkmy, $cmdsql);
                        $registro = mysqli_fetch_array($execsql);
                      ?>
                      <h5><?php echo $registro['quantidade']; ?></h5>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <i class="fas fa-map fa-5x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
              <div class="card text-center border-0">
                <div class="card-body" style="background-color: #5f27cd; border: none; border-radius: 0; color: white;">
                  <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 my-auto">
                      <span>Solicitações</span>
                      <?php
                        $cmdsql = "SELECT COUNT(codigo) AS quantidade FROM solicitações WHERE status = 0";
                        $execsql = mysqli_query($linkmy, $cmdsql);
                        $registro = mysqli_fetch_array($execsql);
                      ?>
                      <h5><?php echo $registro['quantidade']; ?></h5>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <i class="fas fa-file-alt fa-5x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
              <div class="card text-center border-0">
                <div class="card-body" style="background-color: #34495e; border: none; border-radius: 0; color: white;">
                  <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 my-auto">
                      <span>Matrículas</span>
                      <?php
                        $cmdsql = "SELECT COUNT(*) AS 'total' FROM matriculas";
                        $execsql = mysqli_query($linkmy, $cmdsql);
                        $registro = mysqli_fetch_array($execsql);
                      ?>
                      <h5><?php echo $registro['total']; ?></h5>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                      <i class="far fa-address-card fa-5x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
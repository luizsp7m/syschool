<?php require_once '../../_scripts/utilidades/connection.php' ?>
<?php require_once '../../_scripts/utilidades/session.php' ?>

<?php 
  if(isset($_POST['pesquisa'])) { 
    $valor = $_POST['pesquisa'];
    $cmdsql1 = "SELECT * FROM solicitações WHERE lower(nome) LIKE '%$valor%' ORDER BY status desc, codigo"; 
  } else { 
    $cmdsql1 = "SELECT * FROM solicitações ORDER BY status, codigo";
  } 
?>

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

    <title>Solicitações</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav class="navbar navbar-dark bg-light mb-3">
          <div class="container">
            <a href="../../_telas/funcionarios/home.php">
              <button class="btn btn-outline-white">
                <i class="fas fa-arrow-left text-dark"></i>
              </button>
            </a>
          </div>
        </nav>

        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../../_telas/funcionarios/home.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Solicitações</li>
            </ol>
          </nav>
          <div class="card">
            <div class="card-header">Adicionar</div>
            <div class="card-body">
              <!-- <form method="POST" action="../../_scripts/solicitações/adicionar.php"> -->
              <form method="POST" action="adicionar.php">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Nome da escola <span class="text-danger">*</span></label>
                    <select name="codigo_escola" id="escola" class="form-control" required>
                      <option id="selecionado" value="0" selected>Selecione uma escola</option>
                        <?php
                          $cmdsql = "SELECT * FROM escolas";
                          $execsql = mysqli_query($linkmy, $cmdsql);
                          while($registro = mysqli_fetch_array($execsql)) { ?>
                            <option value="<?= $registro['codigo']; ?>"><?= $registro['nome']; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Período <span class="text-danger">*</span></label>
                    <select name="periodo" id="periodo" class="form-control" disabled>

                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label>Turma <span class="text-danger">*</span></label>
                    <select id="turma" name="codigo_turma" class="form-control" disabled>
                      
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-outline-primary float-right">Continuar</button>
              </form>
            </div>
          </div>

          <form action="seleção.php" method="POST" class="my-4">
            <div class="input-group w-50 mx-auto">
              <input type="text" class="form-control" placeholder="Nome da solicitação" name="pesquisa">
              <div class="input-group-append">
                <button class="btn btn-success" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>

          <div class="card">
            <div class="card-header">Solicitações</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nome</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $execsql = mysqli_query($linkmy, $cmdsql1);
                      while($registro = mysqli_fetch_array($execsql)) { ?>
                        <tr>
                          <td><?php echo $registro['codigo']; ?></td>
                          <td><?php echo $registro['nome']; ?></td>
                          <td><?php if($registro['status'] == 0) { echo "<span class='text-warning'>Aguardando</span>"; } else { echo "<span class='text-success'>Matriculado</span>"; } ?></td>
                          <td>
                            <a href="alterar.php?codigo=<?= $registro['codigo'] ?>">
                              <button class="btn btn-outline-success">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                              </button>
                            </a>
                          </td>
                          <td>
                            <a href="consultar.php?codigo=<?= $registro['codigo'] ?>">
                              <button class="btn btn-outline-warning">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                              </button>
                            </a>
                          </td>
                          <td>
                            <?php
                              if($registro['status'] == 0) { ?>
                                <a href="excluir.php?codigo=<?= $registro['codigo'] ?>">
                                  <button class="btn btn-outline-danger">
                                    <i class="fa fa-times" aria-hidden="true"></i>
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

    <script type="text/javascript">

      $('#escola').change(() => {
        $('#periodo').load('periodo.php?escola=' + $('#escola').val());
        $('#selecionado').remove();
        $('#periodo').prop("disabled", false);
      });

      $('#periodo').change(() => {
        $('#turma').load('turma.php?periodo=' + $('#periodo').val() + '&&escola=' + $('#escola').val());
        $('#selecionado').remove();
        $('#turma').prop("disabled", false);
      });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
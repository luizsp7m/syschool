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

    <title>Adicionar</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav class="navbar navbar-dark bg-light mb-3">
          <div class="container">
            <a href="lista_de_registros.php?codigo_matricula=<?= $_SESSION['codigo_matricula'] ?>">
              <button class="btn btn-outline-white">
                <i class="fas fa-arrow-left text-dark"></i>
              </button>
            </a>
          </div>
        </nav>

        <div class="container">
          <form method="POST" action="../../_scripts/integração/alterar.php?codigo=<?= $_GET['codigo_integração'] ?>">
            <div class="form-row">
              <div class="form-group col-md-12">
                <?php
                  $cmdsql = "
                    SELECT S.nome, I.* FROM solicitações S INNER JOIN matriculas M
                    ON S.codigo = M.codigo_solicitação INNER JOIN integração I
                    ON I.codigo_matricula = M.codigo WHERE I.codigo = $_GET[codigo_integração];
                  ";
                  $execsql = mysqli_query($linkmy, $cmdsql);
                  $result = mysqli_fetch_array($execsql);
                ?>
                <strong>Nome do(a) aluno(a)</strong>: <?= $result['nome'] ?>
              </div>
            </div>
            <div class="form-row">
              <?php
                $cmdsql = "SELECT * FROM integração WHERE codigo = $_GET[codigo_integração]";
                $execsql = mysqli_query($linkmy, $cmdsql);
                $result = mysqli_fetch_array($execsql);
              ?>
              <div class="form-group col-md-3">
                <label>Comeu?</label><br>
                <div class="form-check form-check-inline">
                  <input <?php if($result['comida'] == 'Sim') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="comida" value="Sim">
                  <label class="form-check-label">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                  <input <?php if($result['comida'] == 'Não') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="comida" value="Não">
                  <label class="form-check-label">Não</label>
                </div>
              </div>
              <div class="form-group col-md-3">
                <label>Bebeu?</label><br>
                <div class="form-check form-check-inline">
                  <input <?php if($result['bebida'] == 'Sim') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="bebida" value="Sim" checked>
                  <label class="form-check-label">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                  <input  <?php if($result['bebida'] == 'Não') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="bebida" value="Não">
                  <label class="form-check-label">Não</label>
                </div>
              </div>
              <div class="form-group col-md-3">
                <label>Dormiu?</label><br>
                <div class="form-check form-check-inline">
                  <input <?php if($result['sono'] == 'Sim') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="sono" value="Sim" checked>
                  <label class="form-check-label">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                  <input <?php if($result['sono'] == 'Não') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="sono" value="Não">
                  <label class="form-check-label">Não</label>
                </div>
              </div>
              <div class="form-group col-md-3">
                <label>Usou o banheiro?</label><br>
                <div class="form-check form-check-inline">
                  <input <?php if($result['banheiro'] == 'Sim') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="banheiro" value="Sim" checked>
                  <label class="form-check-label">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                  <input <?php if($result['banheiro'] == 'Não') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="banheiro" value="Não">
                  <label class="form-check-label">Não</label>
                </div>
              </div>
            </div>
            <br>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label>Participou das atividades na sala?</label><br>
                <div class="form-check form-check-inline">
                  <input <?php if($result['participação_sala'] == 'Sim') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="participação_sala" value="Sim" checked>
                  <label class="form-check-label">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                  <input <?php if($result['participação_sala'] == 'Não') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="participação_sala" value="Não">
                  <label class="form-check-label">Não</label>
                </div>
              </div>
              <div class="form-group col-md-3">
                <label>Participou das atividades ao ar livre?</label><br>
                <div class="form-check form-check-inline">
                  <input <?php if($result['participação_livre'] == 'Sim') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="participação_livre" value="Sim" checked>
                  <label class="form-check-label">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                  <input <?php if($result['participação_livre'] == 'Não') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="participação_livre" value="Não">
                  <label class="form-check-label">Não</label>
                </div>
              </div>
              <div class="form-group col-md-3">
                <label>Brincou com outros alunos?</label><br>
                <div class="form-check form-check-inline">
                  <input <?php if($result['relacionamento'] == 'Sim') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="relacionamento" value="Sim" checked>
                  <label class="form-check-label">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                  <input <?php if($result['relacionamento'] == 'Não') { echo "checked"; } ?> class="form-check-input position-static" type="radio" name="relacionamento" value="Não">
                  <label class="form-check-label">Não</label>
                </div>
              </div>
              <div class="form-group">
                <input type="hidden" name="codigo_matricula" value="<?= $_GET['codigo_matricula'] ?>">
                <input type="hidden" name="codigo_turma" value="<?= $_SESSION['codigo_turma'] ?>">
                <input type="hidden" name="codigo_professor" value="<?= $_SESSION['codigo_professor'] ?>">
              </div>
            </div>
            <br>
            <div class="form-group">
              <label>Outras observações</label>
              <textarea class="form-control" rows="3" name="outros"><?= $result['outros'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
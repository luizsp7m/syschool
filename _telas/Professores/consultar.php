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

    <!-- JQuery Mask -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script type="text/javascript">
      $(document).ready(() => {
        $('input[name = "rg"]').mask("00.000.000-0");
        $('input[name = "cpf"]').mask("000.000.000-00");
        $('input[name = "telefone"]').mask("(00) 0000-0000");
        $('input[name = "celular"]').mask("(00) 00000-0000");
        $('input[name = "cep"]').mask("00000-000");
      })
    </script>

    <title>Consultar</title>
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
              <li class="breadcrumb-item"><a href="../../_telas/funcionarios/home.php">Home</a></li>
              <li class="breadcrumb-item"><a href="inicio.php">Professores</a></li>
              <li class="breadcrumb-item active" aria-current="page">Consultar</li>
            </ol>
          </nav>
          <?php
            $codigo = $_GET['codigo'];
            $cmdsql = "SELECT * FROM professores WHERE codigo = $codigo";
            $execsql = mysqli_query($linkmy, $cmdsql);
            $registro = mysqli_fetch_array($execsql);
          ?>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label>Nome completo</label>
              <input type="text" class="form-control" name="nome" value="<?php echo $registro['nome'] ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <label>Data de nascimento</label>
              <input type="date" class="form-control" name="data_nascimento" value="<?php echo $registro['data_nascimento'] ?>" disabled>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>RG</label>
              <input type="text" class="form-control" name="rg" value="<?php echo $registro['rg'] ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <label>CPF</label>
              <input type="text" class="form-control" name="cpf" value="<?php echo $registro['cpf'] ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <label>Sexo</label>
              <input type="text" class="form-control" name="sexo" value="<?php echo $registro['sexo'] ?>" disabled>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>E-mail</label>
              <input type="email" class="form-control" name="email" value="<?php echo $registro['email'] ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <label>Telefone</label>
              <input type="text" class="form-control" name="telefone" value="<?php echo $registro['telefone'] ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <label>Celular</label>
              <input type="text" class="form-control" name="celular" value="<?php echo $registro['celular'] ?>" disabled>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label>Endereço</label>
              <input type="text" class="form-control" name="endereco" value="<?php echo $registro['endereco'] ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <label>Bairro</label>
              <input type="text" class="form-control" name="bairro" value="<?php echo $registro['bairro'] ?>" disabled>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Cidade</label>
              <input type="text" class="form-control" name="cidade" value="<?php echo $registro['cidade'] ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <label>Estado</label>
              <input type="text" class="form-control" name="estado" value="<?php echo $registro['estado'] ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <label>CEP</label>
              <input type="text" class="form-control" name="cep" value="<?php echo $registro['cep'] ?>" disabled>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Status</label>
              <input type="text" class="form-control" name="status" value="<?php if($registro['status'] == 0) { echo "Inativo"; } else { echo "Ativo"; } ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <label>Data de registro</label>
              <input type="date" class="form-control" name="data_registro" value="<?php echo $registro['data_registro'] ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <?php
                $cmdsql = "SELECT * FROM funcionarios WHERE codigo = $registro[codigo_funcionario]";
                $execsql = mysqli_query($linkmy, $cmdsql);
                $row = mysqli_fetch_array($execsql);
              ?>
              <label>Responsável pelo cadastro</label>
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
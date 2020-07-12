<?php require_once '../../_scripts/utilidades/connection.php' ?>
<?php require_once '../../_scripts/utilidades/session.php' ?>

<?php date_default_timezone_set('America/Sao_Paulo'); ?>

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

    <script type="text/javascript" src="../../_scripts/utilidades/letras.js"></script>
    
    <script type="text/javascript">
      $(document).ready(() => {
        $('input[name = "rg"]').mask("00.000.000-0");
        $('input[name = "cpf"]').mask("000.000.000-00");
        $('input[name = "telefone"]').mask("(00) 0000-0000");
        $('input[name = "celular"]').mask("(00) 00000-0000");
        $('input[name = "cep"]').mask("00000-000");
      })
    </script>

    <title>Adicionar</title>
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
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item"><a href="inicio.php">Funcionários</a></li>
              <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
            </ol>
          </nav>
          <form method="POST" action="../../_scripts/funcionarios/adicionar.php">
            <div class="form-row">
              <div class="form-group col-md-8">
                <label>Nome completo <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nome" required maxlength="60">
              </div>
              <div class="form-group col-md-4">
                <label>Data de nascimento <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="data_nascimento" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>RG <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="rg" required maxlength="12" minlength="12">
              </div>
              <div class="form-group col-md-4">
                <label>CPF <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="cpf" required maxlength="14" minlength="14">
              </div>
              <div class="form-group col-md-4">
                <label>Sexo <span class="text-danger">*</span></label>
                <select name="sexo" class="form-control">
                  <option value="Masculino" selected>Masculino</option>
                  <option value="Feminino">Feminino</option>
                  <option value="Não binário">Não binário</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>E-mail</label>
                <input type="email" class="form-control" name="email" required maxlength="60">
              </div>
              <div class="form-group col-md-4">
                <label>Telefone</label>
                <input type="text" class="form-control" name="telefone" maxlength="14" minlength="14">
              </div>
              <div class="form-group col-md-4">
                <label>Celular</label>
                <input type="text" class="form-control" name="celular" maxlength="15" minlength="15">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-8">
                <label>Endereço<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="endereco" required maxlength="60">
              </div>
              <div class="form-group col-md-4">
                <label>Bairro <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="bairro" required maxlength="30">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Cidade <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="cidade" required maxlength="30">
              </div>
              <div class="form-group col-md-4">
                <label>Estado <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="estado" required maxlength="2" minlength="2">
              </div>
              <div class="form-group col-md-4">
                <label>CEP <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="cep" required maxlength="9" minlength="9">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                  <option value="1" selected>Ativo</option>
                  <option value="0">Inativo</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label>Data de registro <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="data_registro" value="<?= date('Y-m-d') ?>" disabled>
              </div>
              <div class="form-group col-md-4">
                <?php
                  $cmdsql = "SELECT * FROM funcionarios WHERE codigo = $_SESSION[codigo_funcionario]";
                  $execsql = mysqli_query($linkmy, $cmdsql);
                  $registro = mysqli_fetch_array($execsql);
                ?>
                <label>Responsável pelo cadastro <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="codigo_funcionario" placeholder="<?= $registro['nome'] ?>" disabled>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
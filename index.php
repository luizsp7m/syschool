<?php session_start(); ?>
<?php
  echo 'Current PHP version: ' . phpversion();
  echo "<br>";
  date_default_timezone_set('America/Sao_Paulo');
  echo date('d/m/Y \à\s H:i:s');
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
    <link rel="stylesheet" type="text/css" href="_css/estilo.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/c8bf600d07.js" crossorigin="anonymous"></script>

    <style type="text/css">
      body {
        color: #fff;
        background: #d47677;
      }

      .form-control {
        min-height: 41px;
        background: #fff;
        box-shadow: none !important;
        border-color: #e3e3e3;
      }

      .form-control:focus {
        border-color: #70c5c0;
      }

      .form-control, .btn {        
        border-radius: 2px;
      }

      .login-form {
        width: 350px;
        margin: 0 auto;
        padding: 100px 0 30px;    
      }

      .login-form form {
        color: #7a7a7a;
        border-radius: 2px;
        margin-bottom: 15px;
        font-size: 13px;
        background: #ececec;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;  
        position: relative; 
      }

      .login-form h2 {
        font-size: 22px;
        margin: 35px 0 25px;
      }

      .login-form .avatar {
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -50px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #70c5c0;
        padding: 15px;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        text-align: center;
        color: #fff;
      }

      .login-form .avatar img {
        width: 100%;
      } 

      .login-form input[type="checkbox"] {
        margin-top: 2px;
      }

      .login-form .btn {        
        font-size: 16px;
        font-weight: bold;
        background: #70c5c0;
        border: none;
        margin-bottom: 20px;
      }

      .login-form .btn:hover, .login-form .btn:focus {
        background: #50b8b3;
        outline: none !important;
      }  

      .login-form a {
        color: #fff;
        text-decoration: underline;
      }

      .login-form a:hover {
        text-decoration: none;
      }

      .login-form form a {
        color: #7a7a7a;
        text-decoration: none;
      }

      .login-form form a:hover {
        text-decoration: underline;
      }
    </style>

    <title>Login</title>
  </head>
  <body>
    <div class="login-form">
      <form action="_scripts/utilidades/login.php" method="POST">
        <div class="avatar">
          <i class="fas fa-user-tie fa-5x"></i>
        </div>
        <h2 class="text-center">Login</h2>   
        <div class="form-group">
          <input type="text" class="form-control" name="usuario" placeholder="Usuário" required="required">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="senha" placeholder="Senha" required="required">
        </div>
        <div class="form-group">
          <select name="tipo_conta" class="form-control">
            <option value="funcionario" selected>Funcionário</option>
            <option value="professor">Professor</option>
          </select>
        </div>
        <?php if(isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == false) { ?>
          <div class="form-group text-center">
            <span class="text-danger">ERRO: Usuário ou senha incorreto(s)</span>
          </div>
        <?php }
          unset($_SESSION['autenticado']);
        ?>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
        </div>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
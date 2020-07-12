<?php
  require_once '../../_scripts/utilidades/connection.php';
  require_once '../../_scripts/utilidades/session.php';

  $transacao = true;
  $_SESSION['codigo_escola'] = $_POST['codigo_escola'];
  $_SESSION['periodo'] = $_POST['periodo'];

  /* Vendo idade generica para determinar o tipo de turma */
  $idade_generica = 2020 - $_POST['ano_nascimento'];
  if($idade_generica <= 3) {
    $tipo_turma = 'Tipo 1';
  } else if($idade_generica <= 4) {
    $tipo_turma = 'Tipo 2';
  } else {
    $tipo_turma = 'Tipo 3';
  }

  $_SESSION['tipo_turma'] =  $tipo_turma;

  $cmdsql = "SELECT * FROM turmas WHERE codigo_escola = $_POST[codigo_escola] AND periodo = '$_POST[periodo]' AND tipo_turma = '$tipo_turma' AND status = 1 ORDER BY tipo_turma"; /* Condição */
  $execsql = mysqli_query($linkmy, $cmdsql);
  $row = mysqli_num_rows($execsql);
  if($row == 0) {
    echo "Não exite uma turma e/ou período nessa escola!";
    exit();
  } else {
    Header('Location: ../../_telas/solicitações/adicionar.php');
    exit();
  }
?>
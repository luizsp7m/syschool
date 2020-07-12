<?php
	require_once '../../_scripts/utilidades/connection.php';
	session_start();

	$codigo_solicitação = mysqli_real_escape_string($linkmy, $_POST['codigo_solicitação']);
	$cpf_mae = mysqli_real_escape_string($linkmy, $_POST['cpf_mae']);

	$cmdsql = "SELECT * from solicitações WHERE codigo = '$codigo_solicitação' and cpf_mae = '$cpf_mae' and status = 1";

	$execsql = mysqli_query($linkmy, $cmdsql);
	$registro = mysqli_fetch_array($execsql);
	$row = mysqli_num_rows($execsql);

	if ($row == 1) {
		$_SESSION['codigo_solicitação'] = $codigo_solicitação;
		header('Location: inicio.php');
		exit();
	} else {
		$_SESSION['codigo_solicitação'] = false;
		header('Location: index.php');
		exit();
	}
?>
<?php
	require_once '../../_scripts/utilidades/connection.php';
	session_start();

	$codigo = mysqli_real_escape_string($linkmy, $_POST['codigo']);

	$cmdsql = "SELECT * from solicitações WHERE codigo = '$codigo'";
	$execsql = mysqli_query($linkmy, $cmdsql);
	$registro = mysqli_fetch_array($execsql);
	$row = mysqli_num_rows($execsql);

	if ($row == 1) {
		header('Location: ../../_telas/lista/consultar.php?codigo=' . $codigo);
		exit();
	} else {
		$_SESSION['cadastrado'] = false;
		header('Location: ../../_telas/lista/inicio.php');
		exit();
	}
?>
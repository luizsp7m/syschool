<?php
	require_once 'connection.php';
	session_start();

	$usuario = mysqli_real_escape_string($linkmy, $_POST['usuario']);
	$senha = mysqli_real_escape_string($linkmy, $_POST['senha']);

	if($_POST['tipo_conta'] == 'funcionario') {
		$cmdsql = "SELECT * from funcionarios WHERE usuario = '$usuario' and senha = md5('$senha') and status = 1";
	} else {
		$cmdsql = "SELECT * from professores WHERE usuario = '$usuario' and senha = md5('$senha') and status = 1";
	}

	$execsql = mysqli_query($linkmy, $cmdsql);
	$registro = mysqli_fetch_array($execsql);
	$row = mysqli_num_rows($execsql);

	if ($row == 1) {
		if($_POST['tipo_conta'] == 'funcionario') {
			$_SESSION['usuario'] = $usuario;
			$_SESSION['codigo_funcionario'] = $registro['codigo'];
			header('Location: ../../_telas/funcionarios/home.php');
			exit();
		} else {
			$_SESSION['professor'] = $usuario;
			$_SESSION['codigo_professor'] = $registro['codigo'];
			header('Location: ../../_telas/integração/inicio.php');
			exit();
		}
	} else {
		$_SESSION['autenticado'] = false;
		echo "Não logou";
		header('Location: ../../index.php');
		exit();
	}
?>
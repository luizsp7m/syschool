<?php
	require_once '../../_scripts/utilidades/connection.php';
	require_once '../../_scripts/utilidades/session.php';

	date_default_timezone_set('America/Sao_Paulo');

	$transacao = true;
	while ($transacao) {
		mysqli_query($linkmy, "START TRANSACTION");
		$ultimo = mysqli_fetch_array(mysqli_query($linkmy, "SELECT MAX(codigo) AS CpMAX FROM turmas"));
		$CP = $ultimo['CpMAX'] + 1;
		$codigo_funcionario = $_SESSION['codigo_funcionario'];
		$codigo_escola = $_SESSION['codigo_escola'];
		$data_registro = date('Y-m-d');
		$cmdsql = "INSERT INTO turmas VALUES (
			'$CP',
			'$codigo_escola',
			'$_REQUEST[tipo_turma]',
			'$_REQUEST[num_turma]',
			'$_REQUEST[qtd_maxima]',
			'$_REQUEST[periodo]',
			'$_REQUEST[codigo_professor]',
			'$_REQUEST[status]',
			'$data_registro',
			'$codigo_funcionario'
		)";

		$execsql = mysqli_query($linkmy, $cmdsql);

		if (mysqli_errno($linkmy) == 0) {
    		mysqli_query($linkmy, "COMMIT");
    		$transacao = FALSE;
    		$resultado = 'OK';
    	} else if (mysqli_errno($linkmy) == 1213) {
    		$transacao = TRUE;
    	} else {
    		$transacao = FALSE;
      		$resultado = mysqli_errno($linkmy) . " - " . mysqli_error($linkmy);
    	}

    	mysqli_query($linkmy, "ROLLBACK");
	}

	if($resultado == 'OK') {
		header("Location: ../../_telas/turmas/inicio.php?codigo_escola=$_SESSION[codigo_escola]");
		exit();
	} else {
		echo $resultado;
	}
?>
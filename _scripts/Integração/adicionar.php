<?php
	require_once '../../_scripts/utilidades/connection.php';
	require_once '../../_scripts/utilidades/session_professor.php';
	require_once '../../_scripts/utilidades/funções.php';

	date_default_timezone_set('America/Sao_Paulo');

	$transacao = true;

	while ($transacao) {
		mysqli_query($linkmy, "START TRANSACTION");
		$ultimo = mysqli_fetch_array(mysqli_query($linkmy, "SELECT MAX(codigo) AS CpMAX FROM integração"));
		$CP = $ultimo['CpMAX'] + 1;

		/* Formatando Valores */
		$data_registro = date('Y-m-d');

		$cmdsql = "INSERT INTO integração VALUES (
			'$CP',
			'$_REQUEST[comida]',
			'$_REQUEST[bebida]',
			'$_REQUEST[sono]',
			'$_REQUEST[banheiro]',
			'$_REQUEST[participação_sala]',
			'$_REQUEST[participação_livre]',
			'$_REQUEST[relacionamento]',
			'$_REQUEST[outros]',
			'$data_registro',
			'$_REQUEST[codigo_matricula]',
			'$_REQUEST[codigo_turma]',
			'$_REQUEST[codigo_professor]'
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
		header('Location: ../../_telas/integração/alunos.php?codigo_turma=' . $_SESSION[codigo_turma]);
		exit();
	} else {
		echo $resultado;
	}
?>
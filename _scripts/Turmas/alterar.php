<?php
	require_once '../../_scripts/utilidades/connection.php';
	require_once '../../_scripts/utilidades/session.php';
	
	$transacao = true;
	while ($transacao) {
		mysqli_query($linkmy, "START TRANSACTION");
		$cmdsql = "UPDATE turmas SET
			tipo_turma = '$_REQUEST[tipo_turma]',
			num_turma = '$_REQUEST[num_turma]',
			qtd_maxima = '$_REQUEST[qtd_maxima]',
			periodo = '$_REQUEST[periodo]',
			codigo_professor = '$_REQUEST[codigo_professor]',
			status = '$_REQUEST[status]'
			WHERE codigo = $_GET[codigo]
		";

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
<?php
	require_once '../../_scripts/utilidades/connection.php';
	require_once '../../_scripts/utilidades/session.php';

    $transacao = true;

    $cmdsql = "SELECT * FROM solicitações WHERE codigo = $_GET[codigo]";
    $execsql = mysqli_query($linkmy, $cmdsql);
    $result = mysqli_fetch_array($execsql);

	while ($transacao) {
		mysqli_query($linkmy, "START TRANSACTION");
		$ultimo = mysqli_fetch_array(mysqli_query($linkmy, "SELECT MAX(codigo) AS CpMAX FROM matriculas"));
		$CP = $ultimo['CpMAX'] + 1;
		$cmdsql = "INSERT INTO matriculas VALUES (
			'$CP',
			'$result[codigo]',
            '$result[codigo_turma]'
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
		$cmdsql = "UPDATE solicitações SET status = 1 WHERE codigo = $_GET[codigo]";
        $execsql = mysqli_query($linkmy, $cmdsql);
		header("Location: ../../_telas/matrículas/inicio.php?codigo_escola=$_SESSION[codigo_escola]");
		exit();
	} else {
		echo $resultado;
	}
?>
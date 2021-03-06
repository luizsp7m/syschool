<?php
	require_once '../../_scripts/utilidades/connection.php';
	require_once '../../_scripts/utilidades/session_professor.php';
	require_once '../../_scripts/utilidades/funções.php';
	
	$transacao = true;
	while ($transacao) {
		mysqli_query($linkmy, "START TRANSACTION");
		
		$cmdsql = "UPDATE integração SET
			comida = '$_REQUEST[comida]',
			bebida = '$_REQUEST[bebida]',
			sono = '$_REQUEST[sono]',
			banheiro = '$_REQUEST[banheiro]',
			participação_sala = '$_REQUEST[participação_sala]',
			participação_livre = '$_REQUEST[participação_livre]',
			relacionamento = '$_REQUEST[relacionamento]',
			outros = '$_REQUEST[outros]'
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
		header('Location: ../../_telas/integração/lista_de_registros.php?codigo_matricula=' . $_SESSION[codigo_matricula]);
		echo "OK";
		exit();
	} else {
		echo $resultado;
	}
?>
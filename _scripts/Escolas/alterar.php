<?php
	require_once '../../_scripts/utilidades/connection.php';
	require_once '../../_scripts/utilidades/session.php';
	require_once '../../_scripts/utilidades/funções.php';
	
	$transacao = true;
	while ($transacao) {
		mysqli_query($linkmy, "START TRANSACTION");

		$cnpj = formatarValor($_REQUEST['cnpj']);
		$telefone = formatarValor($_REQUEST['telefone']);
		$celular = formatarValor($_REQUEST['celular']);
		
		$cmdsql = "UPDATE escolas SET
			nome = '$_REQUEST[nome]',
			cnpj = '$cnpj',
			email = '$_REQUEST[email]',
			telefone = '$telefone',
			celular = '$celular',
			endereco = '$_REQUEST[endereco]',
			bairro = '$_REQUEST[bairro]',
			cidade = '$_REQUEST[cidade]',
			estado = '$_REQUEST[estado]',
			cep = '$_REQUEST[cep]',
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
		header('Location: ../../_telas/escolas/inicio.php');
		exit();
	} else {
		echo $resultado;
	}
?>
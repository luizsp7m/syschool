<?php
	require_once '../../_scripts/utilidades/connection.php';
	require_once '../../_scripts/utilidades/session.php';
	require_once '../../_scripts/utilidades/funções.php';

	date_default_timezone_set('America/Sao_Paulo');

	$transacao = true;
	while ($transacao) {
		mysqli_query($linkmy, "START TRANSACTION");
		$ultimo = mysqli_fetch_array(mysqli_query($linkmy, "SELECT MAX(codigo) AS CpMAX FROM professores"));
		$CP = $ultimo['CpMAX'] + 1;

		/* Formatando Valores */
		$rg = formatarValor($_REQUEST['rg']);
		$cpf = formatarValor($_REQUEST['cpf']);
		$telefone = formatarValor($_REQUEST['telefone']);
		$celular = formatarValor($_REQUEST['celular']);
		$username = gerarUsuario($_REQUEST['nome'], $CP);
		$data_registro = date('Y-m-d');

		$codigo_funcionario = $_SESSION['codigo_funcionario'];
		$cmdsql = "INSERT INTO professores VALUES (
			'$CP',
			'$_REQUEST[nome]',
			'$_REQUEST[data_nascimento]',
			'$rg',
			'$cpf',
			'$_REQUEST[sexo]',
			'$_REQUEST[email]',
			'$telefone',
			'$celular',
			'$_REQUEST[endereco]',
			'$_REQUEST[bairro]',
			'$_REQUEST[cidade]',
			'$_REQUEST[estado]',
			'$_REQUEST[cep]',
			'$_REQUEST[status]',
			'$data_registro',
			'$codigo_funcionario', lower('$username'), md5('$cpf')
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
		header('Location: ../../_telas/professores/inicio.php');
		exit();
	} else {
		echo $resultado;
	}
?>
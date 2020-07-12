<?php 
	require_once '../../_scripts/utilidades/connection.php';
	require_once '../../_scripts/utilidades/session.php';
	$periodo = $_GET['periodo'];

	if($periodo == 'Integral') {
		$cmdsql = "SELECT DISTINCT P.nome, P.codigo FROM turmas T INNER JOIN professores P ON T.codigo_professor = P.codigo WHERE T.periodo <> 'Manhã' AND T.periodo <> 'Tarde'";
	} else {
		$cmdsql = "SELECT DISTINCT P.nome, P.codigo FROM turmas T INNER JOIN professores P ON T.codigo_professor = P.codigo WHERE T.periodo <> '$periodo'";
	}

	$execsq = mysqli_query($linkmy, $cmdsql);
	while ($registro = mysqli_fetch_array($execsq)) { ?>
		<option value="<?= $registro[codigo] ?>"><?= $registro['nome'] ?></option>
	<?php } ?>
?>
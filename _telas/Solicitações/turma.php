<?php 
	require_once '../../_scripts/utilidades/connection.php';
	require_once '../../_scripts/utilidades/session.php';
	$escola = $_GET['escola'];
	$periodo = $_GET['periodo'];

	$cmdsql = "SELECT * FROM turmas WHERE codigo_escola = $escola AND periodo = '$periodo'";

	$execsq = mysqli_query($linkmy, $cmdsql);

	while ($registro = mysqli_fetch_array($execsq)) { ?>
		<option value="<?= $registro['codigo'] ?>"><?= $registro['tipo_turma'] ?></option>
	<?php } ?>
?>
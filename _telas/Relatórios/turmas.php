<?php 
	require_once '../../_scripts/utilidades/connection.php';
	require_once '../../_scripts/utilidades/session.php';
	$escola = $_GET['escola'];

	$cmdsql = "SELECT * FROM turmas WHERE codigo_escola = $escola";

	$execsq = mysqli_query($linkmy, $cmdsql);

	while ($registro = mysqli_fetch_array($execsq)) { ?>
		<option value="<?= $registro['codigo'] ?>"><?= $registro['num_turma'] ?></option>
	<?php } ?>

	echo "<option value='todas'>Todas</option>";
?>
<?php 
	require_once '../../_scripts/utilidades/connection.php';
	require_once '../../_scripts/utilidades/session.php';
	$escola = $_GET['escola'];

	$cmdsql = "SELECT * FROM turmas WHERE codigo_escola = $escola GROUP BY periodo";

	$execsq = mysqli_query($linkmy, $cmdsql);

?>

	<option id="selecionado">Escolha o período</option>

<?php

	while ($registro = mysqli_fetch_array($execsq)) { ?>
		<option value="<?= $registro['periodo'] ?>"><?= $registro['periodo'] ?></option>
	<?php } ?>
?>
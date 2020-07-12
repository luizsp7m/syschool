<?php
	session_start();
	if(!isset($_SESSION['codigo_solicitação']) || ($_SESSION['codigo_solicitação'] == false)) {
		header('Location: index.php');
		exit();
	}
?>
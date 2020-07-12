<?php
	session_start();
	if(!isset($_SESSION['professor'])) {
		header('Location: ../../index.php');
		exit();
	}
?>
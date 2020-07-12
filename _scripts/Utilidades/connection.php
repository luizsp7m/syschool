<?php
	global $linkmy;
	$linkmy = mysqli_connect(
		'localhost', // Hostname
		'root', // Username
		'',  // Password
		'waitlist' // Database name
	) or die ('A conexão com o DB falhou');
?>
<?php
	require_once '../../_scripts/utilidades/connection.php';
    require_once '../../_scripts/utilidades/session.php';
    $transacao = true;
    while ($transacao) {
        mysqli_query($linkmy, "START TRANSACTION");
        $cmdsql = "UPDATE funcionarios SET status = 0 WHERE codigo = $_GET[codigo]";
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
        if($_GET['codigo'] == $_SESSION['codigo_funcionario']) {
            header('Location: ../utilidades/logout.php');
        } else {
            header('Location: ../../_telas/funcionarios/inicio.php');
            exit();
        }
    } else {
        echo $resultado;
    }
?>
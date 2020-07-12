<?php
    function formatarValor($valor) {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        $valor = str_replace("(", "", $valor);
        $valor = str_replace(")", "", $valor);
        return $valor;
    }

    function gerarUsuario($valor, $numero) {
        $valor = strstr($valor, ' ', true);
        $valor = $valor . $numero;
        return $valor;
    }
?>
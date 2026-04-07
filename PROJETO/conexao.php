<?php
    $hostname = "localhost";
    $banco_de_dados = "bancodb"; //! vou mudar dps para "edufluxo"
    $usuario = "root";
    $senha = "";

    $mysqli = new mysqli($hostname, $usuario, $senha, $banco_de_dados);

    if($mysqli->connect_errno){
        echo "falha ao conectar:(" . $mysqli->connect_errno . ")" . $mysqli->connect_errno;
    }
    else echo "conectado ao banco de dados"
?>
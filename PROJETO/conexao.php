<?php
    $hostname = "localhost";
    $banco_de_dados = "edufluxo";
    $usuario = "root";
    $senha = "";

    $mysqli = new mysqli($hostname, $usuario, $senha, $banco_de_dados);

    if($mysqli->connect_errno){
        echo "falha ao conectar:(" . $mysqli->connect_errno . ")" . $mysqli->connect_errno;
    }
    else echo "conectado ao banco de dados"

     //! COMANDOS SQL NO PHP:
            
            //todo Conexão com o banco
            // $conexao = new mysqli("localhost", "root", "", "edufloxo");


            //todo INSERT → adiciona um novo usuário
            //! $conexao->query("INSERT INTO usuarios (nome) VALUES ('Larissa')");


            //todo SELECT → pega dados do banco
            


            //todo fetch_row → pega só a PRIMEIRA linha do resultado
            //! $linha = $resultado->fetch_row();


            //todo echo → mostra o valor na tela
            //! echo $linha[0] . "<br>";


            //todo UPDATE → altera um dado existente
            //! $conexao->query("UPDATE usuarios SET nome = 'Ana' WHERE id = 1");


            //todo DELETE → remove um dado
            //! $conexao->query("DELETE FROM usuarios WHERE id = 2");
?>
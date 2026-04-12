<?php
    $conexao = new mysqli("localhost", "root", "", "edufluxo");

    if ($conexao->connect_error) {
        die("Erro na conexão");
    }

    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!is_array($data) || !isset($data["para"])) {  //! caso for null
        http_response_code(400);
        exit("Dados inválidos");
    }

    switch($data["para"]){
        case "alunos":
            $conexao->query("INSERT INTO alunos VALUES ('{$data["cgm"]}', '{$data["nome"]}', '{$data["email"]}', '{$data["serie"]}')");
            // echo "funcionou";
            break;
        case "usuarios":
            $conexao->query("INSERT INTO usuarios VALUES ('{$data["cpf"]}', '{$data["nome"]}', '{$data["email"]}', '{$data["senha"]}', '{$data["permissao"]}')");
            // echo "funcionou";
            break;
        default:
            http_response_code(400);
            exit("Dados inválidos");
    }
?>
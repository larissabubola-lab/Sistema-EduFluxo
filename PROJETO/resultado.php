<?php
    include("conexao.php");

    session_start();

    $conexao = new mysqli("localhost", "root", "", "edufluxo");

    if ($conexao->connect_error) {
        die("Erro na conexão");
    }

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $dados = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    $dados->bind_param("ss", $email, $senha);

    $dados->execute();

    $resultado = $dados->get_result();

    if($resultado->num_rows > 0){
        $usuarios = $resultado->fetch_assoc();

        $_SESSION["nome"] = $usuarios["nome"];
        $permissao = (int) $usuarios["permissao"];
        $_SESSION["permissao"] = $permissao;

        header("Location: pagina.php");

        // switch ($permissao){
        //     case 0:
        //         header("Location: pagina.html?nome=$nome_usuario&permissao=$permissao");
        //         break;
        //     case 1:
        //         header("Location: pagina.html?nome=$nome_usuario&permissao=$permissao");
        //         break;
        //     case 2:
        //         header("Location: pagina.html?nome=$nome_usuario&permissao=$permissao");
        //         break;
        //     default:
        //         http_response_code(400);
        //         die("dados invalidos");
                
        // }
        die();
    }

    else{
        header("Location: index.html?erro=nao_existe");
        die();
        
    }
        
?>
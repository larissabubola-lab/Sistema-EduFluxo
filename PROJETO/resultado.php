<?php
    include("conexao.php");

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

        $permissao = (int) $usuarios["permissao"];
        switch ($permissao){
            case 0:
                header("Location: pagina.html?permissao=$permissao");
                break;
            case 1:
                header("Location: pagina.html?permissao=$permissao");
                break;
            default:
                header("Location: pagina.html?permissao=$permissao");
                break;
        }
        die();

        
    }

    else{
        header("Location: index.html?erro=nao_existe");
        die();
        
    }
        
?>
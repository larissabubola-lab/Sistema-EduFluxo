<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Sistema EduFlux</title>
        <meta charset="UTF-8">
        <link href="PROJETO/resultado.css" rel="stylesheet">
    </head>

    <body>
        <h1>Aqui vai ficar a base do programa</h1>
        <script src="PROJETO/index.js"></script>
        <?php
            include("conexao.php");

            $conexao = new mysqli("localhost", "root", "", "edufluxo");

            $email = $_POST["email"];
            $senha = $_POST["senha"];
            // $permissao = $_POST["input_radio"];

            $dados = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
            $dados->bind_param("ss", $email, $senha);

            $dados->execute();

            $resultado = $dados->get_result();

            if($resultado->num_rows > 0){
                $usuarios = $resultado->fetch_assoc();

                $permissao = $usuarios["permissao"];
                switch ($permissao){
                    case 0:
                        echo "<br>é um admin";
                        break;
                    case 1:
                        echo "<br>é a portaria";
                        break;
                    default:
                        echo "<br>é um professor";
                        break;
                };
                
             
            }
            else{
                header("Location: index.html?erro=nao_existe");
                die();
                
            }

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
    </body>
</html>
<?php
    include("conexao.php");

    $conexao = new mysqli("localhost", "root", "", "edufluxo");

    $email = $_POST["email"];
    $senha = $_POST["senha"];

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
                $nivel_permissao = 0;
                break;
            case 1:
                echo "<br>é a portaria";
                $nivel_permissao = 1;
                break;
            default:
                echo "<br>é um professor";
                $nivel_permissao = 2;
                break;
        };
        
    }

    else{
        header("Location: index.html?erro=nao_existe");
        die();
        
    }
        
    ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Sistema EduFlux</title>
        <meta charset="UTF-8">
        <link href="resultado.css" rel="stylesheet">
    </head>

    <body>
        <h1 id="dashboard">AQUI VAI FICAR O DASHBOARD</h1>

        <div id="ocorrencias">
            <label for="nome_aluno">Nome do aluno</label>
            <input type="text" id="nome_aluno" placeholder="adcione o nome do aluno">
            <label for="sala">Sala:</label>
            <input type="text" id="sala" placeholder="adcione a sala">
            <div id="div">
                <label for="bom" class="label">Elogio</label>
                <input type="radio" id="bom"">
                <label for="ruim" class="label">Bronca</label>
                <input type="radio" id="ruim">
            </div>
            <label for="campo_ocorrencia">O que esse aluno fez?</label>
            <textarea id="campo_ocorrencia" placeholder="escreva o motivo dessa ocorrencia"></textarea>
        </div>

        <div id="fluxos_saida">
            <label for="nome">Nome do aluno:</label>
            <input type="text" name="nome" placeholder="escreva o nome do aluno">
            <label form="serie">Serie:</label>
            <input type="text" name="serie" placeholder="escreva a serie do aluno">
            <label for="motivo">Motivo:</label>
            <select>
                <option>O aluno chegou atrasado</option>
                <option>O aluno vai saiu mais cedo</option>
            </select>
        </div>

        <div id="add_alunos">
            <label for="cgm">CGM:</label>
            <input type="number" name="cgm" placeholder="escreva o cgm do aluno">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" escreva o nome do aluno>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="escreva o email do aluno">
        </div>

        <div id="add_usuarios">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" placeholder="escreva o cpf">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" placeholder="escreva o nome">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="escreva o email">
        </div>
        
        
        <script>
            let permissao = "<?php echo $nivel_permissao; ?>"
            let permissao_numero = parseInt(permissao)
            const ocorrencia = document.getElementById("ocorrencias")
            const fluxo = document.getElementById("fluxos_saida")


            switch(permissao_numero){
                case 0:
                    ocorrencia.style.display = "none"
                    fluxo.style.display = "none"
                    document.getElementById("add_alunos").style.display = "block"
                    document.getElementById("add_usuarios").style.display = "block"
                    break
                case 1:
                    ocorrencia.style.display = "none"
                    fluxo.style.display = "block"
                    document.getElementById("add_alunos").style.display = "none"
                    document.getElementById("add_usuarios").style.display = "none"
                    break
                default:
                    ocorrencia.style.display = "block"
                    fluxo.style.display = "none"
                    document.getElementById("add_alunos").style.display = "none"
                    document.getElementById("add_usuarios").style.display = "none"
                    break
            }
        </script>
        
        <script src="index.js"></script>
    </body>
</html>
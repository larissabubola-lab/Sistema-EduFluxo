<?php
    $conexao = new mysqli("localhost", "root", "", "edufluxo");

    $alunos = $conexao->query("SELECT * FROM alunos");
    $alunos = $alunos->fetch_all();
    $alunos = count($alunos);

    $usuarios = $conexao->query("SELECT * FROM usuarios");
    $usuarios = $usuarios->fetch_all();
    $usuarios = count($usuarios);

    $admins = $conexao->query("SELECT * FROM usuarios WHERE permissao = 0");
    $admins = $admins->fetch_all();
    $admins = count($admins);

    $porteiros = $conexao->query("SELECT * FROM usuarios WHERE permissao = 1");
    $porteiros = $porteiros->fetch_all();
    $porteiros = count($porteiros);

    $professores = $conexao->query("SELECT * FROM usuarios WHERE permissao = 2");
    $professores = $professores->fetch_all();
    $professores = count($professores);

    $ocorrencias = $conexao->query("SELECT * FROM ocorrencias");
    $ocorrencias = $ocorrencias->fetch_all();
    $ocorrencias = count($ocorrencias);

    $ocorrencias_boas = $conexao->query("SELECT * FROM ocorrencias WHERE tipo = 'positiva'");
    $ocorrencias_boas = $ocorrencias_boas->fetch_all();
    $ocorrencias_boas = count($ocorrencias_boas);

    $ocorrencias_ruins = $conexao->query("SELECT * FROM ocorrencias WHERE tipo = 'negativa' ");
    $ocorrencias_ruins = $ocorrencias_ruins->fetch_all();
    $ocorrencias_ruins = count($ocorrencias_ruins);

    $fluxos = $conexao->query("SELECT * FROM fluxo_saidas");
    $fluxos = $fluxos->fetch_all();
    $fluxos = count($fluxos);

    $atrasos = $conexao->query("SELECT * FROM fluxo_saidas WHERE motivo = 'O aluno chegou atrasado'");
    $atrasos = $atrasos->fetch_all();
    $atrasos = count($atrasos);

    $saiu_mais_cedo = $conexao->query("SELECT * FROM fluxo_saidas WHERE motivo = 'O aluno saiu mais cedo'");
    $saiu_mais_cedo = $saiu_mais_cedo->fetch_all();
    $saiu_mais_cedo = count($saiu_mais_cedo);

    $outro = $conexao->query("SELECT * FROM fluxo_saidas WHERE motivo != 'O aluno chegou atrasado' && 'O aluno saiu mais cedo'");
    $outro = $outro->fetch_all();
    $outro = count($outro);
    
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <link href="dashboard.css" rel="stylesheet">
    </head>

    <body>
        <main id="dashboard">
            <div id="numero_alunos" class="espacos">
                <span >Total de alunos:</span>
                <span><?php echo htmlspecialchars($alunos) ?></span>
            </div>

            <div id="numero_usuarios" class="espacos">
                <span>Total de usuarios:</span>
                <span><?php echo htmlspecialchars($usuarios) ?></span><br>

                <!-- <span>Admins:</span>
                <span><?php echo htmlspecialchars($admins) ?></span><br>

                <span>Porteiros:</span>
                <span><?php echo htmlspecialchars($porteiros) ?></span><br>

                <span>Professores:</span>
                <span><?php echo htmlspecialchars($professores) ?></span> -->
            </div>
            
            <!-- <div class="espacos" id="numero_de_ocorrencias"> 
                <span id="numero_ocorrencias">Total de ocorrencias:</span>
                <span><?php echo htmlspecialchars($ocorrencias) ?></span><br>

                <span>Ocorrencias boas:</span>
                <span><?php echo htmlspecialchars($ocorrencias_boas) ?></span><br>

                <span>Ocorrencias ruins:</span>
                <span><?php echo htmlspecialchars($ocorrencias_ruins) ?></span>
            </div> -->

            <!-- <div id="numero_de_portaria" class="espacos">
                <span id="numero_portaria">Total de fluxos:</span>
                <span> <?php echo htmlspecialchars($fluxos) ?></span><br>

                <span>Atrasos:</span>
                <span><?php echo htmlspecialchars($atrasos) ?></span><br>

                <span>Saiu mais cedo:</span>
                <span><?php echo htmlspecialchars($saiu_mais_cedo) ?></span><br>

                <span>Outros:</span>
                <span><?php echo htmlspecialchars($outro) ?></span>

            </div>

            <div class="espacos">
                <span>Salas com mais ocorrencias</span>
                <span>Manhã:</span>
                <span>Tarde:</span>

                <span>Salas com mais ocorrencias positivas:</span>
                <span>Manhã:</span>
                <span>Tarde:</span>

                <span>Salas com mais ocorrencias negativas:</span>
                <span>Manhã:</span><br>
                <span>Tarde:</span>
            </div>

            <div class="espacos">
                <span>Salas com mais atrasos:</span>
                <span>Manhã:</span>
                <span>Tarde:</span>

            </div> -->
            



        </main>

    </body>
</html>
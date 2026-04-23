<?php
    $conexao = new mysqli("localhost", "root", "", "edufluxo");

    $alunos = $conexao->query("SELECT * FROM alunos");
    $alunos = $alunos->fetch_all();
    $alunos = count($alunos);

    //!buscar a quantidade de alunos no fundamental:

    $query_fundamental = $conexao->query("SELECT sala FROM alunos");
    $ensino_fundamental = [];
    $total_fundamental = 0;

    while($linha = $query_fundamental->fetch_assoc()){
        $sala = $linha["sala"];
        
        if(str_contains($sala, "6")|| str_contains($sala, "7")|| str_contains($sala, "8")|| str_contains($sala, "9")){
            $total_fundamental++;
        }
        
    }

    $ensino_fundamental = "Ensino fundamental: " .  $total_fundamental;


    
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    </head>

    <body>
        <main id="dashboard">
            <div id="numero_alunos" class="espacos">
                <div id="alunos" class="a">
                    <i class="bi bi-highlighter"></i>
                    <span class="totais">Total de alunos:</span>
                    <span><?php echo htmlspecialchars($alunos) ?></span>
                </div>
                <button class="botoes" id="botao_series" onclick="mostra_as_series()">Mostrar mais ▼</button>
                    
                <div class="mostrar_mais" id="mostrar_series" style="display: none;">
                    <div id="fundamental"><?php echo htmlspecialchars($ensino_fundamental) ?></div>
                    <div>6° ano:</div>
                    <div>7° ano:</div>
                    <div>8° ano:</div>
                    <div>9° ano:</div>
                    <div>Ensino médio:</div>
                    <div>1° ano:</div>
                    <div>2° ano:</div>
                    <div>3° ano:</div>
                </div>
            </div>

            <div id="numero_usuarios" class="espacos">
                
                <div id="usuarios" class="a">
                    <i class="bi bi-person-square"></i>
                    <span class="totais">Total de usuarios:</span>
                    <span><?php echo htmlspecialchars($usuarios) ?></span>
                </div>
                <button class="botoes" id="botao_permissoes" onclick="mostra_as_permissoes()">Mostrar mais ▼</button>

                <div class="mostrar_mais" id="mostrar_permissoes" style="display: none;">
                    <div>Admins: <?php echo htmlspecialchars($admins) ?></div>

                    <div>Portaria: <?php echo htmlspecialchars($porteiros) ?></div>

                    <div>Professores: <?php echo htmlspecialchars($professores) ?></div>
                </div>

            </div>
            
            <div class="espacos" id="numero_de_ocorrencias"> 
                <div id="ocorrencias" class="a">
                    <i class="bi bi-person-gear"></i>
                    <span class="totais" id="numero_ocorrencias">Total de ocorrencias:</span>
                    <span><?php echo htmlspecialchars($ocorrencias) ?></span>
                </div>

                <button class="botoes" id="botao_ocorrencias" onclick="mostrar_ocorrencias()">Mostrar mais ▼</button>

                <div class="mostrar_mais" id="mostrar_ocorrencias" style="display: none;">
                    <div>Ocorrencias boas: <?php echo htmlspecialchars($ocorrencias_boas) ?></div>

                    <div>Ocorrencias ruins: <?php echo htmlspecialchars($ocorrencias_ruins) ?></div>
                   
                </div>
            </div>

            <div id="numero_de_portaria" class="espacos">
                <div id="portaria" class="a">
                    <i class="bi bi-door-open"></i>
                    <span id="numero_portaria">Total de fluxos:</span>
                    <span> <?php echo htmlspecialchars($fluxos) ?></span><br>
                </div>

                <button class="botoes" id="botao_fluxos" onclick="mostrar_fluxos()">Mostrar mais ▼</button>

                <div class="mostrar_mais" id="mostrar_fluxos" style="display: none;">
                    <div>Atrasos: <?php echo htmlspecialchars($atrasos) ?></div>
             
                    <div>Saiu mais cedo: <?php echo htmlspecialchars($saiu_mais_cedo) ?></div>
             
                    <div>Outros: <?php echo htmlspecialchars($outro) ?></div>
            
                </div>

            </div>

            <!-- <div class="espacos">
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

        <script src="dashboard.js"></script>

    </body>
</html>
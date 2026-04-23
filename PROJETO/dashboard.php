<?php
    $conexao = new mysqli("localhost", "root", "", "edufluxo");

    $alunos = $conexao->query("SELECT * FROM alunos");
    $alunos = $alunos->fetch_all();
    $alunos = count($alunos);

    //!buscar a quantidade de alunos no fundamental e no médio:

    $query = $conexao->query("SELECT sala FROM alunos");

    $total_fundamental = 0;
    
    $total_medio = 0;

    $total_outro = 0;
    
    while($linha = $query->fetch_assoc()){
        $sala = $linha["sala"];
        
        if(str_contains($sala, "6")|| str_contains($sala, "7")|| str_contains($sala, "8")|| str_contains($sala, "9")){
            $total_fundamental++;
        }
        else if(str_contains($sala, "1")|| str_contains($sala, "2")|| str_contains($sala, "3")){
            $total_medio++;
        }
        else{
            $total_outro++;
        }
        
    }


    $ensino_fundamental = "Ensino fundamental: " .  $total_fundamental;

    $ensino_medio = "Ensino médio: " . $total_medio;

    $total_6 = 0;
    $total_7 = 0;
    $total_8 = 0;
    $total_9 = 0;

    $total_1 = 0;
    $total_2 = 0;
    $total_3 = 0;

    $outro_total = 0;

    $query_salas = $conexao->query("SELECT sala FROM alunos");

    while($linha = $query_salas->fetch_assoc()){
        $salas = $linha["sala"];
        if(str_contains($salas, "6")){
            $total_6++;
        }
        else if(str_contains($salas, "7")){
            $total_7++;
        }
        else if(str_contains($salas, "8" )){
            $total_8++;          
        }
        else if(str_contains($salas, "9")){
            $total_9++;
        }
        else if(str_contains($salas, "1")){
            $total_1++;
        } 
        else if(str_contains($salas, "2")){
            $total_2++;
        }
        else if(str_contains($salas, "3")){
            $total_3++;
        }
        else{
            $outro_total++;
        }

    }

    $sexto_ano = "6° ano: " .  $total_6;
    $setimo_ano = "7° ano: " . $total_7;
    $oitavo_ano = "8° ano: " . $total_8;
    $nono_ano = "9° ano: " . $total_9;

    $primeiro_medio = "1° ano:" . $total_1;
    $segundo_medio = "2° ano:" . $total_2;
    $terceirao = "3° ano:" . $total_3;

    $outros = "Outro: " . $outro_total;

    
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
                    <span class="totais">Total de alunos:&nbsp;<?php echo htmlspecialchars($alunos) ?></span>
                    <!-- <span></span> -->
                </div>
                <button class="botoes" id="botao_series" onclick="mostra_as_series()">Mostrar mais ▼</button>
                    
                <div class="mostrar_mais" id="mostrar_series" style="display: none;">
                    <div id="fundamental"><?php echo htmlspecialchars($ensino_fundamental) ?></div>
                    <div><?php echo htmlspecialchars($sexto_ano) ?></div>
                    <div><?php echo htmlspecialchars($setimo_ano)?></div>
                    <div><?php echo htmlspecialchars($oitavo_ano)?></div>
                    <div><?php echo htmlspecialchars($nono_ano)?></div>
                    <div><?php echo $ensino_medio ?></div>
                    <div><?php echo htmlspecialchars($primeiro_medio)?></div>
                    <div><?php echo htmlspecialchars($segundo_medio)?></div>
                    <div><?php echo htmlspecialchars($terceirao)?></div><br>
                    <div><?php echo htmlspecialchars($outros)?></div>
                </div>
            </div>

            <div id="numero_usuarios" class="espacos">
                
                <div id="usuarios" class="a">
                    <i class="bi bi-person-square"></i>
                    <div class="totais">Total de usuarios:&nbsp;<?php echo htmlspecialchars($usuarios) ?></div>
                    <!-- <span></span> -->
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
                    <div class="totais" id="numero_ocorrencias">Total de ocorrencias:&nbsp;<?php echo htmlspecialchars($ocorrencias) ?></div>
                    <!-- <span></span> -->
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
                    <div id="numero_portaria">Total de fluxos:&nbsp; <?php echo htmlspecialchars($fluxos) ?></div>
                    <!-- <span></span><br> -->
                </div>

                <button class="botoes" id="botao_fluxos" onclick="mostrar_fluxos()">Mostrar mais ▼</button>

                <div class="mostrar_mais" id="mostrar_fluxos" style="display: none;">
                    <div>Atrasos: <?php echo htmlspecialchars($atrasos) ?></div>
             
                    <div>Saiu mais cedo: <?php echo htmlspecialchars($saiu_mais_cedo) ?></div>
             
                    <div>Outros: <?php echo htmlspecialchars($outro) ?></div>
            
                </div>
            </div>

            <div id="ocorrencias_salas" class="espacos">
                <div class="a" id="ocorrencias_em_salas">
                    <i class="bi bi-exclamation-triangle"></i>
                    <div id="numero_ocorrencias_salas">Salas com mais ocorrencias:</div>
                </div>
                <div id="manha_tarde">
                    <div><i class="bi bi-brightness-alt-high"></i>&nbsp;Manhã:</div>
                    <div><i class="bi bi-brightness-high"></i>&nbsp;Tarde:</div>
                </div>

                <button class="botoes" id="botao_ocorrencias_salas" onclick="mostra_mais_salas()">Mostrar mais ▼</button>

                <div class="mostrar_mais" id="mostrar_ocorrencias_salas" style="display: none;">
                    <div>Salas com mais ocorrencias positivas:</div>
                    <div>Manhã:</div>
                    <div>Tarde:</div>
                    <div>Salas com mais ocorrencias negativas:</div>
                    <div>Manhã:</div>
                    <div>Tarde:</div>
                </div>
            </div>

            <div id="portaria_salas" class="espacos">
                <div class="a" id="portaria_em_salas">
                    <i class="bi bi-person-walking"></i>
                    <div>Salas com mais atrasos:<div>
                </div>
                <div>
                    <div>Manhã:</div>
                    <div>Tarde:</div>
                </div>

            </div>
            
        </main>

        <script src="dashboard.js"></script>

    </body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Sistema EduFluxo</title>
        <link href="pagina.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    </head>

    <body>
        <?php
            session_start();

            $nome = $_SESSION["nome"];
            $primeiro_nome = (string)$nome;
            $primeiro_nome = str_contains($primeiro_nome, " ")? explode(" ", $primeiro_nome)[0]: $primeiro_nome;

            $permissao = $_SESSION["permissao"];

            switch($permissao){
                case 0:
                    $permissao_mostra = "Administrador";
                    break;
                case 1:
                    $permissao_mostra = "Portaria";
                    break;
                case 2:
                    $permissao_mostra = "Professor";
                    break;
                default:
                    echo "houve um erro";
                    // $permissao_mostra = "Usuá";
                    break;
            }
           
        ?>

        <div id="barra_tarefas">
            <button id="hamburguer" onclick="mostrar_barra_lateral()" title="Abrir barra lateral">☰</button>
            <!-- <i class="" -->
            <h1 id="h1">Sistema&nbsp;EduFluxo</h1>
        </div>

        <aside id="barra_lateral" style="display: none;">
            <div id="menu">
                <h2>Menu:</h2>
                <button id="fechar_menu" onclick="mostrar_barra_lateral()">X</button>
            </div>
            <div id="opcoes">
                <div class="opcoes" id="dashboard" onclick="abrir_dashboard()" title="Abrir dashboard">Dashboard</div>
                <div class="opcoes" id="ocorrencias" onclick="abrir_ocorrencias()" title="Abrir ocorrências">Ocorrências</div>
                <div class="opcoes" id="portaria" onclick="abrir_portaria()" title="Abrir portaria">Portaria</div>
                <div class="opcoes" id="cadastros" onclick="abrir_cadastros()" title="Abrir cadastros">Cadastros</div>
                <!-- <div class="opcoes" id="como_usar" onclick="abrir_ajuda()" title="Como usar">Como usar</div>
                <div class="opcoes" id="configuracoes" onclick="abrir_configuracoes()" title="Abrir configurações">Configurações</div> -->
            </div>
            <div id="voltar" title="Voltar para tela inicial" onclick="abrir_pagina_principal()">▶ Voltar para tela inicial</div>
            <!-- <button id="muda_tema" onclick="mudar_tema()">Tema escuro 🌙</button> -->
            <div id="usuario">
                <i class="bi bi-person-circle"></i>
                <div id="perfil">
                    <div id="nome_usuario"><?php echo htmlspecialchars($primeiro_nome); ?></div>
                    <div id="permissao_usuario"><?php echo htmlspecialchars($permissao_mostra); ?></div>
                </div>
                
                <i class="bi bi-box-arrow-right" title="Sair" onclick="sair()"></i>
            </div>
        </aside>

        <main id="pagina_principal">
            <h1>Bem-vindo ao Sistema EduFluxo!</h1>
            <!-- <p>Aqui vai aparecer um conteudo de inicio</p> -->
        </main>

        <iframe id="iframes" src=""></iframe>
<!-- 
        <div id="ajuda" class="outros" style="display:none">
            <h1>Como usar o sistema EduFluxo</h1>
        </div>

        <div id="configuracoes_pagina" class="outros" style="display:none">
            <h1>Configurações do sistema EduFluxo</h1>
        </div> -->
        <!-- <iframe id="pagina_portaria" src="portaria.html"></iframe> -->
        <!-- <iframe id="pagina_cadastros" src="lista_pessoas.html"></iframe>  -->

        <script>

        let permissao = "<?php echo $permissao; ?>";
        var nome_usuario = "<?php echo $nome; ?>";
        localStorage.setItem("nome_usuario", nome_usuario);
        // alert("oi " + nome_usuario);

        const mostra_dashboard = document.getElementById("dashboard");
        const mostra_ocorrencias = document.getElementById("ocorrencias");
        const mostra_portaria = document.getElementById("portaria");
        const mostra_cadastros = document.getElementById("cadastros");


        let barra = document.getElementById("barra_lateral");

        let clicou = false;

        function mostrar_barra_lateral(){
            clicou = !clicou;
            if(clicou){
                barra.style.display = "flex";
            }   
            else{
                barra.style.display = "none";
            }
        }
        
        permissao = parseInt(permissao);
        switch(permissao){
            case 0:
                mostra_dashboard.style.display = "inline-block";
                mostra_ocorrencias.style.display = "inline-block";
                mostra_portaria.style.display = "inline-block";
                mostra_cadastros.style.display = "inline-block";
                break;
            case 1:
                mostra_dashboard.style.display = "inlinw=block";
                mostra_ocorrencias.style.display = "none";
                mostra_portaria.style.display = "inline-block";
                mostra_cadastros.style.display = "none"
                break;
            case 2:
                mostra_dashboard.style.display = "inline-block";
                mostra_ocorrencias.style.display = "inline-block";
                mostra_portaria.style.display = "none";
                mostra_cadastros.style.display = "none";
                break;
            default:
                alert("houve um problema!");
                break;
        }
        function sair(){
            window.location.replace("sair.php");
        }
        
        </script>
        <script src="pagina.js"></script>
        <!-- <script src="ocorrencias.js"></script> -->
    </body>
</html>
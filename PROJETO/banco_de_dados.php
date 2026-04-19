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
            break;

        case "usuarios":
            $conexao->query("INSERT INTO usuarios VALUES ('{$data["cpf"]}', '{$data["nome"]}', '{$data["email"]}', '{$data["senha"]}', '{$data["permissao"]}')");
            // echo "funcionou";
            break;

        case "buscar_aluno_por_nome":
            $resultado = $conexao->query("SELECT * FROM alunos WHERE nome = '{$data["nome"]}'");
            $linha = $resultado->fetch_assoc();
            echo json_encode($linha);
            break;

        case "ocorrencias":
            $conexao->query("INSERT INTO ocorrencias (cgm, nome, serie, relator, data, tipo, motivo) VALUES ('{$data["cgm"]}', '{$data["nome"]}', '{$data["serie"]}', '{$data["professor"]}', '{$data["data"]}', '{$data["tipo"]}', '{$data["motivo"]}')");
            break;

        case "portaria":
            $conexao->query("INSERT INTO fluxo_saidas (cgm, nome, serie, usuario, data, motivo) VALUES ('{$data["cgm"]}', '{$data["nome"]}', '{$data["serie"]}', '{$data["usuario"]}','{$data["data"]}', '{$data["motivo"]}')");
            break; 

        case "buscar_alunos":
            $informacoes = $conexao->query("SELECT * FROM alunos ORDER BY nome ASC");
            // echo "<button id='botao_add_alunos' onclick='mostra_add_alunos()'>Adicionar Alunos</button>";
            while($linha = $informacoes->fetch_assoc()){
                echo "<div class='mostra_alunos'>";
                echo "<div class='cgms'>" . htmlspecialchars($linha["cgm"]) . "</div><br>";
                echo "<div class='nomes'>" . htmlspecialchars($linha["nome"]) . "</div><br>";
                echo "<div class='emails'>" . htmlspecialchars($linha["email"]) . "</div><br>";
                echo "<div class='series'>" . htmlspecialchars($linha["sala"]) . "</div>";
                echo "</div>";
            }
            break;

        case "buscar_usuarios":
            $informacoes = $conexao->query("SELECT * FROM usuarios ORDER BY nome ASC");
            // echo "<button id='botao_add_usuarios' onclick='mostra_add_usuarios()'>Adcionar Usuarios</button>";
            while($linha = $informacoes->fetch_assoc()){
                echo "<div class='mostra_usuarios'>";
                echo "<div class='cpfs'>" . htmlspecialchars($linha["cpf"]) . "</div><br>";
                echo "<div class='nomes'>" . htmlspecialchars($linha["nome"]) . "</div><br>";
                echo "<div class='emails'>" . htmlspecialchars($linha["email"]) . "</div><br>";
                echo "<div class='permissoes'>" . htmlspecialchars($linha["permissao"]) . "</div>";
                echo "</div>";
            }
            break;

        case "buscar_ocorrencias":
            $informacoes = $conexao->query("SELECT * FROM ocorrencias ORDER BY id ASC");
            while($linha = $informacoes->fetch_assoc()){
                echo "<div class='mostra_ocorrencias'>";
                echo "<div class='cgms'> " . htmlspecialchars($linha["cgm"]) . "</div>";
                echo "<div class='nomes'>" . htmlspecialchars($linha["nome"]) . "</div>";
                echo "<div class= 'series'>" . htmlspecialchars($linha["serie"]) . "</div>";
                echo "<div class= 'relatores'>" . htmlspecialchars($linha["relator"]) . "</div>";
                echo "<div class= 'datas'>" . htmlspecialchars($linha["data"]) . "</div>";
                echo "<div class='tipos'>" . htmlspecialchars($linha["tipo"]) . "</div>";
                echo "<div class= 'motivos'>" . htmlspecialchars($linha["motivo"]) . "</div>";
                echo "</div>";
            }
            break;
        
        case "buscar_portaria":
            $informacoes = $conexao->query("SELECT * FROM fluxo_saidas ORDER BY id ASC");
            while($linha = $informacoes->fetch_assoc()){
                echo "<div class='mostra_portaria'>";
                echo "<div class='cgms'> " . htmlspecialchars($linha["cgm"]) . "</div>";
                echo "<div class='nomes'>" . htmlspecialchars($linha["nome"]) . "</div>";
                echo "<div class= 'series'>" . htmlspecialchars($linha["serie"]) . "</div>";
                echo "<div class= 'usuarios'>" . htmlspecialchars($linha["usuario"]) . "</div>";
                echo "<div class= 'datas'>" . htmlspecialchars($linha["data"]) . "</div>";
                echo "<div class= 'motivos'>" . htmlspecialchars($linha["motivo"]) . "</div>";
                echo "</div>";
            }
            break;
        default:
            http_response_code(400);
            die("Dados inválidos");
    }
?>
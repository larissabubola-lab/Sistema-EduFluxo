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

    function template($info_1, $info_2, $info_3, $info_4){
        echo "<div class='mostra_alunos'>";
            echo "<div class='foto'><i class='bi bi-person-square'></i></div>";
            echo "<div class='informacoes'>";
                echo "<div class='cgms'>";
                    echo "<div>Cgm:</div>";
                    echo "<div>" . htmlspecialchars($info_1) . "</div>";
                echo "</div>";
                echo "<div class='nomes'>";
                    echo "<div>Nome:</div>";
                    echo "<div>" . htmlspecialchars($info_2) . "</div>";
                echo "</div>";
                echo "<div class='series'>";
                    echo "<div>Série:</div>";
                    echo "<div>" . htmlspecialchars($info_3) . "</div>";
                echo "</div>";
                echo "<div class='emails'>";
                    echo "<div>Email:</div>";
                    echo "<div>" . htmlspecialchars($info_4) . "</div>";
                echo "</div>";
                // echo "<div class='botoes'>";
                //     echo "<button class='editar botao' title='Editar cadastro'><i class='bi bi-pencil-square'></i>&nbsp;Editar</button>";
                //     echo "<button class='apagar botao' title='Apagar cadastro'><i class='bi bi-trash-fill'></i>&nbsp;Apagar</button>";
                // echo "</div>";
            echo "</div>";
        echo '</div>';
    }

    function template_usuarios($info_1,$info_2,$info_3, $info_4){
        echo "<div class='mostra_usuarios'>";
            echo "<div class='foto'><i class='bi bi-person-square'></i></div>";
            echo "<div class='informacoes'>";
                echo "<div class='cpfs'>";
                    echo "<div>Cpf:</div>";
                    echo "<div>" . htmlspecialchars($info_1) . "</div>";
                echo "</div>";
                echo "<div class='nomes'>";
                    echo "<div>Nome:</div>";
                    echo "<div>" . htmlspecialchars($info_2) . "</div>";
                echo "</div>";
                echo "<div class='emails'>";
                    echo "<div>Email:</div>";
                    echo "<div>" . htmlspecialchars($info_3) . "</div>";
                echo "</div>";
                echo "<div class='permissao_usuario'>";
                    echo "<div>Permissão:</div>";
                    echo "<div class='permissoes'>" . htmlspecialchars($info_4) . "</div>";
                echo "</div>";
                // echo "<div class='botoes'>";
                //     echo "<button class='editar botao' title='Editar cadastro'><i class='bi bi-pencil-square'></i>&nbsp;Editar</button>";
                //     echo "<button class='apagar botao' title='Apagar cadastro'><i class='bi bi-trash-fill'></i>&nbsp;Apagar</button>";
                // echo "</div>";
            echo "</div>";
        echo '</div>';
    }

    function template_ocorrencias($info_1, $info_2, $info_3, $info_4,$info_5,$info_6, $info_7, $info_8, $info_9, $info_10){
        // echo "<button id='adcionar_ocorrencias' onclick='mostrar_formulario()' title='Criar uma nova ocorrencia'>Criar nova ocorrencia</button>";
         echo "<div class='mostra_ocorrencias $info_1'>"; // valores: bom e ruim
            echo "<div class='parte_cima'>";        
                echo "<div>$info_2</div>"; //😊 ou 🙁

                echo "<div class='nome_cgm'>";
                    echo "<div>" . htmlspecialchars($info_3) . "</div>";
                    echo "<div>Cgm:&nbsp;" . htmlspecialchars($info_4) . "</div>";
                echo "</div>";

                echo "<div class='datas $info_5'>" . htmlspecialchars($info_6) . "</div>"; //valores: data_bom e data_ruim
            echo "</div>";

            echo "<div class='informaçao'>";
                echo "<div class='auxiliar'>";
                    echo "<div class='series'>";
                        echo "<div><i class='bi bi-backpack2'></i>&nbsp;Série:</div>";
                        echo "<div>" . htmlspecialchars($info_7) . "</div>";
                    echo "</div>";

                    echo "<div class='relatores'>";
                        echo "<div><i class='bi bi-person'></i>&nbsp;Relator:</div>";
                        echo "<div>" . htmlspecialchars($info_8) . "</div>";
                    echo "</div>";

                echo "</div>";

                echo "<div class='auxiliar_motivo'>";
                    echo "<div class='motivos $info_9'>"; //motivo_bom e motivo_ruim
                        echo "<div class='titulo_motivo'>Motivo:</div>";
                        echo "<div class='detalhes'>" . htmlspecialchars($info_10) . "</div>";
                    echo "</div>";
                echo "</div>";

            echo "</div>";

            // echo "<div class='botoes'>";
            //     echo "<button class='editar' title='Editar ocorrencia'><i class='bi bi-pencil-square'></i>&nbsp;Editar</button>";
            //     echo "<button class='apagar' title='Apagar ocorrencia'><i class='bi bi-trash-fill'></i>&nbsp;Apagar</button>";
            // echo "</div>";

        echo "</div>";
    }

    function template_portaria($info_1, $info_2,$info_3,$info_4,$info_5, $info_6){
        echo "<div class='mostra_portaria'>";
            echo "<div class='parte_cima'>";
                echo "<i class='bi bi-person-circle'></i>";
                echo "<div class='nome_cgm'>";
                    echo "<div>" . htmlspecialchars($info_1) . "</div>";
                    echo "<div>Cgm:&nbsp;" . htmlspecialchars($info_2) . "</div>";
                echo "</div>";
                echo "<div class='datas'>" . htmlspecialchars($info_3) . "</div>";
            echo "</div>";
            echo "<div class='informacoes'>";
                echo "<div class='auxiliar'>";
                    echo "<div class='series'>";
                        echo  "<div>Série:</div>";
                        echo "<div>" . htmlspecialchars($info_4) . "</div>";
                    echo "</div>";
                    echo "<div class='relatores'>";
                        echo "<div>Relator:</div>";
                        echo "<div>" . htmlspecialchars($info_5) . "</div>";
                    echo "</div>";
                echo "</div>";
                echo "<div class='motivo_auxiliar'>";
                    echo "<div class='motivos'>";
                        echo "<div>Motivo:</div>";
                        echo "<div>" . htmlspecialchars($info_6). "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
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
            while($linha = $informacoes->fetch_assoc()){
                template($linha["cgm"], $linha["nome"], $linha["sala"], $linha["email"]);
            }
            break;

        case "buscar_alunos_6":
            $informacoes = $conexao->query("SELECT * FROM alunos WHERE sala LIKE '6%'");
            while($linha = $informacoes->fetch_assoc()){
                template($linha["cgm"], $linha["nome"], $linha["sala"], $linha["email"]);
            }
            break;
        
        case "buscar_alunos_7":
            $informacoes = $conexao->query("SELECT * FROM alunos WHERE sala LIKE '7%'");
            while($linha = $informacoes->fetch_assoc()){
                template($linha["cgm"], $linha["nome"], $linha["sala"], $linha["email"]);
            }
            break;

        case "buscar_alunos_8":
            $informacoes = $conexao->query("SELECT * FROM alunos WHERE sala LIKE '8%'");
            while($linha = $informacoes->fetch_assoc()){
                template($linha["cgm"], $linha["nome"], $linha["sala"], $linha["email"]);
            }
            break;

        case "buscar_alunos_9":
            $informacoes = $conexao->query("SELECT * FROM alunos WHERE sala LIKE '9%'");
            while($linha = $informacoes->fetch_assoc()){
                template($linha["cgm"], $linha["nome"], $linha["sala"], $linha["email"]);
            }
            break;

        case "buscar_alunos_1":
            $informacoes = $conexao->query("SELECT * FROM alunos WHERE sala LIKE '1%'");
            while($linha = $informacoes->fetch_assoc()){
                template($linha["cgm"], $linha["nome"], $linha["sala"], $linha["email"]);
            }
            break;

        case "buscar_alunos_2":
            $informacoes = $conexao->query("SELECT * FROM alunos WHERE sala LIKE '2%'");
            while($linha = $informacoes->fetch_assoc()){
                template($linha["cgm"], $linha["nome"], $linha["sala"], $linha["email"]);
            }
            break;

        case "buscar_alunos_3":
            $informacoes = $conexao->query("SELECT * FROM alunos WHERE sala LIKE '3%'");
            while($linha = $informacoes->fetch_assoc()){
                template($linha["cgm"], $linha["nome"], $linha["sala"], $linha["email"]);
            }
            break;
        case "input_alunos":
            $busca = "%" . $data["buscar"] . "%";

            $informacoes = $conexao->prepare("SELECT * FROM alunos WHERE cgm LIKE ? OR nome LIKE ?");
            $informacoes->bind_param("ss", $busca, $busca);
            $informacoes->execute();

            $resultado = $informacoes->get_result();
            
            while($linha = $resultado->fetch_assoc()){
                template($linha["cgm"], $linha["nome"], $linha["sala"], $linha["email"]);
            }
            break;
    
        case "buscar_usuarios":
            $informacoes = $conexao->query("SELECT * FROM usuarios ORDER BY nome ASC");
            while($linha = $informacoes->fetch_assoc()){
                template_usuarios($linha["cpf"], $linha["nome"], $linha["email"], $linha["permissao"]);
                
            }
            break;
        
        case "buscar_usuarios_admin":
            $informacoes = $conexao->query("SELECT * FROM usuarios WHERE permissao = 0");
            while($linha = $informacoes->fetch_assoc()){
                template_usuarios($linha["cpf"], $linha["nome"], $linha["email"], $linha["permissao"]);
                
            }
            break;
        
        case "buscar_usuarios_portaria":
            $informacoes = $conexao->query("SELECT * FROM usuarios WHERE permissao = 1");
            while($linha = $informacoes->fetch_assoc()){
                template_usuarios($linha["cpf"], $linha["nome"], $linha["email"], $linha["permissao"]);
                
            }
            break;

        case "buscar_usuarios_professor":
            $informacoes = $conexao->query("SELECT * FROM usuarios WHERE permissao = 2");
            while($linha = $informacoes->fetch_assoc()){
                template_usuarios($linha["cpf"], $linha["nome"], $linha["email"], $linha["permissao"]);
                
            }
            break;

         case "input_usuarios":
            $busca = "%" . $data["buscar"] . "%";

            $informacoes = $conexao->prepare("SELECT * FROM usuarios WHERE cpf LIKE ? OR nome LIKE ?");
            $informacoes->bind_param("ss", $busca, $busca);
            $informacoes->execute();

            $resultado = $informacoes->get_result();
            
            while($linha = $resultado->fetch_assoc()){
                template_usuarios($linha["cpf"], $linha["nome"], $linha["email"], $linha["permissao"]);
            }
            break;
        
        case "buscar_ocorrencias":
            $informacoes = $conexao->query("SELECT * FROM ocorrencias ORDER BY nome ASC");
            while($linha = $informacoes->fetch_assoc()){
                if($linha["tipo"] === "positiva"){
                   template_ocorrencias("bom", "😊", $linha["nome"], $linha["cgm"], "data_bom", $linha["data"], $linha["serie"],  $linha["relator"], "motivo_bom", $linha["motivo"] );
                }
                else{
                    template_ocorrencias("ruim", "🙁", $linha["nome"], $linha["cgm"], "data_ruim", $linha["data"], $linha["serie"],  $linha["relator"], "motivo_ruim", $linha["motivo"] );
                }
            }
            break;

        case "buscar_ocorrencias_positivas":
            $informacoes = $conexao->query("SELECT * FROM ocorrencias WHERE tipo = 'positiva'");
            while($linha = $informacoes->fetch_assoc()){
                template_ocorrencias("bom", "😊", $linha["nome"], $linha["cgm"], "data_bom", $linha["data"], $linha["serie"],  $linha["relator"], "motivo_bom", $linha["motivo"] );
            }
            break;

        case "buscar_ocorrencias_negativas":
            $informacoes = $conexao->query("SELECT * FROM ocorrencias WHERE tipo = 'negativa'");
            while($linha = $informacoes->fetch_assoc()){
                template_ocorrencias("ruim", "🙁", $linha["nome"], $linha["cgm"], "data_ruim", $linha["data"], $linha["serie"],  $linha["relator"], "motivo_ruim", $linha["motivo"] );
            }
            break;
        case "input_ocorrencias":
            $pesquisa = "%" . $data["busca"] . "%";
            $informacoes = $conexao->prepare("SELECT * FROM ocorrencias WHERE nome LIKE ? OR cgm LIKE ?");
            $informacoes->bind_param("ss", $pesquisa, $pesquisa);
            $informacoes->execute();
            $resultado = $informacoes->get_result();
            while($linha = $resultado->fetch_assoc()){
                if($linha["tipo"] === "positiva"){
                   template_ocorrencias("bom", "😊", $linha["nome"], $linha["cgm"], "data_bom", $linha["data"], $linha["serie"],  $linha["relator"], "motivo_bom", $linha["motivo"] );
                }
                else{
                    template_ocorrencias("ruim", "🙁", $linha["nome"], $linha["cgm"], "data_ruim", $linha["data"], $linha["serie"],  $linha["relator"], "motivo_ruim", $linha["motivo"] );
                }
            }
            break;
        
        case "buscar_portaria":
            $informacoes = $conexao->query("SELECT * FROM fluxo_saidas ORDER BY nome ASC");
            while($linha = $informacoes->fetch_assoc()){
               template_portaria($linha["nome"], $linha["cgm"],$linha["data"],  $linha["serie"], $linha["usuario"], $linha["motivo"]);
            }
            break;
        case "buscar_portaria_entrada":
            $informacoes = $conexao->query("SELECT * FROM fluxo_saidas WHERE motivo = 'O aluno chegou atrasado'");
            while($linha = $informacoes->fetch_assoc()){
                template_portaria($linha["nome"], $linha["cgm"],$linha["data"],  $linha["serie"], $linha["usuario"], $linha["motivo"]);
             }
             break;
        case "buscar_portaria_saida":
            $informacoes = $conexao->query("SELECT * FROM fluxo_saidas WHERE motivo = 'O aluno saiu mais cedo'");
            while($linha = $informacoes->fetch_assoc()){
                template_portaria($linha["nome"], $linha["cgm"],$linha["data"],  $linha["serie"], $linha["usuario"], $linha["motivo"]);
             }
             break;
        case "buscar_portaria_outros":
            $informacoes = $conexao->query("SELECT * FROM fluxo_saidas WHERE motivo != 'O aluno saiu mais cedo' && motivo != 'O aluno chegou atrasado'");
            while($linha = $informacoes->fetch_assoc()){
                template_portaria($linha["nome"], $linha["cgm"],$linha["data"],  $linha["serie"], $linha["usuario"], $linha["motivo"]);
             }
             break;
        case "input_portaria":
            $busca = "%" .  $data["buscar"] . "%";
            $informacoes = $conexao->prepare("SELECT * FROM fluxo_saidas WHERE cgm LIKE ? OR nome LIKE ? ");
            $informacoes->bind_param("ss", $busca, $busca);
            $informacoes->execute();
            $resultados = $informacoes->get_result();

            while($linha = $resultados->fetch_assoc()){
                template_portaria($linha["nome"], $linha["cgm"],$linha["data"],  $linha["serie"], $linha["usuario"], $linha["motivo"]);
            }
            break;
        default:
            http_response_code(400);
            die("Dados inválidos");
    }
?>
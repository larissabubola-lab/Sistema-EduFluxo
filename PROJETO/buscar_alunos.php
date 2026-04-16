<?php
    $conexao = new mysqli("localhost", "root", "", "edufluxo");

    if ($conexao->connect_error) {
        die("Erro na conexão");
    }

    if (isset($_GET["busca"])) {
        $busca = "%" . $_GET["busca"] . "%";

        $nome_conexao = $conexao->prepare("SELECT nome FROM alunos WHERE nome LIKE ? LIMIT 5");
        $nome_conexao->bind_param("s", $busca);

        $nome_conexao->execute();
        $resultado = $nome_conexao->get_result();

        while ($linha = $resultado->fetch_assoc()) {
            echo "<div class='nome_resultados'>" . htmlspecialchars($linha["nome"]) . "</div><br>";
          
        }

        $nome_conexao->close();
    }

    $conexao->close();
?>
<?php
    session_start();

    $permissao = $_SESSION["permissao"];
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Como usar</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="como_usar.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    </head>

    <head>
        <h1>Como usar o site:</h1>
        <section id="para_admins">
            <div class="lista">
                <ul>
                    <li>Como criar uma ocorrência?</li>
                    <li>Como criar um fluxo de entrada/saida?</li>
                    <li>Como cadastrar um aluno no banco de dados?</li>
                    <li>Como cadastrar um funcionário no banco de dados?</li>
                    <li>Por que quando vou criar uma ocorrência/fluxo os espaços estão cinzas e eu não consigo escrever?</li>
                    <li>Não sei o cgm do aluno.</li>
                </ul>
            </div>
            <div class="ocorrencias">
                <h2>Como criar uma ocorrencia</h2>
                <ol>
                    <li>Entrar na seção de ocorrências, que pode ser acessada ao clicar nas três barrinhas na barra de ferramentas superor, ao lado do título do site.</li>
                    <li>Lá, vai haver um botão escrito "Criar nova ocorrencia". Clique nele e preencha o formulário que aparecer com as informações necessárias.</li>
                    <li>Depois, clique em confirmar depois de preencher o formulário inteiro(não deixe nada em branco). Pronto! Você acabou de criar uma ocorrência!(espero que tenha sido positiva :p).</li>
                </ol>
                <h2>Como criar um fluxo:</h2>

                <ol>
                    <li>Entrar na seção da portaria, que pode ser acessada ao clicar nas três barrinhas na barra de ferramentas superor, ao lado do título do site.</li>
                    <li>Lá, vai haver um botão escrito "Criar um novo fluxo". Clique nele e preencha o formulário que aparecer com as informações necessárias.</li>
                    <li>Depois, clique em confirmar depois de preencher o formulário inteiro(não deixe nada em branco). Pronto! Você acabou de criar um fluxo!</li>
                </ol>

                <h2>Como cadastrar um novo aluno ao banco de dados?</h2>
                <ol>
                    <li>Entrar na seção de cadastros na barra lateral.</li>
                    <li>Lá, vai haver duas seções, a dos alunos e dos usuários. Normalmente, a dos alunos já está selecionada quando você entre. Caso não esteje, apenas clique no botão "Alunos".</li>
                    <li>Clique no botão escrito "Cadastrar um novo aluno", e preencha todas as informações necessárias(não deixe nada em branco).</li>
                    <li>Para terminar o cadastro, clique no botão "Confirmar", e o aluno vai ser adicionado ao banco de dados.</li>
                </ol>

                <h2>Como cadastrar um novo usuário ao banco de dados?</h2>
                <ol>
                    <li>É a mesma coisa de adicionar um aluno, com a única diferença sendo que você vai precisar entrar na seção de usuários.</li>

                </ol>
                
                <h2>Por que quando vou criar uma ocorrência/fluxo os espaços estão cinzas e eu não consigo escrever?</h2>
                <ul>
                    <li>Isso é para ter dados mais precisos retirados diretamente do banco de dados! Caso o aluno não esteja presente no banco de dados, ou você prefira simplesmente escrever manualmente, apenas clique no botão de criar uma ocorrência/fluxo manual.</li>
                </ul>

                <h2>Não sei o cgm do aluno.</h2>
                <ul>
                    <li>Se você estiver criando uma ocorrencia ou fluxo, tudo bem! Agora, caso estiver cadastrando um aluno, o cgm é obrigatório. A mesma coisa para o cpf dos usuários.</li>
                </ul>

            </div>
        </section>
        
        <section id="para_portaria" style="display: none;">
            <ul>
                <li>Como registrar um fluxo de entrada/saida?</li>
                <li>Como encontrar uma fluxo já criado?</li>
                <li>Por que quando vou criar uma fluxo os espaços estão cinzas e eu não consigo escrever?</li>
                <li>Não sei o cgm do aluno.</li>
            </ul>
        </section>
        
        <section id="para_professores" style="display: none;">
            <ul>
                <li>Como criar uma ocorrência?</li>
                <li>Como encontrar uma ocorrência já criada?</li>
                <li>Por que quando vou criar uma ocorrência os espaços estão cinzas e eu não consigo escrever?</li>
                <li>Não sei o cgm do aluno.</li>
            </ul>
        </section>
        <script>
            const pagina_admin = document.getElementById("para_admin");
            const pagina_portaria = document.getElementById("para_portaria");
            const pagina_professor = document.getElementById("para_professor");

            let permissoes = "<?php echo $permissao ?>"
            switch(permissoes){
                case 0:
                    pagina_admin.style.display = "block";
                    pagina_portaria.style.display = "none";
                    pagina_professor.style.display = "none";

                    break;
                case 1:
                    pagina_admin.style.display = "none";
                    pagina_portaria.style.display = "block";
                    pagina_professor.style.display = "none";
                case 2:
                    pagina_admin.style.display = "none";
                    pagina_portaria.style.display = "none";
                    pagina_professor.style.display = "block";
            }
        </script>
    </head>
</html>
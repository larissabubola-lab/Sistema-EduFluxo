const pagina_fluxos = document.getElementById("fluxos_saida");
const input_fluxos = document.getElementById("nome_aluno_fluxo");
const resultados_fluxos = document.getElementById("resultado_fluxos");

input_fluxos.addEventListener("input", mostrar_resultados_fluxos)
input_fluxos.addEventListener("click", mostrar_resultados_fluxos)

function mostrar_resultados_fluxos(){
    if(!resultados_fluxos){
        return;
    }
    resultados_fluxos.style.display = "block";
    
    fetch("buscar_alunos.php?busca=" + input_fluxos.value)
        .then(resultado=>resultado.text())
        .then(data=>{
            resultados_fluxos.innerHTML = data;
            nomes = resultados_fluxos.querySelectorAll(".nome_resultados");
            nomes.forEach(classe=>{
                classe.dataset.nome = classe.textContent.trim();
                
                classe.addEventListener("click",()=>{
                    alert("ola" + classe.dataset.nome + "!" );
                    fetch("banco_de_dados.php",{
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body:JSON.stringify({
                            para:"buscar_aluno_por_nome",
                            nome:classe.dataset.nome
                        })
                    })
                    .then(resposta=> resposta.json())
                    .then(dados=>{
                        
                        document.getElementById("cgm_fluxos").value = dados.cgm;
                        document.getElementById("cgm_fluxos").disabled = false;
                        document.getElementById("nome_aluno_fluxo").value = dados.nome;
                        document.getElementById("serie_aluno_fluxo").value = dados.sala;
                        document.getElementById("serie_aluno_fluxo").disabled = false;
                        document.getElementById("usuario_fluxos").value = localStorage.getItem("nome_usuario");
                        document.getElementById("usuario_fluxos").disabled = false;
                    })
                    resultados_fluxos.style.display = "none";
                })
            })
        })
}

pagina_fluxos.addEventListener("mouseleave", limpar_resultados_fluxos);

function limpar_resultados_fluxos(){
    resultados_fluxos.style.display = "none";
}

const motivos = document.getElementById("motivo_fluxo");

motivos.addEventListener("change", mostra_input);

function mostra_input(){
    const motivo_outro = document.getElementById("motivo_outro");
    if(motivos.value === "outro"){
        motivo_outro.style.display = "block";
    } 
    else {
        motivo_outro.style.display = "none";
    }
}


function criar_fluxos(){

    let cgm = document.getElementById("cgm_fluxos").value;
    let nome = document.getElementById("nome_aluno_fluxo").value;
    let serie = document.getElementById("serie_aluno_fluxo").value;
    let usuario = document.getElementById("usuario_fluxos").value;
    let motivo = document.getElementById("motivo_fluxo").value;
    if(motivo === "outro"){
        motivo = document.getElementById("motivo_outro").value;
    }

    if(!cgm || !nome || !serie || !usuario || !motivo){
        alert("Preencha todos os campos obrigatórios!");
        return;
    }

    fetch("banco_de_dados.php",{
        method:"POST",
        headers:{
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para:"portaria",
            cgm:cgm,
            nome:nome,
            serie:serie,
            usuario:usuario,
            motivo:motivo
        })
    })

    document.getElementById("cgm_fluxos").value = "";
    document.getElementById("cgm_fluxos").disabled = true;
    document.getElementById("nome_aluno_fluxo").value = "";
    document.getElementById("serie_aluno_fluxo").value = "";
    document.getElementById("serie_aluno_fluxo").disabled = true;
    document.getElementById("usuario_fluxos").value = "";
    document.getElementById("motivo_fluxo").value = "";
    document.getElementById("motivo_outro").value = "";
    document.getElementById("motivo_outro").style.display = "none";

    alert("Documentação de fluxo criado com sucesso!")
}

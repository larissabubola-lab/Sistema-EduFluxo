const pagina_ocorrencias = document.getElementById("ocorrencias")
const input_ocorrencias = document.getElementById("nome_aluno_ocorrencias");
const resultados = document.getElementById("resultado")

input_ocorrencias.addEventListener("input", mostrar_resultados)
input_ocorrencias.addEventListener("click", mostrar_resultados)

function mostrar_resultados(){ 
    if (!resultados) {
        return;
    }
    resultados.style.display = "block";

    fetch("buscar_alunos.php?busca=" + input_ocorrencias.value)
        .then(resultado => resultado.text())
        .then(data=>{
            resultados.innerHTML = data;
            let elementos = resultados.querySelectorAll(".nome_resultados")
            elementos.forEach(classe=>{
                classe.dataset.nome = classe.textContent.trim();
                classe.addEventListener("click", ()=>{
                    alert("ola " + classe.dataset.nome + "!");
                    // input_ocorrencias.value = classe.dataset.nome;
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
                    .then(retorno => retorno.json())
                    .then(dados=>{
                        document.getElementById("cgm_ocorrencias").value = dados.cgm;
                        document.getElementById("cgm_ocorrencias").disabled = false;
                        document.getElementById("nome_aluno_ocorrencias").value = dados.nome;
                        document.getElementById("serie_aluno").value = dados.sala;
                        document.getElementById("serie_aluno").disabled = false;
                        document.getElementById("usuario_ocorrencia").value = localStorage.getItem("nome_usuario");
                        document.getElementById("usuario_ocorrencia").disabled = false;
                    })
                    resultados.style.display = "none";
                })
            })
        })
}

document.getElementById("input_de_nome").addEventListener("mouseleave", limpar_resultados)

function limpar_resultados(){
    resultados.style.display = "none";
}


function criar_ocorrencia(){
    let cgm_aluno = document.getElementById("cgm_ocorrencias").value;
    let nome_aluno = document.getElementById("nome_aluno_ocorrencias").value;
    let serie = document.getElementById("serie_aluno").value;
    // let tipo_ocorrencia = document.getElementById("bom_ou_ruim").value;
    let tipo_ocorrencia = document.querySelector('input[name="bom_ruim"]:checked');
    tipo_ocorrencia = tipo_ocorrencia? tipo_ocorrencia.value: null;
    let motivo = document.getElementById("motivo_ocorrencia").value;
    let usuario = document.getElementById("usuario_ocorrencia").value;
    // let nome = localStorage.getItem("nome_usuario");

    if(!cgm_aluno || !nome_aluno || !serie || !tipo_ocorrencia || !motivo){
        alert("Preencha todos os campos para criar uma ocorrência.")
        return;
    }

    fetch("banco_de_dados.php",{
        method: "POST",
        headers:{
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para:"ocorrencias",
            cgm: cgm_aluno,
            nome: nome_aluno,
            serie:serie,
            professor: usuario,
            tipo: tipo_ocorrencia,
            motivo: motivo
        })
    })

    document.getElementById("cgm_ocorrencias").value = "";
    document.getElementById("nome_aluno_ocorrencias").value = "";
    document.getElementById("serie_aluno").value = "";
    document.getElementById("usuario_ocorrencia").value = "";

    let radio = document.querySelectorAll(".radios")
    radio.forEach(apaga=>{
        apaga.value = "";
    })
    
    document.getElementById("motivo_ocorrencia").value = "";


    document.getElementById("cgm_ocorrencias").disabled = true;
    document.getElementById("serie_aluno").disabled = true;
    document.getElementById("usuario_ocorrencia").disabled = true;

    alert("Ocorrência criada com sucesso!");
}
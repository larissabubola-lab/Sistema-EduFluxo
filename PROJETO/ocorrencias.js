const pagina_ocorrencias = document.getElementById("ocorrencias")
const input_ocorrencias = document.getElementById("nome_aluno_ocorrencias");
const resultados = document.getElementById("resultado")

input_ocorrencias.addEventListener("input", mostrar_resultados)
input_ocorrencias.addEventListener("click", mostrar_resultados)

function mostrar_resultados(){ 
    fetch("buscar_alunos.php?busca=" + input_ocorrencias.value)
        .then(resultado => resultado.text())
        .then(data=>{
            resultados.innerHTML = data;
        })
}

pagina_ocorrencias.addEventListener("mouseleave", limpar_resultados)

function limpar_resultados(){
    resultados.innerHTML = "";
}


function criar_ocorrencia(){
    let cgm_aluno = document.getElementById("cgm_ocorrencias").value;
    let nome_aluno = document.getElementById("nome_aluno_ocorrencias").value;
    let serie = document.getElementById("serie_aluno").value;
    let tipo_ocorrencia = document.getElementById("bom_ou_ruim").value;
    let motivo = document.getElementById("motivo_ocorrencia").value;

    if(!cgm_aluno || !nome_aluno || !serie || !tipo_ocorrencia || !motivo){
        alert("Preencha todos os campos para criar uma ocorrência.")
        return;
    }

    fetch("banco_de_dados",{
        method: "POST",
        headers:{
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para:"ocorrencias",
            cgm: cgm_aluno,
            nome: nome_aluno,
            serie:serie,
            tipo: tipo_ocorrencia,
            motivo: motivo
        })
    })

    document.getElementById("cgm_ocorrencias").value = "";
    document.getElementById("nome_aluno_ocorrencias").value = "";
    document.getElementById("serie_aluno").value = "";
    document.getElementById("bom_ou_ruim").value = "";
    document.getElementById("motivo_ocorrencia").value = "";

    alert("Ocorrência criada com sucesso!");
}
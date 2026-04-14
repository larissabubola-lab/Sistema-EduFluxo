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
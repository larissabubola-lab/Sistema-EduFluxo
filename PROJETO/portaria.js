const pagina_fluxos = document.getElementById("fluxos_saida")
const input_fluxos = document.getElementById("nome_aluno_fluxo");
const resultados_fluxos = document.getElementById("resultado_fluxos")

input_fluxos.addEventListener("input", mostrar_resultados_fluxos)
input_fluxos.addEventListener("click", mostrar_resultados_fluxos)

function mostrar_resultados_fluxos(){
    fetch("buscar_alunos.php?busca=" + input_fluxos.value)
        .then(resultado=>resultado.text())
        .then(data=>{
            resultados_fluxos.innerHTML = data
        })
}

pagina_fluxos.addEventListener("mouseleave", limpar_resultados_fluxos)

function limpar_resultados_fluxos(){
    resultados_fluxos.innerHTML = ""
}


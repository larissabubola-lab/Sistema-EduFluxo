let parametro = new URLSearchParams(window.location.search);

const ocorrencia = document.getElementById("ocorrencias");
const fluxos = document.getElementById("fluxos_saida");
const adcionar_alunos = document.getElementById("add_alunos");
const adcionar_usuarios = document.getElementById("add_usuarios");

let permissoes = parseInt(parametro.get("permissao"));

switch(permissoes){
    case 0:
        ocorrencia.style.display = "block";
        fluxos.style.display = "block";
        adcionar_alunos.style.display = "block";
        adcionar_usuarios.style.display = "block";
        break;
    case 1:
        ocorrencia.style.display = "none";
        fluxos.style.display = "block";
        adcionar_alunos.style.display = "none";
        adcionar_usuarios.style.display = "none";
        break;
    default:
        ocorrencia.style.display = "block";
        fluxos.style.display = "none";
        adcionar_alunos.style.display = "none";
        adcionar_usuarios.style.display = "none";
        break;
};

let outros_serie = document.getElementById("series")
let input_serie_outro = document.getElementById("outra_serie")

outros_serie.addEventListener("change", mostra_input_serie)

function mostra_input_serie(){
    if(outros_serie.value === "outro_serie"){
        input_serie_outro.style.display = "inline"
    }
    else{
        input_serie_outro.style.display = "none"
    }
}


let outros = document.getElementById("salas")
let input_aparece = document.getElementById("sala_outro")

outros.addEventListener("change", mostra_input)

function mostra_input(){
    outros_valor = outros.value
    if(outros_valor === "outro"){
        input_aparece.style.display = "inline"
    }
    else{
        input_aparece.style.display = "none"
    }
}


function checar_add_alunos(){
    let cgm = document.getElementById('aluno_cgm').value
    let nome_aluno = document.getElementById("aluno_add_nome").value;
    let email_aluno = document.getElementById("email_aluno_add").value;
    let serie = document.getElementById("series").value;
    let sala = document.getElementById("salas").value;
    
    let serie_sala = serie + " " + sala;

    fetch("banco_de_dados.php",{
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para: "alunos",
            cgm: cgm,
            nome: nome_aluno,
            email: email_aluno,
            serie: serie_sala 
        })
    })
    
}

function checar_add_usuarios(){
    let cpf = document.getElementById('cpf_usuario').value
    let nome_usuario = document.getElementById("nome_usuario").value;
    let email_usuario = document.getElementById("email_usuario").value;
    let senha_usuario = document.getElementById("senha_usuario").value;
    let permissao_usuario = document.getElementById("permissoes").value;
    permissao_usuario = parseInt(permissao_usuario);

    fetch("banco_de_dados.php",{
        method:"POST",
        headers: {
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para:"usuarios",
            cpf:cpf,
            nome:nome_usuario,
            email:email_usuario,
            senha:senha_usuario,
            permissao: permissao_usuario
        })
    })  
}

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
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

// history.replaceState(null, "", window.location.pathname);

function checar_ocorrencias(){
    let nome_aluno = document.getElementById("nome_aluno_ocorrencias").value;
    let serie_aluno = document.getElementById("serie_aluno_ocorrencias").value;
    let razao = document.getElementById("motivo_ocorrencia").value
    let bom_ruim = document.querySelector("input[name='radios']:checked").value;
    // document.getElementById('h1').innerHTML = nome_aluno;
    // document.getElementById('h2').innerHTML = serie_aluno;
    // document.getElementById("h3").innerHTML = bom_ruim == 0? "bom": "ruim";
    // document.getElementById('p').innerHTML = razao;
}

function checar_fluxos(){
    let nome_aluno = document.getElementById("nome_aluno_fluxo").value;
    let serie_aluno = document.getElementById("serie_aluno_ocorrencias").value;
    let razao = document.getElementById("motivo_fluxo").value;
    // document.getElementById('h1').innerHTML = nome_aluno;
    // document.getElementById('h2').innerHTML = serie_aluno;
    // document.getElementById("h3").innerHTML = razao;
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


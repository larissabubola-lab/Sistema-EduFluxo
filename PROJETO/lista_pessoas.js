const botao_1 = document.getElementById("botao_add_alunos")
const botao_2 = document.getElementById("botao_add_usuarios")

function mostra_add_alunos(){
    document.getElementById("add_alunos").style.display = "block";
    document.getElementById("add_usuarios").style.display = "none";
    botao_1.disabled = true;
    botao_2.disabled = false;
    mostra_todos_alunos();
}

function mostra_add_usuarios(){
    document.getElementById("add_alunos").style.display = "none";
    document.getElementById("add_usuarios").style.display = "block";
    botao_1.disabled = false;
    botao_2.disabled = true;
    mostra_todos_usuarios();
}


const alunos = document.getElementById("lugar_alunos");

//! PARA OS ALUNOS
function mostra_todos_alunos(){
    let apaga_itens = alunos.querySelectorAll(".mostra_alunos");
    apaga_itens.forEach(apaga=>{
        apaga.remove();
    })
  
    fetch("banco_de_dados.php",{
        method: "POST",
        headers:{
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para: "buscar_alunos"
        })
    })
    .then(resposta=>resposta.text())
    .then(dados=>{
        if(!dados){
            return;
        }
        alunos.innerHTML += dados;
    })
}

mostra_todos_alunos()



const usuarios = document.getElementById("lugar_usuarios");

//!PARA USUARIOS

function mostra_todos_usuarios(){
    let apaga_itens = usuarios.querySelectorAll(".mostra_usuarios");
    apaga_itens.forEach(apaga=>{
        apaga.remove();
    })
    

    fetch("banco_de_dados.php",{
        method: "POST",
        headers:{
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para:"buscar_usuarios"
        })
    })
    .then(resposta=>resposta.text())
    .then(dados=>{
        if(!dados){
            return;
        }
        usuarios.innerHTML += dados;
        let permissoes_usuarios = document.querySelectorAll(".permissoes");
        permissoes_usuarios.forEach(permissoes=>{
            switch(permissoes.textContent){
                case "0":
                    permissoes.textContent = "Admin";
                    break;
                case "1":
                    permissoes.textContent = "Portaria";
                    break;
                case "2":
                    permissoes.textContent = "Professor";
                    break;
                default:
                    permissoes.textContent = "Erro";
                    break;
            }
        })
    })
}

mostra_todos_usuarios();



const botao_alunos = document.getElementById("mostra_os_alunos");
const botao_usuarios = document.getElementById("mostra_os_usuarios");

const busca_alunos= document.getElementById("buscar_alunos");
const busca_usuarios = document.getElementById("buscar_usuarios");

function mostra_alunos(){
    alunos.style.display = "grid";
    usuarios.style.display = "none";
    botao_alunos.disabled = true;
    botao_usuarios.disabled = false;
    busca_alunos.style.display = "flex";
    busca_usuarios.style.display = "none";

}

function cancelar(){
    document.getElementById("add_alunos").style.display = "none";
}

function mostra_usuarios(){
    alunos.style.display = "none";
    usuarios.style.display = "grid";
    botao_alunos.disabled = false;
    botao_usuarios.disabled = true;
    busca_alunos.style.display = "none";
    busca_usuarios.style.display = "flex";
}

function cancelar_usuarios(){
    document.getElementById("add_usuarios").style.display = "none";
}


let outros_serie = document.getElementById("series");
let input_serie_outro = document.getElementById("outra_serie");

outros_serie.addEventListener("change", mostra_input_serie);

function mostra_input_serie(){
    if(outros_serie.value === "outro_serie"){
        input_serie_outro.style.display = "inline";
    }
    else{
        input_serie_outro.style.display = "none";
    }
}


let outros = document.getElementById("salas");
let input_aparece = document.getElementById("sala_outro");

outros.addEventListener("change", mostra_input);

function mostra_input(){
    outros_valor = outros.value
    if(outros_valor === "outro"){
        input_aparece.style.display = "inline";
    }
    else{
        input_aparece.style.display = "none";
    }
}


function checar_add_alunos(){

    let cgm = document.getElementById('aluno_cgm').value;
    let nome_aluno = document.getElementById("aluno_add_nome").value;
    let email_aluno = document.getElementById("email_aluno_add").value;
    let serie = document.getElementById("series").value;
    let sala = document.getElementById("salas").value;

    let input_serie = document.getElementById("outra_serie");
    let input_sala = document.getElementById("sala_outro");
    if(input_serie.style.display == "inline"){
        serie = input_serie.value;
    }
    if(input_sala.style.display == "inline"){
        sala = input_sala.value;
        sala = sala.toUpperCase();
    }

    nome_aluno = nome_aluno.trim();
    email_aluno = email_aluno.trim();
    serie = serie.trim();
    sala = sala.trim();
    
    let serie_sala = serie + " " + sala;

    if (!cgm || !nome_aluno || !email_aluno || !serie || !sala ) {
        alert("Preencha todos os campos!");
        return;
    }

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

    document.getElementById('aluno_cgm').value = "";
    document.getElementById("aluno_add_nome").value = "";
    document.getElementById("email_aluno_add").value = "";
    document.getElementById("series").value = "";
    document.getElementById("salas").value = "";
    input_serie.style.display = "none";
    input_sala.style.display = "none";

    document.getElementById("add_alunos").style.display = "none";

    alert("Aluno adicionado com sucesso!");

    mostra_todos_alunos();
    
}

function checar_add_usuarios(){
    let cpf = document.getElementById('cpf_usuario').value
    let nome_usuario = document.getElementById("nome_usuario").value;
    let email_usuario = document.getElementById("email_usuario").value;
    let senha_usuario = document.getElementById("senha_usuario").value;
    let permissao_usuario = document.getElementById("permissoes").value;
    permissao_usuario = parseInt(permissao_usuario);

    cpf = cpf.trim();
    nome_usuario = nome_usuario.trim();
    email_usuario = email_usuario.trim();
    senha_usuario = senha_usuario.trim();

    if(!cpf || !nome_usuario || !email_usuario || !senha_usuario || permissao_usuario === ""|| !permissao_usuario) {
        alert("Preencha todos os campos!");
        return;
    }

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

    document.getElementById('cpf_usuario').value = "";
    document.getElementById("nome_usuario").value = "";
    document.getElementById("email_usuario").value = "";
    document.getElementById("senha_usuario").value = "";
    document.getElementById("permissoes").value = "";
    document.getElementById("add_usuarios").style.display = "none";
    
    alert("Usuário adicionado com sucesso!");

    mostra_todos_usuarios();
}



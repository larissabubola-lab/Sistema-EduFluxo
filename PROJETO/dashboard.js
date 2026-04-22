const series = document.getElementById("mostrar_series");
const botao_das_series = document.getElementById("botao_series");
let clicou_series = false;

function mostra_as_series(){
    clicou_series = !clicou_series;
    if(clicou_series){
        series.style.display = "grid";
        botao_das_series.textContent = "Mostrar menos ▲";
    }
    else{
        series.style.display = "none";
        botao_das_series.textContent = "Mostrar mais ▼";
    }
}

const usuarios_permissoes = document.getElementById("mostrar_permissoes");
const botao_das_permissoes = document.getElementById("botao_permissoes");
let clicou_permissoes = false;

function mostra_as_permissoes(){
    clicou_permissoes = !clicou_permissoes;
    if(clicou_permissoes){
        usuarios_permissoes.style.display = "grid";
        botao_das_permissoes.textContent = "Mostrar menos ▲";
    }
    else{
        usuarios_permissoes.style.display = "none";
        botao_das_permissoes.textContent = "Mostrar mais ▼";
    }
}

const ocorrencias_tipos = document.getElementById("mostrar_ocorrencias");
const botao_de_ocorrencias = document.getElementById("botao_ocorrencias");
let clicou_ocorrencias = false;

function mostrar_ocorrencias(){
    clicou_ocorrencias = !clicou_ocorrencias;
    if(clicou_ocorrencias){
        ocorrencias_tipos.style.display = "grid";
        botao_de_ocorrencias.textContent = "Mostrar menos ▲";
    }
    else{
        ocorrencias_tipos.style.display = "none";
        botao_de_ocorrencias.textContent = "Mostrar mais ▼";
    }
}

const portaria_motivos = document.getElementById("mostrar_fluxos");
const botao_de_portaria = document.getElementById("botao_fluxos");
let clicou_portaria = false;

function mostrar_fluxos(){
    clicou_portaria = !clicou_portaria;
    if(clicou_portaria){
        portaria_motivos.style.display = "grid";
        botao_de_portaria.textContent = "Mostrar menos ▲";
    }
    else{
        portaria_motivos.style.display = "none";
        botao_de_portaria.textContent = "Mostrar mais ▼";
    }
}

fetch("dashboad.php",{
    method: "POST",
    headers:{
        "Content-Type": "application/json"
    },
    body:JSON.stringify({
        para:"ensino_fundamental"
    })
})
.then(resposta=>resposta.json())
.then(dados=>{

    const mostra_fundamental = document.getElementById("fundamental");

    let array = ["6", "7", "8", "9"]
    let valores_encontrados = dados.filter(item => array.includes(item));
    let quantidade = valores_encontrados.length;

    mostra_fundamental.innerHTML = "Ensino fundamental: " + quantidade;
   
})
let parametro = new URLSearchParams(window.location.search);

const mostra_dashboard = document.getElementById("dashboard");
const mostra_ocorrencias = document.getElementById("ocorrencias");
const mostra_portaria = document.getElementById("portaria");
const mostra_cadastros = document.getElementById("cadastros");


let barra = document.getElementById("barra_lateral");

let clicou = false;

function mostrar_barra_lateral(){
    clicou = !clicou;
    if(clicou){
        barra.style.display = "flex";
    }   
    else{
        barra.style.display = "none";
    }
}

let permissao = parametro.get("permissao");
permissao = parseInt(permissao);

switch(permissao){
    case 0:
        mostra_dashboard.style.display = "inline-block";
        mostra_ocorrencias.style.display = "inline-block";
        mostra_portaria.style.display = "inline.block";
        mostra_cadastros.style.display = "inline-block";
        break;
    case 1:
        mostra_dashboard.style.display = "none";
        mostra_ocorrencias.style.display = "none";
        mostra_portaria.style.display = "inline-block";
        mostra_cadastros.style.display = "none"
    default:
        mostra_dashboard.style.display = "none";
        mostra_ocorrencias.style.display = "inline-block";
        mostra_portaria.style.display = "none";
        mostra_cadastros.style.display = "none"
}

const iframe = document.getElementById("iframes");
const paginaprincipal = document.getElementById("pagina_principal");
const pagina_ajuda = document.getElementById("ajuda");
const pagina_configuracoes = document.getElementById("configuracoes_pagina");

function abrir_dashboard(){
    iframe.src = "dashboard.html";
    pagina_ajuda.style.display = "none";
    pagina_configuracoes.style.display = "none";
    paginaprincipal.style.display = "none";
}

function abrir_ocorrencias(){
    iframe.src = "ocorrencias.html";
    paginaprincipal.style.display = "none";
    pagina_ajuda.style.display = "none";
    pagina_configuracoes.style.display = "none";
}  

function abrir_portaria(){
    iframe.src = "portaria.html";
    paginaprincipal.style.display = "none";
    pagina_ajuda.style.display = "none";
    pagina_configuracoes.style.display = "none";
}

function abrir_cadastros(){
    iframe.src = "lista_pessoas.html";
    pagina_ajuda.style.display = "none";
    paginaprincipal.style.display = "none";
    pagina_configuracoes.style.display = "none";
}

function abrir_ajuda(){
    iframe.src = "";
    paginaprincipal.style.display = "none";
    pagina_ajuda.style.display = "block";
    pagina_configuracoes.style.display = "none";
}

function abrir_configuracoes(){
    iframe.src = "";
    paginaprincipal.style.display = "none";
    pagina_configuracoes.style.display = "block";
    pagina_ajuda.style.display = "none";
}

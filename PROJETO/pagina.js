const iframe = document.getElementById("iframes");
const paginaprincipal = document.getElementById("pagina_principal");
const pagina_ajuda = document.getElementById("ajuda");
const pagina_configuracoes = document.getElementById("configuracoes_pagina");

// const barra = document.getElementById("barra_lateral");

function abrir_dashboard(){
    iframe.src = "dashboard.php";
    pagina_ajuda.style.display = "none";
    pagina_configuracoes.style.display = "none";
    paginaprincipal.style.display = "none";
    barra.style.display = "none";
    clicou = false;
}

function abrir_ocorrencias(){
    iframe.src = "ocorrencias.html";
    paginaprincipal.style.display = "none";
    pagina_ajuda.style.display = "none";
    pagina_configuracoes.style.display = "none";
    barra.style.display = "none";
    clicou = false;
}  

function abrir_portaria(){
    iframe.src = "portaria.html";
    paginaprincipal.style.display = "none";
    pagina_ajuda.style.display = "none";
    pagina_configuracoes.style.display = "none";
    barra.style.display = "none";
    clicou = false;
}

function abrir_cadastros(){
    iframe.src = "lista_pessoas.html";
    pagina_ajuda.style.display = "none";
    paginaprincipal.style.display = "none";
    pagina_configuracoes.style.display = "none";
    barra.style.display = "none";
    clicou = false;
}

function abrir_ajuda(){
    iframe.src = "";
    paginaprincipal.style.display = "none";
    pagina_ajuda.style.display = "block";
    pagina_configuracoes.style.display = "none";
    barra.style.display = "none";
    clicou = false;
}

function abrir_configuracoes(){
    iframe.src = "";
    paginaprincipal.style.display = "none";
    pagina_configuracoes.style.display = "block";
    pagina_ajuda.style.display = "none";
    barra.style.display = "none";
    clicou = false;
}

function abrir_pagina_principal(){
    iframe.src = "";
    paginaprincipal.style.display = "block";
    pagina_ajuda.style.display = "none";
    pagina_configuracoes.style.display = "none";
    barra.style.display = "none";
    clicou = false;
}
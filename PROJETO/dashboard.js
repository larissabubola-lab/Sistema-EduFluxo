let series = document.getElementById("mostrar_series");
let botao_das_series = document.getElementById("botao_series");
let clicou_series = false;

function mostra_as_series(){
    clicou_series = !clicou_series;
    if(clicou_series){
        series.style.display = "block";
        botao_das_series.textContent = "Mostrar menos ▲";
    }
    else{
        series.style.display = "none";
        botao_das_series.textContent = "Mostrar mais ▼";
    }
}
let parametro = new URLSearchParams(window.location.search);

let ocorrencia = document.getElementById("ocorrencias");
let fluxos = document.getElementById("fluxos_saida");
let adcionar_alunos = document.getElementById("add_alunos");
let adcionar_usuarios = document.getElementById("add_usuarios");

let erros = parametro.get("erro");
let permissoes = parseInt(parametro.get("permissao"));
// permissoes = parseInt(permissoes);

console.log({
  ocorrencia,
  fluxos,
  adcionar_alunos,
  adcionar_usuarios,
  permissoes
});

if(erros == "nao_existe"){
    alert("essa conta nao existe no banco!");
};

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

history.replaceState(null, "", window.location.pathname);

document.getElementById("email_usuario").value = "";
document.getElementById("senha_usuario").value = "";

// location.reload(true);

window.addEventListener("pageshow",(event)=>{
    if(event.persisted){
        window.location.reload();
    }
})

let parametro = new URLSearchParams(window.location.search);


let erros = parametro.get("erro");
let permissoes = parseInt(parametro.get("permissao"));

if(erros == "nao_existe"){
    alert("essa conta nao existe no banco!");
};


history.replaceState(null, "", window.location.pathname);

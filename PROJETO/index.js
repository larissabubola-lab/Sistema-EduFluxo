let parametro = new URLSearchParams(window.location.search)

let erros = parametro.get("erro")

if(erros == "nao_existe"){
    alert("essa conta nao existe no banco!")
}
history.replaceState(null, "", window.location.pathname);
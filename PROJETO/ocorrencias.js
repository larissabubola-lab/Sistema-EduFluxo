const mostra_ocorrencias = document.getElementById("ocorrencias");

function mostrar_formulario(){
    mostra_ocorrencias.style.display = "grid";
    document.getElementById("cgm_ocorrencias").value = "";
    document.getElementById("cgm_ocorrencias").disabled = true;
    document.getElementById("nome_aluno_ocorrencias").value = "";
    document.getElementById("serie_aluno").value = "";
    document.getElementById("serie_aluno").disabled = true;
    document.getElementById("usuario_ocorrencia").value = "";
    document.getElementById("usuario_ocorrencia").disabled = true;
    // document.getElementsByClassName("radios").value = "";
    let os_radios = document.querySelectorAll(".radios");
    os_radios.forEach(radio=>{
        radio.checked = false;
    })
    document.getElementById("motivo_ocorrencia").value = "";
}

function cancelar_ocorrencia(){
    mostra_ocorrencias.style.display = "none";
}

const lugar_das_ocorrencias = document.getElementById("lugar_ocorrencias");

function mostra_todas_ocorrencias(){
    let tudo = lugar_das_ocorrencias.querySelectorAll(".mostra_ocorrencias")
    tudo.forEach(todos=>{
        todos.remove()
    })
    
    fetch("banco_de_dados.php",{
        method:"POST",
        headers:{
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para:"buscar_ocorrencias"
        })
    })
    .then(resposta=>resposta.text())
    .then(dados=>{
        lugar_das_ocorrencias.innerHTML += dados;
    })
}

mostra_todas_ocorrencias();


const pagina_ocorrencias = document.getElementById("ocorrencias");
const input_ocorrencias = document.getElementById("nome_aluno_ocorrencias");
const resultados = document.getElementById("resultado");

input_ocorrencias.addEventListener("input", mostrar_resultados);
input_ocorrencias.addEventListener("click", mostrar_resultados);

function mostrar_resultados(){ 
    if (!resultados) {
        return;
    }
    resultados.style.display = "block";

    fetch("buscar_alunos.php?busca=" + input_ocorrencias.value)
        .then(resultado => resultado.text())
        .then(data=>{
            resultados.innerHTML = data;
            let elementos = resultados.querySelectorAll(".nome_resultados")
            elementos.forEach(classe=>{
                classe.dataset.nome = classe.textContent.trim();
                classe.addEventListener("click", ()=>{
                    // alert("ola " + classe.dataset.nome + "!");
                    // input_ocorrencias.value = classe.dataset.nome;
                    fetch("banco_de_dados.php",{
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body:JSON.stringify({
                            para:"buscar_aluno_por_nome",
                            nome:classe.dataset.nome
                        })
                    })
                    .then(retorno => retorno.json())
                    .then(dados=>{
                        document.getElementById("cgm_ocorrencias").value = dados.cgm;
                        document.getElementById("cgm_ocorrencias").disabled = false;
                        document.getElementById("nome_aluno_ocorrencias").value = dados.nome;
                        document.getElementById("serie_aluno").value = dados.sala;
                        document.getElementById("serie_aluno").disabled = false;
                        document.getElementById("usuario_ocorrencia").value = localStorage.getItem("nome_usuario");
                        document.getElementById("usuario_ocorrencia").disabled = false;
                    })
                    resultados.style.display = "none";
                })
            })
        })
}

mostra_ocorrencias.addEventListener("mouseleave", limpar_resultados);
resultados.addEventListener("mouseleave", limpar_resultados);

function limpar_resultados(){
    resultados.style.display = "none";
}


function criar_ocorrencia(){
    
    
    function dia_bonitinho(){
        let data = new Date();
        let ano = data.getFullYear();
        let mes = data.getMonth() + 1;
        let dia = data.getDate();

        ano = ano.toString();
        mes = mes.toString();
        dia = dia.toString();

        if(mes.length <2){
            mes = "0" + mes;
        }

        if(dia.length<2){
            dia = "0" + dia;
        }
        return dia + "/" + mes + "/" + ano;
    }
    

    let cgm_aluno = document.getElementById("cgm_ocorrencias").value;
    let nome_aluno = document.getElementById("nome_aluno_ocorrencias").value;
    let serie = document.getElementById("serie_aluno").value;
    let tipo_ocorrencia = document.querySelector('input[name="bom_ruim"]:checked');
    tipo_ocorrencia = tipo_ocorrencia? tipo_ocorrencia.value: null;
    let motivo = document.getElementById("motivo_ocorrencia").value;
    let usuario = document.getElementById("usuario_ocorrencia").value;

    if(!cgm_aluno || !nome_aluno || !serie || !tipo_ocorrencia || !motivo){
        alert("Preencha todos os campos para criar uma ocorrência.")
        return;
    }

    fetch("banco_de_dados.php",{
        method: "POST",
        headers:{
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para:"ocorrencias",
            cgm: cgm_aluno,
            nome: nome_aluno,
            serie:serie,
            professor: usuario,
            data: dia_bonitinho(),
            tipo: tipo_ocorrencia,
            motivo: motivo
        })
    })

    document.getElementById("cgm_ocorrencias").value = "";
    document.getElementById("nome_aluno_ocorrencias").value = "";
    document.getElementById("serie_aluno").value = "";
    document.getElementById("usuario_ocorrencia").value = "";

    let radio = document.querySelectorAll(".radios")
    radio.forEach(apaga=>{
        apaga.checked = false;
    })
    
    document.getElementById("motivo_ocorrencia").value = "";

    mostra_ocorrencias.style.display = "none;"
    document.getElementById("cgm_ocorrencias").disabled = true;
    document.getElementById("serie_aluno").disabled = true;
    document.getElementById("usuario_ocorrencia").disabled = true;
    mostra_ocorrencias.style.display = "none";

    alert("Ocorrência criada com sucesso!");

    mostra_todas_ocorrencias();
}



function mostrar_tipos(){
    let tudo = lugar_das_ocorrencias.querySelectorAll(".mostra_ocorrencias")
    tudo.forEach(todos=>{
        todos.remove()
    })
    let select_value = document.getElementById("select").value;

    switch(select_value){
        case "positivas":
            fetch("banco_de_dados.php",{
                method:"POST",
                headers:{
                    "Content-Type": "application/json"
                },
                body:JSON.stringify({
                    para: "buscar_ocorrencias_positivas"
                })
            })
            .then(resposta=>resposta.text())
            .then(dados=>{
                lugar_das_ocorrencias.innerHTML += dados;
            })
            break;
        case "negativas":
            fetch("banco_de_dados.php",{
                method:"POST",
                headers:{
                    "Content-Type": "application/json"
                },
                body:JSON.stringify({
                    para:"buscar_ocorrencias_negativas"
                })
            })
            .then(resposta=>resposta.text())
            .then(dados=>{
                lugar_das_ocorrencias.innerHTML += dados;
            })
            break;
        default:
            fetch("banco_de_dados.php",{
                method: "POST",
                headers:{
                    "Content-Type": "application/json"
                },
                body:JSON.stringify({
                    para:"buscar_ocorrencias"
                })
            })
            .then(resposta=>resposta.text())
            .then(dados=>{
                lugar_das_ocorrencias.innerHTML += dados;
            })
            break;
    }
    
}

function mostrar_pesquisa(){
    let tudo = lugar_das_ocorrencias.querySelectorAll(".mostra_ocorrencias")
    tudo.forEach(todos=>{
        todos.remove()
    })
    let input = document.getElementById("pesquisa").value;
    if(input === ""){
        fetch("banco_de_dados.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/json"
            },
            body:JSON.stringify({
                para: "buscar_ocorrencias"
            })
        })
        .then(resposta=>resposta.text())
        .then(dados=>{
            lugar_das_ocorrencias.innerHTML += dados;
        })
        return;
    }
    fetch("banco_de_dados.php",{
        method: "POST",
        headers:{
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para: "input_ocorrencias",
            busca: input
        })
    })
    .then(resposta=>resposta.text())
    .then(dados=>{
        lugar_das_ocorrencias.innerHTML += dados;
    })
    
}
   

//     

    
// }
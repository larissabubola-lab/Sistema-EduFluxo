const pagina_add_portaria = document.getElementById("fluxos_saida");

function mostrar_criar_portaria(){
    pagina_add_portaria.style.display = "grid";
    document.getElementById("cgm_fluxos").value = "";
    document.getElementById("cgm_fluxos").disabled = true;
    document.getElementById("nome_aluno_fluxo").value = "";
    document.getElementById("serie_aluno_fluxo").value = "";
    document.getElementById("serie_aluno_fluxo").disabled = true;
    document.getElementById("usuario_fluxos").value = "";
    document.getElementById("usuario_fluxos").disabled = true;
    document.getElementById("motivo_fluxo").value = "";
    document.getElementById("motivo_outro").value = "";
    document.getElementById("motivo_outro").style.display = "none" ; 
    clicou = true;
    manual();
}

function cancelar_fluxos(){
    pagina_add_portaria.style.display = "none";
}

const mostrar_portaria = document.getElementById("lugar_portaria");

function mostrar_fluxos(){
    let elementos = mostrar_portaria.querySelectorAll(".mostra_portaria");
    elementos.forEach(apaga=>{
        apaga.remove();
    })

    fetch("banco_de_dados.php",{
        method: "POST",
        headers:{
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para:"buscar_portaria"
        })
        
    })
    .then(resposta=>resposta.text())
    .then(dados=>{
        mostrar_portaria.innerHTML += dados;
    })
}

mostrar_fluxos();

const pagina_fluxos = document.getElementById("fluxos_saida");
const input_fluxos = document.getElementById("nome_aluno_fluxo");
const resultados_fluxos = document.getElementById("resultado_fluxos");

input_fluxos.addEventListener("input", mostrar_resultados_fluxos);
// input_fluxos.addEventListener("click", mostrar_resultados_fluxos);

function mostrar_resultados_fluxos(){
    if(!resultados_fluxos){
        return;
    }
    resultados_fluxos.style.display = "block";
    
    fetch("buscar_alunos.php?busca=" + input_fluxos.value)
        .then(resultado=>resultado.text())
        .then(data=>{
            resultados_fluxos.innerHTML = data;
            nomes = resultados_fluxos.querySelectorAll(".nome_resultados");
            nomes.forEach(classe=>{
                classe.dataset.nome = classe.textContent.trim();
                
                classe.addEventListener("click",()=>{
                    // alert("ola" + classe.dataset.nome + "!" );
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
                    .then(resposta=> resposta.json())
                    .then(dados=>{
                        
                        document.getElementById("cgm_fluxos").value = dados.cgm;
                        document.getElementById("cgm_fluxos").disabled = false;
                        document.getElementById("nome_aluno_fluxo").value = dados.nome;
                        document.getElementById("serie_aluno_fluxo").value = dados.sala;
                        document.getElementById("serie_aluno_fluxo").disabled = false;
                        document.getElementById("usuario_fluxos").value = localStorage.getItem("nome_usuario");
                        document.getElementById("usuario_fluxos").disabled = false;
                    })
                    resultados_fluxos.style.display = "none";
                })
            })
        })
}

let clicou = false;

function manual(){
    clicou = !clicou;
    if(clicou){
        document.getElementById("cgm_fluxos").disabled = false;
        document.getElementById("nome_aluno_fluxo").removeEventListener("input", mostrar_resultados_fluxos);
        document.getElementById("serie_aluno_fluxo").disabled = false;
        document.getElementById("usuario_fluxos").disabled = false;
        document.getElementById("botao_manual").innerHTML = "<i class='bi bi-arrow-counterclockwise'></i>Desativar escrita manual";
        document.getElementById("botao_manual").title="Desativar a escrita manual";
    }
    else{
        document.getElementById("cgm_fluxos").disabled = true;
        document.getElementById("nome_aluno_fluxo").removeEventListener("input", mostrar_resultados_fluxos);
        document.getElementById("serie_aluno_fluxo").disabled = true;
        document.getElementById("usuario_fluxos").disabled = true;
        document.getElementById("botao_manual").innerHTML = "<i class='bi bi-arrow-clockwise'></i>Criar fluxo manual";    
        document.getElementById("botao_manual").title="Escrever o fluxo manualmente";
    }
    
}

pagina_fluxos.addEventListener("mouseleave", limpar_resultados_fluxos);

function limpar_resultados_fluxos(){
    resultados_fluxos.style.display = "none";
}

const motivos = document.getElementById("motivo_fluxo");

motivos.addEventListener("change", mostra_input);

function mostra_input(){
    const motivo_outro = document.getElementById("motivo_outro");
    if(motivos.value === "outro"){
        motivo_outro.style.display = "block";
    } 
    else {
        motivo_outro.style.display = "none";
    }
}


function criar_fluxos(){

    function data_bonitinha(){
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

        if(dia.length <2){
            dia = "0" + dia;
        }

        return dia + "/" + mes + "/" + ano;
    }

    let cgm = document.getElementById("cgm_fluxos").value;
    let nome = document.getElementById("nome_aluno_fluxo").value;
    let serie = document.getElementById("serie_aluno_fluxo").value;
    let usuario = document.getElementById("usuario_fluxos").value;
    let motivo = document.getElementById("motivo_fluxo").value;
    if(motivo === "outro"){
        motivo = document.getElementById("motivo_outro").value;
    }

    if(!cgm || !nome || !serie || !usuario || !motivo){
        alert("Preencha todos os campos obrigatórios!");
        return;
    }

    fetch("banco_de_dados.php",{
        method:"POST",
        headers:{
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para:"portaria",
            cgm:cgm,
            nome:nome,
            serie:serie,
            usuario:usuario,
            data: data_bonitinha(),
            motivo:motivo
        })
    })

    document.getElementById("cgm_fluxos").value = "";
    document.getElementById("cgm_fluxos").disabled = true;
    document.getElementById("nome_aluno_fluxo").value = "";
    document.getElementById("serie_aluno_fluxo").value = "";
    document.getElementById("serie_aluno_fluxo").disabled = true;
    document.getElementById("usuario_fluxos").value = "";
    document.getElementById("motivo_fluxo").value = "";
    document.getElementById("motivo_outro").value = "";
    document.getElementById("motivo_outro").style.display = "none";
    pagina_add_portaria.style.display = "none";

    alert("Documentação de fluxo criado com sucesso!");

    mostrar_fluxos();
}


function mostrar_motivos(){
    let elementos = mostrar_portaria.querySelectorAll(".mostra_portaria");
    elementos.forEach(apaga=>{
        apaga.remove();
    })

    
    let select_value = document.getElementById("select_portaria").value;

    switch(select_value){
        case "entrada":
            fetch("banco_de_dados.php",{
                method:"POST",
                headers:{
                    "Content-Type": "application/json"
                },
                body:JSON.stringify({
                    para:"buscar_portaria_entrada"
                })
            })
            .then(resposta=>resposta.text())
            .then(dados=>{
                mostrar_portaria.innerHTML += dados;
            })
            break;
        case "saida":
            fetch("banco_de_dados.php",{
                method:"POST",
                headers:{
                    "Content-Type": "application/json"
                },
                body:JSON.stringify({
                    para:"buscar_portaria_saida"
                })
            })
            .then(resposta=>resposta.text())
            .then(dados=>{
                mostrar_portaria.innerHTML += dados;
            })
            break;
        case "outros":
            fetch("banco_de_dados.php",{
                method:"POST",
                headers:{
                    "Content-Type": "application/json"
                },
                body:JSON.stringify({
                    para:"buscar_portaria_outros"
                })
            })
            .then(resposta=>resposta.text())
            .then(dados=>{
                mostrar_portaria.innerHTML += dados;
            })
            break;
        default:
            fetch("banco_de_dados.php",{
                method:"POST",
                headers:{
                    "Content-Type": "application/json"
                },
                body:JSON.stringify({
                    para:"buscar_portaria"
                })
            })
            .then(resposta=>resposta.text())
            .then(dados=>{
                mostrar_portaria.innerHTML += dados;
            })
            break;
    }
}

function mostrar_pesquisa(){
    let elementos = mostrar_portaria.querySelectorAll(".mostra_portaria");
    elementos.forEach(apaga=>{
        apaga.remove();
    })

    let input = document.getElementById("pesquisa").value;
    if(input === ""){
        fetch("banco_de_dados.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/json"
            },
            body:JSON.stringify({
                para:"buscar_portaria"
            })
        })
        .then(resposta=>resposta.text())
        .then(dados=>{
            mostrar_portaria.innerHTML += dados;
        })
        return;
    }
    fetch("banco_de_dados.php",{
        method:"para",
        headers:{
            "Content-Type": "application/json"
        },
        body:JSON.stringify({
            para:"input_portaria",
            buscar:input
        })
    })
    .then(resposta=>resposta.text())
    .then(dados=>{
        mostrar_portaria.innerHTML += dados;
    })
}
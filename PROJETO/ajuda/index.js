let historico = JSON.parse(localStorage.getItem('calculadoraNotasHistorico')) || [];
let usuarioLogado = null;
let cuentasRegistradas = JSON.parse(localStorage.getItem('cuentasRegistradas')) || [];
function registrarCuenta(email, password) {
    if (!email || !validarEmail(email)) {
        return { exito: false, mensaje: '❌ Por favor, insira um email válido.' };
    }
    
    if (!password || password.length < 6) {
        return { exito: false, mensaje: '❌ A senha deve ter pelo menos 6 caracteres.' };
    }

    if (cuentasRegistradas.some(cuenta => cuenta.email === email)) {
        return { exito: false, mensaje: '❌ Esta conta já está registrada.' };
    }
  
    const nuevaCuenta = {
        email: email,
        password: password, 
        fechaRegistro: new Date().toISOString()
    };
    
    cuentasRegistradas.push(nuevaCuenta);
    localStorage.setItem('cuentasRegistradas', JSON.stringify(cuentasRegistradas));
    
    return { exito: true, mensaje: '✅ Conta registrada com sucesso!' };
}

function iniciarSesion(email, password) {
    if (!email || !validarEmail(email)) {
        return { exito: false, mensaje: '❌ Por favor, insira um email válido.' };
    }
    
    const cuenta = cuentasRegistradas.find(c => c.email === email);
    if (!cuenta) {
        return { exito: false, mensaje: '❌ Conta não encontrada. Registre-se primeiro.' };
    }
    
    if (cuenta.password !== password) {
        return { exito: false, mensaje: '❌ Senha incorreta.' };
    }
    
    usuarioLogado = {
        email: email,
        dataLogin: new Date().toISOString()
    };
    
    localStorage.setItem('usuarioLogado', JSON.stringify(usuarioLogado));
    
    return { exito: true, mensaje: '✅ Login realizado com sucesso!' };
}

function cerrarSesion() {
    if (confirm('Tem certeza que deseja sair?')) {
        usuarioLogado = null;
        localStorage.removeItem('usuarioLogado');
        return { exito: true, mensaje: '✅ Sessão encerrada com sucesso!' };
    }
    return { exito: false, mensaje: 'Operação cancelada.' };
}

function cambiarUsuario() {
    if (confirm('Deseja trocar de usuário? Todo o progresso não salvo será perdido.')) {
        usuarioLogado = null;
        localStorage.removeItem('usuarioLogado');
        return { exito: true, mensaje: '✅ Pronto para trocar de usuário!' };
    }
    return { exito: false, mensaje: 'Operação cancelada.' };
}

function eliminarCuenta() {
    if (!usuarioLogado) {
        return { exito: false, mensaje: '❌ Nenhum usuário está logado no momento.' };
    }

    if (confirm('🚨 ATENÇÃO: Esta ação é irreversível!\n\nDeseja realmente excluir sua conta?\nIsso removerá:\n• Seus dados de login\n• Todo seu histórico de cálculos\n• Todas as suas configurações')) {
        
        const emailUsuario = usuarioLogado.email;
        historico = historico.filter(item => item.usuario !== emailUsuario);
        localStorage.setItem('calculadoraNotasHistorico', JSON.stringify(historico));
        
        cuentasRegistradas = cuentasRegistradas.filter(cuenta => cuenta.email !== emailUsuario);
        localStorage.setItem('cuentasRegistradas', JSON.stringify(cuentasRegistradas));
        
        usuarioLogado = null;
        localStorage.removeItem('usuarioLogado');
        
        return { exito: true, mensaje: '✅ Conta excluída com sucesso! Todos os dados foram removidos.' };
    }
    
    return { exito: false, mensaje: 'Operação cancelada.' };
}

function validarEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function obtenerCuentasRegistradas() {
    return cuentasRegistradas.map(cuenta => ({
        email: cuenta.email,
        fechaRegistro: cuenta.fechaRegistro,
        numCalculos: historico.filter(item => item.usuario === cuenta.email).length
    }));
}

function obtenerInfoCuenta(email) {
    const cuenta = cuentasRegistradas.find(c => c.email === email);
    if (!cuenta) return null;
    
    const calculos = historico.filter(item => item.usuario === email);
    
    return {
        email: cuenta.email,
        fechaRegistro: cuenta.fechaRegistro,
        numCalculos: calculos.length,
        ultimoCalculo: calculos.length > 0 ? calculos[calculos.length - 1].data : 'Nenhum cálculo'
    };
}

function cambiarACuentaExistente(email) {
    const cuenta = cuentasRegistradas.find(c => c.email === email);
    if (!cuenta) {
        return { exito: false, mensaje: '❌ Conta não encontrada.' };
    }
    
    const password = prompt(`Digite a senha para a conta ${email}:`);
    if (!password) {
        return { exito: false, mensaje: 'Operação cancelada.' };
    }
    
    if (cuenta.password !== password) {
        return { exito: false, mensaje: '❌ Senha incorreta.' };
    }
    
    usuarioLogado = {
        email: email,
        dataLogin: new Date().toISOString()
    };
    
    localStorage.setItem('usuarioLogado', JSON.stringify(usuarioLogado));
    
    return { exito: true, mensaje: `✅ Agora você está logado como ${email}!` };
}

function mostrarSelectorCuentas() {
    const cuentas = obtenerCuentasRegistradas();
    
    if (cuentas.length === 0) {
        alert('Nenhuma conta registrada ainda.');
        return;
    }
    
    let mensaje = '👥 Contas Registradas:\n\n';
    cuentas.forEach((cuenta, index) => {
        mensaje += `${index + 1}. ${cuenta.email}\n`;
        mensaje += `   📅 Registrada em: ${new Date(cuenta.fechaRegistro).toLocaleDateString('pt-BR')}\n`;
        mensaje += `   📊 Cálculos: ${cuenta.numCalculos}\n\n`;
    });
    
    mensaje += 'Deseja fazer login em uma dessas contas?';
    
    if (confirm(mensaje)) {
        const emailSeleccionado = prompt('Digite o email da conta que deseja acessar:');
        if (emailSeleccionado) {
            const resultado = cambiarACuentaExistente(emailSeleccionado);
            alert(resultado.mensaje);
            
            if (resultado.exito) {

                window.location.reload();
            }
        }
    }
}

function mostrarDialogoRegistro() {
    const email = prompt('Digite seu email para registrar uma nova conta:');
    if (!email) return;
    
    if (!validarEmail(email)) {
        alert('❌ Por favor, insira um email válido.');
        return;
    }
    
    const password = prompt('Digite uma senha (mínimo 6 caracteres):');
    if (!password || password.length < 6) {
        alert('❌ A senha deve ter pelo menos 6 caracteres.');
        return;
    }
    
    const confirmarPassword = prompt('Confirme a senha:');
    if (password !== confirmarPassword) {
        alert('❌ As senhas não coincidem.');
        return;
    }
    
    const resultado = registrarCuenta(email, password);
    alert(resultado.mensaje);
    
    if (resultado.exito) {
        
        if (confirm('Deseja fazer login agora com esta conta?')) {
            const resultadoLogin = iniciarSesion(email, password);
            alert(resultadoLogin.mensaje);
            
            if (resultadoLogin.exito) {
                window.location.reload();
            }
        }
    }
}

function mostrarInfoCuentaActual() {
    if (!usuarioLogado) {
        alert('❌ Nenhum usuário está logado no momento.');
        return;
    }
    
    const info = obtenerInfoCuenta(usuarioLogado.email);
    if (!info) {
        alert('❌ Informações da conta não encontradas.');
        return;
    }
    
    let mensaje = `👤 Informações da Conta:\n\n`;
    mensaje += `📧 Email: ${info.email}\n`;
    mensaje += `📅 Data de registro: ${new Date(info.fechaRegistro).toLocaleDateString('pt-BR')}\n`;
    mensaje += `📊 Total de cálculos: ${info.numCalculos}\n`;
    mensaje += `⏰ Último cálculo: ${info.ultimoCalculo}\n\n`;
    
    mensaje += 'O que deseja fazer?';
    
    const opcao = prompt(`${mensaje}\n\n1. Trocar de conta\n2. Excluir esta conta\n3. Voltar`);
    
    switch (opcao) {
        case '1':
            cambiarUsuario();
            break;
        case '2':
            eliminarCuenta();
            break;
        default:
        break;
    }
}

function inicializarSesion() {
    const usuarioSalvo = localStorage.getItem('usuarioLogado');
    if (usuarioSalvo) {
        usuarioLogado = JSON.parse(usuarioSalvo);
        console.log(`✅ Usuário logado: ${usuarioLogado.email}`);
    } else {
        console.log('ℹ️ Nenhum usuário logado.');
    }
    
    cuentasRegistradas = JSON.parse(localStorage.getItem('cuentasRegistradas')) || [];
    console.log(`📊 ${cuentasRegistradas.length} conta(s) registrada(s).`);
}

document.addEventListener('DOMContentLoaded', function() {
    inicializarSesion();
    
    if (!document.getElementById('btn-gestion-cuentas')) {
        const botonGestion = document.createElement('button');
        botonGestion.id = 'btn-gestion-cuentas';
        botonGestion.textContent = '👥 Gerenciar Contas';
        botonGestion.style.margin = '10px';
        botonGestion.style.padding = '8px 16px';
        botonGestion.style.background = '#007bff';
        botonGestion.style.color = 'white';
        botonGestion.style.border = 'none';
        botonGestion.style.borderRadius = '4px';
        botonGestion.style.cursor = 'pointer';
        
        botonGestion.addEventListener('click', function() {
            mostrarMenuGestionCuentas();
        });
        
        document.body.insertBefore(botonGestion, document.body.firstChild);
    }
});

function mostrarMenuGestionCuentas() {
    let mensaje = '👥 Gestão de Contas\n\n';
    
    if (usuarioLogado) {
        mensaje += `✅ Atualmente logado como: ${usuarioLogado.email}\n\n`;
    } else {
        mensaje += '❌ Nenhum usuário logado.\n\n';
    }
    
    mensaje += 'Opções:\n';
    mensaje += '1. Fazer login\n';
    mensaje += '2. Registrar nova conta\n';
    mensaje += '3. Trocar de conta\n';
    
    if (usuarioLogado) {
        mensaje += '4. Informações da conta atual\n';
        mensaje += '5. Excluir conta atual\n';
        mensaje += '6. Sair\n';
    }
    
    mensaje += '0. Voltar';
    
    const opcao = prompt(mensaje);
    
    switch (opcao) {
        case '1':
            if (usuarioLogado) {
                alert('❌ Você já está logado. Use "Trocar de conta" para alternar entre contas.');
            } else {
                const email = prompt('Digite seu email:');
                const password = prompt('Digite sua senha:');
                
                if (email && password) {
                    const resultado = iniciarSesion(email, password);
                    alert(resultado.mensaje);
                    
                    if (resultado.exito) {
                        window.location.reload();
                    }
                }
            }
            break;
            
        case '2':
            mostrarDialogoRegistro();
            break;
            
        case '3':
            if (usuarioLogado) {
                const resultado = cambiarUsuario();
                alert(resultado.mensaje);
                
                if (resultado.exito) {
                    window.location.reload();
                }
            } else {
                mostrarSelectorCuentas();
            }
            break;
            
        case '4':
            if (usuarioLogado) {
                mostrarInfoCuentaActual();
            }
            break;
            
        case '5':
            if (usuarioLogado) {
                const resultado = eliminarCuenta();
                alert(resultado.mensaje);
                
                if (resultado.exito) {
                    window.location.reload();
                }
            }
            break;
            
        case '6':
            if (usuarioLogado) {
                const resultado = cerrarSesion();
                alert(resultado.mensaje);
                
                if (resultado.exito) {
                    window.location.reload();
                }
            }
            break;
            
        default:
        
            break;
    }
}function login() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    if (!email || !validarEmail(email)) {
        alert('Por favor, insira um email válido.');
        return;
    }
    
    if (!password || password.length < 6) {
        alert('A senha deve ter pelo menos 6 caracteres.');
        return;
    }
    
    usuarioLogado = {
        email: email,
        dataLogin: new Date().toISOString()
    };
    
    localStorage.setItem('usuarioLogado', JSON.stringify(usuarioLogado));
    mostrarInterfaceUsuario();
}
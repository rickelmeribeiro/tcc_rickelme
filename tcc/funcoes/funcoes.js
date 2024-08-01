function carregaMenu(page) {
    fetch('controle.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'controle=' + encodeURIComponent(page),
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById('carregaConteudo').innerHTML = data;
        })
        .catch(error => console.error('Error na requisição:', error));
}

function ValidaCPF() {
    var RegraValida = document.getElementById("cpf_usuario").value;
    var cpfValido = /^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2})|([0-9]{11}))$/;
    if (cpfValido.test(RegraValida) === true) {
        console.log("CPF Válido");
    } else {
        console.log("CPF Inválido");
    }
}

function fMasc(objeto, mascara) {
    obj = objeto;
    masc = mascara;
    setTimeout("fMascEx()", 1);
}

function fMascEx() {
    obj.value = masc(obj.value);
}

function mCPF(cpf_usuario) {
    cpf_usuario = cpf_usuario.replace(/\D/g, "");
    cpf_usuario = cpf_usuario.replace(/(\d{3})(\d)/, "$1.$2");
    cpf_usuario = cpf_usuario.replace(/(\d{3})(\d)/, "$1.$2");
    cpf_usuario = cpf_usuario.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    return cpf_usuario;
}

if (document.getElementById("cpf_usuario")) {
    document.getElementById("cpf_usuario");
}

function sair() {
    window.location.href = "index.php";
}

document.addEventListener('DOMContentLoaded', function () {
    var aside = document.getElementById('show-side-navigation1');
    var elements = aside.querySelectorAll('li');

    elements.forEach(function (element) {
        element.addEventListener('click', function () {
            element.classList.add('pressed');

            setTimeout(function () {
                element.classList.remove('pressed');
            }, 100); // Tempo em milissegundos para remover a classe "pressed"
        });
    });
});

function fecharModal(nomeModal) {
    const modalElement = document.getElementById(nomeModal);
    const ModalInstacia = new bootstrap.Modal(modalElement);
    ModalInstacia.hide();
}

function abrirModalJsExcluir(id, inID, nomeModal, abrirModal = 'A', addEditDel, formulario) {
    const formDados = document.getElementById(`${formulario}`);
    const ModalInstacia = new bootstrap.Modal(document.getElementById(`${nomeModal}`));

    if (abrirModal === 'A') {
        ModalInstacia.show();
        const inputid = document.getElementById(`${inID}`);
        if (inID !== 'nao') {
            inputid.value = id;
        }

        const submitHandler = function (event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            formData.append('controle', `${addEditDel}`);
            if (inID !== 'nao') {
                formData.append('id', `${id}`);
            }

            fetch('excusuario.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    ModalInstacia.hide();
                    carregaMenu('listarUsuario');
                })
                .catch(error => {
                    ModalInstacia.hide();
                    carregaMenu('listarUsuario');
                    console.error('Erro na requisição:', error);
                });
        };

        formDados.addEventListener('submit', submitHandler);
    } else {
        ModalInstacia.hide();

        carregaMenu('listarUsuario');
    }
}

function abrirModalJsAlterar(id, inID, nomeModal, abrirModal = 'A', addEditDel, formulario, idNome, inNome, idCpf, inCpf) {
    const formDados = document.getElementById(formulario);
    const modalElement = document.getElementById(nomeModal);
    const ModalInstacia = new bootstrap.Modal(modalElement);

    if (abrirModal === 'A') {
        ModalInstacia.show();

        const nome = document.getElementById(`${inNome}`);
        if (inNome !== 'nao') {
            nome.value = idNome;
        }
        const cpf = document.getElementById(`${inCpf}`);
        if (inCpf !== 'nao') {
            cpf.value = idCpf;
        }

        const inputId = document.getElementById(inID);
        if (inID !== 'nao') {
            inputId.value = id;
        }

        formDados.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(formDados);
            formData.append('controle', addEditDel);

            if (inID !== 'nao') {
                formData.append('id', id);
            }

            fetch('alterarusuario.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    // Fechar o modal
                    ModalInstacia.hide();

                    // Carregar a página de listagem de usuários
                    carregaMenu('listarUsuario');
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);

                    // Fechar o modal
                    ModalInstacia.hide();


                    // Carregar a página de listagem de usuários
                    carregaMenu('listarUsuario');

                });
        });
    } else {
        ModalInstacia.hide();

        carregaMenu('listarUsuario');
    }
}


function abrirModalJsVerMais(id, inID, nomeModal, abrirModal = 'A') {
    const modalElement = document.getElementById(nomeModal);
    const ModalInstacia = new bootstrap.Modal(modalElement);

    if (abrirModal === 'A') {
        ModalInstacia.show();

        const inputId = document.getElementById(inID);
        if (inID !== 'nao') {
            inputId.value = id;
        }

        const submitHandler = function (event) {
            event.preventDefault();

            const formData = new FormData(formDados);
            if (inID !== 'nao') {
                formData.append('id', id);
            }
        };

        formDados.addEventListener('submit', submitHandler);
    } else {
        carregaMenu('listarUsuario');
    }
}

function voltarParaListarUsuario() {
    carregaMenu('listarUsuario');
}

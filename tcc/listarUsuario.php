<?php
include_once "./configuracoes/conexao.php";
include_once "./configuracoes/constante.php";
include_once "./funcoes/funcoes.php";

$search_cpf = "";
$search_name = "";
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="./css/btncad.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/tabela.css">
    <link rel="stylesheet" href="./css/btngp.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/pesquisa.css">



    <title>Listar Usuários</title>
</head>

<body>
    <div class="welcome mb-5">
        <div class="content rounded-3 p-3">
            <h1 class="fs-3" style="font-family: 'Segoe UI Light',sans-serif">Este é o Menu de Usuários!</h1>
            <p class="mb-0" style="font-family: 'Segoe UI Light',sans-serif">Abaixo Encontra-se a Tabela Geral.</p>
        </div>
    </div>


    <form method="get" name="frmpesquisa" id="frmpesquisa">
        <div class="row mb-4" style="margin-left: 29%">
            <div class="col-md-3">
                <div class="form-group has-search">
                    <input type="text" id="pesquisa_nome" name="pesquisa_nome" value="<?php echo $search_name; ?>"
                        autocomplete="off" class="form-control rounded-5 formedit placer"
                        placeholder="Pesquise Pelo Nome...">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group has-search">
                    <input type="text" id="pesquisa_cpf" name="pesquisa_cpf" value="<?php echo $search_cpf; ?>"
                        onkeydown="fMasc(this, mCPF);" autocomplete="off" maxlength="14"
                        class="form-control rounded-5 formedit placer cpf_usuario" placeholder="Pesquise Pelo CPF...">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btnn mb-2 bg-secondary rounded-5" style="margin-bottom: 20px">
                    <div class="sign">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <title>Pesquisar</title>
                            <path
                                d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                        </svg>
                    </div>
                    <div class="text" style="font-family: 'Segoe UI Light',sans-serif">Pesquisar</div>
                </button>
            </div>
        </div>
    </form>


    <table class="container rounded-5">
        <thead>
            <tr class="text-white" style="font-family: 'Segoe UI Light',sans-serif">
                <th scope="col" width="5%">#</th>
                <th scope="col" width="10%">Nome</th>
                <th scope="col" width="10%">Cpf</th>
                <th scope="col" width="8%">Foto</th>
                <th scope="col" width="8%">Ativo</th>
                <th scope="col" width="10%">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $listarUsuario = listarGeral('idusuario, nomeUsuario, cpf, ativo, foto', 'usuario');
            if ($listarUsuario) {
                foreach ($listarUsuario as $usuario) {
                    $idusuario = $usuario->idusuario;
                    $nomeusuario = $usuario->nomeUsuario;
                    $cpfusuario = $usuario->cpf;
                    $ativousuario = $usuario->ativo;
                    $fotousuario = $usuario->foto;

                    $tipoConteudo = "image/png";

                    ?>
                    <tr class="text-white" style="font-family: 'Segoe UI Light',sans-serif">
                        <td><?php echo $idusuario ?></td>
                        <td><?php echo $nomeusuario ?></td>
                        <td><?php echo $cpfusuario ?></td>
                        <td>
                            <?php if ($fotousuario != null): ?>
                                <img src="data:<?php echo $tipoConteudo ?>;base64,<?php echo base64_encode($fotousuario) ?>"
                                    width="100" height="100" alt="<?php echo $idusuario ?>" title="<?php echo $idusuario ?>">
                            <?php else: ?>
                                Sem Foto
                            <?php endif; ?>
                        </td>
                        <td><?php echo $ativousuario ?></td>
                        <td>
                            <input type="hidden" value="<?php echo $idusuario ?>" id="id" name="id">
                            <button id="btnexc"
                                onclick="abrirModalJsExcluir('<?php echo $idusuario ?>','id','ModalCerteza','A','excusuario','frmexcEnd');"
                                class="Btngp mb-2 bg-danger">

                                <div class="sign">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <title>Excluir Dados</title>
                                        <path
                                            d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                    </svg>
                                </div>

                                <div class="text" style="font-family: 'Segoe UI Light',sans-serif">Excluir</div>
                            </button>
                            <div class="modal fade" id="ModalCerteza" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content rounded-5">
                                        <div class="modal-body bg-dark rounded-5">
                                            <form method="post" name="frmexcEnd" id="frmexcEnd">
                                                <button type="submit" class="btn btn-danger rounded-5" style="margin-left: 29%">
                                                    <b>Tem
                                                        Certeza?</b></button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button
                                onclick="abrirModalJsAlterar('<?php echo $idusuario ?>','id','ModalAlterar','A','alterarusuario','frmalterar','<?php echo $nomeusuario ?>', 'nome_usuario','<?php echo $cpfusuario ?>','cpf_usuario');"
                                class="Btngp mb-2 bg-primary">

                                <div class="sign">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <title>Alterar Dados</title>
                                        <path
                                            d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                    </svg>
                                </div>

                                <div class="text" style="font-family: 'Segoe UI Light',sans-serif">Alterar</div>
                            </button>
                            <div class="modal fade" style="background-color: #313348" id="ModalAlterar" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog rounded-5 modal-dialog-centered">
                                    <div class="modal-content rounded-5">
                                        <div class="modal-body rounded-5" style="background-color: #252636">
                                            <form method="post" name="frmalterar" id="frmalterar">
                                                <input type="hidden" id="id" name="id">
                                                <div class="mb-3">
                                                    <label for="nome_usuario" class="form-label">Nome</label>
                                                    <input type="text" class="form-control formedit placer rounded-5"
                                                        id="nome_usuario" name="nome_usuario" placeholder="Seu Nome"
                                                        autocomplete="off" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="cpf_usuario" class="form-label">CPF</label>
                                                    <input autocomplete="off" type="text" onkeydown="fMasc(this, mCPF);"
                                                        class="form-control cpf_usuario formedit placer rounded-5"
                                                        id="cpf_usuario" name="cpf_usuario" maxlength="14" required
                                                        placeholder="000.000.000-00">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status_usuario" class="form-label">Status</label>
                                                    <select class="form-select formedit placer rounded-5" id="status_usuario"
                                                        name="status_usuario" required>
                                                        <option value="A" <?php echo ($ativousuario === 'A') ? 'selected' : ''; ?>>Ativo</option>
                                                        <option value="D" <?php echo ($ativousuario === 'D') ? 'selected' : ''; ?>>Desativado</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn text-white mt-3 rounded-5"
                                                    style="background-color: #3a3b4a;margin-left: 34%" id="saveChangesBtn">
                                                    Alterar no Banco
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button
                                onclick="abrirModalJsVerMais('<?php echo $idusuario ?>','id','ModalVerMais<?php echo $idusuario ?>','A');"
                                class="Btngp bg-warning">

                                <div class="sign">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <title>Ver Mais Dados</title>
                                        <path
                                            d="M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C12.36,19.5 12.72,19.5 13.08,19.45C13.03,19.13 13,18.82 13,18.5C13,17.94 13.08,17.38 13.24,16.84C12.83,16.94 12.42,17 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12C17,12.29 16.97,12.59 16.92,12.88C17.58,12.63 18.29,12.5 19,12.5C20.17,12.5 21.31,12.84 22.29,13.5C22.56,13 22.8,12.5 23,12C21.27,7.61 17,4.5 12,4.5M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M18,14.5V17.5H15V19.5H18V22.5H20V19.5H23V17.5H20V14.5H18Z" />
                                    </svg>
                                </div>

                                <div class="text" style="font-family: 'Segoe UI Light',sans-serif">Ver Mais</div>
                            </button>
                            <div class="modal fade" style="background-color: #313348" id="ModalVerMais<?php echo $idusuario ?>"
                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog rounded-5  modal-dialog-centered">
                                    <div class="modal-content rounded-5 ">
                                        <div class="modal-body rounded-5" style="background-color: #252636">
                                            <?php if ($fotousuario != null): ?>
                                                <img style="margin-left: 40%"
                                                    src="data:<?php echo $tipoConteudo ?>;base64,<?php echo base64_encode($fotousuario) ?>"
                                                    width="100" height="100" alt="<?php echo $idusuario ?>"
                                                    title="<?php echo $idusuario ?>">
                                            <?php else: ?>
                                                Sem Foto
                                            <?php endif; ?>
                                            <input type="hidden" id="id_registro" name="id_registro">
                                            <div class="mb-3">
                                                <label for="id_regoistro" class="form-label">ID</label>
                                                <input type="text" class="form-control formvermais rounded-5" id="id_regoistro"
                                                    name="id_regoistro" value="<?php echo $idusuario ?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="data_registro" class="form-label">Nome</label>
                                                <input type="text" class="form-control formvermais rounded-5" id="data_registro"
                                                    name="data_registro" value="<?php echo $nomeusuario ?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="data_registro" class="form-label">CPF</label>
                                                <input type="text" class="form-control formvermais rounded-5" id="data_registro"
                                                    name="data_registro" value="<?php echo $cpfusuario ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <th scope="row" colspan="6" class="text-center text-white">Dados Não Encontrados!</th>
                </tr>
                <?php
            }
            ?>

        </tbody>
    </table>

    <script src="./funcoes/funcoes.js"></script>
</body>

</html>
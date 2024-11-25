<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-title" content="Leitor de QR Code Online">
    <meta name="theme-color" content="#ffffff">
    <title>Inventário Tecnokor | Leitor de Qrcode</title>
    <?php $this->insert('partials/sessoes') ?>

    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/app.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="/assets/js/camera_agrupamento.js"></script>

    <!-- INICIO Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/main.css">

    <!-- Sweet Alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <main>

        <?php $this->insert('partials/mensagens') ?>

        <div class="container">

            <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-success rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-success); --bs-nav-pills-link-active-bg: var(--bs-white);">
                <li class="nav-item" role="presentation">
                    <p class="text-white">Usuário Conectado : <?php echo $_SESSION['usuario']; ?></p>
                </li>
            </ul>

            <a href="/home"><img src="/assets/img/tecnokor.png" class="rounded mx-auto d-block imagem-responsivo"></a>
            <h1 class="font_inria" style="text-align: center;">Caixas de Agrupamento</h1>
            <br>
            <div class="box flex justify-center items-center flex-col">
                <div id="reader" style="width: 100%; max-width: 400px; position: relative;"></div>
                <div id="buttons" class="flex justify-center items-center flex-col" style="margin-top:12px;width:100%">
                    <button class="btn btn-lg btn-default font_inria" id="camerabtn" style="display: block;"><i class="glyphicon glyphicon-camera"></i> Abrir Câmera</button>
                    <button class="btn btn-lg btn-default font_inria btn-danger" style="display: none;" id="stopbtn">Fechar</button>
                    <form enctype="multipart/form-data" action="anexar" method="post" id="fileform"
                        style="width: 100%; max-width: 400px; display: block;">
                    </form>
                </div>

                <div id="error" class="text-danger" style="margin-top:12px;display:none"></div>

                <div class="font_inria" style="height: 100%; min-height: 100px; width: 100%; max-width: 400px; display: none; overflow-wrap: break-word;">
                    <div class="resultado">
                        <span class="justify-center items-center" id="result">
                            <form id="form_inventario_agrupamento" action="/caixa_agrupamento/adicionar" method="POST">

                                <label class="text-center">Depósito</label>
                                <input class="form-control text-center" type="text" id="deposito" name="deposito" readonly>
                                <label class="text-center">Seção </label>
                                <input class="form-control text-center" type="text" id="secao" name="secao" readonly>
                                <label class="text-center">Caixa</label>
                                <input class="form-control text-center" type="text" id="caixa" name="caixa" readonly>
                                <label class="text-center">Formulário</label>
                                <input class="form-control text-center" type="text" id="num_formulario" name="num_formulario" readonly>

                                <div class="modal-footer">
                                    <button class="btn btn-sm btn-success" type="submit">Adicionar</button>
                                    <button class="btn btn-sm btn-danger" type="reset">Limpar Leitura</button>
                                </div>
                            </form>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="hidden-print">
        <div class="modal-footer" style="justify-content: center;">
            <a href="/itens_leitura" target="_blank"><button class="btn btn-sm btn-primary">Relatório</button></a>
            <?php if ($_SESSION['permissao_id'] == '1') : ?>
                <a href="/usuarios"><button class="btn btn-sm btn-warning">Novo Usuário</button></a>
            <?php endif ?>
            <a href="/home"><button class="btn btn-sm btn-secondary">Leitor por Itens</button></a>
            <a href="/home_conferencia"><button class="btn btn-sm btn-info">Conferência</button></a>
            <a href="/login/sair"><button class="btn btn-sm btn-danger">Sair</button></a>
        </div>
    </footer>

    <script src="/assets/js/app.js"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script src="/assets/js/clipboard.min.js"></script>
    <script>
        if (typeof run === "function") {
            run();
        }
    </script>

</html>
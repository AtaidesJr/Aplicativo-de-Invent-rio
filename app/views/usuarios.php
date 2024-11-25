<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Inventário Tecnokor | Cadastrar Usuário</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->insert('partials/sessoes') ?>

    <link rel="icon" type="image/png" href="/assets/img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/main.css">

    <!-- Sweet Alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body>

    <?php $this->insert('partials/mensagens') ?>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="/usuarios/cadastrar" method="POST">
                    <span class="login100-form-title p-b-26">
                        <img src="/assets/img/tecnokor.png" alt="">
                    </span>
                    <span class="login100-form-title p-b-48">
                        Cadastrar Usuário
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="O Campo Não Pode Ser Vazio!">
                        <input class="input100" type="text" name="cod_usuario">
                        <span class="focus-input100" data-placeholder="Usuario"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="O Campo Não Pode Ser Vazio!">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="senha">
                        <span class="focus-input100" data-placeholder="Senha"></span>
                    </div>

                    <div class="row mb-2" style="color: #5f5f5ff5; font-family: Poppins-Medium;">
                        <label class="col-sm-8 form-label" for="basic-icon-default-message">Administrador :</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="permissao_id" id="permissao_id" value="1">
                                <label class="form-check-label " for="inlineRadio1">Sim</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="permissao_id" id="permissao_id" value="0">
                                <label class="form-check-label " for="inlineRadio2">Não</label>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center login-form-btn">
                        <button class="btn btn-success me-md-2" type="submit">Cadastrar</button>
                        <a href="/home" class="btn btn-danger"><button type="button" style="color: #fff; font-family: Poppins-Medium;">Cancelar</button></a>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <script src="/assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="/assets/vendor/animsition/js/animsition.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/popper.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/vendor/select2/select2.min.js"></script>
    <script src="/assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="/assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="/assets/vendor/countdowntime/countdowntime.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
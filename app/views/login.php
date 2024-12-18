<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<title>Inventário | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

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

</head>

<body>

	<?php
	if (isset($_SESSION['erro'])) {
	?>
		<script>
			swal.fire({
				icon: "error",
				title: "Atenção!",
				text: "<?php echo $_SESSION['erro']; ?>"
			})
		</script>
	<?php
		unset($_SESSION['erro']);
	}
	?>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="/login/logando" method="POST">
					<span class="login100-form-title p-b-26">
						<img src="/assets/img/tecnokor.png" alt="">
					</span>
					<span class="login100-form-title p-b-48">
						Inventário
						<script>
							document.write(new Date().getFullYear());
						</script>
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

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
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
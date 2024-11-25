<?php
if (isset($_SESSION['sucesso'])) {
?>
    <script>
        swal.fire({
            icon: "success",
            title: "Tudo certo!",
            text: "<?php echo $_SESSION['sucesso']; ?>"
        })
    </script>
<?php
    unset($_SESSION['sucesso']);
}
?>

<?php
if (isset($_SESSION['erro'])) {
?>
    <script>
        swal.fire({
            icon: "error",
            title: "Erro na Solicitação!",
            text: "<?php echo $_SESSION['erro']; ?>"
        })
    </script>
<?php
    unset($_SESSION['erro']);
}
?>

<?php
if (isset($_SESSION['atencao'])) {
?>
    <script>
        swal.fire({
            icon: "warning",
            title: "Atenção!",
            text: "<?php echo $_SESSION['atencao']; ?>"
        })
    </script>
<?php
    unset($_SESSION['atencao']);
}
?>

<?php
if (isset($_SESSION['atualizado'])) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        TUDO CERTO! : <strong> <?php echo $_SESSION['atualizado'] ?> </strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['atualizado']);
}
?>
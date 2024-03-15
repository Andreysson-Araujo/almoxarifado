<?php
require_once("templates/header.php")
?>

<div class="container-category">
    <br>
    <h2>Criar novo usuario</h2>
    <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
        <input type="hidden" name="type" value="register">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
        </div>
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome">
        </div>
        <div class="form-group">
            <label for="nickname">Usuario:</label>
            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="usuario">
        </div>
        <div class="form-group">
            <label for="user_is">Registrar como:</label>
            <br>
            <input type="radio" name="user_is" id="user" value="0" class="form-radio" required>
            <label for="user">Usuário</label>
            <input type="radio" name="user_is" id="adm" value="1" class="form-radio" required>
            <label for="adm">Administrador</label>
        </div>

        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha">
        </div>
        <div class="form-group">
            <label for="confirmpassword">Confirmação de Senha:</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Digite sua senha">
        </div>
        <input type="submit" id="btnbtn" class="btn card-btn" value="Registrar">
    </form>
</div>
<?php
include_once("templates/footer.php")
?>
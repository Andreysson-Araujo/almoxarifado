<?php
require_once("templates/header.php")
    ?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row" id="auth-row">
            <div class="col-md-4" id="login-container">
                <h2>Entrar</h2>
                <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
                <input type="hidden" name="type" value="login">
                    <div class="form-group">
                        <label for="nickname">Usuario:</label>
                        <input type="nickname" class="form-control" id="nickname" name="nickname" placeholder="Digite seu usuario">
                    </div>
                
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Digite sua senha">
                    </div>
                    <input type="submit" class="btn card-btn" value="Entrar">
                    <br>
                    <br>
                    <h6>Feito por : @Detin</h6>
                </form>
                
            </div>
            
        </div>
    </div>
</div>
<?php
require_once("templates/footer.php")
    ?>
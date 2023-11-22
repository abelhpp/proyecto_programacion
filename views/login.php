<?php

require_once 'controllers/loginController.php';
include 'views/includes/header_login.php';

?>

<div class="container">  

    <h3 class="text-center text-white display-4">BIBLIOTECA NACIONAL</h3>                          
    <div id="login" class="row justify-content-center align-items-center bg-light text-dark">            
        <form class="form" action="login" method="post">
            <h3 class="text-center text-dark">Inicio de Sesión</h3>
            <div class="form-group">
                <label for="usuario" class="text-dark">Correo</label><br>
                <input type="text" name="username" id="usuario" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password" class="text-dark">Password</label><br>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6LfpspQoAAAAAItnBw6f-6cMvcCH27spb-VRS6uO">

                </div>
            </div>
            <div class="form-group button text-center">                                
                <input type="submit" name="submit" class="btn btn-success btn-lg btn-block" value="Iniciar Sesión" required>
            </div>

        </form>
                                        
            <a a class="link-offset-2 link-underline link-underline-opacity-10" href="registrarse">Registrarse</a>
        
        <?php            
            if (isset($error_message)) {
                include 'views/partials/alert.php';
            }
        ?>
    </div>
</div>
<?php include 'views/includes/footer_login.php'; ?>
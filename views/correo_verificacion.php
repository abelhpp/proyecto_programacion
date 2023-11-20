<?php

    //require_once ('./controllers/emailController.php');

    $style = 'href="./assets/css/style_inicio.css"'; 
    $title = "Inicio para socios";
    include 'views/includes/headerGeneral.php';

?>
    <div class="container mt-5 alto">
        <h2 class="mb-4">Verificación de Cuenta</h2>
        <p>Por favor, ingresa el código de verificación que recibiste por correo electrónico:</p>

        <form>
            <div class="mb-3">
                <label for="codigo" class="form-label">Código de Verificación:</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>

            <button type="submit" class="btn btn-success">Verificar Cuenta</button>
        </form>

        <p class="mt-3">Si tienes algún problema, contáctanos.</p>
    </div>


<?php include 'views/includes/footerInicio.php'; ?>
<?php

    require_once ('controllers/emailController.php');

    $style = 'href="./assets/css/style_inicio.css"'; 
    $title = "Verificar Correo";
    include 'views/includes/headerGeneral.php';

?>
    <div class="container mt-5 alto">
        <h2 class="mb-4">Verificación de Cuenta</h2>
        <p>Por favor, ingresa el código de verificación que recibiste por correo electrónico:</p>

        <form class="form" action="correo" method="post">
            <div class="mb-3">
                <label for="codigo" class="form-label">Código de Verificación:</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>

            <button type="submit" class="btn btn-success btn-block">Verificar Cuenta</button>
        </form>

        <p class="mt-3">Si tienes algún problema, contáctanos.</p>
    </div>
<?php    
    if (isset($error_message)) {
        include 'views/partials/alertCor.php';
    }

    if (isset($ok_message)) {
        include 'views/partials/alertCorOK.php';
    }




    include 'views/includes/footerInicio.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php
    //config para errores
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    //Control se session
    require_once 'controllers/sessions/sessionController.php';

    require_once 'controllers/activarController.php';

    //Es el titilo del html 
    $style = 'href="./assets/css/style_inicio.css"';
    $title = "Lista de libros";
    $script = '';
    $generoButton = "";
    include('views/includes/headerGeneral.php'); 
?>

<div id="app" class="container mt-5">
        <div class="row">
                <h2>Lista de Socios</h2>
            <?php    include 'views/partiales/tabla.php'   ?> 
        </div>

        <!-- Modal para editar usuario -->
</div>

<?php include("views/includes/footer_listalibros.php"); ?>
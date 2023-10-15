<?php
// Iniciar session o genera error
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a una página de inicio de sesión, por ejemplo:
header('Location: login.php');
exit();
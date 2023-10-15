<?php
    // Genera un valor único para el token (puedes personalizar esto)
    $uniqueValue = uniqid();

    // Hashea el valor único para crear el token
    $token = password_hash($uniqueValue, PASSWORD_DEFAULT);
    
    $infoDb = $usuarioModel->tokenCreate($_SESSION["id"], $token);

    $_SESSION["token"] = $token;
    






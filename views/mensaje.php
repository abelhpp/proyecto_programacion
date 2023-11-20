<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluir Bootstrap CSS -->    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Tu propio CSS personalizado -->
    <link rel="stylesheet" href="assets/css/style_general.css">
    <title>Correo de Verificación</title>
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
        }

        .verification-code {
            background-color: #f0f0f0;
            padding: 10px;
            font-size: 1.2em;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
    <div class="container">
        <h2>Correo de Verificación</h2>
        <p>Gracias por registrarte. Para completar el proceso de registro, utiliza el siguiente código de verificación:</p>

        <div class="verification-code">
            <strong>Código de Verificación:</strong> XXXXXX
        </div>

        <p>Ingresa este código en la aplicación o sitio web para verificar tu cuenta.</p>

        <p>¡Gracias!</p>
    </div>
</body>
</html>
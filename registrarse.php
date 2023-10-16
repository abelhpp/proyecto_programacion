<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'controllers/registrarseController.php';
?>
<?php include 'views/includes/headerInicio.php'; ?>
    <div class="container">
    <p class="fs-2 text-center">Registro Nuevo socio</p>
    
    <form method="POST" action="registrarse.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Nombres</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class ="form-control" id="apellido" name="apellido" required>
    </div>
    <div class="mb-3">
        <label for="dni" class="form-label">DNI</label>
        <input type="number" class="form-control" id="dni" name="dni" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Frente del DNI</label>
        <input class="form-control" type="file" id="formFile" name="dni_front" required>
    </div>
    <button type="submit" class="btn btn-primary">Registrarse</button>
</form>
    </div>
</body>
</html>

<?php include 'views/includes/footerInicio.php'; ?>

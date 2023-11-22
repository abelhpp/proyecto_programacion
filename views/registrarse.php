<?php 
require_once 'controllers/registrarseController.php';
include 'views/includes/header_login.php';
?>
<div class="container">  

<h3 class="text-center text-white display-4">Registro Nuevo socio</h3>                          
<div id="login" class="row justify-content-center align-items-center bg-light text-dark">            

    <div class="container main">
        <p class="fs-2 text-center"></p>
        
        <form method="POST" onsubmit="return validarFormulario();" action="registrarse" enctype="multipart/form-data">
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
            <div class="form-group button text-center">                                
                <input type="submit" name="submit" class="btn btn-success btn-lg btn-block" value="REGISTRARSE" required>
            </div>
        </form>

        <a a class="link-offset-2 link-underline link-underline-opacity-10" href="login">VOLVER</a>
    </div>
</div>
</div>
<?php    
    if (isset($error_message)) {
        include 'views/partials/alertReg.php';
    }
    if (isset($emal_validar)) {
        include 'views/partials/alertRegOK.php';
    }
?>
    


<?php include 'views/includes/footerReg.php'; ?>

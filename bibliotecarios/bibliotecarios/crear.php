<?php include ("../templates/header.php"); ?>
<br/>

<?php
$txtID = isset($_POST['txtID']) ? $_POST['txtID'] : null;
$txtNombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$txtApellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
$txtDni = isset($_POST['dni']) ? $_POST['dni'] : null;
$txtEmail = isset($_POST['email']) ? $_POST['email'] : null;
$txtPassword = isset($_POST['password']) ? $_POST['password'] : null;
$txtFecha = isset($_POST['fechadeingreso']) ? $_POST['fechadeingreso'] : null;
$txtFoto = isset($_POST['foto']) ? $_POST['foto'] : null;
$txtActivado = isset($_POST['activado']) ? $_POST['activado'] : null;
$txtToken = isset($_POST['token']) ? $_POST['token'] : null;
$txtRol = isset($_POST['rol']) ? $_POST['rol'] : null;
$accion = isset($_POST['accion']) ? $_POST['accion'] : null;

include("../bd.php");

switch($accion){

    case "Agregar":
    
    $sentenciaSQL=$conexion->prepare("INSERT INTO `usuarios`(`id`, `nombre`, `apellido`, `email`, `contraseña`, `fecha_registro`, `fotocopia_dni`, 
`activado`, `token`, `roles_id`)VALUES (null,:nombre, :apellido, :email, :contraseña, :fecha_registro, :fotocopia_dni, 
:activado, :token, :roles_id);");

        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':apellido', $txtApellido);
        $sentenciaSQL->bindParam(':email', $txtEmail);
        $sentenciaSQL->bindParam(':contraseña', $txtPassword);
        $sentenciaSQL->bindParam(':fecha_registro', $txtFecha);
        $sentenciaSQL->bindParam(':fotocopia_dni', $txtFoto);
        $sentenciaSQL->bindParam(':activado', $txtActivado);
        $sentenciaSQL->bindParam(':token', $txtToken);
        $sentenciaSQL->bindParam(':roles_id', $txtRol);
        $sentenciaSQL->execute();
    break;

    case "Modificar":

        $sentenciaSQL=$conexion->prepare("UPDATE  usuarios SET nombre=:nombre, apellido=:apellido,  email=:email, contraseña=:contraseña,
        fecha_registro=:fecha_registro, fotocopia_dni=:fotocopia_dni, activado=:activado, token=:token, roles_id=:roles_id;
         WHERE id=:id");
        
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':apellido', $txtApellido);
        $sentenciaSQL->bindParam(':email', $txtEmail);
        $sentenciaSQL->bindParam(':contraseña', $txtPassword);
        $sentenciaSQL->bindParam(':fecha_registro', $txtFecha);
        $sentenciaSQL->bindParam(':fotocopia_dni', $txtFoto);
        $sentenciaSQL->bindParam(':activado', $txtActivado);
        $sentenciaSQL->bindParam(':token', $txtToken);
        $sentenciaSQL->bindParam(':roles_id', $txtRol);
        $sentenciaSQL->execute();
    break;

    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $listaBibliotecarios=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':apellido', $txtApellido);
        $sentenciaSQL->bindParam(':email', $txtEmail);
        $sentenciaSQL->bindParam(':contraseña', $txtPassword);
        $sentenciaSQL->bindParam(':fecha_registro', $txtFecha);
        $sentenciaSQL->bindParam(':fotocopia_dni', $txtFoto);
        $sentenciaSQL->bindParam(':activado', $txtActivado);
        $sentenciaSQL->bindParam(':token', $txtToken);
        $sentenciaSQL->bindParam(':roles_id', $txtRol);
        $sentenciaSQL->execute();

    
    break;

    case "Borrar":
        $sentenciaSQL=$conexion->prepare("DELETE FROM usuarios WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

    break;

}

   $sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios");
   $sentenciaSQL->execute();
   $listaBibliotecarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>




<div class="card">
    <div class="card-header">
        <h3>Datos del Bibliotecario:</h3>
    </div>
    <!--bs5-form-input (AGREGAR CAMPO para FORM) -->
    <div class="card-body">
        <!--multipart/form-data (SIRVE PARA AGREGAR ARCHIVOS AL FORM) -->
        <form action="" method="post" enctype="multipart/form-data">
        <div class = "form-group">
            <label for="txtID">ID</label>
            <input type="text" class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" placeholder="ID">
        </div>
    
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text"
            class="form-control" value="<?php echo $txtNombre;?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre">
        </div>
     
        <div class="mb-3">
          <label for="apellido" class="form-label">Apellido: </label>
          <input type="text"
            class="form-control" value="<?php echo $txtApellido;?>" name="apellido" id="apellido" aria-describedby="helpId" placeholder="Apellido">
        </div>
        <div class="mb-3">
          <label for="dni" class="form-label">DNI: </label>
          <input type="text"
            class="form-control" value="<?php echo $txtDni;?>" name="dni" id="dni" aria-describedby="helpId" placeholder="DNI">
        </div>
       
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="text"
            class="form-control" value="<?php echo $txtEmail;?>" name="email" id="email" aria-describedby="helpId" placeholder="Email">
        </div>

        <div class="mb-3">
          <label for="contraseña" class="form-label">Contraseña</label>
          <input type="text"
            class="form-control" value="<?php echo $txtPassword;?>" name="contraseña" id="contraseña" aria-describedby="helpId" placeholder="contraseña">
        </div>
        <div class="mb-3">
          <label for="fecha_registro" class="form-label">Fecha de ingreso:</label>
          <input type="date" value="<?php echo $txtFecha;?>" class="form-control" name="fecha_registro" id="fecha_registro" aria-describedby="emailHelpId" placeholder="Fecha de ingreso">
        </div>
        <!--Campo para adjuntar archivo -->
        <div class="mb-3">
          <label for="" class="form-label">Fotocopia de DNI:</label>
          <input type="file"
            class="form-control" value="<?php echo $txtFoto;?>" name="foto" id="fotocopia_dni" aria-describedby="helpId" placeholder="Foto">
        </div>
        <!--bs5-form-Selec-Custom (SIRVE PARA TENER CONTENIDOS DESPLEGABLE EN UN CAMPO)-->
        <div class="mb-3">
            <label for="" class="form-label">Activado:</label>
            <!--OPCIONES DESPLEGABLES -->
            <select class="form-select form-select-sm" value="<?php echo $txtActivado;?>" name="activado" id="activado">
                <option selected></option>
                <option value="">Si</option>
                <option value="">No</option>
            </select>
        </div>
        <div class="mb-3">
          <label for="token" class="form-label">Token:</label>
          <input type="text"
            class="form-control" value="<?php echo $txtToken;?>" name="token" id="token" aria-describedby="helpId" placeholder="Ingrese Token">
        </div>

        <div class="mb-3">
          <label for="rol" class="form-label">Roles:</label>
          <input type="text"
            class="form-control" value="<?php echo $txtRol;?>" name="rol" id="rol" aria-describedby="helpId" placeholder="Rol">
        </div>

        <button type="submit" class="btn btn-success">Agregar registro</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">
      
    </div>
</div>

<?php include ("../templates/footer.php"); ?>

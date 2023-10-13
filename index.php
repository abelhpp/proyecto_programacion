<?php include ('config/init.php'); ?>
<?php include ('views/home.php'); ?>

<?php
    //Ejemplo de un ingreso en usuarios
    
    require_once 'models/usuarioModel.php';
    //Importo model
    
    $usuarioModel = new UsuarioModel();
    $result = $usuarioModel->registrarNuevoUsuario(31121592, 'abel humberto', 'paz','1234','abelipes@gmail.com', '2023-12-21', 'dni8', 1,1);
    echo 'enviado';
    echo $result;
?>
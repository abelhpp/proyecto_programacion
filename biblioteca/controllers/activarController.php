<?php

use function PHPSTORM_META\type;

require_once 'models/activarModel.php';
$activarModel = new activarModel();

$resultado = $activarModel->getSocios();

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    if ($activarModel->getActivar($id)) {
        $activarModel->getDesactivar($id);
    }
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit;

}

?>
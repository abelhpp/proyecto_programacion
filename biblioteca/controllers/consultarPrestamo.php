<?php require ("../models/lista_reservas_Model.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $id = $_POST['id'];
    $Reservas = new Loans_Model();
    $consulta = $Reservas->consultarPrestamo($id);
    echo json_encode($consulta);
}

?>
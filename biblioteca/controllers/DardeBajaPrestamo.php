<?php require ("../models/lista_reservas_Model.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $Reservas = new Loans_Model();
    $Reservas->__construct();
    $mensaje = $Reservas->darBajaReserva($id);
}
?>
<script>
    alert("<?php echo $mensaje; ?>");
    window.history.back();
</script>
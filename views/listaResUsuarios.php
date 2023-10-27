
<?php include("./includes/header_listaResUsuarios.php");?>
<?php 
    include_once ("../models/lista_reservas_Model.php");

    $Reservas = new Loans_Model();

    $resultado = $Reservas->consultartabla();
    // echo 'consultada la base';
    echo  json_encode($resultado);

?>
<div class="container py-3">
    <div class="row justify-content-start">
        <div class="col-auto">
            <h1 class="text-center p-3">Prestamos</h1>
        </div>
    </div>
    <table class="table table-lg table-hover">
        <thead class="table-dark">
            <tr>
                <th class="text-center">id</th>
                <th class="text-center">fecha_prestamo</th>
                <th class="text-center">fecha_vencimiento</th>
                <th class="text-center">email</th>
                <th class="text-center col-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $fila) { ?>
            <tr>
                <td><?php echo $fila["id"]; ?> </td>
                <td><?php echo $fila["fecha_prestamo"]; ?> </td>
                <td><?php echo $fila["fecha_vencimiento"]; ?></td>
                <td><?php echo $fila["email"]; ?> </td>
                <td>
                    <a class="btn btn-success" data-bs-id="<?= $fila["id"];?>" data-bs-toggle="modal" data-bs-target="#ConfirmarModal">Confirmar Retiro</a>
                    <a class="btn btn-danger" data-bs-id="<?= $fila["id"];?>" data-bs-toggle="modal" data-bs-target="#BajaModal">Dar de Baja</a>
                    <a class="btn btn-primary" data-bs-id="<?= $fila["id"];?>" data-bs-toggle="modal" data-bs-target="#DetalleModal">Detalles</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php include './Modal_Confirm.php'; ?>
</div>
<?php include './Modal_Baja.php'; ?>
<?php include './Modal_Detalles.php'; ?>
<script><?php include '../assets/js/reservas.js'; ?></script>

<?php include("./includes/footer_listaResUsuarios.php");?>
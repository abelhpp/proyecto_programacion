<?php
session_start();
$conn = new mysqli("localhost", "root", "", "biblioteca");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idLibro = $_POST["idLibro"];
    $cantidad = $_POST["cantidad"];
    $cantidadMAX = $_POST["cantidadMAX"];
    $descripcion = $_POST["descripcion"];
    $usuarios_id = $_SESSION["id"]; // Asume que has almacenado el ID del usuario en la sesión 

    if ($cantidadMAX == 0){
        echo "Este libro no posee stock, por lo tanto no se puede eliminar.";
    } else {
        if ($cantidadMAX < $cantidad){
            $cantidad = $cantidadMAX;
        }
    
        // Actualizar la cantidad en stock_libros
        $sqlUpdateStock = $conn->prepare("UPDATE stock_libros SET cantidad = cantidad - ? WHERE libros_id = ?");
        $sqlUpdateStock->bind_param("ii", $cantidad, $idLibro);
    
        // Insertar el movimiento en movimientos_admin
        $sqlInsertMovimiento = $conn->prepare("INSERT INTO movimientos_admin (cantidad, fecha, hora, descripcion, libros_id, usuarios_id) VALUES (?, CURDATE(), CURTIME(), ?, ?, ?)");
        $sqlInsertMovimiento->bind_param("issi", $cantidad, $descripcion, $idLibro, $usuarios_id);
    
        $conn->begin_transaction();
    
        if ($sqlUpdateStock->execute() && $sqlInsertMovimiento->execute()) {
            $conn->commit();
            $mensaje = "Baja de libro realizada correctamente";
        } else {
            $conn->rollback();
            $mensaje = "Error al realizar la baja: $conn->error";
        }
    
        $sqlUpdateStock->close();
        $sqlInsertMovimiento->close();
    }

}

$conn->close();
?>

<script>
    alert("<?php echo $mensaje; ?>");
    window.history.back();
    // LO DEBO REDIRIGIR A LA PAGINA DE LISTAS
</script>
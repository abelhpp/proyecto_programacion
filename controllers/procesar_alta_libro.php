<?php
// Conexión a la base de datos utilizando mysqli
$conn = new mysqli("localhost", "root", "", "biblioteca");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $cantidad = $_POST["cantidad"];
    $autores_id = $_POST["autores_id"];
    $generos_id = $_POST["generos_id"];
    $descripcion = $_POST["descripcion"];
    $foto = $_POST["foto"];

    $sql = "INSERT INTO libros (nombre, foto, fecha_registro, descripcion, autores_id, generos_id) VALUES ('$nombre', '$foto', NOW(), '$descripcion', $autores_id, $generos_id)";

    if ($conn->query($sql) === TRUE) {
        $idLibro = $conn->insert_id; // Obtiene el ID del libro recién creado
        $sql2 = "INSERT INTO stock_libros (cantidad, libros_id) VALUES ('$cantidad', '$idLibro')";
        
        if ($conn->query($sql2) === TRUE) {
            $mensaje = "Libro y stock agregados correctamente";
        } else {
            $mensaje = "Error al agregar el stock: " . $sql2 . "<br>" . $conn->error;
        }
    } else {
        $mensaje = "Error al agregar el libro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>

<script>
    alert("<?php echo $mensaje; ?>");
    window.history.back();
    // LO DEBO REDIRIGIR A LA PAGINA DE LISTAS
</script>
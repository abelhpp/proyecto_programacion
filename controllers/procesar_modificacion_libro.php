<?php
$conn = new mysqli("localhost", "root", "", "biblioteca");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idLibro = $_POST["idLibro"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $autores_id = $_POST["autores_id"];
    $generos_id = $_POST["generos_id"];

    $sql = $conn->prepare("UPDATE libros SET nombre = ?, descripcion = ?, autores_id = ?, generos_id = ? WHERE id = ?");
    $sql->bind_param("ssiis", $nombre, $descripcion, $autores_id, $generos_id, $idLibro);

    if ($sql->execute()) {
        $mensaje = "Libro modificado correctamente";
    } else {
        $mensaje = "Error: " . $sql->error;
    }

    $sql->close();
}

$conn->close();
?>

<script>
    alert("<?php echo $mensaje; ?>");
    window.history.back();
    // LO DEBO REDIRIGIR A LA PAGINA DE LISTAS
    
</script>
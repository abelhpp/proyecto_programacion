<?php
// Comprueba si hay resultados

    echo '<table class="table table-striped">';
        echo '<tr>';
                echo    '<th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Imagen</th>
                        <th>fecha</th>
                        <th class="text-center">Acciones</th>';
        echo '</tr>';
if (mysqli_num_rows($resultado) > 0) {    
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Convierte la imagen en base64 para mostrarla en la etiqueta img
        $imagenBase64 = base64_encode($fila['dni_img']);
         // Formatea la fecha
        $fechaFormateada = date('d-m-Y', strtotime($fila['fecha']));
        echo '<tr>';
        echo "<td>{$fila['nombre']}</td>";
        echo "<td>{$fila['apellido']}</td>";
        echo "<td>{$fila['email']}</td>";
        echo "<td>{$fechaFormateada}</td>";
        
        
        echo '<td><div class="imgDiv" style="width: 100%;">';
        echo '<img class="img-thunail" src="data:image/jpeg;base64,' . $imagenBase64 . '" alt="Imagen">';
        echo '</div></td>';
        
        

        echo '<td>';
        if ($fila['activo'] == 0) {
            echo '<a class="btn btn-primary" href="activar.php?id='.$fila['id'].'"  >Activar</a>';
        } else {
            echo '<a class="btn btn btn-danger" href="activar.php?id='.$fila['id'].'"  >Desactivar</a>';
        }
        echo '</td>';
        
        echo '</tr>';
    }
    
    echo '</table>';
} else {
    echo 'No se encontraron resultados.';
}
?>


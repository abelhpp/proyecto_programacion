<?php session_start();?>
<?php

//Head y header 
$style = 'href="./assets/css/style_listalibros.css"';
$title = "Lista de libros";
$generoButton = "";

include("views/includes/headerGeneral.php");?>
<?php 
    include_once 'models/lista-libros-Model.php';

    $lista_libros = new lista_libros();

    $resultado = $lista_libros->consultartabla();
    // echo 'consultada la base';
    // echo  json_encode($resultado);

?>
<div class="container-tabla-dinamica">
    <h1 class="text-center p-3">Libros</h1>

    <div class="responsive-button d-grid col-6 p-4 mx-auto"><a class="btn btn-success btn-lg" href="altalibro.php">Agregar nuevo Libro</a></div> <!-- modificar href hacia la pag-->

    <div class="table-responsive-sm table-hover col-10 mx-auto " id="Tabla-consulta">
        <table class="table table-hover vertical-align: middle; table-fixed">
            <thead class="text-muted">
                <tr style="width: 680px">
                    <th class="text-center">id</th>
                    <th class="text-center">libro</th>
                    <th class="text-center">foto</th>
                    <th class="text-center">descripcion</th>
                    <th class="text-center">autor</th>
                    <th class="text-center">genero</th>
                    <th class="text-center col-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $fila) { ?>
                <tr>
                    <td><?php echo $fila["id"]; ?> </td>
                    <td><?php echo $fila["nombre"]; ?> </td>
                    <td><?php echo "<img src='". $fila["foto"]."'width='100'>"; ?></td>
                    <td><?php echo $fila["descripcion"]; ?> </td>
                    <td><?php echo $fila["autor"]; ?> </td>
                    <td><?php echo $fila["genero"]; ?> </td>
                    <td><div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" href="modificar_libro.php?id=<?php echo $fila['id'];?>">Editar</a>
                        <a class="btn btn-danger" href="baja_libro.php?id=<?php echo $fila['id'];?>">Dar de baja</a> <!-- modificar href hacia pagina -->
                    </td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("views/includes/footer_listalibros.php");?>

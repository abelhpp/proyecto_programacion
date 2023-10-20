<?php include("includes/header_bajalibro.php");?>

<div class="container">
    <h1>Confirmar Baja de Libro</h1>
    <form action="./controllers/procesar_baja_libro.php" method="post">

        <p>¿Estás seguro de que deseas dar de baja el libro "<span id="nombreLibro"></span>"?</p>
        <!-- <p>Stock actual del libro es de: "<span id="cantidadMAX"></span></p> -->
        
        <input type="hidden" id="idLibro" name="idLibro">
        <input type="hidden" id="cantidadMAX" name="cantidadMAX">
        
        <div class="form-group">
            <label for="cantidad">Cantidad a dar de baja:</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Motivo de baja:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger mt-3">Confirmar Baja</button>
        <a class="btn btn-secondary  mt-3" href="listalibros.php">Cancelar</a>
    </form>
</div>

<?php include("includes/footer_bajalibro.php");?>
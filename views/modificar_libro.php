





<script src="./assets/js/altalibro.js"></script>
<?php include("includes/header_modificarlibro.php");?>

<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Modificar Libro</h2>
                <form action="./controllers/procesar_modificacion_libro.php" method="POST">
                    
                    <div class="form-group">
                        <label for="idLibro">ID del Libro:</label>
                        <div id="idLibroVer" class="form-control" readonly></div>
                    </div>                    

                    <input type="hidden" id="idLibro" name="idLibro">
                    
                    <div class="form-group">
                        <label for="nombre">Nombre del Libro:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="foto">URL de la Foto:</label>
                        <input type="text" class="form-control" id="foto" name="foto" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="autor">Autor:</label>
                        <select class="form-control" id="autor" name="autores_id" required>
                            <!-- <option value="" disabled selected>Loading...</option> -->
                            <script>
                                obtenerAutores().then(function(data) {
                                    data.forEach(function(autor) {
                                        document.getElementById('autor').innerHTML += `<option value="${autor.id}">${autor.nombre}</option>`;
                                    });
                                });
                            </script>
                        </select>
                    </div>
                                        
                    <div class="form-group">
                        <label for="genero">Género:</label>
                        <select class="form-control" id="genero" name="generos_id" required>
                            <!-- <option value="" disabled selected>Loading...</option> -->
                            <script>
                                obtenerGeneros().then(function(data) {
                                    data.forEach(function(genero) {
                                        document.getElementById('genero').innerHTML += `<option value="${genero.id}">${genero.nombre}</option>`;
                                    });
                                });
                            </script>
                        </select>
                    </div>
                
                    <button type="submit" class="btn btn-primary mt-2">Guardar Cambios</button>
                    <a class="btn btn-secondary  mt-2" href="listalibros.php">Cancelar</a>

                </form>
            </div>
        </div>
    </div>

<?php include("includes/footer_modificarlibro.php");?>
<?php
    //config para errores
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    //Control se session
    require_once 'controllers/sessions/sessionController.php';

    //Head y header 
    $style = 'href="./assets/css/style_inicio.css"';
    $title = "Lista de libros";
    $script = '<script src="./assets/js/altalibro.js"></script>';
    $generoButton = "";
    include('views/includes/headerGeneral.php'); 
?>

<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Alta de Libro</h2>
                <!-- Formulario de alta de libro -->
                <form action="./controllers/procesar_alta_libro.php" method="POST">

                    <div class="form-group">
                        <label for="nombre">Nombre del Libro:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="cantidad">Cantidad de Libros:</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>

                    <div class="form-group">
                        <label for="autor">Autor:</label>
                        <select class="form-control" id="autor" name="autores_id" required>
                            <option value="">Selecciona un autor</option>

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
                            <option value="">Selecciona un género</option>

                            <script>
                                obtenerGeneros().then(function(data) {
                                    data.forEach(function(genero) {
                                        document.getElementById('genero').innerHTML += `<option value="${genero.id}">${genero.nombre}</option>`;
                                    });
                                });
                            </script>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto:</label>
                        <input type="text" class="form-control" id="foto" name="foto" value="https://images.cdn3.buscalibre.com/fit-in/360x360/ea/11/ea11992d6ed7462b9ebd9bd2e7ba6231.jpg" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Agregar Libro</button>
                    <a class="btn btn-secondary  mt-2" href="listaLibros.php">Volver</a>

                    <div class="border border-primary border-top m-4"></div>

                    <div class="form-group">
                        <label for="nuevoAutor">Nuevo Autor:</label>
                        <input type="text" class="form-control" id="nuevoAutor" name="nuevoAutor">
                        <button type="button" class="btn btn-primary mt-2" onclick="agregarNuevoAutor()">Agregar Autor</button>
                    </div>

                    <div class="border border-primary border-top m-4"></div>

                    <div class="form-group">
                        <label for="nuevoGenero">Nuevo Género:</label>
                        <input type="text" class="form-control" id="nuevoGenero" name="nuevoGenero">
                        <button type="button" class="btn btn-primary mt-2" onclick="agregarNuevoGenero()">Agregar Género</button>
                    </div>

                </form>

                <div class="border border-primary border-top m-4"></div>

                <div class="form-group">
                    <label for="eliminarAutor">Eliminar Autor:</label>
                    <select class="form-control" id="eliminarAutor" name="eliminarAutor">
                        <option value="">Selecciona un autor</option>

                        <script>
                            obtenerAutores().then(function(data) {
                                data.forEach(function(autor) {
                                    document.getElementById('eliminarAutor').innerHTML += `<option value="${autor.id}">${autor.nombre}</option>`;
                                });
                            });
                        </script>

                    </select>

                    <button type="button" class="btn btn-danger mt-2" onclick="eliminarAutor()">Eliminar Autor</button>
                </div>

                <div class="border border-primary border-top m-4"></div>

                <div class="form-group">
                    <label for="eliminarGenero">Eliminar Género:</label>
                    <select class="form-control" id="eliminarGenero" name="eliminarGenero">
                        <option value="">Selecciona un género</option>

                        <script>
                            obtenerGeneros().then(function(data) {
                                data.forEach(function(genero) {
                                    document.getElementById('eliminarGenero').innerHTML += `<option value="${genero.id}">${genero.nombre}</option>`;
                                });
                            });
                        </script>

                    </select>

                    <button type="button" class="btn btn-danger mt-2" onclick="eliminarGenero()">Eliminar Género</button>
                </div>

            </div>
        </div>
    </div>
<?php include("includes/footer_listalibros.php"); ?>
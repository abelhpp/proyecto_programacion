<!-- Es el titilo del html -->
<?php $style = 'href="./assets/css/style_inicio.css"'; ?>
<?php $title = "Detalle de libro"?>
<?php $generoButton = "disabled"?>
<!-- header General -->
<?php include 'views/includes/headerGeneral.php'; ?>


<!-- Modal -->
<div class="modal fade" id="prestamoModal" tabindex="-1" aria-labelledby="prestamoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirModalLabel">Prestamo exitoso.</h5>
                <button type="button" class="btn-close" @click="irMisPrestamos" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Su prestamo fue exitoso, pase por biblioteca a retirar el libro con su numero de prestamo.
            </div>
            <div class="col-md-12" id="botones-modal">
                <div class="col-md-4" >
                    <button type="button" @click="irMisPrestamos" class="btn-modal">
                        Aceptar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="col-12 container-btn-volver">
        <button class="btn btn-secondary" @click="irInicio()">Volver Inicio</button>
    </div>

    <div class="row libro-container">
        <div class="col-md-6 libro-detalle" v-if="libro">
            <div class="row">
                <div class="col-md-6 foto-container-detalle">
                    <img :src="libro.foto" class="card-img-detalle" :alt="libro.titulo">
                </div>
                <div class="col-md-6" id="libro-detalles-col2">
                    <div class="card-body-detalles">
                        <h5 class="card-title">Titulo: {{ libro.nombre }}</h5>
                        <h5 class="card-text">Autor/a: {{ buscarAutor(libro.autores_id) }}</h5>
                        <h5 class="card-text" v-if="libro.descripcion">Descripción: {{ libro.descripcion }}</h5>
                    </div>
                    <div class="container-btn-reservar">
                        <button class="btn btn-primary btn-reservar" @click="reservar(libro.id, <?php echo $_SESSION['id']; ?>)" :disabled="parseInt(libro.cantidad) === 0">Reservar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</div>

<?php include 'views/includes/footerDetallesLibro.php'; ?>
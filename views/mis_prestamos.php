

<!-- Es el titilo del html -->
<?php $style = 'href="./assets/css/style_inicio.css"'; ?>
<?php $title = "Inicio para socios"?>
<?php $generoButton = "disabled"?>

<?php include 'views/includes/headerGeneral.php'; ?>

<div class="container">
    <div class="col-12 container-btn-volver">
        <button class="btn btn-secondary" @click="irInicio()">Volver Inicio</button>
    </div>
    <div class="row libro-container">
        <div class="row" style="min-height: 58vh;">
            <div class="col-md-12 prestamo-cards" v-if="prestamos && prestamos.length > 0">
                <div class="col-md-3 prestamo-card" v-for="prestamo in prestamos" :key="prestamo.id">
                    <h2>{{ prestamo.nombre_libro }}</h2>
                    <p><strong>№ de Préstamo:</strong> {{ prestamo.id }}</p>
                    <p><strong>Fecha de Préstamo:</strong> {{ prestamo.fecha_prestamo }}</p>
                    <p><strong>Fecha de Vencimiento:</strong> {{ prestamo.fecha_vencimiento }}</p>
                    <p><strong>Autor:</strong> {{ prestamo.nombre_autor }}</p>
                    <!-- <p><strong>Retirado:</strong> {{ prestamo.fue_retirado === 1 ? 'Sí' : 'No' }}</p> -->
                    <p><strong>Retirado:</strong> {{ prestamo.fue_retirado === 1 ? 'Sí' : (prestamo.fue_retirado === 0 ? 'No' : 'En espera') }}</p>
                    <button class="btn btn-secondary" @click="descargarPDF(prestamo.id)">Descargar PDF</button>

                </div>
            </div>
            <div class="col-md-12 prestamo-cards" v-else>
                <div class="col-md-3 prestamo-card" style="min-height: 49vh;">
                    <h2>El cliente no tiene prestamos disponibles</h2>
                </div>
            </div>

        </div>
    </div>
</div>




<?php include 'views/includes/footerMisPrestamos.php'; ?>
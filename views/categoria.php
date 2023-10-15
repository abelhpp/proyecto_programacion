<?php include 'views/includes/headerCategoria.php'; ?>

<div class="container">
    <div class="col-12 container-btn-volver">
        <button class="btn btn-secondary" @click="irInicio()">Volver</button>
    </div>
    <h1>Libros de {{genero.nombre}}</h1>
    <div class="generos">
        <div class="col-md-3" v-for="libro in librosFiltrados">
            <div class="card">
                <img :src="libro.foto" class="card-img-top" :alt="libro.titulo">
                <div class="card-body">
                    <h5 class="card-title">{{ libro.nombre }}</h5>
                    <h5 class="card-text">{{ buscarAutor(libro.autores_id) }}</h5>
                </div>
                <div>
                    <button class="btn btn-primary" @click="irDetalles(libro.id)">Ver Detalles</button>
                </div>
            </div>
        </div>
    </div>
</div>



</div>

<?php include 'views/includes/footerCategoria.php'; ?>
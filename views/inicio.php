
<?php


?>




<!-- Es el titilo del html -->
<?php $style = 'href="./assets/css/style_inicio.css"'; ?>
<?php $title = "Inicio para socios"?>


<?php include 'views/includes/headerGeneral.php'; ?>
<div class="container mt-3">
            <div class="row">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" v-model="libroBuscado"
                        placeholder="¿Qué libro estás buscando?" @input="buscarLibros">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>

            <div class="row" id="searchResults"
                v-if="libroBuscado && libroBuscado.length > 0 && librosFiltrados && librosFiltrados.length > 0">
                <h3>Resultados de la busqueda</h3>
                <div class="col-md-3" v-for="libro in librosFiltrados">
                    <div class="card mb-4 shadow-sm">
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
            <div v-if="libroBuscado && libroBuscado.length > 0 && librosFiltrados.length == 0" id="no-encontrado">
                <h4>No se encontró ningun libro</h4>
            </div>
        </div>

        <div class="container" v-if="librosRecientes.length > 0" id="recientes">
            <h2>Libros Recientes</h2>
            <div id="librosRecientesCarousel" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item" v-for="(chunk, index) in chunkedLibrosRecientes"
                        :class="{ active: index === 0 }">
                        <div class="row">
                            <div class="col-md-3" v-for="libro in chunk">
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
                <a class="carousel-control-prev" href="#librosRecientesCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#librosRecientesCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>




        <div class="container" v-if="datosCargados && generos.length > 0">
            <div class="row">
                <div class="col-md-12" v-for="genero in generos" :key="genero.id">
                    <!-- <h2>Libros de {{ genero.nombre }}</h2> -->
                    <h2 style="cursor: pointer;" @click="irCategoria(genero.id)">{{ 'Libros de ' + genero.nombre }}</h2>
                    <div :id="'librosCarousel-' + genero.id" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="carousel-item"
                                v-for="(libroChunk, index) in chunkedLibrosFiltradosPorGenero(genero.id)"
                                :class="{ active: index === 0 }">
                                <div class="row">
                                    <div class="col-md-3" v-for="libro in libroChunk">
                                        <!-- Mostrar un libro diferente en cada iteración -->
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
                        <button class="carousel-control-prev" type="button"
                            :data-bs-target="'#librosCarousel-' + genero.id" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            :data-bs-target="'#librosCarousel-' + genero.id" data-bs-slide="next">
                            <span class="carousel-control-next-icon" ariahidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>

<?php include 'views/includes/footerInicio.php'; ?>
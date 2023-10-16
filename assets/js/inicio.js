const app = Vue.createApp({
    data() {
        return {
            libros: [],
            librosFiltrados: [],
            librosRecientes: [],
            chunkedLibrosRecientes: [],
            libroBuscado: null,
            datosCargados: false,
            autores: [],
            generos: [],
            carousels: {},
        };
    },
    methods: {
        chunkArray(array, chunkSize) {
            const chunked = [];
            for (let i = 0; i < array.length; i += chunkSize) {
                chunked.push(array.slice(i, i + chunkSize));
            }
            return chunked;
        },
        libroChunkedFiltradosPorGenero(generoId) {
            const librosFiltrados = this.librosFiltradosPorGenero(generoId);
            return this.chunkArray(librosFiltrados, 4);
        },
        chunkedLibrosFiltradosPorGenero(generoId) {
            if (this.libros.length === 0) {
                return [];
            }
            // Filtra los libros por género
            const librosFiltrados = this.libros.filter(libro => libro.generos_id === generoId);
            // console.log(librosFiltrados);
            const chunkedLibros = [];
            for (let i = 0; i < librosFiltrados.length; i += 4) {
                chunkedLibros.push(librosFiltrados.slice(i, i + 4));
            }
            return chunkedLibros;
        },
        async obtenerLibros() {
            try {
                const APIuno = 1;
                const response = await fetch(`http://localhost/proyecto_programacion/librosAPI.php?APIs=${APIuno}`);
                const data = await response.json();
                data.sort((a, b) => new Date(b.fecha_registro) - new Date(a.fecha_registro));
                this.librosRecientes = data.slice(0, 8); // Obtener los 8 libros más recientes
                // console.log(this.librosRecientes);
                this.libros = data;
                console.log(this.libros);
            } catch (error) {
                console.error('Error al obtener los libros:', error);
            }
        },

        async obtenerAutores() {
            try {
                const APIdos = 2;
                const response = await fetch(`http://localhost/proyecto_programacion/librosAPI.php?APIs=${APIdos}`);
                const data = await response.json();
                this.autores = data;
            } catch (error) {
                console.error('Error al obtener los autores:', error);
            }
        },
        async obtenerGeneros() {
            try {
                const APItres = 3;
                const response = await fetch(`http://localhost/proyecto_programacion/librosAPI.php?APIs=${APItres}`);
                const data = await response.json();
                this.generos = data;
            } catch (error) {
                console.error('Error al obtener los géneros:', error);
            }
        },
        async cargarDatos() {
            await this.obtenerAutores();
            await this.obtenerGeneros();
            await this.obtenerLibros();

            // Divide los libros recientes en grupos de 4
            this.chunkedLibrosRecientes = this.chunkArray(this.librosRecientes, 4);
            this.datosCargados = true;
        },
        toggleAutoresMenu() {
            var autoresDropdown = document.getElementById("autores-dropdown");
            autoresDropdown.classList.toggle("show");
        },
        toggleGenerosMenu() {
            var generosDropdown = document.getElementById("generos-dropdown");
            generosDropdown.classList.toggle("show");
        },
        quitarTildes(cadena) {
            return cadena.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        },
        buscarLibros() {
            const libroBuscado = this.quitarTildes(this.libroBuscado.toLowerCase());
            this.librosFiltrados = [];
            this.libros.forEach(libro => {
                if (this.quitarTildes(libro.nombre.toLowerCase()).includes(libroBuscado)) {
                    this.librosFiltrados.push(libro);
                }
            });
        },
        buscarAutor(autorId) {
            const autoresEncontrados = this.autores.filter(autor => autor.id === autorId).map(autor => autor.nombre);
            return autoresEncontrados[0];
        },
        librosFiltradosPorGenero(generoId) {
            if (this.libros.length === 0) {
                return [];
            }
            // Filtra los libros por género
            const librosFiltrados = this.libros.filter(libro => libro.generos_id === generoId);
            // console.log(librosFiltrados);
            return librosFiltrados;
        },
        irCategoria(generoId) {
            window.location.href = `categoria.php?generoId=${generoId}`;
        },
        irDetalles(libroId){
            window.location.href = `detalles_libro.php?id=${libroId}`;
        },

    },
    mounted() {
        this.cargarDatos();

    },
});

app.mount('#app');
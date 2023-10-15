const app = Vue.createApp({
    data() {
        return {
            libros: [],
            librosFiltrados: [],
            generos: [],
            autores: [],
            genero: {},
            generoId: null,
            datosCargados: false,
        };
    },
    methods: {
        async obtenerLibros() {
            try {
                const response = await fetch('http://localhost/proyecto_programacion/controllers/libros.php');
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
                const response = await fetch('http://localhost/proyecto_programacion/controllers/autores.php');
                const data = await response.json();
                this.autores = data;
            } catch (error) {
                console.error('Error al obtener los autores:', error);
            }
        },
        async obtenerGeneros() {
            try {
                const response = await fetch('http://localhost/proyecto_programacion/controllers/generos.php');
                const data = await response.json();
                this.generos = data;
            } catch (error) {
                console.error('Error al obtener los géneros:', error);
            }
        },
        toggleAutoresMenu() {
            var autoresDropdown = document.getElementById("autores-dropdown");
            autoresDropdown.classList.toggle("show");
        },
        toggleGenerosMenu() {
            var generosDropdown = document.getElementById("generos-dropdown");
            generosDropdown.classList.toggle("show");
        },
        irDetalles(libroId){
            window.location.href = `detalles_libro.php?id=${libroId}`;
        },
        irInicio(){
            window.location.href = 'inicio.php';
        },
        filtrarLibrosPorGenero() {
            this.librosFiltrados = this.libros.filter(libro => libro.generos_id === this.generoId);
            console.log(this.librosFiltrados);
            this.genero = this.generos.find(genero => genero.id == this.generoId);
            this.datosCargados = true;
        },
        buscarAutor(autorId) {
            const autoresEncontrados = this.autores.filter(autor => autor.id === autorId).map(autor => autor.nombre);
            return autoresEncontrados[0];
        },
    },
    async mounted() {
        await this.obtenerLibros();
        await this.obtenerGeneros();
        await this.obtenerAutores();

        const urlParams = new URLSearchParams(window.location.search);
        this.generoId = urlParams.get("generoId");
        this.filtrarLibrosPorGenero();
    },
});

app.mount('#app');


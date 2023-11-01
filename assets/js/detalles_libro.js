const app = Vue.createApp({
    data() {
        return {
            libros: [],
            librosFiltrados: [],
            autores: [],
            generos: [],
            libro: {},
            libroId: null,
            datosCargados: false,
        };
    },
    methods: {
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
        toggleAutoresMenu() {
            var autoresDropdown = document.getElementById("autores-dropdown");
            autoresDropdown.classList.toggle("show");
        },
        toggleGenerosMenu() {
            var generosDropdown = document.getElementById("generos-dropdown");
            generosDropdown.classList.toggle("show");
        },
        irInicio(){
            window.location.href = 'index.php';
        },
        irMisPrestamos(){
            window.location.href = 'mis_prestamos.php';
        },
        encontrarLibro() {
            this.libro = this.libros.find(libro => libro.id == this.libroId);
            this.datosCargados = true;
        },
        buscarAutor(autorId) {
            const autoresEncontrados = this.autores.filter(autor => autor.id === autorId).map(autor => autor.nombre);
            return autoresEncontrados[0];
        },
        async reservar(libroId, usuarioId) {
            try {
                console.log("ENTRO A RESERVAR");
                
                // Crear un objeto con los datos a enviar
                const data = {
                    libros_id: libroId,
                    usuarios_id: usuarioId,
                };
        
                console.log(data);
        
                const response = await fetch('http://localhost/proyecto_programacion/controllers/prestamos.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });
        
                if (response.ok) {
                    this.modal.show();
                } else {
                    console.error('Error al reservar el libro: ' + response.status);
                }
            } catch (error) {
                console.error('Error en la solicitud: ' + error);
            }
        }
        
        
    },
    async mounted() {
        await this.obtenerLibros();
        await this.obtenerAutores();
        await this.obtenerGeneros();

        const urlParams = new URLSearchParams(window.location.search);
        this.libroId = urlParams.get("id");
        this.encontrarLibro();

        this.modal = new bootstrap.Modal(document.getElementById('prestamoModal'));
    },
});

app.mount('#app');

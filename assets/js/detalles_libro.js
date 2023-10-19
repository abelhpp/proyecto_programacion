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
            prestamos: [],
            devoluciones: [],
            prestar: null,
        };
    },
    methods: {
        puedePrestar(libroId) {
            const maxLibrosSinDevolver = 3; // Máximo de libros sin devolver permitidos

            //Filtrar los préstamos activos
            const prestamosActivos = this.prestamos.filter(prestamo => prestamo.fue_retirado === 1);
            // console.log("PRESTAMOS ACTIVOS:", JSON.stringify(prestamosActivos));

            const prestamosActivosDelLibro = prestamosActivos.filter(prestamo => String(prestamo.libros_id) === String(libroId));
            // console.log("PRESTAMOS ACTIVOS DEL LIBRO: ", JSON.stringify(prestamosActivosDelLibro));

            const devolucionesDelLibro = this.devoluciones.filter(devolucion => String(devolucion.libros_id) === String(libroId))
            // console.log("Devoluciones del libro: " + JSON.stringify(devolucionesDelLibro));
            // console.log("LONGITUD DE ACTIVOS: " + prestamos)
            if(devolucionesDelLibro.length < prestamosActivosDelLibro.length) {
                console.log("Ya tienes un prestamo con este libro sin devolver.");
                this.prestar = false;
                return false
            }

            const cantidadLibrosSinDevolver = prestamosActivos.length - this.devoluciones.length
            // Verificar si el usuario ya tiene 3 o más libros en espera por retirar
            const prestamosEnEspera = this.prestamos.filter(prestamo => prestamo.fue_retirado === null);
            console.log("LIBROS EN ESPERA:", JSON.stringify(prestamosEnEspera));
            if (prestamosEnEspera.length + cantidadLibrosSinDevolver >= maxLibrosSinDevolver) {
                // console.log("El usuario tiene 3 o más libros en espera por retirar o prestados");
                this.prestar = false; // No puede prestar más libros
                return false;
            }

            const libroEnEspera = prestamosEnEspera.filter(prestamo => String(prestamo.libros_id) === String(libroId))
            // console.log("LIBRO EN ESPERA: " + JSON.stringify(libroEnEspera));

            if(libroEnEspera.length > 0){
                console.log("Ya tienes este libro para retirar.");
                this.prestar = false;
                return false;
            }
            console.log("El usuario puede prestar el libro");
            this.prestar = true; // No puede prestar más libros
            return true;
        },

        async obtenerPrestamos() {
            try {
                const response = await fetch('http://localhost/proyecto_programacion/controllers/prestamos.php');
                const data = await response.json();
                this.prestamos = data;
            } catch (error) {
                console.error('Error al obtener los prestamos:', error);
            }
        },
        async obtenerDevoluciones() {
            try {
                const response = await fetch('http://localhost/proyecto_programacion/controllers/devoluciones.php');
                const data = await response.json();
                this.devoluciones = data;
            } catch (error) {
                console.error('Error al obtener las devoluciones:', error);
            }
        },
        async obtenerLibros() {
            try {
                const response = await fetch('http://localhost/proyecto_programacion/controllers/libros.php');
                const data = await response.json();
                data.sort((a, b) => new Date(b.fecha_registro) - new Date(a.fecha_registro));
                this.librosRecientes = data.slice(0, 8); // Obtener los 8 libros más recientes
                // console.log(this.librosRecientes);
                this.libros = data;
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
        irInicio() {
            window.location.href = 'inicio.php';
        },
        irMisPrestamos() {
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
                    // this.modal.show();
                    console.log("Reserva exitosa.")
                } else {
                    console.error('Error al reservar el libro: ' + response.status);
                }
            } catch (error) {
                console.error('Error en la solicitud: ' + error);
            }
        }


    },
    async mounted() {
        await this.obtenerPrestamos();
        await this.obtenerDevoluciones();
        await this.obtenerLibros();
        await this.obtenerAutores();
        await this.obtenerGeneros();

        const urlParams = new URLSearchParams(window.location.search);
        this.libroId = urlParams.get("id");
        this.encontrarLibro();
        this.puedePrestar(this.libroId);

        this.modal = new bootstrap.Modal(document.getElementById('prestamoModal'));
    },
});

app.mount('#app');

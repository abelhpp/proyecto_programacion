const app = Vue.createApp({
    data() {
        return {
            prestamos: [],
        };
    },
    methods: {
        async obtenerPrestamos(usuarioId) {
            try {
                const response = await fetch(`http://localhost/proyecto_programacion/controllers/prestamos.php?usuario_id=${usuarioId}`);
                const data = await response.json();
                // Aquí puedes manejar los datos de los préstamos obtenidos
                this.prestamos = data;
                console.log(data);
                console.log("hola")
                console.log(this.prestamos);
            } catch (error) {
                console.error('Error al obtener los préstamos:', error);
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
    },
    async mounted() {
        await this.obtenerPrestamos(1);
    },
});

app.mount('#app');
const app = Vue.createApp({
    data() {
        return {
            prestamos: [],
            usuarioId: null,
        };
    },
    methods: {
        async obtenerPrestamos(usuarioId) {
            try {
                const response = await fetch(`http://localhost/proyecto_programacion/controllers/prestamos.php?usuario_id=${usuarioId}`);
                const data = await response.json();
                // Aquí puedes manejar los datos de los préstamos obtenidos
                this.prestamos = data;
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
        this.usuarioId = usuarioId;
        console.log(this.usuarioId);
        // await this.obtenerPrestamos();
        await this.obtenerPrestamos(this.usuarioId);
    },
});

app.mount('#app');
const { jsPDF } = window.jspdf;



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
        // async descargarPDF(prestamoId){
        //     try {
        //         const response = await fetch('http://localhost/proyecto_programacion/controllers/descargarPDF.php?prestamo_id=' + prestamoId);
        //         const data = await response.json();
        //         // Aquí puedes manejar los datos de los préstamos obtenidos
        //         // this.prestamos = data;
        //         console.log(data);
        //     } catch (error) {
        //         console.error('Error al obtener los préstamos:', error);
        //     }
        // }
        async descargarPDF(prestamoId) {
            try {
                // Obtener datos del servidor
                const response = await fetch('http://localhost/proyecto_programacion/controllers/descargarPDF.php?prestamo_id=' + prestamoId);
                const data = await response.json();
                
                if (data.length > 0) {
                    // Crear un nuevo objeto jsPDF
                    const pdf = new jsPDF();
                
                    // Definir las coordenadas iniciales para el contenido del PDF
                    let y = 10;
                
                    // Agregar encabezado
                    pdf.text(10, y, 'Información del préstamo:');
                    y += 10;
                
                    // Recorrer los datos y agregar información al PDF
                    for (const prestamo of data) {
                        pdf.text(10, y, `ID del préstamo: ${prestamo.id}`);
                        y += 10;
                        pdf.text(10, y, `Nombre del libro: ${prestamo.nombre_libro}`);
                        y += 10;
                        pdf.text(10, y, `Nombre del autor: ${prestamo.nombre_autor}`);
                        y += 20; // Espacio entre los registros
                    }
                
                    // Generar un nombre de archivo único para el PDF
                    const fileName = `prestamo_${prestamoId}.pdf`;
                
                    // Descargar el PDF
                    pdf.save(fileName);
                
                    console.log('PDF generado y descargado con éxito.');
                } else {
                    console.error('No se encontraron datos de préstamo.');
                }
            } catch (error) {
                console.error('Error al obtener los préstamos:', error);
            }
        }
        
        
        
        
        
    },
    async mounted() {
        this.usuarioId = usuarioId;
        console.log(this.usuarioId);
        // await this.obtenerPrestamos();
        await this.obtenerPrestamos(this.usuarioId);
    },
});

app.mount('#app');